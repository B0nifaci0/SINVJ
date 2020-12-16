<?php

namespace App\Http\Controllers\Transfer;

use App\User;
use Carbon\Carbon;
use App\TransferProduct;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GraphicController extends Controller
{
    public function transferInt()
    {
        $user = Auth()->user();
        $usersIds = User::where('shop_id', $user->shop->id)->get()->map(function ($u) {
            return $u->id;
        });

        $transfers = TransferProduct::WhereIn('destination_user_id', $usersIds)
            ->join('branches', 'branches.id', 'transfer_products.new_branch_id')
            ->whereBetween('transfer_products.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->select(
                'branches.name as branch',
                DB::raw('count(transfer_products.id) as quantity'),
                DB::raw('date(transfer_products.created_at) as date'),
            )
            ->groupBy(['branch', 'date'])
            ->get();
        return $transfers;
    }

    public function transferOut()
    {
        $user = Auth()->user();
        $usersIds = User::where('shop_id', $user->shop->id)->get()->map(function ($u) {
            return $u->id;
        });

        $transfers = TransferProduct::whereIn('user_id', $usersIds)
            ->join('branches', 'branches.id', 'transfer_products.last_branch_id')
            ->whereBetween('transfer_products.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->select(
                'branches.name as branch',
                DB::raw('count(transfer_products.id) as quantity'),
                DB::raw('date(transfer_products.created_at) as date'),
            )
            ->groupBy(['branch', 'date'])
            ->get();
        return $transfers;
    }
}
