<?php

namespace App\Http\Controllers;
use App\Branch;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Shop;
use PDF; 
use App\User;
use Illuminate\Support\Facades\Auth;
class BranchProductsController extends Controller

{
  public function index($id)
  {
      $user = Auth::user();
      $branches= Branch::find($id);
      $products = Product::withTrashed()->where('branch_id','=',$id)->get();
      return view('Branches/branchproduct', compact('branches','id','products','user')); 
  }
  public function edit($id)
    {
        $user = Auth::user();
        $category = Auth::user()->shop->id;
        $user = Auth::user();
        $line = Auth::user()->shop->id; 
        $shops = Auth::user()->shop()->get();
        $categorys = Shop::find($category)->categories()->get();
        $lines = Shop::find($line)->lines()->get();
        $branch = Auth::user()->shop->id; 
        $branches = Shop::find($branch)->branches()->get();
        $status = Auth::user()->shop->id;
        $statuses = Shop::find($status)->statuss()->get();
        $product = Product::find($id);
        
      return view('Branches/editproduct', compact('product', 'categorys','lines','shops','branches','statuses','user'));
    }
    public function update(Request $request, $id)
    {
      return $request;
        $product = Product::findOrFail($id);

        if ($request->hasFile('image')){

          // Borrar imagen anterior
          Storage::delete("public/upload/products/{$product->image}");

          $filename = $request->image->getCLientOriginalName();
          $timestamp = time();
          $request->image->storeAs('public/upload/products', $timestamp . $filename);
          $product->image = $timestamp . $filename;
      } 

         $product->description = $request->description;
         $product->weigth = $request->weigth;
         $product->observations = $request->observations;
         $product->price = $request->price;
         
         $product->inventory = $request->inventory;

         $product->save();

      //return $request->all();
      return redirect('/sucursales')->with('mesage-update', 'El producto se ha actualizado  exitosamente!');
    }
    public function destroy($id)
    {
      Product::destroy($id);
    // return redirect('/productos')->with('mesage-delete', 'El producto se ha eliminado exitosamente!');
  
    }
  public function exportPdf($id){
      $branches= Branch::find($id);
      $products = Product::withTrashed()->where('branch_id','=',$id)->get();
      $pdf  = PDF::loadView('Branches.sucursalespdf', compact('branches', 'products'));
      return $pdf->download('productossucursal.pdf');
  }

  /**fucntion for inventory index */
    public function inventory($id){
      $user = Auth::user();
      $branches= Branch::find($id);
      //return $branches;
      $products = Product::withTrashed()->where('branch_id','=',$id)->get();
      //return $products;
      return view('Branches/Inventory/biproduct', compact('branches','id','products','user')); 
    }
}
