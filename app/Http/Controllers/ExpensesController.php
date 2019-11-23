<?php

namespace App\Http\Controllers;

use App\Shop;
use App\User;
use App\Branch;
use App\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpensesRequest;
use Illuminate\Support\Facades\Storage;
use App\Traits\S3ImageManager;
use PDF;


class ExpensesController extends Controller
{

    use S3ImageManager;

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
        $brances = Branch::where('shop_id', $user->shop->id)->select('id')->get();
        $branches_ids = $brances->map(function($item){ return $item->id; });
        $expenses = Expense::whereIn('branch_id', $branches_ids)->get();

        if($user->type_user == User::AA) {
            $shop_expenses = Expense::where('shop_id', $user->shop->id)->get();            
            $expenses = $expenses->merge($shop_expenses);
        }


		$adapter = Storage::disk('s3')->getDriver()->getAdapter();

        foreach ($expenses as $e) {
            if($e->image) {
                $command = $adapter->getClient()->getCommand('GetObject', [
                    'Bucket' => $adapter->getBucket(),
                    'Key' => $adapter->getPathPrefix(). 'tickets/' . $e->id
                ]);
            
                $result = $adapter->getClient()->createPresignedRequest($command, '+20 minute');
            
                $e->image = (string) $result->getUri();
            }
        }
        return view('storeExpenses/index', compact('expenses', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response 
     */
    public function create()
    {
        $user = Auth::user();
        //$shop = $user->branch->shop;
        $shops = Auth::user()->shop()->get();
        $branches = Auth::user()->branch()->get();
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
        $user = Auth::user();
        if($user->type_user == User::AA) {
            if($request->branch_id) {
                $data['branch_id'] = $request->branch_id;
            } else {
                $data['shop_id'] = $user->shop->id;
            }
        } else if($user->type_user == User::CO) {
            $data['branch_id'] = $user->branch->id;
        }
        $data['user_id'] = Auth::user()->id;
        $data['price'] = $request->price;
        $data['descripcion'] = $request->descripcion;
        $data['name'] = $request->name;
        
        $expense = Expense::create($data);

        if($request->hasFile('image')) {
            $adapter = Storage::disk('s3')->getDriver()->getAdapter(); 
            $image = file_get_contents($request->file('image')->path());
            $base64Image = base64_encode($image);
            $path = 'tickets';
            $expense->image = $this->saveImages($base64Image, $path, $expense->id);
        }
        $expense->save();
        return redirect('/gastos')->with('success', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('gastos.show', ['gastos' => Expense::findOrFail($id)]);
   
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
        $expense = Expense::find($id);
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
        $expense = Expense::findOrFail($id);
        if($request->hasFile('image')) {
            $adapter = Storage::disk('s3')->getDriver()->getAdapter(); 
            $image = file_get_contents($request->file('image')->path());
            $base64Image = base64_encode($image);
            $path = 'tickets';
            $expense->image = $this->saveImages($base64Image, $path, $expense->id);
        }
        $expense->save();

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
        Expense::destroy($id);
    }
    
    public function exportPdf(){
        $total = Expense::sum('price');
        $expense = Auth::user()->shop->id;
        $expenses = Shop::find($expense)->expenses()->get();
        $shops = Auth::user()->shop()->get();
        $pdf  = PDF::loadView('storeExpenses.GastosPDF', compact('expenses', 'shops','total'));
        //$pdf->setPaper('a4', 'landscape'); Orientacion de los archivos pdf
        //return $pdf->stream('gastos.pdf'); //solo visualizacion del archivo en la vista web
         return $pdf->download('gastos.pdf');
      }
     
}
