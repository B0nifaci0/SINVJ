<?php

namespace App\Http\Controllers;
use App\Shop;
use App\User;
use App\Sale;
use App\Status;
use App\Branch;
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
        $ids = $user->branch_id;
        $branches_col = Branch::select('*')
        ->where('id',$ids)
        ->get();
        //return $branches_col;

    //CONSULTAS PARA ADMINISTRADORES
       //SUMA TOTAL DE GRAMOS EXISTENTES
      $gramos_existentes = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->where('lines.shop_id', Auth::user()->shop->id)  
      ->where('categories.shop_id', Auth::user()->shop->id)  
      ->where('categories.type_product',2) 
      ->where('products.deleted_at', NULL)
      ->select('products.weigth as total_ex' ,'products.status_id as existente', DB::raw('SUM(products.weigth) as total_ex'))
      ->where('products.status_id',2)
      ->sum('products.weigth');

    //SUMA TOTAL DE GRAMOS TRASPASADOS
      $gramos_traspasado = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->where('lines.shop_id', Auth::user()->shop->id)  
      ->where('categories.shop_id', Auth::user()->shop->id)  
      ->where('categories.type_product',2) 
      ->where('products.deleted_at', NULL)
      ->select('products.weigth as total_ex' ,'products.status_id as trapasado', DB::raw('SUM(products.weigth) as total_traspasado'))
      ->where('products.status_id',3)
      ->sum('products.weigth');

      //SUMA TOTAL DE GRAMOS DAÑADOS
      $gramos_dañados = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->where('lines.shop_id', Auth::user()->shop->id)  
      ->where('categories.shop_id', Auth::user()->shop->id)  
      ->where('categories.type_product',2) 
      ->where('products.deleted_at', NULL)
      ->select('products.weigth as total_dañados' ,'products.status_id as dañados',)
      ->where('products.status_id',4) 
      ->sum('products.weigth');

    //SUMA TOTAL DE GRAMOS
        $total = $gramos_existentes + $gramos_traspasado  + $gramos_dañados;

        /**return response()->json([
          'gramos_existen'=>$gramos_existentes,
          'gramos_traspasados'=>$gramos_traspasado,
          'gramos_dañados'=>$gramos_dañados,
          'total' => $gramos_existentes + $gramos_traspasado  + $gramos_dañados,
          ]);**/

        //return $gramos_d;
       //SUMA TOTAL DE DINERO EN PRODUCTOS POR GRAMOS

        //SUMA TOTAL DE DINERO EN PRODUCTOS POR GRAMOS EXISTENTES
       $ventas_e = Shop::join('products','products.shop_id','shops.id')
       ->join('categories','categories.id','products.category_id')
       ->join('statuss','statuss.id','products.status_id')
       ->join('branches','branches.id','products.branch_id')
       ->join('lines','lines.id','products.line_id')
       ->where('products.status_id',2)
       ->where('products.deleted_at', NULL)
       ->where('lines.shop_id', Auth::user()->shop->id)  
       ->where('categories.type_product',2) 
       ->sum('products.price');

       //SUMA TOTAL DE DINERO EN PRODUCTOS POR GRAMOS TRASPASADOS
       $ventas_t = Shop::join('products','products.shop_id','shops.id')
       ->join('categories','categories.id','products.category_id')
       ->join('statuss','statuss.id','products.status_id')
       ->join('branches','branches.id','products.branch_id')
       ->where('products.status_id',3)
       ->where('products.deleted_at', NULL)
       ->where('products.shop_id', Auth::user()->shop->id)  
       ->where('categories.type_product',2) 
       ->sum('products.price');

       //SUMA TOTAL DE DINERO EN PRODUCTOS POR GRAMOS DAÑADOS
       $ventas_d = Shop::join('products','products.shop_id','shops.id')
       ->join('categories','categories.id','products.category_id')
       ->join('statuss','statuss.id','products.status_id')
       ->join('branches','branches.id','products.branch_id')
       ->where('products.status_id',4)
       ->where('products.deleted_at', NULL)
       ->where('products.shop_id', Auth::user()->shop->id)  
       ->where('categories.type_product',2) 
       ->sum('products.price');

       $ventas = $ventas_e + $ventas_t + $ventas_d;

    //CONSULTAS PARA SUB-ADIMINISTRADORES Y COLABORADORES
       //SUMA TOTAL DE GRAMOS

      //SUMA TOTAL DE GRAMOS EXISTENTES
      $gramos_cole = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->where('products.status_id',2)
      ->where('products.deleted_at', NULL)
      ->where('lines.shop_id', Auth::user()->shop->id)  
      ->where('categories.type_product',2) 
      ->where('products.branch_id',$ids)
      ->sum('products.weigth');

      //SUMA TOTAL DE GRAMOS TRASPASADOS
      $gramos_colt = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->where('products.status_id',3)
      ->where('lines.shop_id', Auth::user()->shop->id)  
      ->where('categories.type_product',2)
      ->where('products.deleted_at', NULL)
      ->where('products.branch_id',$ids)
      ->sum('products.weigth');

      //SUMA TOTAL DE GRAMOS DAÑADOS
      $gramos_cold = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->where('products.status_id',4)
      ->where('lines.shop_id', Auth::user()->shop->id)  
      ->where('categories.type_product',2) 
      ->where('products.branch_id',$ids)
      ->where('products.deleted_at', NULL)
      ->sum('products.weigth');

      $gramos_col = $gramos_cole + $gramos_colt + $gramos_cold;

    //CONSULTAS PARA ADMINISTRADORES
 
       //SUMA TOTAL DE PIEZAS EXISTENTES
       $piezas_e = Shop::join('products','products.shop_id','shops.id')
       ->join('categories','categories.id','products.category_id')
       ->join('statuss','statuss.id','products.status_id')
       ->join('branches','branches.id','products.branch_id')
       ->where('products.deleted_at', NULL)
       ->where('categories.type_product',1)
       ->where('categories.shop_id', Auth::user()->shop->id) 
       ->where('products.status_id',2) 
       ->count('products.id');
 
       //SUMA TOTAL DE PIEZAS TRASPASADAS
       $piezas_t = Shop::join('products','products.shop_id','shops.id')
       ->join('categories','categories.id','products.category_id')
       ->join('statuss','statuss.id','products.status_id')
       ->join('branches','branches.id','products.branch_id')
       ->where('products.status_id',3)
       ->where('products.deleted_at', NULL)
       ->where('categories.shop_id', Auth::user()->shop->id) 
       ->where('categories.type_product',1)
       ->count('products.id');
 
       //SUMA TOTAL DE PIEZAS DAÑADAS
       $piezas_d = Shop::join('products','products.shop_id','shops.id')
       ->join('categories','categories.id','products.category_id')
       ->join('statuss','statuss.id','products.status_id')
       ->join('branches','branches.id','products.branch_id')
       ->where('products.status_id',4)
       ->where('products.deleted_at', NULL)
       ->where('categories.shop_id', Auth::user()->shop->id) 
       ->where('categories.type_product',1)  
       ->count('products.id');

       $piezas = $piezas_e + $piezas_t + $piezas_d;
 
        //SUMA TOTAL DE DINERO EN PRODUCTOS POR PIEZA
 
         //SUMA TOTAL DE DINERO EN PRODUCTOS POR PIEZA EXISTENTES
        $pieza_vente = Shop::join('products','products.shop_id','shops.id')
        ->join('categories','categories.id','products.category_id')
        ->join('statuss','statuss.id','products.status_id')
        ->join('branches','branches.id','products.branch_id')
        ->where('products.status_id',2)
        ->where('products.deleted_at', NULL)
        ->where('categories.shop_id', Auth::user()->shop->id)
        ->where('categories.type_product',1) 
        ->sum('products.price');
 
        //SUMA TOTAL DE DINERO EN PRODUCTOS POR PIEZA TRASPASADOS
        $pieza_ventt = Shop::join('products','products.shop_id','shops.id')
        ->join('categories','categories.id','products.category_id')
        ->join('statuss','statuss.id','products.status_id')
        ->join('branches','branches.id','products.branch_id')
        ->where('products.status_id',3)
        ->where('products.deleted_at', NULL)
        ->where('categories.shop_id', Auth::user()->shop->id)
        ->where('categories.type_product',1) 
        ->sum('products.price');
 
        //SUMA TOTAL DE DINERO EN PRODUCTOS POR PIEZA DAÑADOS
        $pieza_ventd = Shop::join('products','products.shop_id','shops.id')
        ->join('categories','categories.id','products.category_id')
        ->join('statuss','statuss.id','products.status_id')
        ->join('branches','branches.id','products.branch_id')
        ->where('products.status_id',4)
        ->where('products.deleted_at', NULL)
        ->where('categories.shop_id', Auth::user()->shop->id)
        ->where('categories.type_product',1) 
        ->sum('products.price');

        $pieza_vent = $pieza_vente + $pieza_ventt + $pieza_ventd;
 
    //CONSULTAS PARA SUB ADIMINISTRADORES Y COLABORADORES
        //SUMA TOTAL DE PIEZAS
 
       //SUMA TOTAL DE PIEZAS EXISTENTES
       $piezas_cole = Shop::join('products','products.shop_id','shops.id')
       ->join('categories','categories.id','products.category_id')
       ->join('statuss','statuss.id','products.status_id')
       ->join('branches','branches.id','products.branch_id')
       ->where('products.status_id',2)
       ->where('products.deleted_at', NULL)
       ->where('categories.shop_id', Auth::user()->shop->id) 
       ->where('categories.type_product',1) 
       ->where('products.branch_id',$ids)
       ->count('products.id');
 
       //SUMA TOTAL DE PIEZAS TRASPASADAS
       $piezas_colt = Shop::join('products','products.shop_id','shops.id')
       ->join('categories','categories.id','products.category_id')
       ->join('statuss','statuss.id','products.status_id')
       ->join('branches','branches.id','products.branch_id')
       ->where('products.status_id',3)
       ->where('categories.shop_id', Auth::user()->shop->id)
       ->where('categories.type_product',1)
       ->where('products.deleted_at', NULL)
       ->where('products.branch_id',$ids)
       ->count('products.id');
 
       //SUMA TOTAL DE PIEZAS DAÑADAS
       $piezas_cold = Shop::join('products','products.shop_id','shops.id')
       ->join('categories','categories.id','products.category_id')
       ->join('statuss','statuss.id','products.status_id')
       ->join('branches','branches.id','products.branch_id')
       ->where('products.status_id',4)
       ->where('categories.shop_id', Auth::user()->shop->id) 
       ->where('categories.type_product',1) 
       ->where('products.branch_id',$ids)
       ->where('products.deleted_at', NULL)
       ->count('products.id');

       $piezas_col = $piezas_cole + $piezas_colt + $piezas_cold;
        
        return view ('Principal/principal',compact('gramos_dañados','gramos_traspasado','pieza_vent','piezas_cold','piezas_col','piezas_cole','piezas_colt','pieza_vente','pieza_ventt','pieza_ventd','piezas_e','piezas_t','piezas_d','piezas','gramos_colt','gramos_cole','gramos_cold','ventas_d','ventas_t','ventas_e','branches_col','gramos_col','branches','branch','user','shop','shops','gramos_existentes','ventas','gramos_dañados','total'));
    }

    public function exportPdf(){
        $total = User::sum('salary');
        $branch = Auth::user()->shop->id;
        $user = Auth::user();
        $branch = Shop::find($branch)->branches()->get();
        $pdf  = PDF::loadView('Principal.pdf', compact('branch', 'user', 'total'));
        return $pdf->download('Principal.pdf');
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
