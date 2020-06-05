<?php

namespace App\Http\Controllers;
use App\Shop;
use App\User;
use App\Sale;
use App\Status;
use App\Branch;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\S3ImageManager;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;


class PrincipalController extends Controller
{
    use S3ImageManager;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shop = Auth::user()->shop;
        $total = User::sum('salary');
        $branch = Auth::user()->shop->id;
        $user = Auth::user();
        $branch = Shop::find($branch)->branches()->get();
        $shops = Auth::user()->shop()->get();

        if($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $branches= Auth::user()->shop->branches;

        //Consulta para sacar el id de la sucursal a la que pertenezca el usuario
        $ids = $user->branch_id;

        $branches_col = Branch::select('*')
        ->where('id',$ids)
        ->get();
        //return $branches_col;

    //CONSULTAS PARA ADMINISTRADORES
       //SUMA TOTAL DE GRAMOS EXISTENTES
      $gramos_existentes = Product::join('categories','categories.id','products.category_id')
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',2)
      ->where('products.deleted_at', NULL)
      ->where('products.status_id',2)
      ->select('products.weigth as total_ex' ,'products.status_id as existente', DB::raw('SUM(products.weigth) as total_ex'))
      ->where('products.status_id',2)
      ->sum('products.weigth');

    //SUMA TOTAL DE GRAMOS TRASPASADOS
      $gramos_traspasado = Product::join('categories','categories.id','products.category_id')
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',2)
      ->where('products.deleted_at', NULL)
      ->select('products.weigth as total_ex' ,'products.status_id as trapasado', DB::raw('SUM(products.weigth) as total_traspasado'))
      ->where('products.status_id',3)
      ->sum('products.weigth');
      //return $gramos_traspasado;

      //SUMA TOTAL DE GRAMOS DAÑADOS
      $gramos_dañados = Product::join('categories','categories.id','products.category_id')
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',2)
      ->where('products.status_id',4)
      ->where('products.deleted_at', NULL)
      ->select('products.weigth as total_dañados' ,'products.status_id as dañados')
      ->sum('products.weigth');

      //SUMA TOTAL DE GRAMOS DEVUELTOS
      $gramos_devueltos = Product::join('categories','categories.id','products.category_id')
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',2)
      ->where('products.discar_cause', 3)
      ->where('products.restored_at', null)
      ->withTrashed()
      ->sum('products.weigth');
      //return $gramos_devueltos;

    //SUMA TOTAL DE GRAMOS
        $total = $gramos_existentes + $gramos_traspasado  + $gramos_dañados + $gramos_devueltos;

        /**return response()->json([
          'gramos_existen'=>$gramos_existentes,
          'gramos_traspasados'=>$gramos_traspasado,
          'gramos_dañados'=>$gramos_dañados,
          'total' => $gramos_existentes + $gramos_traspasado  + $gramos_dañados,
          ]);**/

        //return $gramos_d;
       //SUMA TOTAL DE DINERO EN PRODUCTOS POR GRAMOS

        //SUMA TOTAL DE DINERO EN PRODUCTOS POR GRAMOS EXISTENTES
       $ventas_e = Product::join('categories','categories.id','products.category_id')
       ->where('products.status_id',2)
       ->where('products.deleted_at', NULL)
       ->where('products.shop_id', Auth::user()->shop->id)
       ->where('categories.type_product',2)
       ->sum('products.discount');

       //SUMA TOTAL DE DINERO EN PRODUCTOS POR GRAMOS TRASPASADOS
       $ventas_t = Product::join('categories','categories.id','products.category_id')
       ->where('products.status_id',3)
       ->where('products.deleted_at', NULL)
       ->where('products.shop_id', Auth::user()->shop->id)
       ->where('categories.type_product',2)
       ->sum('products.discount');

       //SUMA TOTAL DE DINERO EN PRODUCTOS POR GRAMOS DAÑADOS
       $ventas_d = Product::join('categories','categories.id','products.category_id')
       ->where('products.status_id',4)
       ->where('products.deleted_at', NULL)
       ->where('products.shop_id', Auth::user()->shop->id)
       ->where('categories.type_product',2)
       ->sum('products.discount');

       //SUMA TOTAL DE DINERO EN PRODUCTOS POR GRAMOS DEVUELTOS
      $ventas_devueltos = Product::join('categories','categories.id','products.category_id')
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',2)
      ->where('products.discar_cause', 3)
      ->where('products.restored_at', null)
      ->withTrashed()
      ->sum('products.discount');
      //return $ventas_devueltos;

       $ventas = $ventas_e + $ventas_t + $ventas_d + $ventas_devueltos;

    //CONSULTAS PARA SUB-ADIMINISTRADORES Y COLABORADORES
       //SUMA TOTAL DE GRAMOS

      //SUMA TOTAL DE GRAMOS EXISTENTES
      $gramos_cole = Product::join('categories','categories.id','products.category_id')
      ->where('products.status_id',2)
      ->where('products.deleted_at', NULL)
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',2)
      ->where('products.branch_id',$ids)
      ->sum('products.weigth');

      //SUMA TOTAL DE GRAMOS TRASPASADOS
      $gramos_colt = Product::join('categories','categories.id','products.category_id')
      ->where('products.status_id',3)
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',2)
      ->where('products.deleted_at', NULL)
      ->where('products.branch_id',$ids)
      ->sum('products.weigth');

      //SUMA TOTAL DE GRAMOS DAÑADOS
      $gramos_cold = Product::join('categories','categories.id','products.category_id')
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',2)
      ->where('products.branch_id',$ids)
      ->where('products.status_id',4)
      ->where('products.deleted_at', NULL)
      ->sum('products.weigth');

      //SUMA TOTAL DE GRAMOS DEVUELTOS
      $gramos_coldev = Product::join('categories','categories.id','products.category_id')
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',2)
      ->where('products.branch_id',$ids)
      ->where('products.discar_cause', 3)
      ->where('products.restored_at', null)
      ->withTrashed()
      ->sum('products.weigth');
      //return $gramos_coldev;

      $gramos_col = $gramos_cole + $gramos_colt + $gramos_cold + $gramos_coldev;

    //CONSULTAS PARA ADMINISTRADORES

       //SUMA TOTAL DE PIEZAS EXISTENTES
       $piezas_e = Product::join('categories','categories.id','products.category_id')
       ->where('products.deleted_at', NULL)
       ->where('categories.type_product',1)
       ->where('products.shop_id', Auth::user()->shop->id)
       ->where('products.status_id',2)
       ->count('products.id');

       //SUMA TOTAL DE PIEZAS TRASPASADAS
       $piezas_t = Product::join('categories','categories.id','products.category_id')
       ->where('products.status_id',3)
       ->where('products.deleted_at', NULL)
       ->where('products.shop_id', Auth::user()->shop->id)
       ->where('categories.type_product',1)
       ->count('products.id');

       //SUMA TOTAL DE PIEZAS DAÑADAS
       $piezas_d = Product::join('categories','categories.id','products.category_id')
       ->where('products.status_id',4)
       ->where('products.deleted_at', NULL)
       ->where('products.shop_id', Auth::user()->shop->id)
       ->where('categories.type_product',1)
       ->count('products.id');

       $piezas_devueltos = Product::join('categories','categories.id','products.category_id')
       ->where('products.shop_id', Auth::user()->shop->id)
       ->where('categories.type_product',1)
       ->where('products.discar_cause', 3)
       ->where('products.restored_at', null)
       ->withTrashed()
       ->count('products.id');
       //return $piezas_devueltos;

       $piezas = $piezas_e + $piezas_t + $piezas_d + $piezas_devueltos;

        //SUMA TOTAL DE DINERO EN PRODUCTOS POR PIEZA

         //SUMA TOTAL DE DINERO EN PRODUCTOS POR PIEZA EXISTENTES
        $pieza_vente = Product::join('categories','categories.id','products.category_id')
        ->where('products.status_id',2)
        ->where('products.deleted_at', NULL)
        ->where('products.shop_id', Auth::user()->shop->id)
        ->where('categories.type_product',1)
        ->sum('products.discount');

        //SUMA TOTAL DE DINERO EN PRODUCTOS POR PIEZA TRASPASADOS
        $pieza_ventt = Product::join('categories','categories.id','products.category_id')
        ->where('products.status_id',3)
        ->where('products.deleted_at', NULL)
        ->where('products.shop_id', Auth::user()->shop->id)
        ->where('categories.type_product',1)
        ->sum('products.discount');

        //SUMA TOTAL DE DINERO EN PRODUCTOS POR PIEZA DAÑADOS
        $pieza_ventd = Product::join('categories','categories.id','products.category_id')
        ->where('products.status_id',4)
        ->where('products.deleted_at', NULL)
        ->where('products.shop_id', Auth::user()->shop->id)
        ->where('categories.type_product',1)
        ->sum('products.discount');

        $piezas_ventdev = Product::join('categories','categories.id','products.category_id')
       ->where('products.shop_id', Auth::user()->shop->id)
       ->where('categories.type_product',1)
       ->where('products.discar_cause', 3)
       ->where('products.restored_at', null)
       ->withTrashed()
       ->sum('products.discount');
       //return $piezas_ventdev;

        $pieza_vent = $pieza_vente + $pieza_ventt + $pieza_ventd + $piezas_ventdev;

    //CONSULTAS PARA SUB ADIMINISTRADORES Y COLABORADORES
        //SUMA TOTAL DE PIEZAS

       //SUMA TOTAL DE PIEZAS EXISTENTES
       $piezas_cole = Product::join('categories','categories.id','products.category_id')
       ->where('products.status_id',2)
       ->where('products.deleted_at', NULL)
       ->where('products.shop_id', Auth::user()->shop->id)
       ->where('categories.type_product',1)
       ->where('products.branch_id',$ids)
       ->count('products.id');

       //SUMA TOTAL DE PIEZAS TRASPASADAS
       $piezas_colt = Product::join('categories','categories.id','products.category_id')
       ->where('products.status_id',3)
       ->where('products.shop_id', Auth::user()->shop->id)
       ->where('categories.type_product',1)
       ->where('products.deleted_at', NULL)
       ->where('products.branch_id',$ids)
       ->count('products.id');

       //SUMA TOTAL DE PIEZAS DAÑADAS
       $piezas_cold = Product::join('categories','categories.id','products.category_id')
       ->where('products.shop_id', Auth::user()->shop->id)
       ->where('categories.type_product',1)
       ->where('products.branch_id',$ids)
       ->where('products.status_id',4)
       ->where('products.deleted_at', NULL)
       ->count('products.id');

       //SUMA TOTAL DE PIEZAS DEVUELTAS
      $piezas_coldev = Product::join('categories','categories.id','products.category_id')
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',1)
      ->where('products.branch_id',$ids)
      ->where('products.discar_cause', 3)
      ->where('products.restored_at', null)
      ->withTrashed()
      ->count('products.id');
      //return $piezas_coldev;

       $piezas_col = $piezas_cole + $piezas_colt + $piezas_cold + $piezas_coldev;

        return view ('Principal/principal',compact('ventas_devueltos','gramos_coldev','piezas_devueltos','piezas_ventdev','piezas_coldev','gramos_devueltos','gramos_dañados','gramos_traspasado','pieza_vent','piezas_cold','piezas_col','piezas_cole','piezas_colt','pieza_vente','pieza_ventt','pieza_ventd','piezas_e','piezas_t','piezas_d','piezas','gramos_colt','gramos_cole','gramos_cold','ventas_d','ventas_t','ventas_e','branches_col','gramos_col','branches','branch','user','shop','shops','gramos_existentes','ventas','gramos_dañados','total'));
    }

    public function exportPdf(){
        $total = User::sum('salary');
        $branch = Auth::user()->shop->id;
        $user = Auth::user();
        $branch = Shop::find($branch)->branches()->get();
        $pdf  = PDF::loadView('Principal.pdf', compact('branch', 'user', 'total'));
        return $pdf->stream('Principal.pdf');
      }
    /**
     * Funciones para el reporte de nomina
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shop = Auth::user()->shop;

        return view('Shop/edit', compact('shop'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function download(){
            $pdf = PDF::loadVIEW('principal');
            return $pdf->download();
    }
}
