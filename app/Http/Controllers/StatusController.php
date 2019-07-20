<?php
namespace App\Http\Controllers;
use App\User;
use App\Status as estatus;
use App\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\StatusRequest;

class StatusController extends Controller
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
        $user = Auth::user();
        //$sta = estatus::with('shop')->get();
        $sta = Auth::user()->shop->statuss;
        //return $sta;
        return view('Status/index',compact('sta','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $shops = Shop::all();
        return view ('Status/add', compact('shops','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatusRequest $request)
    {
        $status = new estatus($request->all());
        $status->shop_id = Auth::user()->shop->id;
        $status->save(); 

        //return($line);
        return redirect('/status')->with('mesage', 'El estatus se ha agregado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('status.show', ['status' => estatus::findOrFail($id)]);
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
        $status = estatus::findOrFail($id);
        return view('Status/edit', compact('status','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StatusRequest $request, $id)
    {
        $status = estatus::findOrFail($id);
        $status->name = $request->name;
        $status->save();
        return redirect('/status')->with('mesage-update', 'El estatus se ha modificado exitosamente!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        estatus::destroy($id);
    }
}
