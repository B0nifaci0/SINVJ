<?php

namespace App\Http\Controllers;

use App\Sale;
use Illuminate\Http\Request;
use App\Http\Requests\SaleRequest;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $sales = Sale::all();
    return view('sale/index', compact('sales'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sale/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request)
    {
        $sale = new Sale($request->all());
        $sale->save();

    return redirect('/ventas')->with('mesage', 'la venta se ha agregado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     return view('sale.show', ['sale' => Sale::findOrFail($id)]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $sale = Sale::findOrFail($id);
      //return $sale;
      return view('sale/edit', compact('sale'));
       }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(SaleRequest $request, $id)
    {
      $sale = Sale::findOrFail($id);
        $sale->name = $request->name;
        $sale->save();
        return redirect('/ventas')->with('mesage-update', 'La venta se ha modificado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //Sale::destroy($id);
  // return redirect('/ventas')->with('mesage-delete', 'La venta  se ha eliminado exitosamente!');
    }
}
