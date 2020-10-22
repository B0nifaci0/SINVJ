<?php

namespace App\Http\Controllers\Transfer\Reports;

use PDF;
use App\User;
use App\Branch;
use Carbon\Carbon;
use App\TransferProduct;
use Illuminate\Http\Request;
use App\Traits\S3ImageManager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransferProductsController extends Controller
{
    use S3ImageManager;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    public function index()
    {

        $shop = $this->user->shop;
        $branches = $shop->branches()->get();

        $usersIds = User::where('shop_id', $shop->id)->get()->map(function ($u) {
            return $u->id;
        });
        $transout = TransferProduct::whereIn('user_id', $usersIds)->count();
        $transint = TransferProduct::whereIn('destination_user_id', $usersIds)->count();

        if ($transout <= 0 && $transint <= 0) {
            return redirect('/traspasos/create')->with('mesage', 'No se tiene ningun traspaso registrado!');
        }
        return view('Transfer.Reports.index', compact('shop', 'branches'));
    }

    public function pdfAll()
    {
        $user = Auth::user();
        $date = date("Y-m-d");
        $hour = Carbon::now();
        $hour = date('H:i:s');
        $branches = $user->shop->branches;
        $shop = Auth::user()->shop;
        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        // $trans = TransferProduct::all();
        $trans = TransferProduct::where('user_id', $user->id)
            ->orWhere('destination_user_id', $user->id)
            ->with('user')->with('branch')->get();

        $pdf  = PDF::loadView('Transfer.Reports.all', compact('trans', 'date', 'hour', 'shop'));
        return $pdf->stream('Traspasos.pdf');
    }

    public function reportTransferStatus(Request $request)
    {

        $fecini = Carbon::parse($request->fecini);
        $fecter = Carbon::parse($request->fecter);
        $hour = $this->getHour();
        $date = $this->getDate();
        $branch = Branch::findOrFail($request->branch_id);
        $status = $request->status_product;
        $type = $request->type;
        $shop = $this->user->shop;
        $type_product = $request->type_product;

        $branches = $shop->branches;
        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        if ($type == 0) {  //Entradas
            $query = TransferProduct::where('new_branch_id', $branch->id)
                ->whereBetween('updated_at', [$fecini, $fecter]);
        } else {    //Salidas
            $query = TransferProduct::where('last_branch_id', $branch->id)
                ->whereBetween('updated_at', [$fecini, $fecter]);
        }

        if ($request->status_product == 'null') { //Estatus Pendiente
            $query->whereNull('status_product');
        } else {
            if ($request->status_product == 4) { //Pagado
                $query->where('status_product', 1)
                    ->whereNotNull('paid_at');
            } else {
                $query->where('status_product', $request->status_product)
                    ->whereNull('paid_at'); //Por pagar
            }
        }

        $trans = $query->with('product.category')
            ->get()
            ->where('product.category.type_product', $type_product);

        if ($trans->isEmpty()) {
            return back()->with('message', 'El reporte que se intento generar no contiene información');
        }
        $pdf  = PDF::loadView('Transfer.Reports.status', compact('status', 'trans', 'date', 'hour', 'shop', 'type_product', 'type', 'branch'));
        return $pdf->stream('Traspasos.pdf');
    }

    public function reportTransferGeneral(Request $request)
    {

        $fecini = Carbon::parse($request->fecini);
        $fecter = Carbon::parse($request->fecter);
        $hour = $this->getHour();
        $date = $this->getDate();
        $branch = Branch::findOrFail($request->branch_id);
        $type = $request->type;
        $shop = $this->user->shop;
        $type_product = $request->type_product;

        $branches = $shop->branches;
        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        if ($type == 0) {  //Entradas
            $query = TransferProduct::where('new_branch_id', $branch->id)
                ->whereBetween('transfer_products.updated_at', [$fecini, $fecter]);
        } else {    //Salidas
            $query = TransferProduct::where('last_branch_id', $branch->id)
                ->whereBetween('transfer_products.updated_at', [$fecini, $fecter]);
        }

        $trans = $query->with('product.category')
            ->get()
            ->where('product.category.type_product', $type_product);

        if ($trans->isEmpty()) {
            return back()->with('message', 'El reporte que se intento generar no contiene información');
        }
        $pdf  = PDF::loadView('Transfer.Reports.general', compact('trans', 'date', 'hour', 'shop', 'type_product', 'type', 'branch'));
        return $pdf->stream('Traspasos.pdf');
    }
    protected function getDate()
    {
        $date = Carbon::now();
        $date = $date->format('d-m-Y');
        return $date;
    }
    protected function getHour()
    {
        $hour = Carbon::now();
        $hour = date('H:i:s');
        return $hour;
    }
}
