<?php

namespace App\Http\Controllers;

use PDF;
use App\Sale;
use App\Shop;
use App\User;
use App\Branch;
use App\Partial;
use App\SaleDetails;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\S3ImageManager;
use App\Category;
use App\Expense;
use App\TransferProduct;
use App\Http\Requests\BranchRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BranchController extends Controller
{
  use S3ImageManager;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
      $branches= Auth::user()->shop->branches;
        return view('Branches/index', compact('branches','user'));
    }

        /**
     * Index para usuario colaborador.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCo()
    {
      $user = Auth::user();
      $branch = Branch::find(1);
        return view('Branches/CO/sucursal', compact('user','branch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $user = Auth::user();
      $shops = Shop::all();
      return view('Branches/add', compact('shops','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
    {
      //return $request;
       /*$branches= Auth::user()->shop->branches;

        if($name == $request->name){
          return redirect('/sucursales')->with('mesage-delete', 'El nombre ya ha sido registrado!');
        } else */
          
        $branch = new Branch([
          'name' => $request->name,
         // 'name_legal_re' => $request->name_legal_re,
          'email' => $request->email,
          'other' => $request->other,
          'rfc' => $request->rfc,
          'phone_number' => $request->phone_number,
          'address' => $request->address
        ]);
        $branch->shop_id = Auth::user()->shop->id;
        $branch->save();
        //return $branch;
      return redirect('/sucursales')->with('mesage', 'La sucursal  se ha agregado exitosamente!');

    }

    public function setStorePassword(Request $request, $branch)
    {
      // Hash::check($request->nip, $user->nip)
      if($request->password != $request->confirm_password)
        return back()->with('error', 'La contraseña y la confirmación no coinciden');

      $branch->password = Hash::make($request->password);
      $branch->save();
      return Hash::make($request->password);
      return back()->with('success', 'Se ha asignado la contraseña correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->products;

        //var_dump($branch);
    return view('Branches.show', ['branch' => $branch]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = Auth::user();
        $branch = Branch::find($id);
      //return $category;
      return view('Branches/edit', compact('branch','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(BranchRequest $request, $id)
    {
            $branch = Branch::findOrFail($id);
            //return $request->longitude;
            $branch->name =$request->name;
            $branch->name_legal_re =$request->name_legal_re;
            $branch->email =$request->email;
            $branch->other =$request->other;
            $branch->address =$request->address;
            $branch->rfc =$request->rfc;
            $branch->phone_number =$request->phone_number;
            $branch->shop_id = Auth::user()->shop->id;
            $branch->save();

            //return $request->all();
            return redirect('/sucursales')->with('mesage-update','La sucursal  se ha actualizado exitosamente!');
    }

    public function mostrar($id)
    {
      $shop = Auth::user()->shop; 
      $branches_col = Branch::select('*');
      $id_shop = Auth::user()->shop->id;
      $user = Auth::user();
      $branch = Shop::find($id_shop)->branches()->get();
      $shops = Auth::user()->shop()->get();

      if($shop->image) {
        $shop->image = $this->getS3URL($shop->image);
      }

      $branches= Auth::user()->shop->branches;

      $branch = Branch::findOrFail($id);
      $ids = $branch->id;
      //return $ids;
      //return Auth::user()->shop->id;

      $total_tras = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->where('products.branch_id',$ids)
      ->where('lines.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',2)
      ->where('products.deleted_at',null)
      ->select('products.id','products.status_id','lines.id as ids', 'lines.name as name_line', 'lines.sale_price as precio_linea', 'lines.discount_percentage as descuento', DB::raw('SUM(products.weigth) as total_w, SUM(products.weigth * lines.sale_price) as total_line_p, SUM(products.discount * lines.sale_price) as total_tope, SUM(products.weigth * lines.sale_price - (products.weigth * lines.sale_price * (lines.discount_percentage/100))) as total_discount'))
      ->orWhere('products.status_id',2)
      ->where('products.status_id',3)
      ->orWhere('products.status_id',4)
      ->distinct('lines.name')
      ->orderBy('name_line','ASC')
      ->groupBy('products.id','products.status_id','lines.id', 'lines.name', 'lines.discount_percentage', 'lines.sale_price')
      ->get();


      //SUMA TOTAL DE PRECIOS Y GRAMOS POR LINEAS
      $total = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->where('products.branch_id',$ids)
      ->where('lines.shop_id', Auth::user()->shop->id)
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',2)
      ->where('products.deleted_at',null)
      ->orWhere('products.status_id',2)
      ->where('products.status_id',3)
      ->orWhere('products.status_id',4)
      ->select('lines.id as ids', 'lines.name as name_line', 'lines.sale_price as precio_linea', 'lines.discount_percentage as descuento', DB::raw('SUM(products.weigth) as total_w, SUM(products.weigth * lines.sale_price) as total_line_p, SUM(products.discount * lines.sale_price) as total_tope, SUM(products.weigth * lines.sale_price - (products.weigth * lines.sale_price * (lines.discount_percentage/100))) as total_discount'))
      ->distinct('lines.name')
      ->orderBy('name_line','ASC')
      ->groupBy('lines.id', 'lines.name', 'lines.discount_percentage', 'lines.sale_price')
      ->get();

      foreach($total as $t){
        $t->total_exis = Shop::join('products','products.shop_id','shops.id')
        ->join('categories','categories.id','products.category_id')
        ->join('statuss','statuss.id','products.status_id')
        ->join('branches','branches.id','products.branch_id')
        ->join('lines','lines.id','products.line_id')
        ->where('products.branch_id',$ids)
        ->where('lines.shop_id', Auth::user()->shop->id)
        ->where('products.shop_id', Auth::user()->shop->id)
        ->where('categories.type_product',2)
        ->where('products.deleted_at',null)
        ->where('products.status_id', 2)
        ->where('products.line_id', $t->ids)
        ->select('products.id', 'products.weigth', 'products.line_id', 'products.status_id')
        ->get()
        ->sum('weigth');

        $t->total_tras = Shop::join('products','products.shop_id','shops.id')
        ->join('categories','categories.id','products.category_id')
        ->join('statuss','statuss.id','products.status_id')
        ->join('branches','branches.id','products.branch_id')
        ->join('lines','lines.id','products.line_id')
        ->where('products.branch_id',$ids)
        ->where('lines.shop_id', Auth::user()->shop->id)
        ->where('products.shop_id', Auth::user()->shop->id)
        ->where('categories.type_product',2)
        ->where('products.deleted_at',null)
        ->where('products.status_id', 3)
        ->where('products.line_id', $t->ids)
        ->select('products.id', 'products.weigth', 'products.line_id', 'products.status_id')
        ->get()
        ->sum('weigth');

        $t->total_damage = Shop::join('products','products.shop_id','shops.id')
        ->join('categories','categories.id','products.category_id')
        ->join('statuss','statuss.id','products.status_id')
        ->join('branches','branches.id','products.branch_id')
        ->join('lines','lines.id','products.line_id')
        ->where('products.branch_id',$ids)
        ->where('lines.shop_id', Auth::user()->shop->id)
        ->where('products.shop_id', Auth::user()->shop->id)
        ->where('categories.type_product',2)
        ->where('products.deleted_at',null)
        ->where('products.status_id', 4)
        ->where('products.line_id', $t->ids)
        ->select('products.id', 'products.weigth', 'products.line_id', 'products.status_id')
        ->get()
        ->sum('weigth');
      }
      //return $total;

      $total_gramos_tras = Shop::join('products','products.shop_id','shops.id')
      ->join('transfer_products','transfer_products.product_id','products.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->where('products.branch_id',$ids)
      ->where('lines.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',2)
      ->where('transfer_products.status_product',null)
      ->select('lines.id as ids', 'lines.name as name_line', 'lines.sale_price as precio_linea', 'lines.discount_percentage as descuento', DB::raw('SUM(products.weigth) as total_w, SUM(products.weigth * lines.sale_price) as total_line_p, SUM(products.discount * lines.sale_price) as total_tope, SUM(products.weigth * lines.sale_price - (products.weigth * lines.sale_price * (lines.discount_percentage/100))) as total_discount'))
      ->distinct('lines.name')
      ->orderBy('name_line','ASC')
      ->groupBy('lines.id', 'lines.name', 'lines.discount_percentage', 'lines.sale_price')
      ->get();

      //return $total_gramos_tras;

      

      //SUMA TOTAL DE PRECIOS Y GRAMOS POR LINEAS EXISTENTES
      $total_e = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->where('products.status_id',2)
      ->where('lines.shop_id', Auth::user()->shop->id)  
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',2) 
      ->where('products.branch_id',$ids)   
      ->where('products.deleted_at', NULL)
      ->select(DB::raw('SUM(products.weigth) as total_we'))
      ->get();
      //return $total_e;

      //SUMA TOTAL DE PRECIOS Y GRAMOS POR LINEAS TRASPASADOS
      $total_t = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->where('lines.shop_id', Auth::user()->shop->id)  
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',2)
      ->where('products.branch_id',$ids)
      ->where('products.status_id',3)
      ->select(DB::raw('SUM(products.weigth) as total_wt'))
      ->where('lines.shop_id', $id_shop)  
      ->where('products.deleted_at', NULL)
      ->get();
      //return $total_t;

      //SUMA TOTAL DE PRECIOS Y GRAMOS POR DAÑADOS
      $total_d = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->where('lines.shop_id', Auth::user()->shop->id)  
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('products.status_id',4)
      ->where('lines.shop_id', Auth::user()->shop->id)  
      ->where('categories.type_product',2) 
      ->where('products.branch_id',$ids)   
      ->where('products.deleted_at', NULL)
      ->select(DB::raw('SUM(products.weigth) as total_wd'))
      ->get();
      //return $total_d;

     //SUMA TOTAL DE CATEGORIAS POR PIEZAS
      $category = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->where('categories.shop_id', Auth::user()->shop->id)
      ->where('products.shop_id', Auth::user()->shop->id)  
      ->where('categories.type_product',1)
      ->where('products.branch_id',$ids)
      ->where('products.deleted_at', null)
      ->select('categories.id as ids', 'categories.name as cat_name', DB::raw('SUM(products.price) as total, count(products.id) as num_pz'))
      ->orWhere('products.status_id',2)
      ->Where('products.status_id',3)
      ->orWhere('products.status_id',4)
      ->distinct('categories.name')
      ->groupBy('categories.id','categories.name')
      ->orderBy('cat_name', 'ASC')
      ->get();

      foreach($category as $c){
        $c->total_exis = Shop::join('products','products.shop_id','shops.id')
        ->join('categories','categories.id','products.category_id')
        ->join('statuss','statuss.id','products.status_id')
        ->join('branches','branches.id','products.branch_id')
        ->where('categories.shop_id', Auth::user()->shop->id)
        ->where('products.shop_id', Auth::user()->shop->id) 
        ->where('products.branch_id',$ids)
        ->where('categories.shop_id', Auth::user()->shop->id)
        ->where('categories.type_product',1)
        ->where('products.deleted_at',null)
        ->where('products.status_id', 2)
        ->where('products.category_id', $c->ids)
        ->select('products.id', 'products.price', 'products.line_id', 'products.status_id')
        ->get()
        ->count('id');

        $c->total_tras = Shop::join('products','products.shop_id','shops.id')
        ->join('categories','categories.id','products.category_id')
        ->join('statuss','statuss.id','products.status_id')
        ->join('branches','branches.id','products.branch_id')
        ->where('categories.shop_id', Auth::user()->shop->id)
        ->where('products.shop_id', Auth::user()->shop->id) 
        ->where('products.branch_id',$ids)
        ->where('categories.shop_id', Auth::user()->shop->id)
        ->where('categories.type_product',1)
        ->where('products.deleted_at',null)
        ->where('products.status_id', 3)
        ->where('products.category_id', $c->ids)
        ->select('products.id', 'products.price', 'products.line_id', 'products.status_id')
        ->get()
        ->count('id');

        $c->total_damage = Shop::join('products','products.shop_id','shops.id')
        ->join('categories','categories.id','products.category_id')
        ->join('statuss','statuss.id','products.status_id')
        ->join('branches','branches.id','products.branch_id')
        ->where('categories.shop_id', Auth::user()->shop->id)
        ->where('products.shop_id', Auth::user()->shop->id) 
        ->where('products.branch_id',$ids)
        ->where('categories.shop_id', Auth::user()->shop->id)
        ->where('categories.type_product',1)
        ->where('products.deleted_at',null)
        ->where('products.status_id', 4)
        ->where('products.category_id', $c->ids)
        ->select('products.id', 'products.price', 'products.line_id', 'products.status_id')
        ->get()
        ->count('id');
      }

      //SUMA TOTAL DE CATEGORIAS POR PIEZAS EXISTENTES
      $cat_e = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->where('categories.shop_id', Auth::user()->shop->id)
      ->where('products.shop_id', Auth::user()->shop->id) 
      ->where('categories.type_product',1)
      ->where('products.branch_id',$ids)
      ->where('products.status_id',2)
      ->where('products.deleted_at', NULL)
      ->select(DB::raw('count(products.id) as num_pzex'))
      ->get();
      //return $cat_e;

      //SUMA TOTAL DE CATEGORIAS POR PIEZAS TRASPASADAS
      $cat_t = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->where('categories.shop_id', Auth::user()->shop->id)
      ->where('products.shop_id', Auth::user()->shop->id) 
      ->where('categories.type_product',1)
      ->where('products.branch_id',$ids)
      ->where('products.status_id',3)
      ->where('products.deleted_at', NULL)
      ->select(DB::raw('count(products.id) as num_pzt'))
      ->get();

      //SUMA TOTAL DE CATEGORIAS POR PIEZAS DAÑADAS
      $cat_d = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->where('categories.shop_id', Auth::user()->shop->id)
      ->where('products.shop_id', Auth::user()->shop->id) 
      ->where('categories.type_product',1)
      ->where('products.branch_id',$ids)
      ->where('products.status_id',4)
      ->where('products.deleted_at', NULL)
      ->select(DB::raw('count(products.id) as num_pzd'))
      ->get();

      return view('Branches/mostrar', ['cat_d' => $cat_d,'cat_t' => $cat_t,'cat_e' => $cat_e,'total_e'=> $total_e,'total_d'=> $total_d,'category' => $category , 'total_t'=> $total_t,'branch' => $id_shop, 'total' => $total, 'shop' => $shop],compact('branches_col','branch'));
    }

    /** 
     * Remove the specified resource from storage.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Branch::destroy($id);
        // return redirect('/sucursales')->with('mesage', 'La sucursal  se ha eliminado exitosamente!');
        //METODO NO SE PUEDE ELIMINAR SI LA SUCURSAL TIENE PRODUCTOS
        $exist =  Product::where('branch_id', $id)->get()->count();
        //return $exist;
        if($exist > 0){
          return response()->json([
            'success' => false,
            'message' => 'La sucursal no puede ser eliminada, porque tiene productos existentes', 
          ]);
        }
        $existe = User::where('branch_id', $id)->get()->count();
        //return $existe;
        if($existe > 0){
          return response()->json([
            'success' => false,
            'message' => 'La sucursal no puede ser eliminada, porque tiene usuarios asignados',
          ]);
        $have = TransferProduct::where('branch_id', $id)->get()->count();
        if($have > 0){
          return response()->json([
            'success' => false,
            'message' => 'La sucursal no puede ser eliminda, porque tiene transferencias activas',
          ]);
        }
        $has = Expense::where('branch_id', $id)->get()->count();
        if($has > 0){
          return response()->json([
            'success' => false,
            'message' => 'La sucursal no puede ser eliminada, porque tiene gastos existentes',
          ]);
        }
        }else{
          Branch::destroy($id);
          return response()->json([
            'success'=>true
          ]);
        }
    }
    public function users($id)
    {
    	///echo "dfsd";
    	$users = User::where('branch_id', $id);
    	return $users;
    }
//**Vista /Sucursales/corte */
    public function boxcut(){
      $user = Auth::user();
      $branches=Auth::user()->shop->branches;
      return view('Branches/boxcut/reportes',compact('branches','user'));
    }

    public function reportBox_cutDate(Request $request){
      
      $hour = Carbon::now();
      $hour = date('H:i:s');
      $dates = Carbon::now(); 
      $dates = $dates->format('d-m-Y');
      $branch = Branch::findOrFail($request->branch_id);
      $branch->hour = $hour;
      $branch->date = $dates;

      $fecini = Carbon::parse($request->fecini)->format('Y-m-d');
      $fecter = Carbon::parse($request->fecter)->format('Y-m-d');

      $branch->total  = DB::table('partials')
      ->join('sale_details','partials.sale_id', '=', 'sale_details.sale_id')
      ->join('products','sale_details.product_id', '=', 'products.id')
      ->where('partials.updated_at','>=',$fecini,'AND','partials.updated_at','<=',$fecter)
      ->where('branch_id','=',$request->branch_id)
      ->select('partials.amount')->sum('amount');
      $branch->tarjeta  = DB::table('partials')
      ->join('sale_details','partials.sale_id', '=', 'sale_details.sale_id')
      ->join('products','sale_details.product_id', '=', 'products.id')
      ->where('partials.updated_at','>=',$fecini,'AND','partials.updated_at','<=',$fecter)
      ->select('partials.amount')
      ->where('branch_id',$request->branch_id)
      ->where('type',2)
      ->distinct()->sum('amount');
      $branch->efectivo = DB::table('partials')
      ->join('sale_details','partials.sale_id', '=', 'sale_details.sale_id')
      ->join('products','sale_details.product_id', '=', 'products.id')
      ->where('partials.updated_at','>=',$fecini,'AND','partials.updated_at','<=',$fecter)
      ->select('partials.amount')
      ->where('branch_id',$request->branch_id)
      ->where('type',1)
      ->distinct()->sum('amount');
      $branch->gastos = DB::table('expenses')
      ->join('branches','expenses.branch_id','=', 'branches.id')
      ->where('expenses.updated_at','>=',$fecini,'AND','partials.updated_at','<=',$fecter)
      ->select('price')
      ->where('branch_id',$request->branch_id)
      ->sum('price');
      $branch->totalFin = $branch->total - $branch->gastos;  
      $pdf  = PDF::loadView('Branches/boxcut/reportes.box_curt_Branch',compact('branch'));  
     return $pdf->stream('CorteSucursal.pdf');
    }
}   
