<?php

namespace App\Http\Controllers;

use App\Shop;
use App\User;
use App\Branch;
use App\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpensesRequest;
use Illuminate\Support\Facades\Storage;
use App\Traits\S3ImageManager;
use Illuminate\Support\Facades\DB;
use PDF;


class ExpensesController extends Controller
{

    use S3ImageManager;

    public function index()
    {
        $user = Auth::user();
        return view('storeExpenses.index', compact('user'));
    }

    public function serverSide()
    {
        $user = Auth::user();

        if ($user->isAdmin())
            $expenses = $user->shop->expenses()->with('branch:id,name')->get();
        else if ($user->type_user == 2)
            $expenses = $user->branch->expenses()->with('branch:id,name')->get();
        else
            $expenses = Expense::whereUserId($user->id)->with('branch:id,name')->get();

        $adapter = Storage::disk('s3')->getDriver()->getAdapter();

        foreach ($expenses as $e) {
            if ($e->image) {

                $path = env('S3_ENVIRONMENT') . '/' .  'tickets/' . $e->id;

                $command = $adapter->getClient()->getCommand('GetObject', [
                    'Bucket' => $adapter->getBucket(),
                    'Key' => $adapter->getPathPrefix() . $path
                ]);

                $result = $adapter->getClient()->createPresignedRequest($command, '+20 minute');

                $e->image = (string) $result->getUri();
            }
        }

        return datatables()->of($expenses)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        //$shop = $user->branch->shop;
        $shops = Auth::user()->shop()->get();
        $branches = Auth::user()->branch()->get();
        //return $shops;
        return view('storeExpenses/add ', compact('shops', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpensesRequest $request)
    {
        $user = Auth::user();
        if ($user->type_user == User::AA) {
            $data['branch_id'] = $request->branch_id;
            $data['shop_id'] = $user->shop->id;
        } else {
            $data['branch_id'] = $user->branch->id;
        }
        $data['user_id'] = Auth::user()->id;
        $data['price'] = $request->price;
        $data['descripcion'] = $request->descripcion;
        $data['name'] = $request->name;

        $expense = Expense::create($data);

        if ($request->hasFile('image')) {
            $adapter = Storage::disk('s3')->getDriver()->getAdapter();
            $image = file_get_contents($request->file('image')->path());
            $base64Image = base64_encode($image);
            $path = 'tickets';
            $expense->image = $this->saveImages($base64Image, $path, $expense->id);
        }
        $expense->save();
        return redirect('/gastos')->with('success', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('gastos.show', ['gastos' => Expense::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $expense = Expense::find($id);
        $shops = Auth::user()->shop()->get();
        return view('storeExpenses/edit ', compact('shops', 'expense', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpensesRequest $request, $id)
    {
        $expense = Expense::findOrFail($id);
        if ($request->hasFile('image')) {
            $adapter = Storage::disk('s3')->getDriver()->getAdapter();
            $image = file_get_contents($request->file('image')->path());
            $base64Image = base64_encode($image);
            $path = 'tickets';
            $expense->image = $this->saveImages($base64Image, $path, $expense->id);
        }
        $expense->save();

        $expense->name = $request->name;
        $expense->descripcion = $request->descripcion;
        $expense->price = $request->price;
        $expense->save();

        //return $request->all();
        return redirect('/gastos')->with('mesage-update', 'Gasto actualizado  exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expense::destroy($id);
    }

    public function exportPdf(Request $request)
    {
        $user = Auth::user();
        $shop = Auth::user()->shop;
        $fecini = Carbon::parse($request->fecini);
        $fecter = Carbon::parse($request->fecter);
        $hour = $this->getHour();
        $date = $this->getDate();
        $shops = Shop::where('id', $request->shop_id)->get();
        $branches = Branch::where('shop_id', $user->shop->id)->get();
        $branches_ids = $branches->map(function ($b) {
            return $b->id;
        });
        $branchs = $user->shop->branches;
        if($shop->image){
            $shop->image = $this->getS3URL($shop->image);
        }

        $branch_expenses = Expense::whereIn('branch_id', $branches_ids)
        ->get();
        $shop_expenses = Expense::where('shop_id', $user->shop->id)
        ->get();
        $expenses = $branch_expenses->merge($shop_expenses);
        
        if ($fecini == $fecter) {
            $expenses = Expense::where('shop_id', $user->shop->id)
                ->whereDate('updated_at', $fecini)
                ->get();
        } else {
            $fecini = $fecini->subDay();
            $fecter = $fecter->addDay();
            $expenses = Expense::where('shop_id', $user->shop->id)
                ->whereBetween('updated_at', [$fecini, $fecter])
                ->get();
        }

        //return $expenses;
        $branches = Shop::join('expenses', 'expenses.branch_id', 'shops.id')
            ->join('branches', 'branches.id', 'expenses.branch_id')
            ->select('branches.name')
            ->distinct('branches.name')
            ->orderBy('branches.name', 'DESC')
            ->get();
        //return $branches;
        //Funcion para sumar el gastos de tienda
        foreach ($expenses as $expense) {
               $expense->totales = $expense->where('branch_id', $branchs)->sum('price');
        }

        $totales = 0;
        foreach ($branch_expenses as $expense) {
            $totales = $expense->price + $totales;
        }
        //return $totales;
        //Sumar Gasto por sucursal
        foreach ($expenses as $expense) {
            $expense->total = $expense->where('branch_id', $expense->id)->sum('price');
        }

        $totals = 0;
        foreach ($expenses as $expense) {
            $totals = $expense->price + $totals;
        }

        //return $totals;
            //Funcion para sumar el gastos de por sucursal
        $branches = Branch::where('shop_id', $user->shop->id)->get();
            // return $user->shop->id;
            //return $branch_ids;
        //return $expenses;
        $total = Branch::join('expenses', 'expenses.branch_id', 'branches.id')
            //->where('branches.shop_id', $user->shop->id)
            ->whereIn('expenses.branch_id', $branches_ids)
            //->where('expenses.deleted_at', NULL)
            ->select('branches.id as id', 'branches.name as sucursal', DB::raw('SUM(expenses.price) as money'))
            //->whereBetween('expenses.updated_at', [$fecini, $fecter])
            ->groupBy('branches.id', 'branches.name')
            ->get();

        //return $total;
        if ($expenses->isEmpty()) {
            return back()->with('message', 'No, hay gastos registrados, en las fechas seleccionadas');
        }

        $pdf  = PDF::loadView('storeExpenses.GastosPDF', compact('totals', 'branchs', 'branches', 'totales', 'hour', 'date', 'expenses', 'shops', 'shop', 'total', 'branch_expenses'));
        //$pdf->setPaper('a4', 'landscape'); Orientacion de los archivos pdf
        //return $pdf->stream('gastos.pdf'); //solo visualizacion del archivo en la vista web
        return $pdf->stream('gastos.pdf');
        //return $totals;

    }

    public function exportPdfall($id)
    {
        $date = date("Y-m-d");
        $hour = Carbon::now();
        $hour = date('H:i:s');
        $branch = Auth::user()->branch;
        $shop = Auth::user()->shop;
        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        $expense = Expense::where("id", "=", $id)->get();
        $pdf = PDF::loadview('storeExpenses.PDFGasto', compact('expense', 'shop', 'branch', 'hour', 'date'))
            ->setOption('page-width', '58')
            ->setOption('page-height', '100');;
        return  $pdf->stream('gasto.pdf');
    }
    //funcion para reporte de gastos por sucursal
    public function reportExpense()
    {

        $date = date("y-m-d");
        $hour = Carbon::now();
        $hour = date("H:i:s");

        $idshop = Auth::user()->shop->id;
        $user = Auth::user();
        $branch = Shop::find($idshop)->branches()->get();
        //xreturn $branch;
        return view('storeExpenses.reportsPDF.reportgastos', compact('date', 'hour', 'idshop', 'branch', 'user'));
    }
    //METODO PARA CONSULTA DE GASTOS POR SUCURSAL Y POR FECHA //
    public function reportexpensebranch(Request $request)
    {   
        //return $request;
        $user = Auth::user();
        $fecini = Carbon::parse($request->fecini);
        $fecter = Carbon::parse($request->fecter);
        $hour = $this->getHour();
        $date = $this->getDate();
        $branches = Branch::where('id', $request->branch_id)->get();
        $branch = Branch::findOrFail($request->branch_id);
        $shop = Auth::user()->shop;

        if($shop->image){
            $shop->image = $this->getS3URL($shop->image);
        }

        if($fecini == $fecter){
            $expenses = Expense::where('branch_id', $request->branch_id)
            ->WhereDate('updated_at', $fecini)
            ->get();
        } else {
            $fecini = $fecini->subDay();
            $fecter = $fecter->addDay();
            $expenses = Expense::where('branch_id', $request->branch_id)
                ->whereBetween('updated_at', [$fecini, $fecter])
                ->get();
        }

        //Funcion para sumar el gastos de surcursal
        foreach ($expenses as $expense) {
            $expense->totals = $expense->where('branch_id', $expense->id)->sum('price');
        }
        $totals = 0;
        foreach ($expenses as $expense) {
            $totals = $expense->price + $totals;
        }
        
        if ($expenses->isEmpty()) {
            return back()->with('message', 'No, hay gastos registrados, en las fechas seleccionadas');
        }

        $pdf  = PDF::loadView('storeExpenses.reportsPDF.reportbranch', compact('user','totals', 'shop', 'expenses', 'branch','branches', 'hour', 'date'));
        return $pdf->stream('gastosucursal.pdf');
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
