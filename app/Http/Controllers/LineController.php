<?php

namespace App\Http\Controllers;

use App\Line;
use Illuminate\Http\Request;
use App\Http\Requests\LineRequest;
use Illuminate\Support\Facades\Auth;

class LineController extends Controller
{
    public function __construct()
    {
        $this->middleware('Authentication');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lines = Line::all();
      return view('line/index', compact('lines'));
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('line/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LineRequest $request)
    {
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
        $line = Line::findOrFail($id);
        //return $line;
        return view('line/edit', compact('line'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LineRequest $request, $id)
    {
        $line = Line::findOrFail($id);
        $line->name = $request->name;
        $line->price = $request->price;
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
}
