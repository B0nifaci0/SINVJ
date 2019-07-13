<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\Product;
use App\Category;
use App\Municipality;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductSearch extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function search(Request $request)
     {
         //return $request->all();
         $municipality = Municipality::find($request->id_municipality);
         $state_name = $municipality->state->name;
         $string = "concat('%', '$state_name' ,'%')";
         $products = DB::table('products')
                  ->join('branches', 'products.branch_id', '=', 'branches.id')
                  ->where('products.category_id', '=', $request->id_category)
                  ->where('branches.state', 'like', '%' . $state_name . '%')
                  ->get();
         $categories = Category::all();
         $states = State::all();
         //return $products;
          return view('results', compact('products', 'categories', 'states'));
     }

    public function index()
    {
      $categories = Category::all();
      $states = State::all();
        return view('collection-left',compact('categories','states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
