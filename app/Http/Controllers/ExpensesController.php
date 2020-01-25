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

    /*public function __construct(){
        $this->middleware('Authentication');

    }/*

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $brances = Branch::where('shop_id', $user->shop->id)->select('id')->get();
        $branches_ids = $brances->map(function($item){ return $item->id; });
        $expenses = Expense::whereIn('branch_id', $branches_ids)->get();

        if($user->type_user == User::AA) {
            $shop_expenses = Expense::where('shop_id', $user->shop->id)->get();
            $expenses = $expenses->merge($shop_expenses);
        }


		$adapter = Storage::disk('s3')->getDriver()->getAdapter();

        foreach ($expenses as $e) {
            if($e->image) {

              $path = env('S3_ENVIRONMENT') . '/' .  'tickets/' . $e->id;

                $command = $adapter->getClient()->getCommand('GetObject', [
                    'Bucket' => $adapter->getBucket(),
                    'Key' => $adapter->getPathPrefix() . $path
                ]);

                $result = $adapter->getClient()->createPresignedRequest($command, '+20 minute');

                $e->image = (string) $result->getUri();
            }
        }
        return view('storeExpenses/index', compact('expenses', 'user'));
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
        return view('storeExpenses/add ',compact('shops','user'));
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
        if($user->type_user == User::AA) {
            if($request->branch_id) {
                $data['branch_id'] = $request->branch_id;
            } else {
                $data['shop_id'] = $user->shop->id;
            }
        } else if($user->type_user == User::CO) {
            $data['branch_id'] = $user->branch->id;
        }
        $data['user_id'] = Auth::user()->id;
        $data['price'] = $request->price;
        $data['descripcion'] = $request->descripcion;
        $data['name'] = $request->name;

        $expense = Expense::create($data);

        if($request->hasFile('image')) {
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
        return view('storeExpenses/edit ',compact('shops','expense','user'));

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
        if($request->hasFile('image')) {
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

    public function exportPdf(Request $request){

        $user = Auth::user();

        if($user->type_user == User::CO) {
            $expenses = Expense::where('branch_id', $user->branch->id)->get();
        } else {
            $branches = $user->shop->branches;
            $branches_ids = $branches->map(function($b) { return $b->id; });
            $branch_expenses = Expense::whereIn('branch_id', $branches_ids)->get();

            $shop_expenses = Expense::where('shop_id', $user->shop->id)->get();

            $expenses = $branch_expenses->merge($shop_expenses);
           // $total = $expenses->sum('price');
        //Consulta de gastos generales entre fechas//
        $fech1 = Carbon::parse($request->fecini)->subDay();
        $fech2 = Carbon::parse($request->fecter)->addDay();

        if($fech1 == $fech2){
            $shops = Shop::where("id","=",$request->shop_id)->get();
            $shop = Auth::user()->shop;
       $shops= Auth::user()->shop()->get();

        if($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
            $expenses = Expense::where("shop_id","=",$request->shop_id)
                            ->where('created_at',"=",$fech1)
                            ->where('created_at',"=",$fech2)
                            ->get();
                           // $pdf  = PDF::loadView('storeExpenses.GastosPDF', compact('hour','date','expenses','shops','shop','total'));
                            //return $pdf->stream('gastos.pdf');
        }elseif($fech1 != $fech2){
            $shops = Shop::where("id","=",$request->shop_id)->get();
            $expenses = Expense::where("shop_id","=",$request->shop_id)
                                ->whereBetween('created_at',[$fech1,$fech2])
                                ->get();
                       $shop = Auth::user()->shop;
                       $shops = Auth::user()->shop()->get();

                      if($shop->image) {
                        $shop->image = $this->getS3URL($shop->image);
                    }

           // return $total;
        }
        $date= date("Y-m-d");
        $hour = Carbon::now();
        $hour = date('H:i:s');
        $total = Expense::sum('price');

        $branches = Shop::join('expenses','expenses.branch_id','shops.id')
        ->join('branches','branches.id','expenses.branch_id')
        ->select('branches.name')
        ->distinct('branches.name')
        ->orderBy('branches.name','DESC')
        ->get();

        //Funcion para sumar el gastos de tienda
        foreach($expenses as $expense){
            $expense->totales = $expense->where('id', $expense->id)->sum('price');
        }

        $totales = 0;
        foreach($expenses as $expense){
            $totales = $expense ->price + $totales;
        }

        //Funcion para sumar el gastos de por sucursal
        $totals = Expense::join('branches', 'expenses.branch_id', 'branches.id')
        ->where('expenses.shop_id', Auth::user()->shop->id)
        ->select('branches.id', 'branches.name', DB::raw('SUM(expenses.price) as total'))
        ->groupBy('branches.id', 'branches.name')
        ->get();


        $pdf  = PDF::loadView('storeExpenses.GastosPDF', compact('branches','totals','totales','hour','date','expenses', 'shops','shop','total'));
        //$pdf->setPaper('a4', 'landscape'); Orientacion de los archivos pdf
        //return $pdf->stream('gastos.pdf'); //solo visualizacion del archivo en la vista web
       return $pdf->stream('gastos.pdf');
        //return $totals;
      }
    }

   //  public function exportPdfall(){
     //   $user = Auth::user();
       // $shop = Auth::user()->shop;
        //$expense = Expense::all();
     //$pdf  = PDF::loadView('storeExpenses.PDFGasto', compact('expense','shop'));
        //return $pdf->stream('gasto.pdf');
      //}

    //crear reporte individual de cada gasto//
    public function exportPdfall($id){
        $date= date("Y-m-d");
        $hour = Carbon::now();
        $hour = date('H:i:s');
        $branch = Auth::user()->branch;
        $shop = Auth::user()->shop;
        if($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        $expense = Expense::where("id","=",$id)->get();
        $pdf = PDF::loadview('storeExpenses.PDFGasto', compact('expense','shop','branch','hour','date'));
        return  $pdf->stream('gasto.pdf');
    }
    //funcion para reporte de gastos por sucursal
    public function reportExpense(){

        $date = date("y-m-d");
        $hour = Carbon::now();
        $hour = date("H:i:s");

        $idshop = Auth::user()->shop->id;
        $user = Auth::user();
        $branch = Shop::find($idshop)->branches()->get();
        //xreturn $branch;
        return view('storeExpenses.reportsPDF.reportgastos',compact('date','hour','idshop','branch','user'));
    }
    //METODO PARA CONSULTA DE GASTOS POR SUCURSAL Y POR FECHA //
    public function reportexpensebranch(Request $request){

        $fech1 = Carbon::parse($request->fecini)->subDay();
        $fech2 = Carbon::parse($request->fecter)->addDay();
        /**
         * Checar este if para la validacion de la fecha de un rango de 1 a 1
         */
        if($fech1 == $fech2){
          $branches = Branch::where("id","=",$request->branch_id)->get();
          //$categories = Category::where("id","=",$request->id)->get();
          $shop = Auth::user()->shop;
     $shops = Auth::user()->shop()->get();

      if($shop->image) {
          $shop->image = $this->getS3URL($shop->image);
      }
          $expenses = Expense::where("branch_id","=",$request->branch_id)
                            ->where('created_at','=',$fech1)
                            ->where('created_at','=',$fech2)
                            ->get();
                            //return $products;
                            $pdf  = PDF::loadView('storeExpenses.reportsPDF.reportbranch', compact('shop','shops','expenses','branches','hour','dates'));
                            return $pdf->stream('gastosucursal.pdf');

        }elseif($fech1 != $fech2){
          $branches = Branch::where("id","=",$request->branch_id)->get();
          //$categories = Category::where("id","=",$request->id)->get();
          $expenses = Expense::where("branch_id","=",$request->branch_id)
                              ->whereBetween('created_at',[$fech1,$fech2])
                              ->get();
                      //return $products;
                      $shop = Auth::user()->shop;
                      $shops = Auth::user()->shop()->get();

                      if($shop->image) {
                          $shop->image = $this->getS3URL($shop->image);
                      }
        $hour = Carbon::now();
        $hour = date('H:i:s');

        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');

        //Funcion para sumar el gastos de surcursal
        foreach($expenses as $expense){
            $expense->totals = $expense->where('branch_id', $expense->id)->sum('price');
        }

        $totals = 0;
        foreach($expenses as $expense){
            $totals = $expense ->price + $totals;
        }
        $pdf  = PDF::loadView('storeExpenses.reportsPDF.reportbranch',compact('totals','shop','shops','expenses','branches','hour','dates'));
        //return $totals;
        return $pdf->stream('gastosucursal.pdf');

        }
      }
}
