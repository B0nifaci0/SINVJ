<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Product;
use App\Line;
use App\User;
use App\Branch;
use App\Parcial;
use PDF;
use Illuminate\Http\Request;
use App\Http\Requests\SaleRequest;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{ 
    public function __construct()
      {
          //$this->middleware('Authentication');
      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
      $sales = Sale::all();
      $products = Product::with('line')
        ->with('branch')
        ->with('category')
        ->with('status')
        ->get();
    return view('sale/index', compact('sales','products','user'));
    }

    public function indexCO()
    {
      $user = Auth::user(); 
      $sales = Sale::all();
      $products = Product::with('line')
        ->with('branch')
        ->with('category')
        ->with('status')
        ->get();
      return view('sale/index', compact('sales','products','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $user = Auth::user();
      if($user->branch) {
        $branch_id = $user->branch->id;
        $products = Product::where('branch_id',$branch_id)->get();
      } else {
        $branches = Branch::where('shop_id', $user->shop->id)->get();
        $branch_ids = $branches->map(function($item) {
          return $item->id;
        });
        $products = Product::whereIn('branch_id', $branch_ids)->get();
      }
      $products = Product::with('line')
        ->with('branch')
        ->with('category')
        ->with('status')
        ->get();
      //return $products;
        return view('sale/add', compact('products','products','user', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sale = new Sale($request->all());
        $sale->save();

    return redirect('/ventas')->with('mesage', 'la venta se ha agregado exitosamente!');
    \App\Parcial::create([
      'parcial_pay' => $request['parcial_pay'],
      'total_pay' => $request['total_pay'],
  ]);

    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     return view('sale.show', ['sale' => Sale::findOrFail($id)]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = Auth::user();
      $sale = Sale::findOrFail($id);
      $products = Product::all();
      //return $sale;
      return view('sale/edit', compact('sale','products','user'));
       }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(SaleRequest $request, $id)
    {
      $sale = Sale::findOrFail($id);
        $sale->name = $request->name;
        $sale->save();
        return redirect('/ventas')->with('mesage-update', 'La venta se ha modificado exitosamente!');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Product::destroy($id);
     // return redirect('/productos')->with('mesage-delete', 'El producto se ha eliminado exitosamente!');
   
}
public function exportPdf(){ 
  $user = Auth::user();
  $sales = Sale::all();
  $shops = Auth::user()->shop()->get();
  $branches = Branch::where('id', '!=', $user->branch_id)->get(); 
  $pdf  = PDF::loadView('sale.PDFVenta', compact('sales','branches','user','shops'));
  return $pdf->stream('venta.pdf');
}

}
