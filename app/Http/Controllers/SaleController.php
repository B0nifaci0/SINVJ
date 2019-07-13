<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Product;
use App\Line;
use PDF;
use Illuminate\Http\Request;
use App\Http\Requests\SaleRequest;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{ 
    public function __construct()
      {
          $this->middleware('Authentication');
      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $sales = Sale::all();
      $products = Product::with('line')
        ->with('branch')
        ->with('category')
        ->with('status')
        ->get();
    return view('sale/index', compact('sales','products'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $products = Product::with('line')
        ->with('branch')
        ->with('category')
        ->with('status')
        ->get();
      //return $products;
        return view('sale/add', compact('products'));
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
      $sale = Sale::findOrFail($id);
      $products = Product::all();
      //return $sale;
      return view('sale/edit', compact('sale','products'));
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
  $sales = Sale::all();
  $pdf  = PDF::loadView('sale.PDFVenta', compact('sales'));
  return $pdf->download('venta.pdf');
}

}
