<?php

namespace App\Http\Controllers;

use App\Shop;
use App\State; 
use Illuminate\Http\Request;
use App\Http\Requests\ShopRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Traits\S3ImageManager;
use Illuminate\Support\Facades\Hash;


class ShopController extends Controller
{
  use S3ImageManager;
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
    $shop_img = Auth::user()->shop;
    $shops = Auth::user()->shop()->get();
    if($shop_img->image) {
      $shop_img->image = $this->getS3URL($shop_img->image);
    }
    //return $shop;
    /**
     * Checar para hacer la comparacion entre el null para hacer el remplazo de informacion
     */

    return view('Shop/index ', compact('shops','user','shop_img'));
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
  public function store(ShopRequest $request)
  {
    if ($request->hasFile('image')){
      $filename = $request->image->getCLientOriginalName();
      $timestamp = time();
      $request->image->storeAs('public/upload/shops',$timestamp . $filename);

      $shop = new Shop($request->all());
      $shop->password = Hash::make($request->password);
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
	public function update(ShopRequest $request, $id)
	{ 
    	$shop = Shop::findOrFail($id);

		if($request->hasFile('image')) {
			$adapter = Storage::disk('s3')->getDriver()->getAdapter();
			$image = file_get_contents($request->file('image')->path());
			$base64Image = base64_encode($image);
			$path = 'shops';
			$shop->image = $this->saveImages($base64Image, $path, $shop->id);
		}

    	$shop->name = $request->name;
    	$shop->description = $request->description;
    	$shop->email = $request->email;
    	$shop->password = Hash::make($request->password);
    	$shop->phone_number = $request->phone_number;
    	$shop->save();
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