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
      foreach($branches as $b){
        $b->num_products = Product::withTrashed()->where('branch_id','=',$b->id)->where('deleted_at','=',NULL)->count();
      }
      
     // return $branches;
      
        return view('Branches/index', compact('branches','user'));
    }

    public function verificacion($id){
      $num_products = Product::withTrashed()->where('branch_id','=',$id)->where('deleted_at','=',NULL)->count();
      if($num_products == 0){
        response()->json([
          'success' => false,
          'respuesta' => $id,
          'message' => 'La sucursal no tiene productos activos',
         ]);
       } else {
        return redirect('/sucursales/$id/producto');    
       } 
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
          'name_legal_re' => $request->name_legal_re,
          'email' => $request->email,
          'other' => $request->other,
          'rfc' => $request->rfc,
          'phone_number' => $request->phone_number,
          'address' => $request->address
        ]);
        $branch->shop_id = Auth::user()->shop->id;
        $branch->save();

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
      $braname = Branch::findOrFail($id);
      //return $braname;
      //return $ids;
      //return Auth::user()->shop->id;

      //SUMA TOTAL DE PRECIOS Y GRAMOS POR LINEAS
      $total = Product::join('categories','categories.id','products.category_id')
      ->join('lines','lines.id','products.line_id')
      ->where('products.branch_id',$ids)
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',2)
      ->whereIn('products.status_id', [1, 2, 3, 4])
      ->where('products.restored_at', null)
      ->withTrashed()
      ->select('lines.id as ids', 'lines.name as name_line', 'lines.sale_price as precio_linea', 'lines.discount_percentage as descuento', DB::raw('SUM(products.weigth) as total_w, SUM(products.weigth * lines.sale_price) as total_line_p, SUM(products.discount * lines.sale_price) as total_tope, SUM(products.weigth * lines.sale_price - (products.weigth * lines.sale_price * (lines.discount_percentage/100))) as total_discount'))
      ->distinct('lines.id')
      ->orderBy('name_line','ASC')
      ->groupBy('lines.id', 'lines.name', 'lines.discount_percentage', 'lines.sale_price')
      ->get();

      foreach($total as $t){
        //SUMA TOTAL DE GRAMOS EXISTENTES POR LINEA
        $t->total_exis = Product::join('categories','categories.id','products.category_id')
        ->join('lines','lines.id','products.line_id')
        ->where('products.branch_id',$ids)
        ->where('products.shop_id', Auth::user()->shop->id)
        ->where('categories.type_product',2)
        ->where('products.deleted_at',null)
        ->where('products.status_id', 2)
        ->where('products.line_id', $t->ids)
        ->select('products.id', 'products.weigth', 'products.line_id', 'products.status_id')
        ->get()
        ->sum('weigth');

        //SUMA TOTAL DE GRAMOS TRASPASADOS POR LINEA
        $t->total_tras = Product::join('categories','categories.id','products.category_id')
        ->join('lines','lines.id','products.line_id')
        ->where('products.branch_id',$ids)
        ->where('products.shop_id', Auth::user()->shop->id)
        ->where('categories.type_product',2)
        ->where('products.deleted_at',null)
        ->where('products.status_id', 3)
        ->where('products.line_id', $t->ids)
        ->select('products.id', 'products.weigth', 'products.line_id', 'products.status_id')
        ->get()
        ->sum('weigth');

        //SUMA TOTAL DE GRAMOS DAÑADOS POR LINEA
        $t->total_damage = Product::join('categories','categories.id','products.category_id')
        ->join('lines','lines.id','products.line_id')
        ->where('products.branch_id',$ids)
        ->where('products.shop_id', Auth::user()->shop->id)
        ->where('categories.type_product',2)
        ->where('products.deleted_at',null)
        ->where('products.status_id', 4)
        ->where('products.line_id', $t->ids)
        ->select('products.id', 'products.weigth', 'products.line_id', 'products.status_id')
        ->get()
        ->sum('weigth');
        
        //SUMA TOTAL DE GRAMOS DEVUELTOS POR LINEA
        $t->total_giveback = Product::join('categories','categories.id','products.category_id')
        ->join('lines','lines.id','products.line_id')
        ->withTrashed()
        ->where('products.shop_id', Auth::user()->shop->id)
        ->where('products.branch_id',$ids)
        ->where('categories.type_product',2)
        ->where('products.discar_cause', 3)
        ->where('products.line_id', $t->ids)
        ->whereNull('products.restored_at')
        ->select('products.id', 'products.price', 'products.line_id', 'products.status_id')
        ->sum('products.weigth');

        //SUMA DE DINERO DE PRODUCTOS POR GRAMOS VENDIDOS PERO NO DEVUELTOS
        $t->total_sold_money = Product::join('categories','categories.id','products.category_id')
        ->join('lines','lines.id','products.line_id')
        ->withTrashed()
        ->where('products.shop_id', Auth::user()->shop->id)
        ->where('products.branch_id',$ids)
        ->where('categories.type_product', 2)
        ->where('products.status_id', 1)
        ->whereNull('products.discar_cause')
        ->where('products.line_id', $t->ids)
        ->where('products.restored_at', null)
        ->select('products.id', 'products.price', 'products.status_id')
        ->sum('products.price');

        //SUMA DE DINERO DE PRODUCTOS POR GRAMOS VENDIDOS PERO NO DEVUELTOS CON DESCUENTO
        $t->total_discount_sold_money = Product::join('categories','categories.id','products.category_id')
        ->join('lines','lines.id','products.line_id')
        ->withTrashed()
        ->where('products.shop_id', Auth::user()->shop->id)
        ->where('products.branch_id',$ids)
        ->where('categories.type_product', 2)
        ->where('products.status_id', 1)
        ->whereNull('products.discar_cause')
        ->where('products.line_id', $t->ids)
        ->where('products.restored_at', null)
        ->select('products.id', 'products.price', 'products.status_id')
        ->sum('products.discount');

        //RESTA AL TOTAL DE DINERO POR LINEAS MENOS EL DINERO DE LOS PRODUCTOS YA VENDIDOS
        $t->total_line_p -= $t->total_sold_money;

        //RESTA AL TOTAL DE DINERO POR LINEAS MENOS EL DINERO DE LOS PRODUCTOS YA VENDIDOS CPN DESCUENTO
        $t->total_discount -= $t->total_discount_sold_money;

        $t->totals = $t->total_exis + $t->total_tras + $t->total_damage + $t->total_giveback;
      }
      //return $total;

      //SUMA TOTAL DE PRECIOS Y GRAMOS POR LINEAS EXISTENTES
      $total_e = Product::join('categories','categories.id','products.category_id')
      ->where('products.status_id',2)
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',2)
      ->where('products.branch_id',$ids)
      ->where('products.deleted_at', NULL)
      ->select(DB::raw('SUM(products.weigth) as total_we'))
      ->get();
      //return $total_e;

      //SUMA TOTAL DE PRECIOS Y GRAMOS POR LINEAS TRASPASADOS
      $total_t = Product::join('categories','categories.id','products.category_id')
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',2)
      ->where('products.branch_id',$ids)
      ->where('products.status_id',3)
      ->where('products.deleted_at', NULL)
      ->select(DB::raw('SUM(products.weigth) as total_wt'))
      ->get();
      //return $total_t;

      //SUMA TOTAL DE PRECIOS Y GRAMOS POR DAÑADOS
      $total_d = Product::join('categories','categories.id','products.category_id')
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',2)
      ->where('products.branch_id',$ids)
      ->where('products.deleted_at', NULL)
      ->where('products.status_id',4)
      ->select(DB::raw('SUM(products.weigth) as total_wd'))
      ->get();
      //return $total_d;

      //SUMA TOTAL DE PRECIOS Y GRAMOS POR DEVUELTOS
      $total_devueltos = Product::join('categories','categories.id','products.category_id')
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',2)
      ->where('products.branch_id',$ids)
      ->where('products.discar_cause',3)
      ->whereNull('products.restored_at')
      ->withTrashed()
      ->sum('products.weigth');
      //return $total_devueltos;

     //SUMA TOTAL DE CATEGORIAS POR PIEZAS
      $category = Product::join('categories','categories.id','products.category_id')
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',1)
      ->where('products.branch_id',$ids)
      ->withTrashed()
      ->select('categories.id as ids', 'categories.name as cat_name', DB::raw('SUM(products.discount) as total, count(products.id) as num_pz'))
      ->whereIn('products.status_id', [1, 2, 3, 4])
      ->where('products.restored_at', null)
      ->distinct('categories.id')
      ->groupBy('categories.id','categories.name')
      ->orderBy('cat_name', 'ASC')
      ->get();
      //return $category;

      foreach($category as $c){
        //SUMA DE PIEZAS EXISTENTES POR CATEGORIA
        $c->total_exis = Product::join('categories','categories.id','products.category_id')
        ->where('products.shop_id', Auth::user()->shop->id)
        ->where('products.branch_id',$ids)
        ->where('categories.type_product',1)
        ->where('products.deleted_at',null)
        ->where('products.status_id', 2)
        ->where('products.category_id', $c->ids)
        ->select('products.id', 'products.price', 'products.status_id')
        ->get()
        ->count('id');

        //SUMA DE PIEZAS TRASPASADAS POR CATEGORIA
        $c->total_tras = Product::join('categories','categories.id','products.category_id')
        ->where('products.shop_id', Auth::user()->shop->id)
        ->where('products.branch_id',$ids)
        ->where('categories.type_product',1)
        ->where('products.deleted_at',null)
        ->where('products.status_id', 3)
        ->where('products.category_id', $c->ids)
        ->select('products.id', 'products.price', 'products.status_id')
        ->get()
        ->count('id');

        //SUMA DE PIEZAS DAÑADAS POR CATEGORIA
        $c->total_damage = Product::join('categories','categories.id','products.category_id')
        ->where('products.shop_id', Auth::user()->shop->id)
        ->where('products.branch_id',$ids)
        ->where('categories.type_product',1)
        ->where('products.deleted_at',null)
        ->where('products.status_id', 4)
        ->where('products.category_id', $c->ids)
        ->select('products.id', 'products.price', 'products.status_id')
        ->get()
        ->count('id');

        //SUMA DE PIEZAS DEVUELTAS POR CATEGORIA
        $c->total_giveback = Product::join('categories','categories.id','products.category_id')
        ->withTrashed()
        ->where('products.shop_id', Auth::user()->shop->id)
        ->where('products.branch_id',$ids)
        ->where('categories.type_product',1)
        ->where('products.discar_cause', 3)
        ->where('products.category_id', $c->ids)
        ->where('products.restored_at', null)
        ->select('products.id', 'products.price', 'products.status_id')
        ->get()
        ->count('id');

        //SUMA DE DINERO DE PIEZAS VENDIDAS PERO NO DEVUELTAS
        $c->total_sold_money = Product::join('categories','categories.id','products.category_id')
        ->withTrashed()
        ->where('products.shop_id', Auth::user()->shop->id)
        ->where('products.branch_id',$ids)
        ->where('categories.type_product',1)
        ->where('products.status_id', 1)
        ->whereNull('products.discar_cause')
        ->where('products.category_id', $c->ids)
        ->where('products.restored_at', null)
        ->select('products.id', 'products.price', 'products.status_id')
        ->sum('products.discount');

        //RESTA AL TOTAL DE DINERO POR CATEGORIA MENOS EL DINERO DE LAS PIEZAS YA VENDIDAS
        $c->total -= $c->total_sold_money;

        //SUMA DE TODOS LOS TOTALES DE LOS STATUS
        $c->totals = $c->total_exis + $c->total_tras + $c->total_damage + $c->total_giveback;
      }

      //return $category;

      //SUMA TOTAL DE CATEGORIAS POR PIEZAS EXISTENTES
      $cat_e = Product::join('categories','categories.id','products.category_id')
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',1)
      ->where('products.branch_id',$ids)
      ->where('products.status_id',2)
      ->where('products.deleted_at', NULL)
      ->select(DB::raw('count(products.id) as num_pzex'))
      ->get();
      //return $cat_e;

      //SUMA TOTAL DE CATEGORIAS POR PIEZAS TRASPASADAS
      $cat_t = Product::join('categories','categories.id','products.category_id')
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',1)
      ->where('products.branch_id',$ids)
      ->where('products.status_id',3)
      ->where('products.deleted_at', NULL)
      ->select(DB::raw('count(products.id) as num_pzt'))
      ->get();

      //SUMA TOTAL DE CATEGORIAS POR PIEZAS DAÑADAS
      $cat_d = Product::join('categories','categories.id','products.category_id')
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',1)
      ->where('products.branch_id',$ids)
      ->where('products.deleted_at', NULL)
      ->where('products.status_id',4)
      ->select(DB::raw('count(products.id) as num_pzd'))
      ->get();

      //SUMA TOTAL DE CATEGORIAS POR PIEZAS DEVUELTAS
      $cat_devueltos = Product::join('categories','categories.id','products.category_id')
      ->where('products.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',1)
      ->where('products.branch_id',$ids)
      ->where('products.discar_cause',3)
      ->whereNull('products.restored_at')
      ->withTrashed()
      ->count('products.id');
      //return $cat_devueltos;

      return view('Branches/mostrar', ['total_devueltos' => $total_devueltos,'cat_devueltos' => $cat_devueltos,'cat_d' => $cat_d,'cat_t' => $cat_t,'cat_e' => $cat_e,'total_e'=> $total_e,'total_d'=> $total_d,'category' => $category , 'total_t'=> $total_t,'branch' => $id_shop, 'total' => $total, 'shop' => $shop],compact('braname','branch'));
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

        $shop = Auth::user()->shop;
      $hour = Carbon::now();
      $hour = date('H:i:s');
      $dates = Carbon::now();
      $dates = $dates->format('d-m-Y');
      $branch = Branch::findOrFail($request->branch_id);
      $branch->hour = $hour;
      $branch->date = $dates;

      if($shop->image) {
        $shop->image = $this->getS3URL($shop->image);
    }

      //return $shop->image;

      $fecini = Carbon::parse($request->fecini)->format('Y-m-d');
      $fecter = Carbon::parse($request->fecter)->format('Y-m-d');

      $branch->total  = DB::table('partials')
      ->join('sale_details','partials.sale_id', '=', 'sale_details.sale_id')
      ->join('products','sale_details.product_id', '=', 'products.id')
      ->where('partials.updated_at','>=',$fecini,'AND','partials.updated_at','<=',$fecter)
      ->select('partials.amount')
      ->where('branch_id','=',$request->branch_id)
      ->WhereIn('type',[1,2])
      ->distinct()->sum('amount');

      //return $branch->total;
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

      //return $branch->efectivo;

      $branch->gastos = DB::table('expenses')
      ->join('branches','expenses.branch_id','=', 'branches.id')
      ->where('expenses.updated_at','>=',$fecini,'AND','partials.updated_at','<=',$fecter)
      ->select('price')
      ->where('branch_id',$request->branch_id)
      ->sum('price');
      $branch->cambio = Sale::where('branch_id', $request->branch_id)
      ->where('updated_at','>=',$fecini,'AND','updated_at','<=',$fecter)
      ->sum('change');
      $branch->efectivo -= $branch->cambio;
      $branch->total -= $branch->cambio;
      $branch->totalFin = $branch->total-$branch->tarjeta - $branch->gastos;
      //return $branch->totalFin;
      //return $branch;
      $pdf  = PDF::loadView('Branches/boxcut/reportes.box_curt_Branch',compact('branch','shop'));
     return $pdf->stream('CorteSucursal.pdf');
    }
}
