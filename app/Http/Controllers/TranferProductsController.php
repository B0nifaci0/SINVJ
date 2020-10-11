<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\TransferProduct;
use App\Product;
use App\Branch;
use App\InventoryDetail;
use App\User;
use Carbon\Carbon;
use PDF;
use Auth;
use App\Traits\S3ImageManager;

class TranferProductsController extends Controller
{
    use S3ImageManager;
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        $user = Auth::user();

        $trans1 = TransferProduct::where('user_id', $user->id)
            ->withTrashed()
            ->with('user')->with('branch')->with('product')
            ->orderBy('transfer_products.created_at', 'desc')
            ->get();

        $trans2 = TransferProduct::where('destination_user_id', $user->id)
            ->withTrashed()
            ->with('user')->with('branch')->with('product')
            ->orderBy('transfer_products.created_at', 'desc')
            ->get();

        if ($user->type_user == User::AA || $user->type_user == User::SA) {
            return redirect('/traspasosAA');
        }

        return view('transfer/index', compact('trans1', 'trans2'));
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->type_user == User::AA) {
            return redirect('/traspasosAA/create');
        } else {

            $shop = $user->branch->shop;
            $users = User::where('id', '!=', $user->id)->get();
            $products = Product::where('branch_id', $user->branch_id)
                ->whereIn('status_id', [2])
                ->get();

            if ($user->shop && $user->shop->shop_group_id) {
                $shop_ids = Shop::where('shop_group_id', $user->shop->shop_group_id)->get()->map(function ($item) {
                    return $item->id;
                });
                $branches = Branch::whereIn('shop_id', $shop_ids)
                    ->get();
            } else {
                $branches = Branch::where('shop_id', $user->shop->id)
                    // ->where('id', '!=', $user->branch_id)
                    ->get();
            }

            $branch_ids = $branches->map(function ($b) {
                return $b->id;
            });

            $user = Auth::user(); //Retorna el usuario con el que se encuentra logueado
            $users = User::where('id', '!=', $user->id)->get(); // Retorna los usuarios que pertenecen a la tienda y no estan logueados
            //return $users;
            // $products = Product::where('branch_id', $user->branch_id)
            // ->get(); //Retorna todos los productos de la tienda solo si el usuario tiene
            return view('transfer/add', compact('branches', 'users', 'products', 'user'));
        }
    }

    public function show()
    {
        return view('transfer.show');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        // $data = $request->all();
        // $data['last_branch_id']  = $user->branch_id;
        // $data['user_id'] = $user->id;
        // $data['status_product'] = null;

        // $transfer_product = TransferProduct::create($data);

        // $product = Product::find($request->product_id);
        // $product->status_id = Product::TRANSFER;
        // $product->save();
        $product = Product::findOrFail($request->product_id);
        // $branch_product = $product
        $transfer_product = new TransferProduct([
            'user_id' => $user->id,
            'last_branch_id' => $product->branch_id,
            'new_branch_id' => $request->new_branch_id,
            'product_id' => $product->id,
            'destination_user_id' => $request->destination_user_id,
            'status_product' => null
        ]);
        $transfer_product->save();

        $product->status_id = Product::TRANSFER;
        $product->save();

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
            $inventory->status_id = 5;
            $inventory->save();
        }
        return redirect('/lista-traspasos')->with('mesage', 'El Traspaso se ha agregado exitosamente!');
    }

    public function answerTransferRequest(Request $request)
    {
        $user = Auth::user();
        $transfer = TransferProduct::find($request->transfer_id);
        $product = Product::find($transfer->product_id);

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

        if ($request->answer === null) {
            $transfer->delete();
            $product->status_id = Product::EXISTING;
            if ($inventory) {
                $inventory->status_id = 1;
                $inventory->save();
            }
            $product->save();
        } else {
            $transfer->status_product = $request->answer;
            $transfer->save();
            if ($request->answer) {
                $product->branch_id = $transfer->new_branch_id;
                if ($inventory) {
                    $inventory->status_id = 6;
                    $inventory->save();
                }
                $product->shop_id = $user->shop->id;
                $product->date_creation = Now();
                $product->save();
            } else {
                $product->status_id = Product::EXISTING;
                if ($inventory) {
                    $inventory->status_id = 1;
                    $inventory->save();
                }
                $product->save();
            }
        }
        return redirect('/lista-traspasos');
    }

    public function payTransfer(Request $request)
    {
        $transfer = TransferProduct::find($request->transfer_id);
        $transfer->paid_at = Carbon::now()->format('Y-m-d');
        $transfer->save();
        return back();
    }

    public function giveBack(Request $request)
    {
        $transfer = TransferProduct::find($request->transfer_id);

        $last_shop = Branch::where('id', $transfer->last_branch_id)
            ->sum('shop_id');
        //return $last_shop;

        $product = Product::where('id', $transfer->product_id)->first();
        $product->branch_id = $transfer->last_branch_id;
        $product->shop_id = $last_shop;
        $product->status_id = Product::EXISTING;
        $product->save();

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
            $inventory->status_id = 1;
            $inventory->save();
        }

        $transfer->status_product = 3;
        $transfer->save();

        return back();
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
        // $trans = TransferProduct::all();
        $trans = TransferProduct::where('user_id', $user->id)
            ->orWhere('destination_user_id', $user->id)
            ->with('user')->with('branch')->get();

        $pdf  = PDF::loadView('transfer.PdfTranferall', compact('trans', 'date', 'hour', 'shop'));
        return $pdf->stream('Traspasos.pdf');
    }

    public function exportPdfIn($id)
    {
        $user = Auth::user();
        $shop = Auth::user()->shop;
        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        $trans = TransferProduct::where("id", "=", $id)->get();
        $pdf  = PDF::loadView('transfer.PdfTranferInt', compact('trans', 'shop'))
            ->setOption('page-width', '55')
            ->setOption('page-height', '150');
        return $pdf->stream('TraspasoEntrante.pdf');
    }

    public function exportPdfOut($id)
    {
        $user = Auth::user();
        $shop = Auth::user()->shop;
        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        $trans = TransferProduct::where("id", "=", $id)->get();
        $pdf  = PDF::loadView('transfer.PdfTranferOut', compact('trans', 'shop'))
            ->setOption('page-width', '55')
            ->setOption('page-height', '150');
        return $pdf->stream('TraspasoSaliente.pdf');
    }

    public function reportTransfer()
    {
        $idshop = Auth::user()->shop->id;
        $user = Auth::user();
        $tienda = Shop::find($idshop)->branches()->get();
        $statuses = TransferProduct::all();
        $shop = Auth::user()->shop;
        $shops = Auth::user()->shop()->get();
        return view('transfer.Reports.indexReportTransfer', compact('shop', 'shops', 'tienda', 'user', 'statuses'));
    }

    public function testInterfaz()
    {
        $user = Auth::user();
        $branches = $user->shop->branches;
        return view('transfer.Traspaso', compact('branches'));
    }
}

//reporte de gastos
//reporte de productos por sucursal
//Que aparesca el crud de elimina y edita en sucursales productos
