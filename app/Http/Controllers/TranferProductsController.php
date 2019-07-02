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
        $users = Auth::user()->shop->branch;
        $users = User::all();
        $products = Product::all();
        $branches = Branch::all();
        return view('transfer/index', compact('branches','users','products'));
       }
}
