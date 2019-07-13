<?php

namespace App\Http\Controllers;

use App\State;
use App\Product;
use App\Category;
use App\Shop;
use App\Line;
use App\Branch;
use App\Status;
use App\User;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductValidate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

  public function __construct(){
    $this->middleware('Authentication');
    $this->middleware('shop');
    $this->middleware('BranchMiddleware');
    $this->middleware('CategoryMiddleware');
    $this->middleware('LineMiddleware');
    $this->middleware('StatusMiddleware'); 
  }
    
    public function index()
    {
     /* $products = Product::with('category')->with('branch')->with('line')->with('status')->get();
      $categories = Category::all();
      $user = Auth::user();
        //return $user ;
      $lines = Line::all();
      $statuses = Status::all();
      return view('product/index', compact('user','products', 'categories','lines','statuses')); */
        
        $user = Auth::user();
        $shop_id = $user->shop->id;
        if($user->type_user == User::CO) {
          $products = Product::where('branch_id', $user->branch_id)->get();
        } else {
          $products = Shop::find($shop_id)->products()->get();
        }
        //return $products;
        $user = Auth::user(); 
        //$categories = Category::all();
        $shops = Auth::user()->shop()->get();
        //return $shops;
        $category = Auth::user()->shop->id;  
        $categories = Shop::find($category)->categories()->get();
        $line = Auth::user()->shop->id; 
        $lines = Shop::find($line)->lines()->get();
        //return $lines;  
        $status = Auth::user()->shop->id;
        $statuses = Shop::find($status)->statuss()->get();

        return view('product/index', compact('user', 'categories','lines','shops','statuses','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Auth::user()->shop->id;
        //return $category;
        $user = Auth::user();
        $line = Auth::user()->shop->id; 
        $shops = Auth::user()->shop()->get();
        //return $shops;  
        $categories = Shop::find($category)->categories()->get();
        $lines = Shop::find($line)->lines()->get();
        //return $lines;  
        $status = Auth::user()->shop->id;
        $statuses = Shop::find($status)->statuss()->get();
        return view('product/add', compact('user', 'categories','lines','shops','statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductValidate $request)
    {
      $product = new Product($request->all());
      if ($request->hasFile('image')){
         $filename = $request->image->getCLientOriginalName();
         $request->image->storeAs('public/upload/products',$filename);
         $product->image = $filename;
      }
      $product->save();
      return redirect('/productos')->with('success', true);
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
      /*$product = Product::find($id);
      $categorys = Category::all();
      $lines = Line::all();
      $shops = Shop::all();
      $branches = Branch::all();
      $statuses = Status::all();*/
        $category = Auth::user()->shop->id;
        //return $category;
        $user = Auth::user();
        #$categories = Category::all();
        $line = Auth::user()->shop->id; 
        $shops = Auth::user()->shop()->get();
        //return $shops;  
        $categorys = Shop::find($category)->categories()->get();
        $lines = Shop::find($line)->lines()->get();
        $branch = Auth::user()->shop->id; 
        $branches = Shop::find($branch)->branches()->get();
        //return $lines;  
        $status = Auth::user()->shop->id;
        $statuses = Shop::find($status)->statuss()->get();
        $product = Product::find($id);
        //return $product;
        
      return view('product/edit', compact('product', 'categorys','lines','shops','branches','statuses'));
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
         $product->weigth = $request->weigth;
         $product->observations = $request->observations;
         $product->price = $request->price;
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
        // return redirect('/productos')->with('mesage-delete', 'El producto se ha eliminado exitosamente!');
      
        }
    public function exportPdf(){ 
        $product = Auth::user()->shop->id;
        $products = Shop::find($product)->products()->get();
        //return $products;
        $user = Auth::user(); 
        //$categories = Category::all();
        $shops = Auth::user()->shop()->get();
        //return $shops;
        $category = Auth::user()->shop->id;  
        $categories = Shop::find($category)->categories()->get();
        $line = Auth::user()->shop->id; 
        $lines = Shop::find($line)->lines()->get();
        //return $lines;  
        $status = Auth::user()->shop->id;
        $statuses = Shop::find($status)->statuss()->get();
      $pdf  = PDF::loadView('product.pdf', compact('user', 'categories','lines','shops','statuses','products'));
      return $pdf->download('product.pdf');
    }

}