<?php

namespace App\Http\Controllers;
use App\Branch;
use Illuminate\Http\Request;
use App\Product;
class BranchProductsController extends Controller
{
  public function index($id)
  {

      $branches= Branch::find($id);
      $products = Product::withTrashed()->where('branch_id','=',$id)->get();

      return view('panel-structure', compact('branches','id','products'));
  }


}
