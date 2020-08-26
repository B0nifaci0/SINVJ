<?php

namespace App\Http\Controllers\Branch;

use App\Branch;
use Carbon\Carbon;
use PDF;
use App\Traits\S3ImageManager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductBranchController extends Controller
{

    use S3ImageManager;

    public function productsWithLine($id)
    {

        $shop = Auth::user()->shop;
        $branch = Branch::findOrFail($id);
        $products = $branch->products()
            ->has('line')
            ->orderByRaw('CHAR_LENGTH(clave)')
            ->orderBy('clave')
            ->get();

        $date = Carbon::now();
        $date = $date->format('d-m-Y');
        $hour = Carbon::now();
        $hour = date('H:i:s');

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $pdf  = PDF::loadView('Branch.productsWithLine', compact('branch', 'products', 'date', 'hour', 'shop'));
        return $pdf->stream('productossucursal.pdf');
    }
    public function productsWithoutLine($id)
    {

        $shop = Auth::user()->shop;
        $branch = Branch::findOrFail($id);
        $products = $branch->products()
            ->doesnthave('line')
            ->orderByRaw('CHAR_LENGTH(clave)')
            ->orderBy('clave')
            ->get();

        $date = Carbon::now();
        $date = $date->format('d-m-Y');
        $hour = Carbon::now();
        $hour = date('H:i:s');

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $pdf  = PDF::loadView('Branch.productsWithoutLine', compact('branch', 'products', 'date', 'hour', 'shop'));
        return $pdf->stream('productossucursal.pdf');
    }
}
