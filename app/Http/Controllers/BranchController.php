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
use App\Http\Requests\BranchRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BranchController extends Controller
{


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
       /*$branches= Auth::user()->shop->branches;

        if($name == $request->name){
          return redirect('/sucursales')->with('mesage-delete', 'El nombre ya ha sido registrado!');
        } else */
          
        $branch = new Branch([
          'name' => $request->name
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
    public function update(Request $request, $id)
    {
            $branch = Branch::findOrFail($id);
            //return $request->longitude;
            $branch->name =$request->name;
            $branch->shop_id = Auth::user()->shop->id;
            $branch->save();

            //return $request->all();
            return redirect('/sucursales')->with('mesage-update','La sucursal  se ha actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Branch::destroy($id);
        // return redirect('/sucursales')->with('mesage', 'La sucursal  se ha eliminado exitosamente!');
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


      $fecini = $fecter = date('Y-m-d');
      $fecini = $request->fecini;
      $fecter = $request->fecter;

      
      $branch->total  = DB::table('partials')
      ->join('sale_details','partials.sale_id', '=', 'sale_details.sale_id')
      ->join('products','sale_details.product_id', '=', 'products.id')
      ->whereBetween('partials.updated_at',[$fecini,$fecter])
      ->where('branch_id','=',$request->branch_id)
      ->select('partials.amount')->distinct()->sum('amount');
      $branch->tarjeta  = DB::table('partials')
      ->join('sale_details','partials.sale_id', '=', 'sale_details.sale_id')
      ->join('products','sale_details.product_id', '=', 'products.id')
      ->whereBetween('partials.updated_at',[$fecini,$fecter])
      ->select('partials.amount')
      ->where('branch_id',$request->branch_id)
      ->where('type',2)
      ->distinct()->sum('amount');
      $branch->efectivo = DB::table('partials')
      ->join('sale_details','partials.sale_id', '=', 'sale_details.sale_id')
      ->join('products','sale_details.product_id', '=', 'products.id')
      ->whereBetween('partials.updated_at',[$fecini,$fecter])
      ->select('partials.amount')
      ->where('branch_id',$request->branch_id)
      ->where('type',1)
      ->distinct()->sum('amount');
      $branch->gastos = DB::table('expenses')
      ->join('branches','expenses.branch_id','=', 'branches.id')
      ->whereBetween('expenses.updated_at',[$fecini,$fecter])
      ->select('price')
      ->where('branch_id',$request->branch_id)
      ->sum('price');

      $branch->totalFin = $branch->efectivo - $branch->gastos;
      
      $pdf  = PDF::loadView('Branches/boxcut/reportes.box_curt_Branch',compact('branch'));  
     return $pdf->stream('CorteSucursal.pdf');
    }
}   
