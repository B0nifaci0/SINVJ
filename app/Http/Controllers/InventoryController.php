<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Branch;
use App\Product;
use App\InventoryReport;
use App\InventoryDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index() {
        $inventories = InventoryReport::all();
        // return $inventoryReport;
        return view('inventory.index', compact('inventories'));
    }

    public function create() {
        $exist = InventoryReport::where('start_date', Carbon::now()->format('Y-m-d'))->get();
        $branches = Branch::where('shop_id', Auth::user()->shop->id)->get();

        $branch_ids = $exist->map(function($item) {
            return $item->branch_id;
        })->toArray();

        $branches = $branches->map(function($item) use($branch_ids) {
            if(in_array($item->branch_id, $branch_ids)) {
                $item->enabled = false;
            } else {
                $item->enabled = true;
            }
            return $item;
        });
        $date = Carbon::now()->toFormattedDateString();

        return view('inventory.add', compact('date', 'branches'));
    }

    public function show($id) {
        $inventory = InventoryReport::where('id', $id)->first();

        $inventory->products = InventoryDetail::join('products', 'products.id', 'inventory_details.product_id')
        ->where('inventory_details.inventory_report_id', $inventory->id)
        ->select('inventory_details.id', 'inventory_details.status', 'inventory_details.product_id',
            'products.clave', 'products.description'
        )
        ->get();
        return view('inventory.show', compact('inventory'));
    }

    public function store(Request $request) {
        $shop = Auth::user()->shop;

        $branches_ids = $shop->branches->map(function($b) {
            return $b->id;
        });
        
        $inventory = InventoryReport::create([
            'start_date' => Carbon::now()->format('Y-m-d')
        ]);

        $products = Product::whereIn('branch_id', $branches_ids)->get();
        
        foreach ($products as $p) {
            InventoryDetail::create([
                'inventory_report_id' => $inventory->id,
                'product_id' => $p->id,
            ]);
        }

        return redirect('/inventarios');
    }

    public function check(Request $request) {
        $inventory = InventoryDetail::find($request->inventory_id);
        if(!$request->status === null) {
            $product = Product::find($inventory->product_id);
            $product->discar_cause = $request->discar_cause;
            $product->save();            
            $product->delete();
        } else {
            $product = Product::withTrashed()->where('id', $inventory->product_id)->first();
            $product->discar_cause = null;            
            $product->deleted_at = null;            
            $product->save();
        }

        InventoryDetail::where('id', $request->inventory_id)->update(['status' => $request->status]);
        return back();
    }
}
