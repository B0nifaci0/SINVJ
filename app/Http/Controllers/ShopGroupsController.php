<?php

namespace App\Http\Controllers;

use App\Line;
use App\Shop;
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
        $shop_groups = ShopGroup::where('id', $user->shop->shop_group_id)->get();
        return view('shop_groups.index', compact('shop_groups', 'user'));
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

        return redirect('/grupos')->with('mesage', "Te has unido al grupo {$shopGroup->name} exitosamente");
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
}
