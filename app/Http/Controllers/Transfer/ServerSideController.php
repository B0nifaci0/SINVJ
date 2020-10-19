<?php

namespace App\Http\Controllers\Transfer;

use App\User;
use App\TransferProduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ServerSideController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    public function transInt()
    {
        $user = $this->user;
        if ($user->type_user == User::AA) {
            $usersIds = User::where('shop_id', $user->shop->id)->get()->map(function ($u) {
                return $u->id;
            });
            $trans_int = TransferProduct::whereIn('destination_user_id', $usersIds);
        } else
            $trans_int = TransferProduct::where('new_branch_id', $user->branch->id);

        $trans_int = $trans_int->with('user')->with('product.line:id,name')->with('product.category:id,name')->with('lastBranch:id,name')->with('newBranch:id,name')->with('destinationUser:id,name')->get();

        return datatables()->of($trans_int)->toJson();
    }

    public function transOut()
    {
        $user = $this->user;

        if ($user->isAdmin()) {
            $usersIds = User::where('shop_id', Auth::user()->shop->id)->get()->map(function ($u) {
                return $u->id;
            });
            $trans_out = TransferProduct::whereIn('user_id', $usersIds);
        } else
            $trans_out = TransferProduct::where('last_branch_id', $user->branch->id);

        $trans_out = $trans_out->with('user')->with('product.line:id,name')->with('product.category:id,name')->with('lastBranch:id,name')->with('newBranch:id,name')->with('destinationUser:id,name')->get();

        return datatables()->of($trans_out)->toJson();
    }
}
