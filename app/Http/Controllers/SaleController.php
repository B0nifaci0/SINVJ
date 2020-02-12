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
use App\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Requests\SaleRequest;
use Illuminate\Support\Facades\Storage;
use App\Traits\S3ImageManager;
use Illuminate\Support\Facades\Auth;
use PDF;
use DB;

class SaleController extends Controller
{
    use S3ImageManager;
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
 /*      $p = SaleDetails::where('product_id','=','1')->first();
      //return $p;
      $po = Product::where('id','=','p')->first();
      return $po;
      //return $user;
    $sale = Sale::with(['partials', 'client'])->findOrFail($id);
    	$sale->itemsSold = $sale->itemsSold();
      $sale->total = $sale->itemsSold->sum('final_price'); 
      $sale->payments = $sale->partials->sum('amount'); */


      $user = Auth::user();
      if($user->type_user == User::AA)
      {
          //VENDIDOS
       $sold = Sale::with('client')
            ->join('branches','branches.id','sales.branch_id')
            ->join('shops','shops.id','branches.shop_id')
            ->where('sales.deleted_at', NULL)
            ->select('sales.*', 'branches.name as sucursal' )
            ->whereRaw('sales.total = sales.paid_out')
            ->where('shops.id',$user->shop_id)
            ->orderBy('sales.created_at','DESC')
            ->get();

            //APARTADOS
       $apart = Sale::with('client')
            ->join('branches','branches.id','sales.branch_id')
            ->join('shops','shops.id','branches.shop_id')
            ->where('sales.deleted_at', NULL)
            ->select('sales.*', 'branches.name as sucursal' )
            ->whereRaw('sales.total > sales.paid_out')
            ->where('shops.id',$user->shop_id)
            ->orderBy('sales.created_at','DESC')
            ->get();
     
 
      }elseif ($user->type_user == User::CO || $user->type_user == User::SA ){
          //VENDIDOS
          $sold = Sale::with('client')
            ->join('branches','branches.id','sales.branch_id')
            ->where('sales.deleted_at', NULL)
            ->select('sales.*' )
            ->whereRaw('sales.total = sales.paid_out')
            ->where('sales.branch_id',$user->branch_id)
            ->orderBy('sales.created_at','DESC')
            ->get();

            //APARTADOS
          $apart = Sale::with('client')
            ->join('branches','branches.id','sales.branch_id')
            ->where('sales.deleted_at', NULL)
            ->select('sales.*' )
            ->whereRaw('sales.total > sales.paid_out')
            ->where('sales.branch_id',$user->branch_id)
            ->orderBy('sales.created_at','DESC')
            ->get();


      }
 /*        return response()->json([
          'Vendidos' => $sold,
          'Apartados' => $apart,
        ],200); */

      
      /* $products = Product::with('line') 
        ->with('branch')
        ->with('category')
        ->with('status') 
        ->get(); */
    return view('sale/index', compact('sold','user','apart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->branch) {
            $clients = Client::where('branch_id', $user->branch->id)->get();
        } else {
            $clients = Client::where('shop_id', $user->shop->id)->get();
        }

    if($user->branch) {
      	$branch_id = $user->branch->id;
        $products = Product::where('branch_id',$branch_id)
          ->whereIn('status_id', [2, 3])
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
          ->whereIn('status_id', [2, 3])
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
         //return $request;
        $user = Auth::user();
        if($user->type_user == User::AA)
        {
            /* $branches = Branch::where('shop_id', $user->shop->id)->get();
        	$branch_ids = $branches->map(function($item) {
              return $item->id;
            }); */
            $product = Product::find($request->product_id);
            //return $product;
            $folio = Sale::whereIn('branch_id', $product->branch_id)->select('id')->get()->count();
            $folio++;
        }
        elseif ($user->type_user == User::CO || $user->type_user == User::SA )
        {
            $folio = Sale::where('branch_id', $user->branch_id)->select('id')->get()->count();
            $folio++;
        }
        
        $validator = Validator::make($request->all(), [
            'customer_name' => Rule::requiredIf($request->user_type == 1),
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'errors' => $validator->errors(),
                'error' => 'Error en alguno de los campos'
            ];
            //return response()->json($response, $this->unprocessable);
            return back()->withErrors($validator->errors());
        }
        $sale = Sale::create([
            'customer_name' => Rule::requiredif($request->user_type == 1),
            'customer_name' => $request->customer_name,
            'telephone' => $request->telephone,
            'price' => $request->price,
            'customer_name' => $request->customer_name,
            'total' => $request->total_pay,
            'change' => $request->change,
            'income' => $request->income,
            'user_id' => $user->id,
            'branch_id' => $user->branch_id ? $user->branch_id : null,
            'client_id' => $request->user_type == 2 ? $request->client_id : null,
            'paid_out' => 0,
            'folio' => $folio
        ]);

        $products = json_decode($request->products_list);

        foreach ($products as $i => $p) {
            if (!$sale->branch_id && $i == 0) {
                $pranch_product = Product::find($p->id);
                $sale->branch_id = $pranch_product->branch_id;
                $sale->save();
                // Sale::where('id', $sale->id)->update([ 'branch_id' => $pranch_product->branch_id ]);
            }

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

        if ($request->cash_income) {
            $partial = Partial::create([
                'sale_id' => $sale->id,
                'amount' => ($request->cash_income) ? $request->cash_income : 0,
                'type' => Partial::CASH,
            ]);
            $partials_list->push($partial);
        }

        if ($request->card_income) {
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
        $lines = Line::all();

        return view('sale.show', compact('sale', 'lines'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $user = Auth::user();
    //     $sale = Sale::findOrFail($id);
    //     $products = Product::all();
    //     //return $sale;
    //     return view('sale/edit', compact('sale', 'products', 'user'));
    // }


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
    public function exportPdfall()
    {
        $user = Auth::user();
        $date = date("Y-m-d");
        $hour = Carbon::now();
        $hour = date('H:i:s');
        $branches = $user->shop->branches;
        $shop = Auth::user()->shop;
        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        $branch_ids = $branches->map(function ($item) {
            return $item->id;
        });

        $sales = Sale::with('client')
            ->whereIn('branch_id', $branch_ids)
            ->get();
        //return $sales;
        $pdf  = PDF::loadView('sale.PDFVentas', compact('sales', 'date', 'hour', 'shop', 'branches'));
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

    public function exportPdf(Request $request, $id)
    {
        //return $request;
        //   $user = Auth::user();
        //   $sales = Sale::all();
        //   $sales = Sale::where("id","=",$id)->get();
        //   $shops = Auth::user()->shop()->get();
        //   $branches = Branch::where('shop_id', $user->shop->id)->get();
        //return [$sales,$branches,$user,$shops];
        $user = Auth::user();
        $folio;
        $shop = Auth::user()->shop;
        $shops = Auth::user()->shop()->get();
        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        $sale = Sale::with(['partials', 'client', 'user'])->findOrFail($id);
        $sale->itemsSold = $sale->itemsSold();
        $sale->total = $sale->itemsSold->sum('final_price');
        $branch = Branch::find($sale->branch_id);
        $prueba = response()->json(['shop' => $shop, 'sucursal' => $branch, 'sale' => $sale]);
        //return $prueba;
        $pdf  = PDF::loadView('sale.PDFVenta', compact('shop', 'sale', 'branch', 'user'));
        return $pdf->stream('venta.pdf');
        // return $branches;
    }
    /**Reportes De Ventas */
    public function reporstSale()
    {
        $user = Auth::user();
        $branches = Auth::user()->shop->branches;

        return view('sale.reportsales.reports', compact('user', 'branches'));
    }
}
