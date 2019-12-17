<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Product;
use App\SaleDetails;
use App\Line;
use App\Client;
use App\User;
use App\Branch;
use App\Partial;
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
      $sales = Sale::with('client')->get();
      
      $user = Auth::user();
      $products = Product::with('line')
        ->with('branch')
        ->with('category')
        ->with('status') 
        ->get();
    return view('sale/index', compact('sales','products','user','p'));
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
      $clients = Client::where('branch_id', $user->branch->id)->get();
    } else {
      $clients = Client::where('shop_id', $user->shop->id)->get();
    }

    if($user->branch) {
      	$branch_id = $user->branch->id;
        $products = Product::where('branch_id',$branch_id)
          ->with('line')
          ->with('branch')
          ->with('category')
          ->with('status')
          ->get();
        $branches = [$user->branch];
    } else {
      	$branches = Branch::where('shop_id', $user->shop->id)->get();
      	$branch_ids = $branches->map(function($item) {
      	  return $item->id;
        });
        $products = Product::whereIn('branch_id', $branch_ids)
          ->where('status_id', 2)
          ->with('line')
          ->with('branch')
          ->with('category')
          ->with('status')
          ->get();
    }
    // $products = Product::where([
    //   'branch_id' => $user->branch_id,
    //   'status_id' => 2
    // ])
    //   ->with('line')
    // 	->with('branch')
    // 	->with('category')
    // 	->with('status')
    // 	->get();
        return view('sale/add', compact('products', 'user', 'branches', 'clients'));
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
      $user = Auth::user();
      $sale = Sale::create([
        'customer_name' => $request->customer_name,
        'telephone' => $request->telephone,
        'price' => $request->price,
        'customer_name' => $request->customer_name,
        'total' => $request->total_pay,
        'user_id' => $user->id,
        'branch_id' => $user->branch_id ? $user->branch_id : null,
        'client_id' => $request->user_type == 2 ? $request->client_id : null,
        'paid_out' => 0
      ]);
      
      $products = json_decode($request->products_list);
      
      foreach ($products as $p) {
        $product = Product::find($p->id);
        SaleDetails::create([
    			'sale_id' => $sale->id,
    			'product_id' => $p->id,
    			'final_price' => $p->price,
          'profit' => $p->price - $product->price_purchase
        ]);
        $product->status_id = 1;
        $product->save();
		} 
	  
		$partials_list = collect([]);

    if($request->cash_income){
    	$partial = Partial::create([
    		'sale_id' => $sale->id,
    		'amount' => ($request->cash_income) ? $request->cash_income : 0,
    		'type' => Partial::CASH,
      ]);
  		$partials_list->push($partial);
    }

    if($request->card_income) {
    	$partial = Partial::create([
    		'sale_id' => $sale->id,
    		'amount' => ($request->card_income) ? $request->card_income : 0,
    		'type' => Partial::CARD,
		  ]);
  		$partials_list->push($partial);
    }

		$sale->paid_out = $partials_list->sum('amount');
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
    	$sale = Sale::with(['partials', 'client'])->findOrFail($id);
    	$sale->itemsSold = $sale->itemsSold();
    	$sale->total = $sale->itemsSold->sum('final_price'); 
      // return $sale;
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

public function exportPdf( Request $request, $id) {
  //return $request;
	//   $user = Auth::user();  
	//   $sales = Sale::all();
	//   $sales = Sale::where("id","=",$id)->get(); 
	//   $shops = Auth::user()->shop()->get();
	//   $branches = Branch::where('shop_id', $user->shop->id)->get();
  //return [$sales,$branches,$user,$shops];
  $user = Auth::user();
  $shop_id = Auth::user()->shop->id; 
  $shop = Auth::user()->shop()->get();
 
  //return $shops; 
	$sale = Sale::with(['partials', 'client'])->findOrFail($id);
	$sale->itemsSold = $sale->itemsSold();
	$sale->total = $sale->itemsSold->sum('final_price');

  $branch = Branch::find($sale->branch_id);
  $pdf  = PDF::loadView('sale.PDFVenta', compact('shop','sale','branch','shop_id')); 
  return $pdf->stream('venta.pdf');
 // return $branches;
} 
/**Reportes De Ventas */
public function reporstSale(){
      $user = Auth::user();
      $branches= Auth::user()->shop->branches;   

  return view('sale.reportsales.reports',compact('user','branches'));
}

}
