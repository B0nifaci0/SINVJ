<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Product;
use App\InventoryReport;
use App\InventoryDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OldInventoryController extends Controller
{
    public function index() {
        $inventories = InventoryReport::all();
        // return $inventoryReport;
        return view('inventory.index', compact('inventories'));
    }

    public function create() {
        $exist = InventoryReport::where('start_date', Carbon::now()->format('Y-m-d'))->first();
        if($exist) {
            $date = null;
        } else  {
            $date = Carbon::now()->toFormattedDateString();
        }

        
        return view('inventory.add', compact('date'));
    }

    public function show($id) {
        $inventory = InventoryReport::where('id', $id)->first();

        $inventory->products = InventoryDetail::join('products', 'products.id', 'inventory_details.product_id')
        ->where('inventory_details.inventory_report_id', $inventory->id)
        // ->whereNull('products.deleted_at')
        ->get();
        return view('inventory.show', compact('inventory'));
    }

    public function store() {
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

        return back();
    }

    public function check(Request $request) {
        // return $request;
        if(!$request->status) {
            $inventory = InventoryDetail::find($request->inventory_id);
            $product = Product::find($inventory->product_id);
            $product->discar_cause = $request->discar_cause;
            $product->save();
            $product->delete();
        }

        InventoryDetail::where('id', $request->inventory_id)->update(['status' => $request->status]);
        return redirect('/inventarios');
    }
}
