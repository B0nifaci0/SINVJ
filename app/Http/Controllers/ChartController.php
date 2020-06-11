<?php

namespace App\Http\Controllers;

use App\Shop;
use App\User;
use App\Branch;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::join('shops','users.shop_id', 'shops.id')
            ->select('users.id', 'shops.name', DB::RAW('COUNT(users.id) as CantUsers'))
            ->GroupBy('shops.id','shops.name')
            ->get();

            $array[] = ['Name', 'CantUsers'];
            foreach($data as $key => $value)
            {
             $array[++$key] = [$value->name, $value->CantUsers];
            }  
        //return $array;

        $databranch = Branch::join('shops','branches.shop_id', 'shops.id')
        ->select('branches.id', 'shops.name', DB::RAW('COUNT(branches.id) as CantSucur'))
        ->GroupBy('shops.id','shops.name')
        ->get();

        $arraybranch[] = ['Name', 'CantSucur'];
        foreach($databranch as $key => $value)
        {
         $arraybranch[++$key] = [$value->name, $value->CantSucur];
        }  
        return view('Charts.index',compact('data','databranch'));
    }

  /*  public function indexBranches()
    {
        $databranch = Branch::join('shops','branches.shop_id', 'shops.id')
            ->select('branches.id', 'shops.name', DB::RAW('COUNT(branches.id) as CantSucur'))
            ->GroupBy('shops.id','shops.name')
            ->get();

            $arraybranch[] = ['Name', 'CantSucur'];
            foreach($databranch as $key => $value)
            {
             $arraybranch[++$key] = [$value->name, $value->CantSucur];
            }  
        //return $databranch;
        return view('Charts.index')->with('CantSucur', json_encode($arraybranch));
    }*/

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
