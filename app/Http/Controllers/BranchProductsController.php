<?php

namespace App\Http\Controllers;

use PDF;
use App\Shop;
use App\Branch;
use App\Status;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\S3ImageManager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BranchProductsController extends Controller

{

    use S3ImageManager;

    /** Función para listar los productos por sucursal pra el usuario administrador y sub-administrador  */
    public function index($id)
    {


        $user = Auth::user();
        $branch = Branch::find($id);
        $shop_id = Auth::user()->shop->id;
        $categories = Shop::find($shop_id)->categories()->get();
        $lines = Shop::find($shop_id)->lines()->get();
        $statuses = Status::all();
        $products = Product::withTrashed()->where('branch_id', '=', $id)->where('deleted_at', '=', NULL)->get();
        $num_products = Product::withTrashed()->where('branch_id', '=', $id)->where('deleted_at', '=', NULL)->count();
        $adapter = Storage::disk('s3')->getDriver()->getAdapter();

        foreach ($products as $product) {
            if ($product->image) {

                $path = env('S3_ENVIRONMENT') . '/' . 'products/' . $product->clave;

                $command = $adapter->getClient()->getCommand('GetObject', [
                    'Bucket' => $adapter->getBucket(),
                    'Key' => $adapter->getPathPrefix() . $path
                ]);

                $result = $adapter->getClient()->createPresignedRequest($command, '+20 minute');

                $product->image = (string) $result->getUri();
            }
        }

        if ($num_products == 0) {
            return redirect('/productos/create')->with('mesage', 'Primero debes crear productos de esta Sucursal!');
        } else {
            return view('Branches/branchproduct', compact('branch', 'products', 'user', 'categories', 'lines', 'statuses'));
        }
    }
    public function edit($id)
    {
        $user = Auth::user();
        $category = Auth::user()->shop->id;
        $line = Auth::user()->shop->id;
        $shops = Auth::user()->shop()->get();
        $categorys = Shop::find($category)->categories()->get();
        $lines = Shop::find($line)->lines()->get();
        $branch = Auth::user()->shop->id;
        $branches = Shop::find($branch)->branches()->get();
        $status = Auth::user()->shop->id;
        //$statuses = Shop::find($status)->statuss()->get();
        $statuses = Status::all();
        $product = Product::find($id);

        return view('Branches/editproduct', compact('product', 'categorys', 'lines', 'shops', 'branches', 'statuses', 'user'));
    }
    public function update(Request $request, $id)
    {
        return $request;
        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {

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
    public function exportPdf($id)
    {
        $shop = Auth::user()->shop;
        $date = Carbon::now();
        $date = $date->format('d-m-Y');
        $hour = Carbon::now();
        $hour = date('H:i:s');

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $branch = Branch::findOrFail($id);
        $products = $branch->products()
            ->orderByRaw('CHAR_LENGTH(clave)')
            ->orderBy('clave')
            ->get();
        //return $products;
        $pdf  = PDF::loadView('Branches.sucursalespdf', compact('branch', 'products', 'date', 'hour', 'shop'));
        return $pdf->stream('productossucursal.pdf');
    }

    /**fucntion for inventory index */
    public function inventory($id)
    {
        $user = Auth::user();
        $branches = Branch::find($id);
        //return $branches;
        $products = Product::withTrashed()->where('branch_id', '=', $id)->get();
        //return $products;
        return view('Branches/Inventory/biproduct', compact('branches', 'id', 'products', 'user'));
    }
}
