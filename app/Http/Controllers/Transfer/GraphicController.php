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

        $transfers = TransferProduct::whereIn('destination_user_id', $usersIds)
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->select(
                [
                    DB::raw('new_branch_id as branch'),
                    DB::raw('count(id) as quantity'),
                    DB::raw('day(created_at) as day'),
                ]
            )
            ->groupBy(['branch', 'day'])
            ->get()
            ->toArray();
        return $transfers;
    }

    public function transferOut()
    {
        $user = Auth()->user();
        $usersIds = User::where('shop_id', $user->shop->id)->get()->map(function ($u) {
            return $u->id;
        });

        $transfers = TransferProduct::whereIn('user_id', $usersIds)
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->select([
                DB::raw('last_branch_id as branch'),
                DB::raw('count(id) as quantity'),
                DB::raw('day(created_at) as day'),
            ])
            ->groupBy(['branch', 'day'])
            ->get()
            ->toArray();
        return $transfers;
    }
}
