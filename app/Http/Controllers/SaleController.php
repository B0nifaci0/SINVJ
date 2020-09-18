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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Requests\SaleRequest;
use App\Traits\S3ImageManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;
use App\Http\Controllers\Controller;

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
        if ($user->type_user == User::AA) {
            //VENDIDOS
            $sold_public = Sale::with('client')
                ->join('branches', 'branches.id', 'sales.branch_id')
                ->join('shops', 'shops.id', 'branches.shop_id')
                ->join('clients', 'clients.id', 'sales.client_id')
                ->where('sales.deleted_at', null)
                ->select('sales.*', 'branches.name as sucursal')
                ->whereRaw('sales.total <= sales.paid_out')
                ->where('shops.id', $user->shop_id)
                ->where('clients.type_client', 0)
                ->orderBy('sales.updated_at', 'desc')
                ->get();
            $sold_wholesaler = Sale::with('client')
                ->join('branches', 'branches.id', 'sales.branch_id')
                ->join('shops', 'shops.id', 'branches.shop_id')
                ->join('clients', 'clients.id', 'sales.client_id')
                ->where('sales.deleted_at', null)
                ->select('sales.*', 'branches.name as sucursal')
                ->whereRaw('sales.total = sales.paid_out')
                ->whereRaw('sales.total > 0')
                ->where('shops.id', $user->shop_id)
                ->where('clients.type_client', 1)
                ->orderBy('sales.updated_at', 'desc')
                ->get(); 
            $sold = $sold_public->merge($sold_wholesaler);   

            //APARTADOS
            $apart_public = Sale::with('client')
                ->join('branches', 'branches.id', 'sales.branch_id')
                ->join('shops', 'shops.id', 'branches.shop_id')
                ->join('clients', 'clients.id', 'sales.client_id')
                ->where('sales.deleted_at', null)
                ->select('sales.*', 'branches.name as sucursal')
                ->whereRaw('sales.total > sales.paid_out')
                ->where('shops.id', $user->shop_id)
                ->where('clients.type_client', 0)
                ->orderBy('sales.updated_at', 'desc')
                ->get();
            $apart_wholesaler = Sale::with('client')
                ->join('branches', 'branches.id', 'sales.branch_id')
                ->join('shops', 'shops.id', 'branches.shop_id')
                ->join('clients', 'clients.id', 'sales.client_id')
                ->where('sales.deleted_at', null)
                ->select('sales.*', 'branches.name as sucursal')
                ->whereRaw('sales.total != sales.paid_out')
                ->where('shops.id', $user->shop_id)
                ->where('clients.type_client', 1)
                ->orderBy('sales.updated_at', 'desc')
                ->get(); 

            $apart = $apart_public->merge($apart_wholesaler);
            
            //DEVUELTOS
            $givedback = Sale::with('client')
                ->join('branches', 'branches.id', 'sales.branch_id')
                ->join('shops', 'shops.id', 'branches.shop_id')
                ->join('clients', 'clients.id', 'sales.client_id')
                ->where('sales.deleted_at', null)
                ->select('sales.*', 'branches.name as sucursal')
                ->whereRaw('sales.total = 0')
                ->where('shops.id', $user->shop_id)
                ->orderBy('sales.updated_at', 'desc')
                ->get();

        } elseif ($user->type_user == User::CO || $user->type_user == User::SA) {
            //VENDIDOS
            $sold_public = Sale::with('client')
                ->join('branches', 'branches.id', 'sales.branch_id')
                ->join('shops', 'shops.id', 'branches.shop_id')
                ->join('clients', 'clients.id', 'sales.client_id')
                ->where('sales.deleted_at', null)
                ->select('sales.*', 'branches.name as sucursal')
                ->whereRaw('sales.total <= sales.paid_out')
                ->where('sales.branch_id', $user->branch_id)
                ->where('clients.type_client', 0)
                ->orderBy('sales.updated_at', 'desc')
                ->get();
            $sold_wholesaler = Sale::with('client')
                ->join('branches', 'branches.id', 'sales.branch_id')
                ->join('shops', 'shops.id', 'branches.shop_id')
                ->join('clients', 'clients.id', 'sales.client_id')
                ->where('sales.deleted_at', null)
                ->select('sales.*', 'branches.name as sucursal')
                ->whereRaw('sales.total = sales.paid_out')
                ->whereRaw('sales.total > 0')
                ->where('sales.branch_id', $user->branch_id)
                ->where('clients.type_client', 1)
                ->orderBy('sales.updated_at', 'desc')
                ->get(); 
            $sold = $sold_public->merge($sold_wholesaler);   

            //APARTADOS
            $apart_public = Sale::with('client')
                ->join('branches', 'branches.id', 'sales.branch_id')
                ->join('shops', 'shops.id', 'branches.shop_id')
                ->join('clients', 'clients.id', 'sales.client_id')
                ->where('sales.deleted_at', null)
                ->select('sales.*', 'branches.name as sucursal')
                ->whereRaw('sales.total > sales.paid_out')
                ->where('sales.branch_id', $user->branch_id)
                ->where('clients.type_client', 0)
                ->orderBy('sales.updated_at', 'desc')
                ->get();
            $apart_wholesaler = Sale::with('client')
                ->join('branches', 'branches.id', 'sales.branch_id')
                ->join('shops', 'shops.id', 'branches.shop_id')
                ->join('clients', 'clients.id', 'sales.client_id')
                ->where('sales.deleted_at', null)
                ->select('sales.*', 'branches.name as sucursal')
                ->whereRaw('sales.total != sales.paid_out')
                ->where('sales.branch_id', $user->branch_id)
                ->where('clients.type_client', 1)
                ->orderBy('sales.updated_at', 'desc')
                ->get(); 
            $apart = $apart_public->merge($apart_wholesaler); 

            //DEVUELTOS
            $givedback = Sale::with('client')
                ->join('branches', 'branches.id', 'sales.branch_id')
                ->join('shops', 'shops.id', 'branches.shop_id')
                ->join('clients', 'clients.id', 'sales.client_id')
                ->where('sales.deleted_at', null)
                ->select('sales.*', 'branches.name as sucursal')
                ->whereRaw('sales.total = 0')
                ->where('sales.branch_id', $user->branch_id)
                ->orderBy('sales.updated_at', 'desc')
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
        return view('sale/index', compact('sold', 'user', 'apart', 'givedback'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $new_id = Client::max('id');
        $new_id += 1;
        //return $new_id;

        if ($user->branch) {
            $public = Client::where('shop_id', $user->shop->id)
                ->Where('type_client', Client::P)
                ->get();
            $wholesaler = Client::where('branch_id', $user->branch->id)
                ->Where('type_client', Client::M)
                ->get();
        } else {
            $public = Client::where('shop_id', $user->shop->id)
                ->Where('type_client', Client::P)
                ->get();
            $wholesaler = Client::where('shop_id', $user->shop->id)
                ->Where('type_client', Client::M)
                ->get();
        }
        $clients = $public->merge($wholesaler);

        if ($user->branch) {
            $branch_id = $user->branch->id;
            $products = Product::where('branch_id', $branch_id)
                ->whereIn('status_id', [2, 3])
                ->with('line')
                ->with('branch')
                ->with('category')
                ->with('status')
                ->get();
            $branches = [$user->branch];
        } else {
            $branches = Branch::where('shop_id', $user->shop->id)->get();
            $branch_ids = $branches->map(function ($item) {
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

        $clientsIds = $clients->map(function ($c) {
            return $c->id;
        });

        //return $clientsIds;

        $sales = Sale::whereIn('client_id', $clientsIds)
        ->whereRaw('paid_out <> total')
        ->get();
        //return $sales;
        // $products = Product::where([
        //   'branch_id' => $user->branch_id,
        //   'status_id' => 2
        // ])
        //   ->with('line')
        // 	->with('branch')
        // 	->with('category')
        // 	->with('status')
        // 	->get();
        return view('sale/add', compact('new_id' ,'public', 'wholesaler','products', 'user', 'branches', 'clients', 'sales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request)
    {
        //return $request;
        $sale = null;
        $user = Auth::user();
        if ($user->type_user == User::AA) {
            /* $branches = Branch::where('shop_id', $user->shop->id)->get();
        	$branch_ids = $branches->map(function($item) {
              return $item->id;
            }); */
            $product = Product::find($request->product_id);
            //return $product;
            $folio = Sale::where('branch_id', $product->branch_id)->select('id')->get()->count();
            $folio++;
        } elseif ($user->type_user == User::CO || $user->type_user == User::SA) {
            $folio = Sale::where('branch_id', $user->branch_id)->select('id')->get()->count();
            $folio++;
        }

        if ($request->user_type == 2) {
            $sale = Sale::where('client_id', $request->client_id)
                ->first();
            $cliente = Client::find($request->client_id);
        }

        if ($sale) {
            $sale->total += $request->total_pay;
        } else {
            $sale = Sale::create([
                'telephone' => $request->telephone,
                'price' => $request->price,
                'customer_name' => $request->customer_name,
                'total' => $request->total_pay,
                'change' => $request->change,
                'income' => $request->income,
                'user_id' => $user->id,
                'branch_id' => $user->branch_id ? $user->branch_id : null,
                'client_id' => $request->user_type == 2 ? $request->client_id : $request->cliente_id,
                'paid_out' => 0,
                'folio' => $folio
            ]);
        }
        //return $request;
        $date = Carbon::now();
        $products = json_decode($request->products_list);

        foreach ($products as $i => $p) {
            if (!$sale->branch_id && $i == 0) {
                $pranch_product = Product::find($p->id);
                $sale->branch_id = $pranch_product->branch_id;
            }

            $product = Product::find($p->id);
            SaleDetails::create([
                'sale_id' => $sale->id,
                'product_id' => $p->id,
                'final_price' => $p->price,
                'profit' => $p->price - $product->price_purchase
            ]);
            $product->status_id = 1;
            $product->sold_at = $date;
            $product->save();
        }

        if ($request->cash_income) {
            $partial = Partial::create([
                'sale_id' => $sale->id,
                'amount' => ($request->cash_income) ? $request->cash_income : 0,
                'type' => Partial::CASH,
            ]);
        }

        if ($request->card_income) {
            $adapter = Storage::disk('s3')->getDriver()->getAdapter();
            $image = file_get_contents($request->file('image')->path());
            $base64Image = base64_encode($image);
            $path = 'payment-tickets';

            $partial= Partial::all()->last();

            $count = $partial->id +1;

            $imagen = $this->saveImages($base64Image, $path, $count);
            $partial = Partial::create([
                'sale_id' => $sale->id,
                'amount' => ($request->card_income) ? $request->card_income : 0,
                'type' => Partial::CARD,
                'image' => $imagen,
            ]);
        }

        $sale->paid_out = Partial::where('sale_id', $sale->id)->sum('amount');
        $client = Client::find($sale->client_id);
        //return $sale;
        $sale->save();

        return redirect('/ventas')->with('mesage', 'La venta se ha agregado exitosamente!');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $sale = Sale::with(['partials', 'client'])->findOrFail($id);
        $sale->itemsSold = $sale->itemsSold();
        $sale->itemsGivedBack =  $sale->ItemsGivedBack();
        $sale->total = $sale->itemsSold->sum('final_price');
        //return $sale;
        $finalprice = Product::join('sale_details', 'sale_details.product_id', 'products.id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->withTrashed()
            ->whereIn('products.discar_cause', [3, 4])
            ->select('products.id as id_product', 'clave', 'weigth', 'line_id', 'categories.name as category_name', 'sale_details.final_price', 'description')
            ->where('sale_id', $id)
            ->sum('sale_details.final_price');
        //return $finalprice;
        $restan = $sale->total - $sale->partials->sum('amount');
        //return $restan;
        $lines = Line::all();
        $partials = Partial::all();
        $adapter = Storage::disk('s3')->getDriver()->getAdapter();
        foreach ($sale->partials as $e) {
            if ($e->image) {
                $path = env('S3_ENVIRONMENT') . '/' .  'payment-tickets/' . $e->id;

                $command = $adapter->getClient()->getCommand('GetObject', [
                    'Bucket' => $adapter->getBucket(),
                    'Key' => $adapter->getPathPrefix() . $path
                ]);

                $result = $adapter->getClient()->createPresignedRequest($command, '+20 minute');

                $e->image = (string) $result->getUri();
            }
        }


            $date_now = Carbon::now();
            $date_now = $date_now->format('Y-m-d');
            //return $sale;
            foreach($sale->itemsSold as $item)
            {
                $date_limit = $item->sold_at;
                $item->date_limit = (new Carbon($date_limit))->addDays(60);

                //VALIDACION PARA DEVOLUCION DE PRODUCTOS CON UN MAXIMO DE 60 DIAS
                if($date_now >= $item->date_limit)
                {
                    $item->limit = 1;
                } 
                else 
                {
                    $item->limit = 0;
                }
            }

        //return $sale->itemsSold;
        return view('sale.show', compact('finalprice', 'sale', 'lines', 'restan', 'partials'));
    }

    public function check(Request $request)
    {
        //return $request;
        $product = Product::find($request->product_id);
        $give = Product::join('transfer_products', 'transfer_products.product_id', 'products.id')
            ->where('products.id', $request->product_id)
            ->where('transfer_products.status_product', 1)
            ->count('products.id');
        //return $give;
        $sale = Sale::findOrFail($request->sale_id);
        //return $sale;
        $client = Client::find($sale->client_id);
        //return $client;
        $giveback = SaleDetails::where('sale_id', $request->sale_id)
            ->where('product_id', $request->product_id)
            ->sum('final_price');
        //return $giveback;
        $total = $sale->total - $giveback;
        //return $total;
        $sale->total = $total;
        if ($sale->total == 0) {
            //$balance = $sale->paid_out - $sale->total;
            $sale->positive_balance = $sale->positive_balance + $sale->paid_out;
            $client->positive_balance = $client->positive_balance + $sale->paid_out;
            if ($client->positive_balance < 0) {
                $client->positive_balance = $client->positive_balance * -1;
            }
            $client->save();
            $sale->paid_out = 0;
        }

        //return $sale;
        //return $client;
        if ($give == 1) {
            $product->discar_cause = 4;
        } else {
            $product->discar_cause = $request->discar_cause;
        }
        //return $product;

        $product->restored_at = null;

        $sale->save();

        $product->save();
        $product->delete();
        Sale::where('id', $request->sale_id)->update(['total' => $total]);
        return back()->with('mesage-givedback', 'El producto ha sido devuelto exitosamente!');
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
