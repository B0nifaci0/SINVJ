<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Product;
use App\Shop;
use App\TransferExt;
use App\TransferProduct;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransferExtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('transfer/TransferExt/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $shops = Shop::where('id', '!=', $user->shop->id)->get();
        $shop_id = $user->shop->id;
        $branches = Branch::where('shop_id', '!=', $user->shop->id)->get();
        $users = User::where('type_user', User::AA)->get();

        $products = Product::join('branches', 'branches.id', 'products.branch_id')
            ->join('shops', 'shops.id', 'branches.shop_id')
            ->where('shops.id', $shop_id)
            ->where('products.status_id', 2)
            ->select(
                'products.id',
                'products.description',
                'products.clave',
                'branches.name as branchName',
                'branches.id as branchId'
            )
            ->get();

        return view('transfer/TransferExt/add', compact('products', 'shop_id', 'shops', 'branches', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);

        $user = Auth::user();

        if ($request->type == 1) {

            $transfer_product = new TransferProduct([
                'user_id' => $user->id,
                'last_branch_id' => $request->branch_id,
                'new_branch_id' => $request->new_branch_id,
                'product_id' => $request->product_id,
                'destination_user_id' => $request->destination_user_id,
                'status_product' => null,
            ]);
        } else {

            $branch = Branch::create([
                'name' => $request->new_branch,
            ]);
            $branchid = $branch->id;
            $newUser = User::create([
                'name' => $request->destination_user,
                'branch_id' => $branchid,
                'type_user' => User::NO_REGISTER
            ]);
            $userId = $newUser->id;
            $transfer_product = new TransferProduct([
                'user_id' => $user->id,
                'last_branch_id' => $request->branch_id,
                'new_branch_id' => $branchid,
                'product_id' => $request->product_id,
                'destination_user_id' => $userId,
                'status_product' => 1,
            ]);
        }

        $transfer_product->save();

        $product->status_id = Product::TRANSFER;
        $product->save();

        return redirect('/traspasosAA')->with('mesage', 'El Traspaso se ha agregado exitosamente!');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\TransferExt  $transferExt
     * @return \Illuminate\Http\Response
     */
    public function show(TransferExt $transferExt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TransferExt  $transferExt
     * @return \Illuminate\Http\Response
     */
    public function edit(TransferExt $transferExt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TransferExt  $transferExt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransferExt $transferExt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TransferExt  $transferExt
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransferExt $transferExt)
    {
        //
    }
}
