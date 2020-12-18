<?php

namespace App\Http\Controllers;

use PDF;
use App\Line;
use App\Sale;
use App\User;
use App\Branch;
use App\Client;
use App\Partial;
use App\Product;
use Carbon\Carbon;
use App\SaleDetails;
use App\InventoryDetail;
use App\TransferProduct;
use Illuminate\Http\Request;
use App\Traits\S3ImageManager;
use Illuminate\Validation\Rule;
use App\Http\Requests\SaleRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

    public function tableSold()
    {

        $user = Auth::user();
        $sold_wholesaler = Sale::with('client')
            ->join('branches', 'branches.id', 'sales.branch_id')
            ->join('shops', 'shops.id', 'branches.shop_id')
            ->join('clients', 'clients.id', 'sales.client_id')
            ->select('sales.*', 'branches.name as branch', 'clients.name as clientName', 'clients.phone_number as phone', 'clients.type_client as type')
            ->whereRaw('sales.total = sales.paid_out')
            ->whereRaw('sales.total > 0')
            ->where('clients.type_client', 1);

        $sold_public = Sale::with('client')
            ->join('branches', 'branches.id', 'sales.branch_id')
            ->join('shops', 'shops.id', 'branches.shop_id')
            ->join('clients', 'clients.id', 'sales.client_id')
            ->select('sales.*', 'branches.name as branch', 'clients.name as clientName', 'clients.phone_number as phone', 'clients.type_client as type')
            ->whereRaw('sales.total <= sales.paid_out')
            ->where('clients.type_client', 0);

        if ($user->type_user == User::AA) {
            $sold_wholesaler = $sold_wholesaler->where('shops.id', $user->shop_id)->get();
            $sold_public = $sold_public->where('shops.id', $user->shop_id)->get();
        } elseif ($user->type_user == User::CO) {
            $sold_wholesaler = $sold_wholesaler->where('sales.user_id', $user->id)->get();
            $sold_public = $sold_public->where('sales.user_id', $user->id)->get();
        } elseif ($user->type_user == User::SA) {
            $sold_wholesaler = $sold_wholesaler->where('sales.branch_id', $user->branch_id)->get();
            $sold_public = $sold_public->where('sales.branch_id', $user->branch_id)->get();
        }
        $sold = $sold_public->merge($sold_wholesaler);
        return datatables()->of($sold)->toJson();
    }

    public function tableApart()
    {
        $user = Auth::user();
        $apart_public = Sale::with('client')
            ->join('branches', 'branches.id', 'sales.branch_id')
            ->join('shops', 'shops.id', 'branches.shop_id')
            ->join('clients', 'clients.id', 'sales.client_id')
            ->select('sales.*', 'branches.name as branch', 'clients.name as clientName', 'clients.phone_number as phone', 'clients.type_client as type')
            ->whereRaw('sales.total > sales.paid_out')
            ->where('clients.type_client', 0);
        $apart_wholesaler = Sale::with('client')
            ->join('branches', 'branches.id', 'sales.branch_id')
            ->join('shops', 'shops.id', 'branches.shop_id')
            ->join('clients', 'clients.id', 'sales.client_id')
            ->select('sales.*', 'branches.name as branch', 'clients.name as clientName', 'clients.phone_number as phone', 'clients.type_client as type')
            ->whereRaw('sales.total != sales.paid_out')
            ->where('clients.type_client', 1);

        if ($user->type_user == User::AA) {
            $apart_public = $apart_public->where('shops.id', $user->shop_id)->get();
            $apart_wholesaler = $apart_wholesaler->where('shops.id', $user->shop_id)->get();
        } elseif ($user->type_user == User::CO) {
            $apart_public = $apart_public->where('sales.user_id', $user->id)->get();
            $apart_wholesaler = $apart_wholesaler->where('sales.user_id', $user->id)->get();
        } elseif ($user->type_user == User::SA) {
            $apart_public = $apart_public->where('sales.branch_id', $user->branch_id)->get();
            $apart_wholesaler = $apart_wholesaler->where('sales.branch_id', $user->branch_id)->get();
        }
        $apart = $apart_public->merge($apart_wholesaler);

        return datatables()->of($apart)->toJson();
    }

    public function tableGivedback()
    {
        $user = Auth::user();
        $givedback = Sale::with('client')
            ->join('branches', 'branches.id', 'sales.branch_id')
            ->join('shops', 'shops.id', 'branches.shop_id')
            ->join('clients', 'clients.id', 'sales.client_id')
            ->select('sales.*', 'branches.name as branch', 'clients.name as clientName', 'clients.phone_number as phone', 'clients.type_client as type')
            ->whereRaw('sales.total = 0');
        if ($user->type_user == User::AA) {
            $givedback = $givedback->where('shops.id', $user->shop_id)->get();
        } elseif ($user->type_user == User::CO) {
            $givedback = $givedback->where('sales.user_id', $user->id)->get();
        } elseif ($user->type_user == User::SA) {
            $givedback = $givedback->where('sales.branch_id', $user->branch_id)->get();
        }
        return datatables()->of($givedback)->toJson();
    }
    public function index()
    {
        $user = Auth::user();
        return view('sale/index', compact('user'));
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

        if ($user->branch) {
            $public = Client::whereBranchId($user->branch->id)
                ->Where('type_client', Client::P)
                ->get();
            $wholesaler = Client::whereBranchId($user->branch->id)
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

        $sales = Sale::whereIn('client_id', $clientsIds)
            ->whereRaw('paid_out <> total')
            ->get();
        return view('sale/add', compact('new_id', 'public', 'wholesaler', 'products', 'user', 'branches', 'clients', 'sales'));
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
        $sale = null;
        $user = Auth::user();
        if ($user->type_user == User::AA) {
            /* $branches = Branch::where('shop_id', $user->shop->id)->get();
        	$branch_ids = $branches->map(function($item) {
              return $item->id;
            }); */
            $product = Product::find($request->product_id);
            //return $product;
            $venta = Sale::where('branch_id', $product->branch_id)->select('folio')->latest()->first();
            $folio = $venta->folio + 1;
            //return $folio;
            $folios = Sale::where('branch_id', $product->branch_id)->get();
        } elseif ($user->type_user == User::CO || $user->type_user == User::SA) {
            $venta = Sale::where('branch_id', $user->branch_id)->select('folio')->latest()->first();
            $folio = $venta->folio + 1;
            //return $folio;
            $folios = Sale::where('branch_id', $user->branch_id)->get();
        }

        $folios_ids = $folios->map(function ($item) {
            return $item->folio;
        });

        $existing = 0;

        foreach ($folios_ids as $f) {
            if ($f == $folio) {
                $existing = 1;
            }
        }

        if ($existing == 1) {
            return redirect('/ventas/create')->with('mesage-limit', 'Folio de la venta duplicado, Por favor intentalo de nuevo!');
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
                $branch_product = Product::find($p->id);
                $sale->branch_id = $branch_product->branch_id;
            }

            $product = Product::find($p->id);
            SaleDetails::create([
                'sale_id' => $sale->id,
                'product_id' => $p->id,
                'final_price' => $p->price,
                'profit' => $p->price - $product->price_purchase
            ]);

            $inventory = InventoryDetail::join('inventory_reports', 'inventory_details.inventory_report_id', 'inventory_reports.id')
                ->where('inventory_reports.branch_id', $product->branch_id)
                ->where('inventory_details.product_id', $product->id)
                ->where(function ($q) use ($request) {
                    $q->where(function ($query) use ($request) {
                        $query->Where('inventory_reports.status_report', 1)
                            ->orWhere('inventory_reports.status_report', 2);
                    });
                })
                ->select('inventory_details.*')
                ->first();

            if ($inventory) {
                $inventory->status_id = 7;
                $inventory->save();
            }

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

            $partial = Partial::all()->last();

            $count = $partial->id + 1;

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
        if ($client->phone_number == '0000000000') {
            $client->phone_number = null;
            $client->save();
        }
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
    public function show($id)
    {
        $user = Auth::user();
        $sale = Sale::with(['partials', 'client'])->findOrFail($id);
        $sale->itemsSold = $sale->itemsSold();
        $sale->itemsGivedBack =  $sale->ItemsGivedBack();
        $sale->total = $sale->itemsSold->sum('final_price');
        $finalprice = Product::join('sale_details', 'sale_details.product_id', 'products.id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->withTrashed()
            ->select('products.id as id_product', 'clave', 'weigth', 'line_id', 'categories.name as category_name', 'sale_details.final_price', 'description', 'sale_details.deleted_at')
            ->where('sale_id', $id)
            ->whereNotNull('sale_details.deleted_at')
            ->sum('sale_details.final_price');
        $restan = $sale->total - $sale->partials->sum('amount');

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

        $date_now = Carbon::now()->format('Y-m-d');

        foreach ($sale->itemsSold as $item) {
            $date_limit = $item->sold_at;
            $item->date_limit = (new Carbon($date_limit))->addDays(60);

            //VALIDACION PARA DEVOLUCION DE PRODUCTOS CON UN MAXIMO DE 60 DIAS
            if ($date_now >= $item->date_limit) {
                $item->limit = 1;
            } else {
                $item->limit = 0;
            }
        }
        if ($user->isAdmin())
            $products = Product::whereShopId($user->shop->id);
        else
            $products = Product::whereBranchId($sale->branch_id);

        $products = $products->where('status_id', 2)
            ->with('line')
            ->with('branch')
            ->with('category')
            ->with('status')
            ->get();

        return view('sale.show', compact('finalprice', 'sale', 'restan', 'products'));
    }

    public function check(Request $request)
    {
        $product = Product::find($request->product_id);
        $inTransfer = TransferProduct::whereProductId($request->product_id)->first();

        if ($inTransfer) return  back()->with('mesage-givedback', 'El producto no se puede devolver porqué se encuentra en un traspaso activo!');

        $give = Product::join('transfer_products', 'transfer_products.product_id', 'products.id')
            ->where('products.id', $request->product_id)
            ->where('transfer_products.status_product', 1)
            ->count('products.id');
        $sale = Sale::findOrFail($request->sale_id);
        $client = Client::find($sale->client_id);
        $giveback = SaleDetails::where('sale_id', $request->sale_id)
            ->where('product_id', $request->product_id)
            ->sum('final_price');
        $saleDetails = SaleDetails::whereProductId($request->product_id)->firstOrFail();
        $saleDetails->delete();

        $total = $sale->total - $giveback;
        $sale->total = $total;
        if ($sale->total == 0) {
            $sale->positive_balance = $sale->positive_balance + $sale->paid_out;
            $client->positive_balance = $client->positive_balance + $sale->paid_out;
            if ($client->positive_balance < 0) {
                $client->positive_balance = $client->positive_balance * -1;
            }
            $client->save();
            $sale->paid_out = 0;
        }

        if ($give == 1) {
            $product->discar_cause = 4;
        } else {
            $product->discar_cause = $request->discar_cause;
        }

        $product->restored_at = null;

        $sale->save();

        $product->save();
        $product->delete();
        Sale::where('id', $request->sale_id)->update(['total' => $total]);
        return back()->with('mesage-givedback', 'El producto ha sido devuelto exitosamente!');
    }

    public function canceled(Request $request)
    {
        $product = Product::find($request->product_id);
        $sale = Sale::findOrFail($request->sale_id);

        $product->sold_at = null;
        $product->status_id = Product::EXISTING;
        $product->save();

        $detail = SaleDetails::whereProductId($product->id)->first();
        $detail->forceDelete();

        if ($request->deleteSale == 'true') {
            $client = Client::find($sale->client->id);
            $client->positive_balance += $sale->paid_out;
            $client->save();
            $sale->delete();
            return redirect('/ventas')->with('mesage', 'La venta ha sido eliminada!');
        }

        $sale->total -= $detail->final_price;
        $sale->save();

        return back()->with('mesage-givedback', 'El producto ha sido cancelado de la venta exitosamente!');
    }

    public function addProduct(Request $request)
    {
        //return $request;
        $product = Product::find($request->product_id);
        $sale = Sale::findOrFail($request->sale_id);
        $date = Carbon::now();

        $details = SaleDetails::create([
            'sale_id' => $sale->id,
            'product_id' => $product->id,
            'final_price' => $request->product_price,
            'profit' => $request->product_price - $product->price_purchase
        ]);

        $inventory = InventoryDetail::join('inventory_reports', 'inventory_details.inventory_report_id', 'inventory_reports.id')
            ->where('inventory_reports.branch_id', $product->branch_id)
            ->where('inventory_details.product_id', $product->id)
            ->where(function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $query->Where('inventory_reports.status_report', 1)
                        ->orWhere('inventory_reports.status_report', 2);
                });
            })
            ->select('inventory_details.*')
            ->first();

        if ($inventory) {
            $inventory->status_id = 7;
            $inventory->save();
        }

        $product->status_id = 1;
        $product->sold_at = $date;

        $sale->total += $details->final_price;
        //return $sale;

        $sale->save();
        $product->save();

        return back()->with('mesage', 'El producto ha sido agregado a la venta exitosamente!');
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

    public function exportPdf(Request $request, $id)
    {

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
        $pdf  = PDF::loadView('sale.PDFVenta', compact('shop', 'sale', 'branch', 'user'))
            ->setOption('page-width', '55')
            ->setOption('page-height', '150');
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
