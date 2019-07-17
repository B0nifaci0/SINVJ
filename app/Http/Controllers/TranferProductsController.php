<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\TransferProduct;
use App\Product;
use App\Branch;
use App\User;
use App\State;
use App\Category;
use App\Line;
use PDF;
use DB;
use Auth;
use Illuminate\Support\Facades\Storage;



class TranferProductsController extends Controller
{
    public function index()
       {
        $user = Auth::user();
        $trans = TransferProduct::with('user')
          ->with('newBranch')
          ->where('new_branch_id', $user->branch_id)
          ->get();
         //return response()->json($trans);
         //$status = Auth::user()->shop->id;
        //$statuses = Shop::find($status)->statuss()->get();
        /*$users=Auth::user()->shop->id;
        $trans = Shop::find('users')->trans();
        return $trans;
        if($trans == 0){
          return redirect('/traspasos/create');
        }else{
        }*/
        
        //return $transs;
        $branches=Branch::all();
        return view('transfer/index', compact('branches','user','trans'));
        
       }

       public function create()
       {
        $user = Auth::user(); //Retorna el usuario con el que se encuentra logueado 
        $users = User::where('id', '!=', $user->id)->get(); // Retorna los usuarios que pertenecen a la tienda y no estan logueados
        //return $users;
        $products = Product::where('branch_id', $user->branch_id)->get(); //Retorna todos los productos de la tienda solo si el usuario tiene
        // un  type_user direfente de 0
        //$products = Product::all();
        //return $products;
        $branches = Branch::where('id', '!=', $user->branch_id)->get(); 
        //return $branches;
        return view('transfer/add', compact('branches','users','products'));
       }

       public function store(Request $request)
       {
          $user = Auth::user();
          $data = $request->all();
          $data['last_branch_id']  = $user->branch_id;
          $data['user_id'] = $user->id;

           $transfer_product = TransferProduct::create($data);
           return redirect('/traspasos')->with('mesage', 'El Traspaso se ha agregado exitosamente!');
    }

  public function answerTransferRequest(Request $request) {
    $transfer = TransferProduct::find($request->transfer_id);
    $transfer->status_product = $request->answer;
    $transfer->save();
    return redirect('/traspasos');
  }

public function exportPdf(){ 
    $trans = TransferProduct::all();
    $pdf  = PDF::loadView('transfer.PdfTranfer', compact('trans'));
    return $pdf->download('Traspasos.pdf');
  }

}

//reporte de gastos
//reporte de productos por sucursal 
//Que aparesca el crud de elimina y edita en sucursales productos