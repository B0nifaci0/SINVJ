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
    public function __construct(){
    }
    public function index()
       {
        $user = Auth::user();
        $trans = TransferProduct::where('user_id', $user->id)
          ->orWhere('destination_user_id', $user->id)
          ->with('user')->with('branch')->with('product')->get();
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
        // return view('transfer/TrasferUser/index', compact('branches','trans','user'));
        return view('transfer/index', compact('branches','user','trans'));
        
       }
       public function indexAA()
       {
         
        $user = Auth::user();
        $trans = TransferProduct::all();
        
          // return ['new_branch_id', $user->branch_id];
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
        return view('transfer/TrasferUser/index', compact('branches','user','trans'));
        
       }
       public function createAA()
       {
        $user = Auth::user();
        $users = User::where('id', '!=', $user->id)->get();
        return $users;
        $products = Product::where('branch_id', $user->branch_id)->get();
        $branches = Branch::all();
        return view('transfer/TrasferUser/add', compact('branches','users','products'));
       }
       

       public function create()
       {
        $user = Auth::user();
        $shop = $user->branch->shop;
        $users = User::where('id', '!=', $user->id)->get();
        $products = Product::where('branch_id', $user->branch_id)->get();
        
        $branches = Branch::where('branches.id', '!=', $user->branch_id)
          ->join('shops', 'shops.id', 'branches.shop_id')
          ->where('shops.id', $shop->id)
          ->select('branches.id', 'branches.name')
          ->get();
        
        $user = Auth::user(); //Retorna el usuario con el que se encuentra logueado 
        $users = User::where('id', '!=', $user->id)->get(); // Retorna los usuarios que pertenecen a la tienda y no estan logueados
        //return $users;
        $products = Product::where('branch_id', $user->branch_id)->get(); //Retorna todos los productos de la tienda solo si el usuario tiene
        // un  type_user direfente de 0
        //$products = Product::all();
        //return $products;
        $branches = Branch::where('id', '!=', $user->branch_id)->get(); 
        //return $branches;
        return view('transfer/add', compact('branches','users','products','user'));
       }

       public function show()
       {
       return view('transfer.show');
       }

       public function store(Request $request)
       {
          $user = Auth::user();
          $data = $request->all();
          $data['last_branch_id']  = $user->branch_id;
          $data['user_id'] = $user->id;
          $data['status_product'] = null;

           $transfer_product = TransferProduct::create($data);
           return redirect('/traspasos')->with('mesage', 'El Traspaso se ha agregado exitosamente!');
    }

  public function answerTransferRequest(Request $request) {
    $user = Auth::user();
    $transfer = TransferProduct::find($request->transfer_id);
    $product = Product::find($transfer->product_id);

    if($request->answer === null) {
      $transfer->delete();
    } else {
      $transfer->status_product = $request->answer;
      $transfer->save(); 
      if($request->answer) {
        $product->branch_id = $transfer->new_branch_id;
        $product->shop_id = $user->shop->id;
        $product->save();
      }
    }
    if($user->type_user == User::AA || $user->type_user == User::SA) {
      return redirect('/traspasosAA');
    } else {
      return redirect('/traspasos');
    }
  }

  
public function exportPdfall(){ 
    $trans = TransferProduct::all();
    $pdf  = PDF::loadView('transfer.PdfTranferall', compact('trans'));
    $pdf->setpaper('letter', 'landscape');
    return $pdf->stream('Traspasos.pdf');
  }

    public function exportPdf($id){
     // return $id;
    $trans = TransferProduct::where("id","=",$id)->get();
    $pdf  = PDF::loadView('transfer.PdfTranfer', compact('trans'));
    return $pdf->stream('Traspaso.pdf');
  }

}

//reporte de gastos
//reporte de productos por sucursal 
//Que aparesca el crud de elimina y edita en sucursales productos