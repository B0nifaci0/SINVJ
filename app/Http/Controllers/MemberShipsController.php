<?php

namespace App\Http\Controllers;

use App\MenberShip;
use Illuminate\Http\Request;
use App\Shop;

class MemberShipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $shops = Shop::all();
      return view('pricetable',compact('shops'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MenberShip  $menberShip
     * @return \Illuminate\Http\Response
     */
    public function show(MenberShip $menberShip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenberShip  $menberShip
     * @return \Illuminate\Http\Response
     */
    public function edit(MenberShip $menberShip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenberShip  $menberShip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenberShip $menberShip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenberShip  $menberShip
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenberShip $menberShip)
    {
        //
    }



}
