<?php

namespace App\Http\Controllers;

use App\Line;
use App\User;
use App\Category;
use App\ShopGroup;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopGroupsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $shop_group = ShopGroup::where('id', $user->shop->shop_group_id)->first();
        return view('shop_groups.index', compact('shop_group', 'user'));
    }

    public function create()
    {
        $user = Auth::user();
        return view('shop_groups.create', compact('user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $shopGroup = ShopGroup::create([
            'name' => $request->name,
            'admin_id' => $user->id,
            'group_code' => time(),
            'password' => Str::random(10),
        ]);
        $user->shop->shop_group_id = $shopGroup->id;
        $user->admin_group = User::ADMIN_GROUP;
        $user->save();
        $user->shop->save();
        return redirect('/grupos')->with('mesage', 'Se ha creado el grupo correctamente');
    }

    public function groupJoinForm()
    {
        $user = Auth::user();
        return view('shop_groups.join_group', compact('user'));
    }

    public function groupJoin(Request $request)
    {
        $user = Auth::user();
        $shopGroup = ShopGroup::where([
            'group_code' => $request->code,
            'password' => $request->password
        ])->first();

        if (!$shopGroup) {
            return redirect('/grupos')->with('mesage', "El grupo que buscas no existe");
        }

        $shop = $user->shop;
        $shop->shop_group_id = $shopGroup->id;
        $shop->save();

        return redirect('/changeCategoriesAndLines')->with('mesage', "Te has unido al grupo {$shopGroup->name} exitosamente, ahora es necesario actualizar las lineas y categorias de tus productos existentes.");
    }

    function categories()
    {
        $user = Auth::user();
        $group = $user->shop->shop_group_id;
        $categories = Category::where('shop_group_id', $group)->get();

        return view('shop_groups/categories', compact('categories', 'user'));
    }

    function lines()
    {
        $user = Auth::user();
        $group = $user->shop->shop_group_id;
        $lines = Line::where('shop_group_id', $group)->get();

        return view('shop_groups/lines', compact('lines', 'user'));
    }

    function changeCategoriesAndLines()
    {
        $user = Auth::user();

        $products = $user->shop->products()
            ->where('products.status_id', 2);

        $categories = $products->with('category')
            ->get()
            ->pluck('category')
            ->unique()
            ->where('shop_id', $user->shop->id);

        $lines = $products->with('line')
            ->get()
            ->pluck('line')
            ->unique()
            ->where('shop_id', $user->shop->id);

        if (!$lines->count() && !$categories->count()) {
            return redirect('productos')->with('mesage', "No tienes productos por actualizar.");
        }

        $group = $user->shop->shop_group_id;
        $lines_group = Line::where('shop_group_id', $group)->get();
        $categories_group = Category::where('shop_group_id', $group)->get();

        return view('shop_groups/changeCategoriesAndLines', compact('categories', 'lines', 'categories_group', 'lines_group'));
    }

    function updateCategories(Request $request)
    {
        $user = Auth::user();
        $products = $user->shop->products
            ->where('category_id', $request->category_id)
            ->where('status_id', 2);
        foreach ($products as $product) {
            $product->category_id = $request->new_category_id;
            $product->update();
        }
        return redirect('changeCategoriesAndLines')->with('mesage', "Los productos han sido actualizados exitosamente");
    }

    function updateLines(Request $request)
    {
        $user = Auth::user();
        $newLine = Line::where('id', $request->new_line_id);
        $products = $user->shop->products
            ->where('line_id', $request->line_id)
            ->where('status_id', 2);
        foreach ($products as $product) {
            $product->line_id = $newLine->id;
            $product->purchase_price = $product->weigth * $newLine->purchase_price;
            $product->sale_price = $product->weigth * $newLine->sale_price;
            $product->update();
        }
        return redirect('changeCategoriesAndLines')->with('mesage', "Los productos han sido actualizados exitosamente");
    }
}
