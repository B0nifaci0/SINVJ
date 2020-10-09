<?php

namespace App\Http\Controllers;

use PDF;
use App\Shop;
use App\User;
use App\Branch;
use App\InventoryDetail;
use App\Product;
use Carbon\Carbon;
use App\TransferProduct;
use Illuminate\Http\Request;
use App\Traits\S3ImageManager;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class TrasferUserController extends Controller
{

    use S3ImageManager;

    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }
    public function transInt()
    {
        $user = Auth::user();

        if ($user->type_user == User::SA) {
            $trans_int = TransferProduct::where('new_branch_id', $user->branch->id)
                ->with('user')->with('branch')->with('product')
                ->get();
        } else if ($user->type_user == User::AA) {
            $usersIds = User::where('shop_id', Auth::user()->shop->id)->get()->map(function ($u) {
                return $u->id;
            });
            $trans_int = TransferProduct::whereIn('destination_user_id', $usersIds)
                ->with('user')->with('product.line:id,name')->with('product.category:id,name')->with('lastBranch:id,name')->with('newBranch:id,name')->with('destinationUser:id,name')
                ->get();
        } else {
            $trans_int = TransferProduct::where('destination_user_id', $user->id)
                ->with('user')->with('branch')->with('product')
                ->get();
        }
        // return $trans_int;
        // $trans_int->cantidad = $trans_int->count();
        return datatables()->of($trans_int)->toJson();
    }

    public function indexNew()
    {
        return view('transfer/TrasferUser/index');
    }


    public function index()
    {
        $user = Auth::user();

        $usersIds = User::where('shop_id', Auth::user()->shop->id)->get()->map(function ($u) {
            return $u->id;
        });

        if ($user->type_user == User::SA) {
            $trans1 = TransferProduct::whereIn('user_id', $usersIds)
                ->where('last_branch_id', $user->branch->id)
                ->with('user')->with('branch')->with('product')
                ->orderBy('transfer_products.updated_at', 'desc')
                ->get();
            $trans2 = TransferProduct::whereIn('destination_user_id', $usersIds)
                ->where('new_branch_id', $user->branch->id)
                ->orderBy('transfer_products.updated_at', 'desc')
                ->with('user')->with('branch')->with('product')
                ->get();
        } else {
            $trans1 = TransferProduct::whereIn('user_id', $usersIds)
                ->with('user')->with('branch')->with('product')
                ->orderBy('transfer_products.updated_at', 'desc')
                ->get();
            $trans2 = TransferProduct::whereIn('destination_user_id', $usersIds)
                ->orderBy('transfer_products.updated_at', 'desc')
                ->with('user')->with('branch')->with('product')
                ->get();
        }
        // return $trans1;

        return view('transfer/TrasferUser/index', compact('trans1', 'trans2'));
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->type_user == User::SA) {
            return redirect('/traspasos/create');
        } else {

            $shop_id = $user->shop->id;

            // if($user->branch && $user->branch->id) {
            //   $branch_ids = [$user->branch->id];
            // } else {
            //   $branch_ids = $user->shop->branches->map(function($b) { return $b->id; });
            // }

            if ($user->shop && $user->shop->shop_group_id) {
                $shop_ids = Shop::where('shop_group_id', $user->shop->shop_group_id)->get()->map(function ($item) {
                    return $item->id;
                });
                $branches = Branch::whereIn('shop_id', $shop_ids)
                    ->get();
            } else {
                $branches = Branch::where('shop_id', $user->shop->id)
                    ->get();
            }

            $branch_ids = $branches->map(function ($b) {
                return $b->id;
            });


            if ($user->type_user == User::CO) {
                $products = Product::where('branch_id', $user->branch_id)->get();
            } else {
                $products = Product::join('branches', 'branches.id', 'products.branch_id')
                    ->join('shops', 'shops.id', 'branches.shop_id')
                    ->where('shops.id', $shop_id)
                    ->where('products.status_id', 2)
                    ->select(
                        'products.id',
                        'products.clave',
                        //'products.name',
                        'products.description',
                        'products.weigth',
                        'products.observations',
                        'products.price',
                        'products.image',
                        'products.category_id',
                        'products.line_id',
                        'products.shop_id',
                        'products.branch_id',
                        'status_id',
                        'branches.name as branchName',
                        'branches.id as branchId'
                    )
                    ->get();
            }
            $users = User::where('id', '!=', $user->id)
                ->whereIn('branch_id', $branch_ids)
                ->get();
            return view('transfer/TrasferUser/add', compact('branches', 'users', 'products', 'shop_id'));
        }
    }

    public function store(Request $request)
    {
        $product = Product::find($request->product_id);

        $user = Auth::user();

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

        $transfer_product = new TransferProduct([
            'user_id' => $user->id,
            'last_branch_id' => $request->branch_id,
            'new_branch_id' => $request->new_branch_id,
            'product_id' => $request->product_id,
            'destination_user_id' => $request->destination_user_id,
            'status_product' => null
        ]);
        $transfer_product->save();

        $product->status_id = Product::TRANSFER;


        $product->save();

        return redirect('/traspasosAA')->with('mesage', 'El Traspaso se ha agregado exitosamente!');
    }

    // public function exportPdf()
    // {
    //     // $trans = TrasferUser::all();
    //     $trans = TransferProduct::where('user_id', $user->id)
    //         ->orWhere('destination_user_id', $user->id)
    //         ->with('user')->with('branch')->get();
    //     $pdf  = PDF::loadView('transfer.TrasferUser.PdfTranferUser', compact('trans'));
    //     return $pdf->stream('Traspasos.pdf');
    // }

    public function indexReportTransfer()
    {

        $shop = $this->user->shop;
        $branches = $shop->branches()->get();

        $usersIds = User::where('shop_id', $shop->id)->get()->map(function ($u) {
            return $u->id;
        });
        $transout = TransferProduct::whereIn('user_id', $usersIds)->count();
        $transint = TransferProduct::whereIn('destination_user_id', $usersIds)->count();

        if ($transout <= 0 && $transint <= 0) {
            return redirect('/traspasosAA/create')->with('mesage', 'No se tiene ningun traspaso registrado, primero debes crear uno !');
        }
        return view('transfer.TrasferUser.Reports.index', compact('shop', 'branches'));
    }

    public function reportTransferG(Request $request)
    {
        $fecini = Carbon::parse($request->fecini);
        $fecter = Carbon::parse($request->fecter);
        $hour = $this->getHour();
        $date = $this->getDate();

        $shop = $this->user->shop;

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        $fecini = Carbon::parse($request->fecini)->subDay();
        $fecter = Carbon::parse($request->fecter)->addDay();

        $category = $request->category_id;

        $usersIds = User::where('shop_id', Auth::user()->shop->id)->get()->map(function ($u) {
            return $u->id;
        });
        $type = $request->type;

        $branchesIds = Branch::where('shop_id', Auth::user()->shop->id)->get()->map(function ($u) {
            return $u->id;
        });

        $branches = $shop
            ->products()->has('transfer_products')
            ->with('branch')
            ->get()
            ->pluck('branch')
            ->unique();

        // return $branches;

        if ($request->type == 0) {
            $query = TransferProduct::whereIn('destination_user_id', $usersIds)->OrderBy('new_branch_id', 'asc');
        } else {
            //return "Salientes";
            $query = TransferProduct::whereIn('user_id', $usersIds)
                ->OrderBy('last_branch_id', 'asc');
        }

        if ($request->status_product == 'null') { //Estatus Pendiente
            $query->whereNull('transfer_products.status_product');
        } else {
            if ($request->status_product == 4) { //Pagado
                $query->where('transfer_products.status_product', 1)
                    ->whereNotNull('transfer_products.paid_at');
            } else {
                $query->where('transfer_products.status_product', $request->status_product)
                    ->whereNull('transfer_products.paid_at'); //Por pagar
            }
        }

        $trans = $query->with('user')->with('branch')->with('product')
            ->whereBetween('updated_at', [$fecini, $fecter])
            ->get();


        if ($trans->isEmpty()) {
            return back()->with('message', 'El reporte que se intento generar no contiene información');
        }

        $pdf  = PDF::loadView('transfer.TrasferUser.Reports.reportTransferGeneral', compact('trans', 'date', 'hour', 'shop', 'category', 'type', 'branches'));
        return $pdf->stream('Traspasos.pdf');
    }

    public function reportTransferBranch(Request $request)
    {

        $fecini = Carbon::parse($request->fecini);
        $fecter = Carbon::parse($request->fecter);
        $hour = $this->getHour();
        $date = $this->getDate();
        $branch = Branch::findOrFail($request->branch_id);
        $status = $request->status_product;
        $type = $request->type;
        $shop = $this->user->shop;
        $type_product = $request->category_id;
        $branches = $shop->branches;
        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $usersIds = User::where('shop_id', $shop->id)->get()->map(function ($u) {
            return $u->id;
        });

        if ($type == 0) {  //Entradas
            $query = TransferProduct::whereIn('destination_user_id', $usersIds)
                ->where('new_branch_id', $branch->id)
                ->whereBetween('transfer_products.updated_at', [$fecini, $fecter]);
        } else {    //Salidas
            $query = TransferProduct::whereIn('user_id', $usersIds)
                ->where('last_branch_id', $branch->id)
                ->whereBetween('transfer_products.updated_at', [$fecini, $fecter]);
        }

        if ($request->status_product == 'null') { //Estatus Pendiente
            $query->whereNull('transfer_products.status_product');
        } else {
            if ($request->status_product == 4) { //Pagado
                $query->where('transfer_products.status_product', 1)
                    ->whereNotNull('transfer_products.paid_at');
            } else {
                $query->where('transfer_products.status_product', $request->status_product)
                    ->whereNull('transfer_products.paid_at'); //Por pagar
            }
        }

        $trans = $query->with('product.category')
            ->get()
            ->where('product.category.type_product', $type_product);

        if ($trans->isEmpty()) {
            return back()->with('message', 'El reporte que se intento generar no contiene información');
        }
        $pdf  = PDF::loadView('transfer.TrasferUser.Reports.reportTransfer', compact('status', 'trans', 'date', 'hour', 'shop', 'type_product', 'type', 'branch'));
        return $pdf->stream('Traspasos.pdf');
    }
    protected function getDate()
    {
        $date = Carbon::now();
        $date = $date->format('d-m-Y');
        return $date;
    }
    protected function getHour()
    {
        $hour = Carbon::now();
        $hour = date('H:i:s');
        return $hour;
    }
}
