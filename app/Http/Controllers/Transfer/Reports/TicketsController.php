<?php

namespace App\Http\Controllers\Transfer\Reports;

use PDF;
use App\TransferProduct;
use App\Traits\S3ImageManager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
    use S3ImageManager;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    public function incoming($id) 
    {
        $shop = $this->user->shop;
        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        $trans = TransferProduct::where("id", "=", $id)->get();
        $pdf  = PDF::loadView('Transfer.Reports.incoming', compact('trans', 'shop'))
            ->setOption('page-width', '55')
            ->setOption('page-height', '150');
        return $pdf->stream('TraspasoEntrante.pdf');
    }

    public function outgoing($id)
    {
        $shop = $this->user->shop;
        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        $trans = TransferProduct::where("id", "=", $id)->get();
        $pdf  = PDF::loadView('Transfer.Reports.outgoing', compact('trans', 'shop'))
            ->setOption('page-width', '55')
            ->setOption('page-height', '150');
        return $pdf->stream('TraspasoSaliente.pdf');
    }
}
