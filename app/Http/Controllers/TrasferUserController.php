<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\TrasferUser;
use App\Product;
use App\Branch;
use App\User;
use App\State;
use App\Category;
use App\Line;
use App\TransferProduct;
use PDF;
use DB;
use Auth;
use Illuminate\Support\Facades\Storage;



class TrasferUserController extends Controller
{
    public function index()
       {
        
        // $trans = TransferProduct::all();
        $usersIds = User::where('shop_id', Auth::user()->shop->id)->get()->map(function($u) {
          return $u->id;
        });
        $trans = TransferProduct::whereIn('user_id', $usersIds)
        ->whereIn('destination_user_id', $usersIds)
        ->with('user')->with('branch')->with('product')->get();
        //return $trans;
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
        
        return view('transfer/TrasferUser/index', compact('trans'));
        
       }

       public function create()
       {
        $user = Auth::user();
        $shop_id = $user->shop->id;

        // if($user->branch && $user->branch->id) {
        //   $branch_ids = [$user->branch->id];
        // } else {
        //   $branch_ids = $user->shop->branches->map(function($b) { return $b->id; });
        // }

        if($user->shop && $user->shop->shop_group_id) {
          $shop_ids = Shop::where('shop_group_id', $user->shop->shop_group_id)->get()->map(function($item) { return $item->id;  });
          $branches = Branch::whereIn('shop_id', $shop_ids)
          ->get();
        } else {
          $branches = Branch::where('shop_id', $user->shop->id)
          ->get();
        }
        
          $branch_ids = $branches->map(function($b) { return $b->id; });


        if($user->type_user == User::CO) {
          $products = Product::where('branch_id', $user->branch_id)->get();
        } else {
          $products = Product::join('branches', 'branches.id', 'products.branch_id')
          ->join('shops', 'shops.id', 'branches.shop_id')
          ->where('shops.id', $shop_id)
          ->where('products.status_id', 2)
          ->select(
            'products.id',
            'products.clave',
            //'products.name',
            'products.description',
            'products.weigth',
            'products.observations',
            'products.price',
            'products.image',
            'products.category_id',
            'products.line_id',
            'products.shop_id',
            'products.branch_id',
            'status_id',
            'branches.name as branchName',
            'branches.id as branchId'
            )
            ->get();
        }
        $users = User::where('id', '!=', $user->id)
          ->whereIn('branch_id', $branch_ids)
          ->get();
        return view('transfer/TrasferUser/add', compact('branches','users','products', 'shop_id'));
       }

  public function store(Request $request)
  {
    $product = Product::find($request->product_id);

    $user = Auth::user();
    $transfer_product = new TransferProduct([
      'user_id' => $user->id,
      'last_branch_id' => $request->branch_id,
      'new_branch_id' => $request->new_branch_id,
      'product_id' => $request->product_id,
      'destination_user_id' => $request->destination_user_id,
      'status_product' => null
    ]);
    $transfer_product->save();
    
		$product->status_id = 3;
		$product->save();
      
    return redirect('/traspasosAA')->with('mesage', 'El Traspaso se ha agregado exitosamente!');
  }
 
  public function exportPdf(){ 
    $trans = TrasferUser::all();
    $pdf  = PDF::loadView('transfer.TrasferUser.PdfTranferUser', compact('trans'));
    return $pdf->download('Traspasos.pdf');
  }

}