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

        //CONSULTAS PARA ADMINISTRADORES
       //SUMA TOTAL DE GRAMOS
      $gramos = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->withTrashed()
      ->where('products.status_id',2)
      ->where('lines.shop_id', Auth::user()->shop->id)  
      ->where('categories.type_product',2) 
     // ->where('products.branch_id',$branch->id)
      ->select(DB::raw('SUM(products.weigth) as total_w'))
      ->get();
      //return $gramos->total_w;

       //SUMA TOTAL DE VENTAS
       $ventas = Shop::join('products','products.shop_id','shops.id')
       ->join('categories','categories.id','products.category_id')
       ->join('statuss','statuss.id','products.status_id')
       ->join('branches','branches.id','products.branch_id')
       ->join('lines','lines.id','products.line_id')
       ->withTrashed()
       ->where('products.status_id',2)
       ->where('lines.shop_id', Auth::user()->shop->id)  
       ->where('categories.type_product',2) 
      // ->where('products.branch_id',$branch->id)
       ->select(DB::raw('SUM(products.price) as total_p'))
       ->get();
       //return $ventas;
        
        return view ('Principal/principal',compact('branches','branch','user','shop','shops','gramos','ventas'));
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
