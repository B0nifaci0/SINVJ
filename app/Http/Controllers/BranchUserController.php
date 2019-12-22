<?php

namespace App\Http\Controllers;

use App\User;
use App\Shop;
use App\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchUserController extends Controller
{
	// Controlador de recursos anidados
    public function index($id)
    {
        $branch = Branch::find($id);
        $users = User::where('branch_id', $branch->id)->get();
        $shop = Shop::find($branch->shop_id);
        $admin = User::where('shop_id', $shop->id)->first();
        $users->push($admin);

        return $users;  
    }
}