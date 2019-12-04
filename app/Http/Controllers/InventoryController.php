<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Branch;
use App\Product;
use App\InventoryReport;
use App\InventoryDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\Line;
use App\Sale;
use App\Shop;
use App\User;
use App\State;
use App\Status;
use App\Category;
use App\Traits\S3ImageManager;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductValidate;
use Illuminate\Support\Facades\Storage;

class InventoryController extends Controller
{

    use S3ImageManager;

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
        
        $branch_id = $request->branch_id ? $request->branch_id : Auth::user()->branch_id;

        $inventory = InventoryReport::create([
            'start_date' => Carbon::now()->format('Y-m-d'),
            'branch_id' => $branch_id
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

    public function inventariosPDF(Request $request){
        $branches= Auth::user()->shop->branches;
        $product = Auth::user()->shop->id;
        $products = Shop::find($product)->products()->get();
        $line = Auth::user()->shop->id;
        $lines = Shop::find($line)->lines()->get();
       
        $shop = Auth::user()->shop; 
        $hour = Carbon::now();
        $hour = date('H:i:s');
          $dates = Carbon::now();
          $dates = $dates->format('d-m-Y');
      $shops = Auth::user()->shop()->get();
  
      
  //CONSULTAS PARA PRODUCTOS POR GRAMOS
      $totals = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('lines','lines.id','products.line_id')
      ->where('statuss.id',2)
      ->where('lines.shop_id', Auth::user()->shop->id)  
      ->where('categories.type_product',2)  
      ->select('lines.id', 'lines.name as name_line', DB::raw('SUM(products.weigth) as total_w'))
      ->distinct('lines.name')
      ->groupBy('lines.id', 'lines.name')
      ->get();
     // return $totals;

    // CONSULTAS PARA PRODUCTOS POR PIEZA
       //FUNCION PARA SUMA DE TOTAL DE PRECIO VENTA Y NUMERO DE PIEZAS TOTALES
      $cat_totals = Category::join('products', 'products.category_id', 'categories.id')
      ->where('categories.shop_id', Auth::user()->shop->id)  
      ->where('categories.type_product',1)  
      ->select('categories.id', 'categories.name as cat_name', DB::raw('SUM(products.price) as total, count(products.id) as num_pz'))
      ->distinct('categories.name')
      ->groupBy('categories.id','categories.name')
      ->get();
     // return $cat_totals;  

     if($shop->image) {
        $shop->image = $this->getS3URL($shop->image);
    }

      $pdf  = PDF::loadView('inventory.Reports.reportPDF', compact('cat_totals','shop','hour','dates','shops','branches','lines','totals'));
      return $pdf->stream('ReporteInventarios.pdf');
    }

    public function reportInventarios(){
        $idshop = Auth::user()->shop->id;
         $user = Auth::user();
         $branch = Shop::find($idshop)->branches()->get();
    	  $statuses = Status::all();
         $line = Shop::find($idshop)->lines()->get();
        $category = Auth::user()->shop->id;
        $categories = Shop::find($category)->categories()->get();
        $shop = Auth::user()->shop; 
    $shops = Auth::user()->shop()->get();
    $hour = Carbon::now();
      $hour = date('H:i:s');

      $dates = Carbon::now();
      $dates = $dates->format('d-m-Y');


    if($shop->image) {
        $shop->image = $this->getS3URL($shop->image);
    }
         //return $categories;

      return view('inventory.Reports.reportinventory',compact('hour','dates','shop','shops','branch','user','statuses','line','categories'));
     }

}
