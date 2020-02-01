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
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryController extends Controller
{

    use S3ImageManager;
    use SoftDeletes;

    public function index() {
		
        $user = Auth::user();
        $ids = $user->branch_id;
        $inventories = InventoryReport::join('branches','branches.id','inventory_reports.branch_id')
        ->where('branches.shop_id', Auth::user()->shop->id)
        ->select('inventory_reports.*','branches.name as sucursal')
        ->get();

        $inventories_user = InventoryReport::join('branches','branches.id','inventory_reports.branch_id')
        ->where('inventory_reports.branch_id', $ids)
        ->select('inventory_reports.*','branches.name as sucursal')
        ->get();
        $branch_user = Branch::where('id', $ids)
        ->select('name as branch')
        ->get();
        //return $branch_user;
        //return $inventories_user;
        return view('inventory.index', compact('branch_user','inventories','inventories_user'));
    }

    public function create(Request $request) {
        //return $request;
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
        //return $branches;
        $date = Carbon::now()->toFormattedDateString();

        return view('inventory.add', compact('date', 'branches'));
    }

    public function show($id) {
        $branch = InventoryReport::where('id', $id)->select('branch_id')->sum('branch_id');
        $name_branch = InventoryReport::join('branches','branches.id','inventory_reports.branch_id')
        ->where('inventory_reports.id', $id)->select('branches.name')->get();
        $inventory = InventoryReport::where('id', $id)->first();
        $inventory->products = InventoryDetail::join('products', 'products.id', 'inventory_details.product_id')
        ->where('inventory_details.inventory_report_id', $inventory->id)
        ->where('products.branch_id',$branch)
        ->where('products.deleted_at',NULL)
        ->whereIn('products.status_id', [2, 4])
        ->select('inventory_details.id', 'inventory_details.status', 'inventory_details.product_id',
            'products.clave', 'products.description', 'products.weigth'
        )
        ->get();
        //QUERY PARA SABER SI HAY PRODUCTOS SIN LISTAR EN EL INVENTARIO
        $finalizar = InventoryDetail::where('inventory_report_id', $id)
        ->where('status',null)
        ->count('id');
        $id_inventory = InventoryReport::where('id', $id)->select('id')->get();
        //return $id_inventory;
        
        if($inventory->status_report == 1){
          $inventorie = InventoryReport::findOrFail($id);
          $inventorie->status_report = 2;
          $inventorie->save();
        }
        //return $finalizar;
        //return $inventory->products;
        return view('inventory.show', compact('inventory','name_branch','finalizar','id_inventory'));
    }

    public function store(Request $request) {
        $shop = Auth::user()->shop;

        $branches_ids = $shop->branches->map(function($b) {
            return $b->id;
        });
        
        $branch_id = $request->branch_id ? $request->branch_id : Auth::user()->branch_id;

        $num_products = Product::withTrashed()->where('branch_id','=',$branch_id)->where('deleted_at','=',NULL)->count();

        if($num_products == 0){
            return redirect('/inventarios')->with('mesage-update', 'No se pudo crear el inventario, porque la sucursal no tiene productos!');

        } else {
            //return $branch_id;
            $inventory = InventoryReport::create([
                'start_date' => Carbon::now()->format('Y-m-d'),
                'status_report' => 1,
                'branch_id' => $branch_id
            ]);

            $products = Product::where('branch_id', $branch_id)->get();
            
            
        
            foreach ($products as $p) {
                InventoryDetail::create([
                    'inventory_report_id' => $inventory->id,
                    'product_id' => $p->id,
                ]);
            }
            //return $products;
        }

        return redirect('/inventarios');
    }

    public function check(Request $request) {
        $inventory = InventoryDetail::find($request->inventory_id);
        // return [$request->status];
        if(!$request->status) {
            $product = Product::withTrashed()->where('id', $inventory->product_id)->first();
            $product->discar_cause = $request->discar_cause;
            $product->save();            
            //$product->delete();
        } else {
            $product = Product::withTrashed()->where('id', $inventory->product_id)->first();
            $product->discar_cause = null;            
            $product->deleted_at = null;            
            $product->save();
        }

        InventoryDetail::where('id', $request->inventory_id)->update(['status' => $request->status]);
        return back();
    }

    public function checkPassword(Request $request){
        $user = Auth::user();
        
        if(Hash::check($request->password, $user->password)) {
			return response()->json([
				'success' => true
			], 200);
		}

		return response()->json([
			'success' => false
		], 401);
    }

    public function terminar($id) {
        $inventorie = InventoryReport::findOrFail($id);
        $inventorie->status_report = 3;
        $inventorie->end_date = Carbon::now()->format('Y-m-d');
        $inventorie->save();
        return redirect('/inventarios');
    }

    public function inventariosPDF($id){
        
        $id_branch = InventoryReport::where('id',$id)->sum('branch_id');  
       //return $id_branch;

        $product = Auth::user()->shop->id;
        $products = Shop::find($product)->products()->get();
        $line = Auth::user()->shop->id;
        $lines = Shop::find($line)->lines()->get();
       
        $shop = Auth::user()->shop;

        $dates = InventoryReport::where('id',$id)->select('created_at as fecha')->get();
        //return $dates;

      $shops = Auth::user()->shop()->get();
      
      $inventory = InventoryReport::findOrFail($id);
      $id_inventory = $inventory->id;
      //return $id_inventory;
      $report = InventoryReport::join('branches','branches.id','inventory_reports.branch_id')
      ->select('inventory_reports.*', 'branches.name as name_branch', 'branches.id as id_branch')
      ->where('inventory_reports.id',$id)
      ->get();

  //CONSULTAS PARA PRODUCTOS POR GRAMOS
        //CONSULTA PARA OBTENER EL TOTAL DE GRAMOS POR LINEA DE LA SUCURSAL
      $gramos_totales = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->join('inventory_details','inventory_details.product_id','products.id')
      ->withTrashed()
      ->whereIn('products.status_id', [2, 4])
      //->where('lines.shop_id', Auth::user()->shop->id)  
      ->where('lines.shop_id', NULL) 
      ->where('products.deleted_at',NULL)
      ->where('products.shop_id', Auth::user()->shop->id) 
      ->where('categories.type_product',2) 
      ->where('products.branch_id',$id_branch)
      ->where('inventory_details.inventory_report_id',$id)
      ->select('lines.id as ids', 'lines.name as name_line', DB::raw('SUM(products.weigth) as total_w, SUM(products.price) as dinero'))
      ->distinct('lines.name')
      ->groupBy('lines.id', 'lines.name')
      ->orderBy('name_line', 'DESC')
      ->get();
      //return $totals;

      foreach($gramos_totales as $g)
      {
          //CONSULTA PARA OBTENER GRAMOS DAÑADOS POR LINEA
          $g->gramos_da = Shop::join('products','products.shop_id','shops.id')
          ->join('categories','categories.id','products.category_id')
          ->join('statuss','statuss.id','products.status_id')
          ->join('branches','branches.id','products.branch_id')
          ->join('lines','lines.id','products.line_id')
          ->join('inventory_details','inventory_details.product_id','products.id')
          ->where('products.branch_id',$id_branch)
          //->where('lines.shop_id', Auth::user()->shop->id)  
          ->where('lines.shop_id', NULL) 
          ->where('products.deleted_at',NULL)
          ->where('products.shop_id', Auth::user()->shop->id) 
          ->where('categories.type_product',2)
          ->whereIn('products.status_id', [2, 4])
          ->where('products.line_id', $g->ids)
          ->where('inventory_details.status',2)
          ->where('inventory_details.inventory_report_id',$id)
          //->select('products.id', 'products.weigth', 'products.line_id', 'products.status_id')
          ->get()
          ->sum('weigth');

          //CONSULTA PARA OBTENER DINERO POR GRAMOS DAÑADOS POR LINEA
          $g->dinero_da = Shop::join('products','products.shop_id','shops.id')
          ->join('categories','categories.id','products.category_id')
          ->join('statuss','statuss.id','products.status_id')
          ->join('branches','branches.id','products.branch_id')
          ->join('lines','lines.id','products.line_id')
          ->join('inventory_details','inventory_details.product_id','products.id')
          ->where('products.branch_id',$id_branch)
          //->where('lines.shop_id', Auth::user()->shop->id)  
          ->where('lines.shop_id', NULL) 
          ->where('products.deleted_at',NULL)
          ->where('products.shop_id', Auth::user()->shop->id) 
          ->where('categories.type_product',2)
          ->whereIn('products.status_id', [2, 4])
          ->where('products.line_id', $g->ids)
          ->where('inventory_details.status',2)
          ->where('inventory_details.inventory_report_id',$id)
          //->select('products.id', 'products.weigth', 'products.line_id', 'products.status_id')
          ->get()
          ->sum('price');

          //CONSULTA PARA OBTENER GRAMOS FALTANTES POR LINEA
          $g->gramos_fal = Shop::join('products','products.shop_id','shops.id')
          ->join('categories','categories.id','products.category_id')
          ->join('statuss','statuss.id','products.status_id')
          ->join('branches','branches.id','products.branch_id')
          ->join('lines','lines.id','products.line_id')
          ->join('inventory_details','inventory_details.product_id','products.id')
          ->where('products.branch_id',$id_branch)
          //->where('lines.shop_id', Auth::user()->shop->id)  
          ->where('lines.shop_id', NULL) 
          ->where('products.deleted_at',NULL)
          ->where('products.shop_id', Auth::user()->shop->id) 
          ->where('categories.type_product',2)
          ->whereIn('products.status_id', [2, 4])
          ->where('products.line_id', $g->ids)
          ->where('inventory_details.status',3)
          ->where('inventory_details.inventory_report_id',$id)
          //->select('products.id', 'products.weigth', 'products.line_id', 'products.status_id')
          ->get()
          ->sum('weigth');

          //CONSULTA PARA OBTENER DINERO POR GRAMOS FALTANTES POR LINEA
          $g->dinero_fal = Shop::join('products','products.shop_id','shops.id')
          ->join('categories','categories.id','products.category_id')
          ->join('statuss','statuss.id','products.status_id')
          ->join('branches','branches.id','products.branch_id')
          ->join('lines','lines.id','products.line_id')
          ->join('inventory_details','inventory_details.product_id','products.id')
          ->where('products.branch_id',$id_branch)
          //->where('lines.shop_id', Auth::user()->shop->id)  
          ->where('lines.shop_id', NULL) 
          ->where('products.deleted_at',NULL)
          ->where('products.shop_id', Auth::user()->shop->id) 
          ->where('categories.type_product',2)
          ->whereIn('products.status_id', [2, 4])
          ->where('products.line_id', $g->ids)
          ->where('inventory_details.status',3)
          ->where('inventory_details.inventory_report_id',$id)
          //->select('products.id', 'products.weigth', 'products.line_id', 'products.status_id')
          ->get()
          ->sum('price');

            //OPERACION PARA OBTENER LOS GRAMOS EXISTENTES POR LINEA
          $g->gramos_ex = $g->total_w - $g->gramos_da - $g->gramos_fal;

           //OPERACION PARA OBTENER EL DINERO EXISTENTE POR LINEA
           $g->dinero_ex = $g->dinero - $g->dinero_da - $g->dinero_fal;
      }
      //return $gramos_totales;

      //DESCRIPCION DE PRODUCTOS GRAMOS FALTANTES
      $prod_fal = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->join('inventory_details','inventory_details.product_id','products.id')
      ->whereIn('products.status_id', [2, 4])
      //->where('lines.shop_id', Auth::user()->shop->id) 
      ->where('products.shop_id', Auth::user()->shop->id)  
      ->where('lines.shop_id', NULL)  
      ->where('products.deleted_at',NULL)
      ->where('categories.type_product',2)
      ->where('products.branch_id',$id_branch)
      ->where('inventory_details.status',3)  
      ->where('inventory_details.inventory_report_id',$id)    
      ->select('products.weigth','products.description','products.clave', 'lines.name as name_line', DB::raw('SUM(products.price) as money'))
      ->distinct('products.clave')
      ->groupBy('products.weigth','products.description','products.clave','lines.name')
      ->orderBy('name_line', 'DESC') 
      ->get();
      //return $prod_fal;

      //DESCRIPCION DE PRODUCTOS GRAMOS DAÑADOS
      $prod_da = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->join('inventory_details','inventory_details.product_id','products.id')
      ->whereIn('products.status_id', [2, 4])
      //->where('lines.shop_id', Auth::user()->shop->id) 
      ->where('products.shop_id', Auth::user()->shop->id)  
      ->where('lines.shop_id', NULL)  
      ->where('products.deleted_at',NULL)
      ->where('categories.type_product',2)
      ->where('products.branch_id',$id_branch)
      ->where('inventory_details.status',2)  
      ->where('inventory_details.inventory_report_id',$id)    
      ->select('products.weigth','products.description','products.clave', 'lines.name as name_line', DB::raw('SUM(products.price) as money'))
      ->distinct('products.clave')
      ->groupBy('products.weigth','products.description','products.clave','lines.name')
      ->orderBy('name_line', 'DESC') 
      ->get();
      //return $prod_fal;

       //CONSULTA PARA OBTENER EL TOTAL DE GRAMOS Y DINERO EN LINEAS DE LA SUCURSAL
       $totales_g = Shop::join('products','products.shop_id','shops.id')
       ->join('categories','categories.id','products.category_id')
       ->join('statuss','statuss.id','products.status_id')
       ->join('branches','branches.id','products.branch_id')
       ->join('lines','lines.id','products.line_id')
       ->join('inventory_details','inventory_details.product_id','products.id')
       ->withTrashed()
       ->whereIn('products.status_id', [2, 4])
       //->where('lines.shop_id', Auth::user()->shop->id)  
       ->where('lines.shop_id', NULL)  
       ->where('products.deleted_at',NULL)
       ->where('products.shop_id', Auth::user()->shop->id) 
       ->where('categories.type_product',2) 
       ->where('products.branch_id',$id_branch)
       ->where('inventory_details.inventory_report_id',$id)
       ->select(DB::raw('SUM(products.weigth) as gramos, SUM(products.price) as t_dinero'))
       ->get();
       //return $totales_g;
 
       foreach($totales_g as $g)
       {
           //CONSULTA PARA OBTENER EL TOTAL DE GRAMOS DAÑADOS
          $g->g_dañados = Shop::join('products','products.shop_id','shops.id')
          ->join('categories','categories.id','products.category_id')
          ->join('statuss','statuss.id','products.status_id')
          ->join('branches','branches.id','products.branch_id')
          ->join('lines','lines.id','products.line_id')
          ->join('inventory_details','inventory_details.product_id','products.id')
          ->where('products.branch_id',$id_branch)
          //->where('lines.shop_id', Auth::user()->shop->id)  
          ->where('lines.shop_id', NULL) 
          ->where('products.deleted_at',NULL)
          ->where('products.shop_id', Auth::user()->shop->id) 
          ->where('categories.type_product',2)
          ->whereIn('products.status_id', [2, 4])
          ->where('inventory_details.status',2)
          ->where('inventory_details.inventory_report_id',$id)
          //->select('products.id', 'products.weigth', 'products.line_id', 'products.status_id')
          ->get()
          ->sum('weigth');

          //CONSULTA PARA OBTENER EL TOTAL EN DINERO POR GRAMOS DAÑADOS
          $g->d_dañados = Shop::join('products','products.shop_id','shops.id')
          ->join('categories','categories.id','products.category_id')
          ->join('statuss','statuss.id','products.status_id')
          ->join('branches','branches.id','products.branch_id')
          ->join('lines','lines.id','products.line_id')
          ->join('inventory_details','inventory_details.product_id','products.id')
          ->where('products.branch_id',$id_branch)
          //->where('lines.shop_id', Auth::user()->shop->id)  
          ->where('lines.shop_id', NULL) 
          ->where('products.deleted_at',NULL)
          ->where('products.shop_id', Auth::user()->shop->id) 
          ->where('categories.type_product',2)
          ->whereIn('products.status_id', [2, 4])
          ->where('inventory_details.status',2)
          ->where('inventory_details.inventory_report_id',$id)
          //->select('products.id', 'products.weigth', 'products.line_id', 'products.status_id')
          ->get()
          ->sum('price');

          //CONSULTA PARA OBTENER EL TOTAL DE DINERO EN GRAMOS FALTANTES
          $g->g_faltantes = Shop::join('products','products.shop_id','shops.id')
          ->join('categories','categories.id','products.category_id')
          ->join('statuss','statuss.id','products.status_id')
          ->join('branches','branches.id','products.branch_id')
          ->join('lines','lines.id','products.line_id')
          ->join('inventory_details','inventory_details.product_id','products.id')
          ->where('products.branch_id',$id_branch)
          //->where('lines.shop_id', Auth::user()->shop->id)  
          ->where('lines.shop_id', NULL) 
          ->where('products.deleted_at',NULL)
          ->where('products.shop_id', Auth::user()->shop->id) 
          ->where('categories.type_product',2)
          ->whereIn('products.status_id', [2, 4])
          ->where('inventory_details.status',3)
          ->where('inventory_details.inventory_report_id',$id)
          //->select('products.id', 'products.weigth', 'products.line_id', 'products.status_id')
          ->get()
          ->sum('weigth');

          //CONSULTA PARA OBTENER EL TOTAL DE DINERO POR GRAMOS FALTANTES
          $g->d_faltantes = Shop::join('products','products.shop_id','shops.id')
          ->join('categories','categories.id','products.category_id')
          ->join('statuss','statuss.id','products.status_id')
          ->join('branches','branches.id','products.branch_id')
          ->join('lines','lines.id','products.line_id')
          ->join('inventory_details','inventory_details.product_id','products.id')
          ->where('products.branch_id',$id_branch)
          //->where('lines.shop_id', Auth::user()->shop->id)  
          ->where('lines.shop_id', NULL) 
          ->where('products.deleted_at',NULL)
          ->where('products.shop_id', Auth::user()->shop->id) 
          ->where('categories.type_product',2)
          ->whereIn('products.status_id', [2, 4])
          ->where('inventory_details.status',3)
          ->where('inventory_details.inventory_report_id',$id)
          //->select('products.id', 'products.weigth', 'products.line_id', 'products.status_id')
          ->get()
          ->sum('price');

            //OPERACION PARA OBTENER EL TOTAL DE GRAMOS EXISTENTES
          $g->g_existente = $g->gramos - $g->g_faltantes - $g->g_dañados;

           //OPERACION PARA OBTENER EL TOTAL EN DINERO EXISTENTE
           $g->d_existente = $g->t_dinero - $g->d_faltantes - $g->d_dañados;
       }
       //return $totales_g;

    // CONSULTAS PARA PRODUCTOS POR PIEZA
       //PRODUCTOS PIEZA
      $cat_totals = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('inventory_details','inventory_details.product_id','products.id')
      //->where('categories.shop_id', Auth::user()->shop->id)  
      ->whereIn('products.status_id', [2, 4])
      ->where('categories.shop_id', NULL) 
      ->where('products.deleted_at',NULL)
      ->where('products.shop_id', Auth::user()->shop->id)  
      ->where('categories.type_product',1)  
      ->where('products.branch_id',$id_branch)   
      ->where('inventory_details.inventory_report_id',$id)
      //->where('inventory_details.status', 1)
      ->select('categories.id as ids', 'categories.name as cat_name', DB::raw('SUM(products.price) as total, count(products.id) as num_pz'))
      ->distinct('categories.name')
      ->groupBy('categories.id','categories.name')
      ->orderBy('cat_name', 'DESC')
      ->get();

      foreach($cat_totals as $c)
      {
          //CONSULTA PARA OBTENER PIEZAS DAÑADOS POR CATEGORIA
          $c->pz_da = Shop::join('products','products.shop_id','shops.id')
          ->join('categories','categories.id','products.category_id')
          ->join('statuss','statuss.id','products.status_id')
          ->join('branches','branches.id','products.branch_id')
          ->join('inventory_details','inventory_details.product_id','products.id')
          ->where('products.branch_id',$id_branch)
          //->where('categories.shop_id', Auth::user()->shop->id)  
          ->where('categories.shop_id', NULL) 
          ->where('products.deleted_at',NULL)
          ->where('products.shop_id', Auth::user()->shop->id) 
          ->where('categories.type_product',1)
          ->whereIn('products.status_id', [2, 4])
          ->where('products.category_id', $c->ids)
          ->where('inventory_details.status',2)
          ->where('inventory_details.inventory_report_id',$id)
          //->select('products.id', 'products.weigth', 'products.line_id', 'products.status_id')
          ->get()
          ->count('id');

          //CONSULTA PARA OBTENER DINERO POR PIEZAS DAÑADOS POR CATEGORIA
          $c->d_da = Shop::join('products','products.shop_id','shops.id')
          ->join('categories','categories.id','products.category_id')
          ->join('statuss','statuss.id','products.status_id')
          ->join('branches','branches.id','products.branch_id')
          ->join('inventory_details','inventory_details.product_id','products.id')
          ->where('products.branch_id',$id_branch)
          //->where('categories.shop_id', Auth::user()->shop->id)  
          ->where('categories.shop_id', NULL) 
          ->where('products.deleted_at',NULL)
          ->where('products.shop_id', Auth::user()->shop->id) 
          ->where('categories.type_product',1)
          ->whereIn('products.status_id', [2, 4])
          ->where('products.category_id', $c->ids)
          ->where('inventory_details.status',2)
          ->where('inventory_details.inventory_report_id',$id)
          //->select('products.id', 'products.weigth', 'products.line_id', 'products.status_id')
          ->get()
          ->sum('price');

          //CONSULTA PARA OBTENER PIEZAS FALTANTES POR CATEGORIA
          $c->pz_fal = Shop::join('products','products.shop_id','shops.id')
          ->join('categories','categories.id','products.category_id')
          ->join('statuss','statuss.id','products.status_id')
          ->join('branches','branches.id','products.branch_id')
          ->join('inventory_details','inventory_details.product_id','products.id')
          ->where('products.branch_id',$id_branch)
          //->where('categories.shop_id', Auth::user()->shop->id)  
          ->where('categories.shop_id', NULL) 
          ->where('products.deleted_at',NULL)
          ->where('products.shop_id', Auth::user()->shop->id) 
          ->where('categories.type_product',1)
          ->whereIn('products.status_id', [2, 4])
          ->where('products.category_id', $c->ids)
          ->where('inventory_details.status',3)
          ->where('inventory_details.inventory_report_id',$id)
          //->select('products.id', 'products.weigth', 'products.line_id', 'products.status_id')
          ->get()
          ->count('id');

          //CONSULTA PARA OBTENER DINERO POR PIEZAS FALTANTES POR CATEGORIA
          $c->d_fal = Shop::join('products','products.shop_id','shops.id')
          ->join('categories','categories.id','products.category_id')
          ->join('statuss','statuss.id','products.status_id')
          ->join('branches','branches.id','products.branch_id')
          ->join('inventory_details','inventory_details.product_id','products.id')
          ->where('products.branch_id',$id_branch)
          //->where('categories.shop_id', Auth::user()->shop->id)  
          ->where('categories.shop_id', NULL) 
          ->where('products.deleted_at',NULL)
          ->where('products.shop_id', Auth::user()->shop->id) 
          ->where('categories.type_product',1)
          ->whereIn('products.status_id', [2, 4])
          ->where('products.category_id', $c->ids)
          ->where('inventory_details.status',3)
          ->where('inventory_details.inventory_report_id',$id)
          //->select('products.id', 'products.weigth', 'products.line_id', 'products.status_id')
          ->get()
          ->sum('price');

            //OPERACION PARA OBTENER LAS PIEZAS EXISTENTES POR CATEGORIA
          $c->pz_ex = $c->num_pz - $c->pz_da - $c->pz_fal;

           //OPERACION PARA OBTENER EL DINERO EXISTENTE POR CATEGORIA
           $c->din_ex = $c->total - $c->d_da - $c->d_fal;
      }

      //return $cat_totals;
     
     //PRODUCTOS FALTANTES PIEZA
     $p_faltantes = Shop::join('products','products.shop_id','shops.id')
     ->join('categories','categories.id','products.category_id')
     ->join('branches','branches.id','products.branch_id')
     ->join('inventory_details','inventory_details.product_id','products.id')
     ->withTrashed()
     //->where('categories.shop_id', Auth::user()->shop->id)  
     ->whereIn('products.status_id', [2, 4])
     ->where('products.deleted_at',NULL)
     ->where('categories.shop_id', NULL)  
     ->where('products.shop_id', Auth::user()->shop->id) 
     ->where('categories.type_product',1)  
     ->where('products.branch_id',$id_branch)    
     ->where('inventory_details.status',3)  
     ->where('inventory_details.inventory_report_id',$id)
     ->select('products.clave','products.price','products.description','categories.id as id_cat', 'categories.name as cat_name')
     ->groupBy('products.clave','products.price','products.description','categories.id', 'categories.name')
     ->orderBy('cat_name', 'DESC')
     ->get();
      // return $p_faltantes;

     //PRODUCTOS DAÑADOS PIEZA
     $p_dañados = Shop::join('products','products.shop_id','shops.id')
     ->join('categories','categories.id','products.category_id')
     ->join('statuss','statuss.id','products.status_id')
     ->join('branches','branches.id','products.branch_id')
     ->join('inventory_details','inventory_details.product_id','products.id')
     ->whereIn('products.status_id', [2, 4])
     //->where('categories.shop_id', Auth::user()->shop->id)  
     ->where('categories.shop_id', NULL)  
     ->where('products.deleted_at',NULL)
     ->where('products.shop_id', Auth::user()->shop->id) 
     ->where('categories.type_product',1) 
     ->where('products.branch_id',$id_branch)     
     ->where('inventory_details.status',2) 
     ->where('inventory_details.inventory_report_id',$id)
     ->select('products.clave','products.price','products.description','categories.id as id_cat', 'categories.name as cat_name')
     ->groupBy('products.clave','products.price','products.description','categories.id', 'categories.name')
     ->orderBy('cat_name', 'DESC')
     ->get();
     //  return $p_dañados;

     //CONSULTA PARA OBTENER LOS TOTALES DE PRODUCTOS POR PIEZAS DE LA SUCURSAL
     $totales_piezas = Shop::join('products','products.shop_id','shops.id')
     ->join('categories','categories.id','products.category_id')
     ->join('statuss','statuss.id','products.status_id')
     ->join('branches','branches.id','products.branch_id')
     ->join('inventory_details','inventory_details.product_id','products.id')
     ->whereIn('products.status_id', [2, 4])
     //->where('categories.shop_id', Auth::user()->shop->id)  
     ->where('categories.shop_id', NULL)  
     ->where('products.deleted_at',NULL)
     ->where('products.shop_id', Auth::user()->shop->id) 
     ->where('categories.type_product',1) 
     ->where('products.branch_id',$id_branch)
     ->where('inventory_details.inventory_report_id',$id)
     ->select(DB::raw('COUNT(products.id) as piezas, SUM(products.price) as dine'))
     ->get();
     //return $totales_piezas;

     foreach($totales_piezas as $p)
     {
         //CONSULTA PARA OBTENER PIEZAS FALTANTES DE LA SUCURSAL
         $p->falt = Shop::join('products','products.shop_id','shops.id')
         ->join('categories','categories.id','products.category_id')
         ->join('statuss','statuss.id','products.status_id')
         ->join('branches','branches.id','products.branch_id')
         ->join('inventory_details','inventory_details.product_id','products.id')
         ->where('products.branch_id',$id_branch)
         //->where('categories.shop_id', Auth::user()->shop->id)  
         ->where('categories.shop_id', NULL)  
         ->where('products.deleted_at',NULL)
         ->where('products.shop_id', Auth::user()->shop->id) 
         ->where('categories.type_product',1)
         ->whereIn('products.status_id', [2, 4])
         ->Where('inventory_details.status',3)
         ->where('inventory_details.inventory_report_id',$id)
         ->get()
         ->count('id');

         //CONSULTA PARA OBTENER DINERO POR PIEZAS FALTANTES DE LA SUCURSAL
         $p->din_falt = Shop::join('products','products.shop_id','shops.id')
         ->join('categories','categories.id','products.category_id')
         ->join('statuss','statuss.id','products.status_id')
         ->join('branches','branches.id','products.branch_id')
         ->join('inventory_details','inventory_details.product_id','products.id')
         ->where('products.branch_id',$id_branch)
         //->where('categories.shop_id', Auth::user()->shop->id)  
        ->where('categories.shop_id', NULL)  
        ->where('products.deleted_at',NULL)
         ->where('products.shop_id', Auth::user()->shop->id) 
         ->where('categories.type_product',1)
         ->whereIn('products.status_id', [2, 4])
         ->Where('inventory_details.status',3) 
         ->where('inventory_details.inventory_report_id',$id)
         ->get()
         ->sum('price');
         //return $totales_piezas;

         //CONSULTA PARA OBTENER PIEZAS DAÑADAS DE LA SUCURSAL
         $p->da = Shop::join('products','products.shop_id','shops.id')
         ->join('categories','categories.id','products.category_id')
         ->join('statuss','statuss.id','products.status_id')
         ->join('branches','branches.id','products.branch_id')
         ->join('inventory_details','inventory_details.product_id','products.id')
         ->where('products.branch_id',$id_branch)
         //->where('categories.shop_id', Auth::user()->shop->id)  
         ->where('categories.shop_id', NULL)  
         ->where('products.deleted_at',NULL)
         ->where('products.shop_id', Auth::user()->shop->id) 
         ->where('categories.type_product',1)
         ->whereIn('products.status_id', [2, 4])
         ->Where('inventory_details.status',2)
         ->where('inventory_details.inventory_report_id',$id)
         ->get()
         ->count('id');

         //CONSULTA PARA OBTENER DINERO POR PIEZAS DAÑADAS DE LA SUCURSAL
         $p->din_da = Shop::join('products','products.shop_id','shops.id')
         ->join('categories','categories.id','products.category_id')
         ->join('statuss','statuss.id','products.status_id')
         ->join('branches','branches.id','products.branch_id')
         ->join('inventory_details','inventory_details.product_id','products.id')
         ->where('products.branch_id',$id_branch)
         //->where('categories.shop_id', Auth::user()->shop->id)  
        ->where('categories.shop_id', NULL)  
        ->where('products.deleted_at',NULL)
         ->where('products.shop_id', Auth::user()->shop->id) 
         ->where('categories.type_product',1)
         ->whereIn('products.status_id', [2, 4])
         ->Where('inventory_details.status',2) 
         ->where('inventory_details.inventory_report_id',$id)
         ->get()
         ->sum('price');
         //return $totales_piezas;  

           //OPERACION PARA OBTENER LAS PIEZAS EXISTENTES
         $p->exist = $p->piezas - $p->falt - $p->da;

          //OPERACION PARA OBTENER EL DINERO TOTAL EN PRODUCTOS POR PIEZAS EXISTENTES
         $p->din_exis = $p->dine - $p->din_falt - $p->din_da;
     }
     //return $totales_piezas;

     if($shop->image) {
        $shop->image = $this->getS3URL($shop->image);
    }
      $pdf  = PDF::loadView('inventory.Reports.reportPDF', compact('prod_da','totales_piezas','totales_g','report','p_dañados','p_faltantes','prod_fal','cat_totals','shop','dates','shops','lines','gramos_totales'));
      return $pdf->stream('ReporteInventarios.pdf');
    }

    public function reportInventarios(){
        $idshop = Auth::user()->shop->id;
         $user = Auth::user();
         $branch = Shop::find($idshop)->branches()->get();
         //return $branch;
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

      

      //CONSULTA DE REPORTES DE INVENTARIOS
      $inventories = InventoryReport::join('branches','branches.id','inventory_reports.branch_id')
      ->where('branches.shop_id', Auth::user()->shop->id)
      ->select('inventory_reports.*', 'branches.name as name_branch', 'branches.id as branch_id')
      ->get();
      

    //CONSULTAS PARA COLABORADORES POR SUCURSAL
    //SUMA TOTAL DE GRAMOS POR SUCURSAL
    $gramos_s = Shop::join('products','products.shop_id','shops.id')
    ->join('categories','categories.id','products.category_id')
    ->join('statuss','statuss.id','products.status_id')
    ->join('branches','branches.id','products.branch_id')
    ->join('lines','lines.id','products.line_id')
    ->withTrashed()
    ->where('lines.shop_id', Auth::user()->shop->id)  
    ->where('categories.type_product',2) 
   // ->where('products.branch_id',$branches)   
    ->select('lines.id', 'lines.name as name_line', DB::raw('SUM(products.weigth) as total_w'))
    ->distinct('lines.name')
    ->groupBy('lines.id', 'lines.name')
    ->orderBy('name_line', 'DESC')
    ->get();
   // return $gramos_s;

   //SUMA TOTAL DE VENTAS POR SUCURSAL
    

    if($shop->image) {
        $shop->image = $this->getS3URL($shop->image);
    }
         //return $categories;

      return view('inventory.Reports.reportinventory',compact('gramos_s','inventories','hour','dates','shop','shops','branch','user','statuses','line','categories'));
     }

}
