<?php

namespace App\Http\Controllers;

use App\Client;
use App\Branch;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ClientRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $wholesaler = Client::with(['sales', 'branch'])
            ->where('type_client', Client::M)
            ->where('shop_id', $user->shop->id)
            ->orderBy('updated_at', 'DESC')
            ->get();

        $public = Client::with(['sales', 'branch'])
            ->where('type_client', Client::P)
            ->where('shop_id', $user->shop->id)
            ->orderBy('updated_at', 'DESC')
            ->get();

        return view('clients.index', compact('wholesaler', 'public'));
    }

    Public function IndexCO(){
        $user = Auth::user();
        $shop_id = $user->shop->id;
        if($user->type_user != 1){
                $wholesaler = Client::where('branch_id', $user->branch_id)
                ->whereIn('type_client', [1])
                ->where('shop_id', $user->shop->id)
                ->orderBy('updated_at', 'DESC')
                ->get();

                $public = Client::where('branch_id', $user->branch_id)
                ->whereIn('type_client', [0])
                ->where('shop_id', $user->shop->id)
                ->orderBy('updated_at', 'DESC')
                ->get();
            }
            
            return view('clients.IndexCO', compact('wholesaler', 'public'));
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
        if ($user->shop) {
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
        if($user->type_user == User::AA){
            $client['branch_id'] = $request->branch_id;
            $client['shop_id'] = $user->shop->id;
        } else {
            $client['branch_id'] = $user->branch_id;
            $client['shop_id'] = $user->shop->id;
        }

            $client['name'] = $request->name;
            $client['first_lastname'] = $request->first_lastname;
            $client['second_lastname']= $request->second_lastname;
            $client['phone_number']= $request->phone_number;
            $client['credit']= $request->credit;
            $client['type_client'] = $request->type_client;
        $client = Client::create($client);
        //return $client;
        if(Auth::User()->type_user == 1){
        return redirect('/clientes')->with('mesage', 'El cliente se ha creado correctamente');
        } else {
            return redirect('/Clientes')->with('mesage','El cliente se ha creado correctamente');
        }
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

        //return $client;
        // return response()->json([
        //     'client' => $client
        // ]);
        {
            $user = Auth::user();
            $cliente = Client::find($id);

            //return $cliente;
            $products = Product::join('sale_details', 'sale_details.product_id', 'products.id')
                ->join('sales', 'sales.id', 'sale_details.sale_id')
                ->whereIn('products.discar_cause', [3, 4])
                ->where('sales.client_id', $id)
                ->select('products.id as id', 'products.clave as clave', 'products.description as description', 'products.weigth', 'products.price as price', 'products.deleted_at as devol', DB::raw('SUM(products.price) as total'))
                ->groupBy('products.id', 'products.clave', 'products.description', 'products.weigth', 'products.price', 'products.deleted_at')
                ->withTrashed()
                ->get();

            //return $products;

        }

        return view('clients.show', compact('client', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        $client_branch_id = $client->branch_id;
        $user = Auth::user();
        if ($user->shop) {
            $branches = $user->shop->branches;
            /*    $selected_branch = $branches->filter(function ($value, $key) use ($client_branch_id) {
                return $value->id == $client_branch_id;
            })->first();


            $branches = $branches->reject(function ($value, $key) use ($client_branch_id) {
                return $value->id == $client_branch_id;
            });
            $branches->prepend($selected_branch);
        */
        }
        return view('clients.form', compact('client', 'branches'));;
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
        $user = Auth::user();
        if($user->type_user == User::AA){
            $client['branch_id'] = $request->branch_id;
            $client['shop_id'] = $user->shop->id;
        } else {
            $client['branch_id'] = $user->branch_id;
            $client['shop_id'] = $user->shop->id;
        }
        $client = Client::find($id);

        $client->name = $request->name;
        $client->phone_number = $request->phone_number;
        $client->type_client = $request->type_client;
        //$client->branch_id = $request->branch_id;

        if ($client->type_client == 1) {
            $client->first_lastname = $request->first_lastname;
            $client->second_lastname = $request->second_lastname;
            $client->credit = $request->credit;
        } else {
            $client->first_lastname = null;
            $client->second_lastname = null;
            $client->credit = null;
        }
        //return $client;
        $client->save();
        if(Auth::User()->type_user == 1){
        return redirect('/clientes')->with('mesage-update', 'El cliente se ha actualizado correctamente');
        } else {
            return redirect('/Clientes')->with('mesage-update', 'El cliente se ha actualizado correctamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::destroy($id);
    }
}
