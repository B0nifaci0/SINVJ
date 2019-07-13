<?php

namespace App\Http\Controllers;


use App\Branch;
use App\User;
use App\Product;
use PDF;
use Home;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('Authentication');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

              $branches = Branch::all();
              $users = User::all();
             
        return view('home/home', compact('branches','users'));
    }
    public function exportPdf(){ 
        $products = Product::all();
        $branches = Branch::all();
        $users = User::all();
        $pdf  = PDF::loadView('home.pdf', compact('products','users'));
        return $pdf->download('home.pdf');
      }
}
