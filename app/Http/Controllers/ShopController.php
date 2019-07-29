<?php

namespace App\Http\Controllers;

use App\Shop;
use App\State;
use Illuminate\Http\Request;
use App\Http\Requests\ShopsValidate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
  public function __construct()
    {
        $this->middleware('Authentication');
    }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $user = Auth::user();
    $shops = Auth::user()->shop()->get();
    return view('Shop/index ', compact('shops','user'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $states = State::all();

      return view('shop/add', compact('states'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ShopsValidate $request)
  {
    if ($request->hasFile('image')){
      $filename = $request->image->getCLientOriginalName();
      $timestamp = time();
       $request->image->storeAs('public/upload/shops',$timestamp . $filename);

       $shop = new Shop($request->all());
       $shop->user_id = Auth::user()->id;
       $shop->image = $timestamp . $filename;
       $shop->save();
       //return $shop;
    }

    //return $request->all();
    return redirect('/tiendas')->with('mesage', 'La tienda se ha agregado exitosamente!');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Shop  $shop
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      
      return view('shop.show', ['shop' => Shop::findOrFail($id)]);

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Shop  $shop
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $user = Auth::user();
      $shop = Shop::find($id);
      $states = State::all();
      return view('Shop/edit', compact('shop', 'states','user'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Shop  $shop
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  { 
       $shop = Shop::findOrFail($id);

      if ($request->hasFile('image')){

        // Borrar imagen anterior
        Storage::delete("public/upload/shops/{$shop->image}");

         $filename = $request->image->getCLientOriginalName();
        $timestamp = time();         
        $request->image->storeAs('public/upload/shops', $timestamp . $filename);
        $shop->image = $timestamp . $filename;       
    }

       $shop->name = $request->name;
       $shop->description = $request->description;
       $shop->email = $request->email;
       $shop->phone_number = $request->phone_number;
       $shop->save();
    //return $request->all();
    return redirect('/principal')->with('mesage-update', 'La tienda se ha modificoo exitosamente!');;
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Shop  $shop
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      $shop = Shop::findOrFail($id);
      Storage::delete("public/upload/shops/{$shop->image}");
      $shop->delete();
      //return redirect('/tiendas')->with('mesage-delete', 'La tienda se ha eliminado exitosamente!');;

  }
} 