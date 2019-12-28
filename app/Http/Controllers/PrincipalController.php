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
       //SUMA TOTAL DE GRAMOS
      $gramos = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->where('lines.shop_id', Auth::user()->shop->id)  
      ->where('categories.shop_id', Auth::user()->shop->id)  
      ->where('categories.type_product',2) 
      ->where('products.deleted_at', NULL)
      ->select(DB::raw('SUM(products.weigth) as total_w'))
      ->orWhere('products.status_id',2)
      ->Where('products.status_id',3)
      ->orWhere('products.status_id',4)
      ->get();
     // return $gramos;

      //SUMA TOTAL DE GRAMOS EXISTENTES
      $gramos_e = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->where('products.deleted_at', NULL)
      ->where('lines.shop_id', Auth::user()->shop->id)
      ->where('categories.shop_id', Auth::user()->shop->id)    
      ->where('categories.type_product',2)
      ->select(DB::raw('SUM(products.weigth) as total_w'))
      ->where('products.status_id',2)
      ->get();
      //return $gramos_e;

      //SUMA TOTAL DE GRAMOS TRASPASADOS
      $gramos_t = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->where('products.deleted_at', NULL)
      ->where('lines.shop_id', Auth::user()->shop->id) 
      ->where('categories.shop_id', Auth::user()->shop->id)   
      ->where('categories.type_product',2)
      ->select(DB::raw('SUM(products.weigth) as total_w'))
      ->where('products.status_id',3)
      ->get();

      //SUMA TOTAL DE GRAMOS DAÑADOS
      $gramos_d = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->where('products.deleted_at', NULL)
      ->where('lines.shop_id', Auth::user()->shop->id)
      ->where('categories.shop_id', Auth::user()->shop->id)     
      ->where('categories.type_product',2) 
      ->select(DB::raw('SUM(products.weigth) as total_w'))
      ->where('products.status_id',4)
      ->get();

       //SUMA TOTAL DE DINERO EN PRODUCTOS POR GRAMOS
       $ventas = Shop::join('products','products.shop_id','shops.id')
       ->join('categories','categories.id','products.category_id')
       ->join('statuss','statuss.id','products.status_id')
       ->join('branches','branches.id','products.branch_id')
       ->join('lines','lines.id','products.line_id')
       ->where('lines.shop_id', Auth::user()->shop->id)  
       ->where('categories.type_product',2) 
       ->where('products.deleted_at', NULL)
       ->select(DB::raw('SUM(products.price) as total_p'))
       ->orWhere('products.status_id',2)
       ->Where('products.status_id',3)
       ->orWhere('products.status_id',4)
       ->get();

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
       ->select(DB::raw('SUM(products.price) as total_p'))
       ->get();

       //SUMA TOTAL DE DINERO EN PRODUCTOS POR GRAMOS TRASPASADOS
       $ventas_t = Shop::join('products','products.shop_id','shops.id')
       ->join('categories','categories.id','products.category_id')
       ->join('statuss','statuss.id','products.status_id')
       ->join('branches','branches.id','products.branch_id')
       ->join('lines','lines.id','products.line_id')
       ->where('products.status_id',3)
       ->where('products.deleted_at', NULL)
       ->where('lines.shop_id', Auth::user()->shop->id)  
       ->where('categories.type_product',2) 
       ->select(DB::raw('SUM(products.price) as total_p'))
       ->get();

       //SUMA TOTAL DE DINERO EN PRODUCTOS POR GRAMOS DAÑADOS
       $ventas_d = Shop::join('products','products.shop_id','shops.id')
       ->join('categories','categories.id','products.category_id')
       ->join('statuss','statuss.id','products.status_id')
       ->join('branches','branches.id','products.branch_id')
       ->join('lines','lines.id','products.line_id')
       ->where('products.status_id',4)
       ->where('products.deleted_at', NULL)
       ->where('lines.shop_id', Auth::user()->shop->id)  
       ->where('categories.type_product',2) 
       ->select(DB::raw('SUM(products.price) as total_p'))
       ->get();

    //CONSULTAS PARA SUB-ADIMINISTRADORES Y COLABORADORES
       //SUMA TOTAL DE GRAMOS
      $gramos_col = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->where('lines.shop_id', Auth::user()->shop->id)  
      ->where('categories.type_product',2) 
      ->where('products.branch_id',$ids)
      ->where('products.deleted_at', NULL)
      ->select(DB::raw('SUM(products.weigth) as total_w'))
      ->orWhere('products.status_id',2)
      ->Where('products.status_id',3)
      ->orWhere('products.status_id',4)
      ->get();

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
      ->select(DB::raw('SUM(products.weigth) as total_we'))
      ->get();

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
      ->select(DB::raw('SUM(products.weigth) as total_wt'))
      ->get();

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
      ->select(DB::raw('SUM(products.weigth) as total_wd'))
      ->get();

    //CONSULTAS PARA ADMINISTRADORES
       //SUMA TOTAL DE PIEZAS
       $piezas = Shop::join('products','products.shop_id','shops.id')
       ->join('categories','categories.id','products.category_id')
       ->join('statuss','statuss.id','products.status_id')
       ->join('branches','branches.id','products.branch_id')
       ->where('categories.type_product', 1) 
       ->where('products.deleted_at', NULL)
       ->where('categories.shop_id', Auth::user()->shop->id)  
       ->select(DB::raw('COUNT(products.id) as total_pzs'))
       ->orWhere('products.status_id',2)
       ->Where('products.status_id',3)
       ->orWhere('products.status_id',4)
       ->get();
 
       //SUMA TOTAL DE PIEZAS EXISTENTES
       $piezas_e = Shop::join('products','products.shop_id','shops.id')
       ->join('categories','categories.id','products.category_id')
       ->join('statuss','statuss.id','products.status_id')
       ->join('branches','branches.id','products.branch_id')
       ->where('products.deleted_at', NULL)
       ->where('categories.type_product',1)
       ->where('categories.shop_id', Auth::user()->shop->id)  
       ->select(DB::raw('COUNT(products.id) as total_pzse'))
       ->where('products.status_id',2)
       ->get();
 
       //SUMA TOTAL DE PIEZAS TRASPASADAS
       $piezas_t = Shop::join('products','products.shop_id','shops.id')
       ->join('categories','categories.id','products.category_id')
       ->join('statuss','statuss.id','products.status_id')
       ->join('branches','branches.id','products.branch_id')
       ->where('products.status_id',3)
       ->where('products.deleted_at', NULL)
       ->where('categories.shop_id', Auth::user()->shop->id) 
       ->where('categories.type_product',1)
       ->select(DB::raw('COUNT(products.id) as total_pzst'))
       ->get();
 
       //SUMA TOTAL DE PIEZAS DAÑADAS
       $piezas_d = Shop::join('products','products.shop_id','shops.id')
       ->join('categories','categories.id','products.category_id')
       ->join('statuss','statuss.id','products.status_id')
       ->join('branches','branches.id','products.branch_id')
       ->where('products.status_id',4)
       ->where('products.deleted_at', NULL)
       ->where('categories.shop_id', Auth::user()->shop->id) 
       ->where('categories.type_product',1)  
       ->select(DB::raw('COUNT(products.id) as total_pzsd'))
       ->get();
 
        //SUMA TOTAL DE DINERO EN PRODUCTOS POR PIEZA
        $pieza_vent = Shop::join('products','products.shop_id','shops.id')
        ->join('categories','categories.id','products.category_id')
        ->join('statuss','statuss.id','products.status_id')
        ->join('branches','branches.id','products.branch_id')
        ->where('categories.shop_id', Auth::user()->shop->id)  
        ->where('categories.type_product',1) 
        ->where('products.deleted_at', NULL)
        ->select(DB::raw('SUM(products.price) as vent'))
        ->orWhere('products.status_id',2)
        ->Where('products.status_id',3)
        ->orWhere('products.status_id',4)
        ->get();
 
         //SUMA TOTAL DE DINERO EN PRODUCTOS POR PIEZA EXISTENTES
        $pieza_vente = Shop::join('products','products.shop_id','shops.id')
        ->join('categories','categories.id','products.category_id')
        ->join('statuss','statuss.id','products.status_id')
        ->join('branches','branches.id','products.branch_id')
        ->where('products.status_id',2)
        ->where('products.deleted_at', NULL)
        ->where('categories.shop_id', Auth::user()->shop->id)
        ->where('categories.type_product',1) 
        ->select(DB::raw('SUM(products.price) as vent_e'))
        ->get();
 
        //SUMA TOTAL DE DINERO EN PRODUCTOS POR PIEZA TRASPASADOS
        $pieza_ventt = Shop::join('products','products.shop_id','shops.id')
        ->join('categories','categories.id','products.category_id')
        ->join('statuss','statuss.id','products.status_id')
        ->join('branches','branches.id','products.branch_id')
        ->where('products.status_id',3)
        ->where('products.deleted_at', NULL)
        ->where('categories.shop_id', Auth::user()->shop->id)
        ->where('categories.type_product',1) 
        ->select(DB::raw('SUM(products.price) as vent_t'))
        ->get();
 
        //SUMA TOTAL DE DINERO EN PRODUCTOS POR PIEZA DAÑADOS
        $pieza_ventd = Shop::join('products','products.shop_id','shops.id')
        ->join('categories','categories.id','products.category_id')
        ->join('statuss','statuss.id','products.status_id')
        ->join('branches','branches.id','products.branch_id')
        ->where('products.status_id',4)
        ->where('products.deleted_at', NULL)
        ->where('categories.shop_id', Auth::user()->shop->id)
        ->where('categories.type_product',1) 
        ->select(DB::raw('SUM(products.price) as vent_d'))
        ->get();
 
    //CONSULTAS PARA SUB ADIMINISTRADORES Y COLABORADORES
        //SUMA TOTAL DE PIEZAS
       $piezas_col = Shop::join('products','products.shop_id','shops.id')
       ->join('categories','categories.id','products.category_id')
       ->join('statuss','statuss.id','products.status_id')
       ->join('branches','branches.id','products.branch_id')
       ->where('categories.shop_id', Auth::user()->shop->id)
       ->where('categories.type_product',1) 
       ->where('products.branch_id',$ids)
       ->where('products.deleted_at', NULL)
       ->select(DB::raw('COUNT(products.id) as total_p'))
       ->orWhere('products.status_id',2)
       ->Where('products.status_id',3)
       ->orWhere('products.status_id',4)
       ->get();
 
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
       ->select(DB::raw('COUNT(products.id) as total_pe'))
       ->get();
 
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
       ->select(DB::raw('COUNT(products.id) as total_pt'))
       ->get();
 
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
       ->select(DB::raw('COUNT(products.id) as total_pd'))
       ->get();
        
        return view ('Principal/principal',compact('pieza_vent','piezas_cold','piezas_col','piezas_cole','piezas_colt','pieza_vente','pieza_ventt','pieza_ventd','piezas_e','piezas_t','piezas_d','piezas','gramos_colt','gramos_cole','gramos_cold','ventas_d','ventas_t','ventas_e','gramos_d','gramos_t','gramos_e','branches_col','gramos_col','branches','branch','user','shop','shops','gramos','ventas'));
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
