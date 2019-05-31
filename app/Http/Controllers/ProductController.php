<?php

namespace App\Http\Controllers;

use App\State;
use App\Product;
use App\Category;
use App\Shop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductValidate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

  public function __construct(){
    $this->middleware('auth');
    
  }
    
    public function index()
    {
      $products = Product::all();
    return view('product/index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $categories = Category::all();
        //echo "$user";
        return view('product/add', compact('user', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductValidate $request)
    {
      if ($request->hasFile('image')){
        $filename = $request->image->getCLientOriginalName();
         $request->image->storeAs('public/upload/products',$filename);

         $product = new Product($request->all());
         $product->image = $filename;
         $product->deleted_at = date('Y-m-d');
         $product->save();
        return redirect('/productos')->with('mesage', 'El producto se ha agregado exitosamente!');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    return view('product.show', ['product' => Product::findOrFail($id)]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $product = Product::find($id);
      $categorys = Category::all();

      return view('product/edit', compact('product', 'categorys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductValidate $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->hasFile('image')){

          // Borrar imagen anterior
          Storage::delete("public/upload/products/{$product->image}");

          $filename = $request->image->getCLientOriginalName();
          $timestamp = time();
          $request->image->storeAs('public/upload/products', $timestamp . $filename);
          $product->image = $timestamp . $filename;
      }

         $product->name = $request->name;
         $product->description = $request->description;
         $product->purity = $request->purity;
         $product->weigth = $request->weigth;
         $product->price = $request->price;
         $product->nationality = $request->nationality;
         $product->category_id = $request->category_id;
         $product->save();

      //return $request->all();
      return redirect('/productos')->with('mesage-update', 'El producto se ha actualizado  exitosamente!');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Product::destroy($id);
      return redirect('/productos')->with('mesage-delete', 'El producto se ha eliminado exitosamente!');
    }

    public function paypalItem(){
      return \PaypalPayment::item()->setName($product->name)
                                ->setDescription($product->description)
                                ->setCurrency('USD')
                                ->setQuantity(1)
                                ->setPrice($this->pricing);
    }
}
