<?php

namespace App\Http\Controllers\Transfer;

use App\Shop;
use App\User;
use App\Branch;
use App\Product;
use App\InventoryDetail;
use App\TransferProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransferProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    public function index()
    {
        $user = Auth::user();

        return view('Transfer.index', compact('user'));
    }

    public function create()
    {
        $user = $this->user;
        if ($user->shop->shop_group_id == null) {
            $users = User::whereShopId($user->shop->id)->get();
            if ($user->isAdmin())
                $branches = $user->shop->branches()->get();
            else
                $branches = $user->shop->branches()
                    ->whereStateId($user->branch->state_id)
                    ->get();
        } else {
            if ($user->isAdmin()) {
                $shop_ids = Shop::where('shop_group_id', $user->shop->shop_group_id)
                    ->get()->map(function ($item) {
                        return $item->id;
                    });
                $users = User::whereIn('shop_id', $shop_ids)->get();
            } else {
                $shop_ids = Shop::where('shop_group_id', $user->shop->shop_group_id)
                    ->where('state_id', $user->shop->state_id)
                    ->get()->map(function ($item) {
                        return $item->id;
                    });
                $users = User::whereIn('shop_id', $shop_ids)
                    ->whereBranchId($user->branch->id)->get();
            }

            $branches = Branch::whereIn('shop_id', $shop_ids)->get();
        }

        if ($user->isAdmin())
            $products = $user->shop->products();
        else
            $products = $user->branch->products();

        $products = $products->whereStatusId(2)
            ->with('category:id,name')
            ->with('line:id,name')->get();

        return view('Transfer.add', compact('branches', 'products', 'users'));
    }

    public function store(Request $request)
    {
        $user = $this->user;
        $products = json_decode($request->products);

        foreach ($products as $p) {
            $product = Product::find($p);

            $transfer_product = new TransferProduct([
                'user_id' => $user->id,
                'last_branch_id' => $product->branch_id,
                'new_branch_id' => $request->new_branch,
                'product_id' => $product->id,
                'destination_user_id' => $request->destination_user,
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
        }
        return redirect('/traspasos')->with('mesage', 'El Traspaso se ha agregado exitosamente!');
    }
}
