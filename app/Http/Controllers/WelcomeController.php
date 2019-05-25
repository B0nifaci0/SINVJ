<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\State;
use App\Shop;
use App\Promotion;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{

  public function index(){
      $categories = Category::all();
      $products = Product::all();
      $states = State::all();
      $shops = Shop::all();
      $promotions = Promotion::all();
      return view('welcome', compact('products','categories', 'states', 'shops','promotions'));

  }

}
