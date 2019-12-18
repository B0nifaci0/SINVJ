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
          'name_legal_re' => $request->name_legal_re,
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
      $branch = Auth::user()->shop->id;
      $user = Auth::user();
      $branch = Shop::find($branch)->branches()->get();
      $shops = Auth::user()->shop()->get();

      if($shop->image) {
        $shop->image = $this->getS3URL($shop->image);
      }

      $branches= Auth::user()->shop->branches;

      $branch = Branch::findOrFail($id);
      $ids = $branch->id;
      //return $ids;
      //return Auth::user()->shop->id;
      $total = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->where('products.status_id',2)
      ->where('lines.shop_id', Auth::user()->shop->id)  
      ->where('categories.type_product',2) 
      ->where('products.branch_id',$ids)   
      ->select('lines.id', 'lines.name as name_line', 'lines.sale_price as precio_linea', 'lines.discount_percentage as descuento', DB::raw('SUM(products.weigth) as total_w, SUM(products.weigth * lines.sale_price) as total_line_p, SUM(products.discount * lines.sale_price) as total_tope, SUM(products.weigth * lines.sale_price - (products.weigth * lines.sale_price * (lines.discount_percentage/100))) as total_discount'))
      ->distinct('lines.name')
      ->groupBy('lines.id', 'lines.name', 'lines.discount_percentage', 'lines.sale_price')
      ->orderBy('name_line', 'DESC')
      ->get();
     // return $total;

      $category = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->where('categories.shop_id', Auth::user()->shop->id)
      ->where('categories.type_product',1)
      ->where('products.branch_id',$ids)
      ->where('products.status_id',2)
      ->select('categories.id', 'categories.name as cat_name', DB::raw('SUM(products.price) as total, count(products.id) as num_pz'))
      ->distinct('categories.name')
      ->groupBy('categories.id','categories.name')
      ->orderBy('cat_name', 'DESC')
      ->get();
     // return $category;

      return view('Branches/mostrar', ['category' => $category ,'branch' => $branch, 'total' => $total, 'shop' => $shop]);
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
        $exist =  Product::where('branch_id', $id)->get()->count();
        //return $exist;
        if($exist > 0){
          return response()->json([
            'success' => false
          ]);
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
