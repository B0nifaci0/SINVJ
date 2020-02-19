<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use App\Shop;
use App\User;
use App\Branch;
use App\Product;
use Carbon\Carbon;
use App\Traits\S3ImageManager;
use App\TransferProduct;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TrasferUserController extends Controller
{

    use S3ImageManager;

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {

        $usersIds = User::where('shop_id', Auth::user()->shop->id)->get()->map(function ($u) {
            return $u->id;
        });
        $trans1 = TransferProduct::whereIn('user_id', $usersIds)
            ->with('user')->with('branch')->with('product')
            ->orderBy('transfer_products.created_at', 'desc')
            ->get();

        $trans2 = TransferProduct::whereIn('destination_user_id', $usersIds)
            ->orderBy('transfer_products.created_at', 'desc')
            ->with('user')->with('branch')->with('product')
            ->get();

        return view('transfer/TrasferUser/index', compact('trans1', 'trans2'));
    }

    public function create()
    {
        $user = Auth::user();
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

    public function store(Request $request)
    {
        $product = Product::find($request->product_id);

        $user = Auth::user();
        $transfer_product = new TransferProduct([
            'user_id' => $user->id,
            'last_branch_id' => $request->branch_id,
            'new_branch_id' => $request->new_branch_id,
            'product_id' => $request->product_id,
            'destination_user_id' => $request->destination_user_id,
            'status_product' => null
        ]);
        $transfer_product->save();

        $product->status_id = 3;
        $product->save();

        return redirect('/traspasosAA')->with('mesage', 'El Traspaso se ha agregado exitosamente!');
    }

    public function exportPdf()
    {
        // $trans = TrasferUser::all();
        $trans = TransferProduct::where('user_id', $user->id)
            ->orWhere('destination_user_id', $user->id)
            ->with('user')->with('branch')->get();
        $pdf  = PDF::loadView('transfer.TrasferUser.PdfTranferUser', compact('trans'));
        return $pdf->stream('Traspasos.pdf');
    }

    public function reportTransfer()
    {
        $idshop = Auth::user()->shop->id;
        $user = Auth::user();
        $tienda = Shop::find($idshop)->branches()->get();
        $shop = Auth::user()->shop;

        $shops = Auth::user()->shop()->get();
        return view('transfer.TrasferUser.Reports.indexReportTransfer', compact('shop', 'shops', 'tienda', 'user'));
    }

    public function reportTransferG(Request $request)
    {
        $user = Auth::user();
        $hour = Carbon::now();
        $hour = date('H:i:s');
        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');
        $branches = $user->shop->branches;
        $shop = Auth::user()->shop;


        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        $estado = $request->estatus_id;
        $fecini = Carbon::parse($request->fecini)->subDay();
        $fecter = Carbon::parse($request->fecter)->addDay();

        $categoria = $request->category_id;

        $usersIds = User::where('shop_id', Auth::user()->shop->id)->get()->map(function ($u) {
            return $u->id;
        });
        $trans1 = TransferProduct::whereIn('user_id', $usersIds)
            ->whereBetween('updated_at', [$fecini, $fecter])
            ->with('user')->with('branch')->with('product')->with('product')
            ->get();

        $trans2 = TransferProduct::whereIn('destination_user_id', $usersIds)
            ->with('user')->with('branch')->with('product')
            ->whereBetween('updated_at', [$fecini, $fecter])
            ->get();

        $trans = $trans1->merge($trans2);

        $pdf  = PDF::loadView('transfer.TrasferUser.Reports.reportTransferGeneral', compact('trans', 'dates', 'hour', 'shop', 'estado', 'categoria', 'branches'));
        return $pdf->stream('Traspasos.pdf');
    }

    public function reportTransferBranch(Request $request)
    {
        $user = Auth::user();
        $hour = Carbon::now();
        $hour = date('H:i:s');
        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');
        $branches = $user->shop->branches;
        $shop = Auth::user()->shop;

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        //return $shop;

        $estado = $request->estatus_id;
        $fecini = Carbon::parse($request->fecini)->subDay();
        $fecter = Carbon::parse($request->fecter)->addDay();

        $categoria = $request->category_id;

        $estado = $request->status_product;

        $usersIds = User::where('shop_id', Auth::user()->shop->id)->get()->map(function ($u) {
            return $u->id;
        });

        $query = TransferProduct::whereIn('user_id', $usersIds);
        if ($request->status_product == 'null') {
            $query->whereNull('transfer_products.status_product');
        } else {
            $query->where('transfer_products.status_product', $request->status_product);
        }
        //->where('last_branch_id',$request->branch_id)
        // ->orWhere('new_branch_id',$request->branch_id)
        $trans1 = $query->with('user')
            ->with(['branch' => function ($q) use ($request) {
                $q->where('id', $request->branch_id)
                    ->orWhere('id', $request->branch_id);
            }])
            ->with('product')
            ->get();
        // return $trans1;

        $trans2 = TransferProduct::whereIn('destination_user_id', $usersIds)
            ->where('transfer_products.status_product', $request->status_product)
            ->where('last_branch_id', $request->branch_id)
            ->orWhere('new_branch_id', $request->branch_id)
            ->with('user')->with('branch')->with('product')
            ->get();

        $trans = $trans1->merge($trans2);
        $pdf  = PDF::loadView('transfer.TrasferUser.Reports.reportTransfer', compact('estado', 'trans', 'dates', 'hour', 'shop', 'categoria', 'branches'));
        return $pdf->stream('Traspasos.pdf');
    }
}
