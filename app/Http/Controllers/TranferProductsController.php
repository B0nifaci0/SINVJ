<?php

namespace App\Http\Controllers;
use App\Product;
use App\Branch;
use App\User;
use App\TransferProduct;
use App\State;
use App\Category;
use App\Line;
use PDF;
use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class TranferProductsController extends Controller
{
    public function index()
       {
        $trans = TransferProduct::with('user')->with('branch')->get();
        $users=User::all();
        $branches=Branch::all();
        return view('transfer/index', compact('branches','users','products','trans'));
       
       }

       public function create()
       {
        $users = User::all();
        $products = Product::all();
        $branches = Branch::all();
        return view('transfer/add', compact('branches','users','products'));
       }

       public function store()
       {
           $transfer_products = new TransferProduct;
           $transfer_products->save();
   
           return redirect('/traspasos')->with('mesage', 'El Traspaso se ha agregado exitosamente!');
}

public function exportPdf(){ 
    $trans = TransferProduct::all();
    $pdf  = PDF::loadView('transfer.PdfTranfer', compact('trans'));
    return $pdf->download('Traspasos.pdf');
  }

}