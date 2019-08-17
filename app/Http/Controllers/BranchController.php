<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Shop;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\BranchRequest;
//use App\Http\Requests\BranchValidate;
use Illuminate\Support\Facades\Auth;


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
          
        $branch = new Branch($request->all());
        $branch->shop_id = Auth::user()->shop->id;
        $branch->save();
        //return $branch;
      return redirect('/sucursales')->with('mesage', 'La sucursal  se ha agregado exitosamente!');

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
}
