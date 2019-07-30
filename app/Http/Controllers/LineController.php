<?php

namespace App\Http\Controllers;

use App\Line;
use Illuminate\Http\Request;
use App\Http\Requests\LineRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

use  App\Exports\LinesExport;


class LineController extends Controller
{
    public function __construct()
    {
        //$this->middleware('Authentication');
    }
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::User();
        //Muestra los las lineas que pertenecen a esa tienda midiante la variable $lines
        $lines = Auth::user()->shop->lines;
        //return $lines;
      return view('line/index', compact('lines','user'));
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::User();
        return view('line/add', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LineRequest $request)
    {   
        //$nombre = $request->input("name");
        //return $nombre; 
        $line = new Line($request->all());
        $line->shop_id = Auth::user()->shop->id;
        $line->save();

    return redirect('/lineas')->with('mesage', 'la linea se ha agregado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        return view('line.show', ['line' => Line::findOrFail($id)]);
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
        $line = Line::findOrFail($id);
        //return $line;
        return view('line/edit', compact('line','user'));
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
        $line = Line::findOrFail($id);
        $line->name = $request->name;
        $line->purchase_price = $request->purchase_price;
        $line->sale_price = $request->sale_price;

        $line->save();
        return redirect('/lineas')->with('mesage-update', 'La Linea se ha modificado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Line::destroy($id);
   //return redirect('/lineas')->with('mesage-delete', 'La Linea  se ha eliminado exitosamente!');
    }
// Funcion para gener pdf!!
    public function exportPdf(){ 
        $lines = Line::all();
        $pdf  = PDF::loadView('line.pdf', compact('lines'));
        return $pdf->download('lineas.pdf');
    }

    // Funcion para gener excel!!
    public function exportExcel(){ 
     return Excel::download( new LinesExport, 'line.xlsx');
    }
}
