<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Shop;
use App\Line;
use App\Branch;
use App\Status;
use App\User;
use App\Sale;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductValidate;
use Illuminate\Support\Facades\Storage;

class BranchProductsController extends Controller

{
  /** Función para listar los productos por sucursal pra el usuario administrador y sub-administrador  */
  public function index($id)
  {
      $user = Auth::user();
      $branch= Branch::find($id);
      $shop_id = Auth::user()->shop->id;
      $categories = Shop::find($shop_id)->categories()->get();
      $lines = Shop::find($shop_id)->lines()->get();
    	$statuses = Status::all();
      $products = Product::withTrashed()->where('branch_id','=',$id)->get();
      
      $adapter = Storage::disk('s3')->getDriver()->getAdapter();

      foreach ($products as $product) {
        if($product->image) {
          $command = $adapter->getClient()->getCommand('GetObject', [
            'Bucket' => $adapter->getBucket(),
            'Key' => $adapter->getPathPrefix(). 'products/' . $product->clave
          ]);
  
          $result = $adapter->getClient()->createPresignedRequest($command, '+20 minute');
  
          $product->image = (string) $result->getUri();
        }
      }

      return view('Branches/branchproduct', compact('branch','products','user','categories','lines','statuses'));
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
