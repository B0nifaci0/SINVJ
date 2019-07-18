<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\Product;
use App\Shop;
use App\User;
use Illuminate\Support\Facades\Auth;
class ProductsBranchController extends Controller
{
  public function index($id)
  {
    $user = Auth::user();
    //$shop = Shop::find($id);
    $shop = Shop::withTrashed()->where('id',$id)->get()->first();
    //echo $shop;
     //$product = Product::where('shop_id','=', $id);
     //return$shop->products;
  return view('collection', compact('shop','user'));
}
}
