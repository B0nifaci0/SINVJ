<?php

namespace App\Http\Controllers;
use App\Product;
use App\Branch;
use App\User;
use PDF;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TranferProductsController extends Controller
{
    public function index()
       {
        $branches = Auth::user()->shop->branches;
        $users = User::with('type_user != 0');
        $products = Product::all();
        return view('transfer/index', compact('branches','users','products'));
       }
}
