<?php

namespace App\Http\Controllers;

use App\Shop;
use App\User;
use App\store_expenses as Expenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpensesRequest;
use Illuminate\Support\Facades\Storage;
use PDF;


class ControllerExpenses extends Controller
{
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
        $expense = Auth::user()->shop->id;
        $expenses = Shop::find($expense)->expenses()->get();
        //return $expenses;
        $shops = Auth::user()->shop()->get();
        $user = Auth::user();
        return view('storeExpenses/index', compact('expenses','shops','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $shops = Auth::user()->shop()->get();
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
         if ($request->hasFile('image')){
            $filename = $request->image->getCLientOriginalName();
            $request->image->storeAs('public/upload/expenses',$filename);
            $expense = new Expenses($request->all());
            $expense->image = $filename;
            $expense->save();
            //return $expense;
        return redirect('/gastos')->with('success', true);
         } 
    
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('gastos.show', ['gastos' => Expenses::findOrFail($id)]);
   
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
        $expense = Expenses::find($id);
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
    public function update(Request $request, $id)
    {
        $expense = Expenses::findOrFail($id);

        if ($request->hasFile('image')){

          // Borrar imagen anterior
          Storage::delete("public/upload/expenses/{$expense->image}");

          $filename = $request->image->getCLientOriginalName();
          $timestamp = time();
          $request->image->storeAs('public/upload/expenses', $timestamp . $filename);
          $expense->image = $timestamp . $filename;
      }

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
        Expenses::destroy($id);
    }
    public function exportPdf(){
        $total = Expenses::sum('price');
        $expense = Auth::user()->shop->id;
        $expenses = Shop::find($expense)->expenses()->get();
        $shops = Auth::user()->shop()->get();
        $pdf  = PDF::loadView('storeExpenses.GastosPDF', compact('expenses', 'shops','total'));
        //$pdf->setPaper('a4', 'landscape'); Orientacion de los archivos pdf
        //return $pdf->stream('gastos.pdf'); //solo visualizacion del archivo en la vista web
         return $pdf->stream('gastos.pdf');
      }
     
}
