<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $exist = InventoryReport::where('start_date', Carbon::now()->format('Y-m-d'))->first();
        if($exist) {
            $date = null;
        } else  {
            $date = Carbon::now()->toFormattedDateString();
        }

        
        return view('inventory.add', compact('date'));
    }

    public function show($id) {
        $inventory = InventoryReport::find($id)->with('products')->first();
        // return $inventory;
        // return $inventory;
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

        return redirect('inventarios');
    }
}
