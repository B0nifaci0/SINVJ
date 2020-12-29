<?php

namespace App\Http\Controllers\Sale;

use App\Sale;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GraphicController extends Controller
{
    public function __invoke()
    {
        $user = Auth()->user();
        $usersIds = User::where('shop_id', $user->shop->id)->get()->map(function ($u) {
            return $u->id;
        });

        $sales = Sale::whereIn('user_id', $usersIds)
            ->join('branches', 'branches.id', 'sales.branch_id')
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->select([
                'branches.name as branch',
                DB::raw('count(id) as quantity'),
                DB::raw('day(created_at) as day'),
            ])
            ->groupBy(['branch', 'day'])
            ->get();
            //->toArray();
        return $sales;
    }
}
