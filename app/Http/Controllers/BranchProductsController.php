<?php

namespace App\Http\Controllers;

use PDF;
use App\Line;
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
        $branch = Branch::findOrFail($id);

        $products = $branch->products()->orderBy('created_at', 'desc')->paginate(10);

        return view('Branches/branchproduct', compact('products', 'branch'));
    }

    function search(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);

            $branch_id = $request->get('branch');
            $branch = Branch::findOrFail($branch_id);
            $products = $branch->products();
            if ($query != "") {

                $status = Status::where('name', 'like', '%' . $query . '%')->first();

                $products = $products->where('description', 'like', '%' . $query . '%')
                    ->orWhere('clave', 'like', '%' . $query . '%')
                    ->orWhere('observations', 'like', '%' . $query . '%');

                if ($status) {
                    $products = $products->orWhere('status_id', $status->id);
                }
            }
            $products = $products->orderByRaw('CHAR_LENGTH(clave)')
                ->orderBy('clave')->paginate(10);
            return view('Branches/table', compact('products'))->render();
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
