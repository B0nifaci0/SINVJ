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
        $users = User::where('branch_id', $id)->get();
        $shop = Shop::find($id);
        $admin = User::where('shop_id', $shop->id)->first();
        $users->push($admin);

        return $users;  
    }
}