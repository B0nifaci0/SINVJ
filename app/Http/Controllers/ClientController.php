<?php

namespace App\Http\Controllers;

use App\Client;
use App\Branch;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $query = Client::with(['sales', 'branch'])
            ->where('shop_id', $user->shop->id);
        $clients = $query->get();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $client = null;
        if($user->shop) {
            $branches = $user->shop->branches;
        }
        return view('clients.form', compact('client', 'branches'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $client = Client::create([
            'name' => $request->name,
            'first_lastname' => $request->first_lastname,
            'second_lastname' => $request->second_lastname,
            'phone_number' => $request->phone_number,
            'shop_id' => $user->shop->id,
            'bransh_id' => $request->bransh_id
        ]);
        return redirect('/mayoristas')->with('mesage', 'El cliente se ha creado correctamente');
    }













    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        foreach ($client->sales as $sale) {

            $sale->itemsSold = $sale->itemsSold();
            $sale->partials = $sale->partials;
            $sale->total = $sale->itemsSold->sum('final_price');
        }
        // return response()->json([
        //     'client' => $client
        // ]);
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $client = Client::findOrFail($id);
        $branches = Auth::user()->shop->branches;
        return view('clients.form', compact('client','branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
            $client->name =$request->name;
            $client->first_lastname =$request->first_lastname;
            $client->second_lastname =$request->second_lastname;
            $client->phone_number =$request->phone_number;
            $client->branch_id = $request->branch_id;
        $client->save();
        return redirect('/mayoristas')->with('mesage-update', 'El cliente se ha actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expense::destroy($id);
    }
}
