<?php

namespace App\Http\Controllers;

use App\Shop;
use App\store_expenses as Expenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ControllerExpenses extends Controller
{
    public function __construct(){
        $this->middleware('Authentication');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expense = Auth::user()->shop->id;
        $expenses = Shop::find($expense)->expenses()->get();
        //return $expenses;
        $shops = Auth::user()->shop()->get();
        return view('storeExpenses/index', compact('expenses','shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $shops = Auth::user()->shop()->get();
        //return $shops;
        return view('storeExpenses/add ',compact('shops')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if ($request->hasFile('image')){
            $filename = $request->image->getCLientOriginalName();
            $request->image->storeAs('public/upload/expenses',$filename);
            $expense = new Expenses($request->all());
            $expense->image = $filename;
            $expense->save();
            return $expense;
           //return redirect('/gastos')->with('success', true);
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
        $expense = Expenses::find($id);

        $shops = Auth::user()->shop()->get();
        return view('storeExpenses/edit ',compact('shops','expense'));

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
}
