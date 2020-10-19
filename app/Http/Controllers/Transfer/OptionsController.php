<?php

namespace App\Http\Controllers\Transfer;

use App\Branch;
use App\Product;
use Carbon\Carbon;
use App\InventoryDetail;
use App\TransferProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OptionsController extends Controller
{
    public function response(Request $request)
    {
        $user = Auth::user();
        $transfer = TransferProduct::find($request->transfer_id);
        $product = Product::find($transfer->product_id);

        $inventory = InventoryDetail::join('inventory_reports', 'inventory_details.inventory_report_id', 'inventory_reports.id')
            ->where('inventory_reports.branch_id', $product->branch_id)
            ->where('inventory_details.product_id', $product->id)
            ->where(function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $query->Where('inventory_reports.status_report', 1)
                        ->orWhere('inventory_reports.status_report', 2);
                });
            })
            ->select('inventory_details.*')
            ->first();

        if ($request->answer === null) {
            $transfer->delete();
            $product->status_id = Product::EXISTING;
            if ($inventory) {
                $inventory->status_id = 1;
                $inventory->save();
            }
            $product->save();
        } else {
            $transfer->status_product = $request->answer;
            $transfer->destination_user_id = $user->id;
            $transfer->save();
            if ($request->answer) {
                $product->branch_id = $transfer->new_branch_id;
                if ($inventory) {
                    $inventory->status_id = 6;
                    $inventory->save();
                }
                $product->shop_id = $user->shop->id;
                $product->date_creation = Now();
                $product->save();
            } else {
                $product->status_id = Product::EXISTING;
                if ($inventory) {
                    $inventory->status_id = 1;
                    $inventory->save();
                }
                $product->save();
            }
        }
        return redirect('/traspasos');
    }

    public function payTransfer(Request $request)
    {
        $transfer = TransferProduct::find($request->transfer_id);
        $transfer->paid_at = Carbon::now()->format('Y-m-d');
        $transfer->save();
        return back();
    }

    public function giveBack(Request $request)
    {
        $transfer = TransferProduct::find($request->transfer_id);

        $last_shop = Branch::where('id', $transfer->last_branch_id)
            ->sum('shop_id');

        $product = Product::where('id', $transfer->product_id)->first();
        $product->branch_id = $transfer->last_branch_id;
        $product->shop_id = $last_shop;
        $product->status_id = Product::EXISTING;
        $product->save();

        $inventory = InventoryDetail::join('inventory_reports', 'inventory_details.inventory_report_id', 'inventory_reports.id')
            ->where('inventory_reports.branch_id', $product->branch_id)
            ->where('inventory_details.product_id', $product->id)
            ->where(function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $query->Where('inventory_reports.status_report', 1)
                        ->orWhere('inventory_reports.status_report', 2);
                });
            })
            ->select('inventory_details.*')
            ->first();

        if ($inventory) {
            $inventory->status_id = 1;
            $inventory->save();
        }

        $transfer->status_product = 3;
        $transfer->save();

        return back();
    }
}
