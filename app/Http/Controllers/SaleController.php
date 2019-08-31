<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Product;
use App\SaleDetails;
use App\Line;
use App\User;
use App\Branch;
use App\Parcial;
use PDF;
use DB;
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
    public function index(Request $request)
    {
     $p = SaleDetails::where('product_id','=','1')->first();
      //return $p;
      $po = Product::where('id','=','p')->first();
      // return $po;
      $sales = Sale::all();
      // return $sales;
      $user = Auth::user();
      $products = Product::with('line')
        ->with('branch')
        ->with('category')
        ->with('status')
        ->get();
    return view('sale/index', compact('sales','products','user','SaleDetails'));
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
          //return $item->id;
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
      // return $request;
      $sale = Sale::create([
        'customer_name' => $request->customer_name,
        'telephone' => $request->telephone,
        'price' => $request->price,
        'customer_name' => $request->customer_name,
        'price' => $request->total_pay
      ]);
      $products = json_decode($request->products_list);
      
      foreach ($products as $p) {
        SaleDetails::create([
          'sale_id' => $sale->id,
          'product_id' => $p->id,
          'final_price' => $p->price
        ]);
      }

      Parcial::create([
        'sale_id' => $sale->id,
        'amount' => $request->cash_income,
        'type' => Parcial::CASH,
      ]);

      Parcial::create([
        'sale_id' => $sale->id,
        'amount' => $request->card_income,
        'type' => Parcial::CARD,
      ]);

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
      $sale = Sale::findOrFail($id);
      $sale->items = SaleDetails::where('sale_id', $sale->id)->get();
      return view('sale.show', ['sale' => $sale]);
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
public function exportPdfall(){ 
  $sales = Sale::all();
  $pdf  = PDF::loadView('sale.PDFVentas', compact('sales'));
  return $pdf->stream('venta.pdf');
}

// public function exportPdf($id){ 
//   $user = Auth::user();  
//   $sales = Sale::all();
//   $sales = Sale::where("id","=",$id)->get();
//   $shops = Auth::user()->shop()->get();
//   $branches = Branch::where('id', '!=', $user->branch_id)->get(); 
//   $pdf  = PDF::loadView('sale.PDFVenta', compact('sales','branches','user','shops')); 
//   return $pdf->stream('venta.pdf');
// }

public function exportPdf($id){
  $user = Auth::user();  
  $sales = Sale::all();
  $sales = Sale::where("id","=",$id)->get();
  $shops = Auth::user()->shop()->get();
  $branches = Branch::where('id', '=', $user->branch_id)->get();
  //return [$sales,$branches,$user,$shops];
  $pdf  = PDF::loadView('sale.PDFVenta', compact('sales','branches','user','shops')); 
  return $pdf->stream('venta.pdf');
}

}
