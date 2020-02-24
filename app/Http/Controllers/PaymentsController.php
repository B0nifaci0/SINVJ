<?php

namespace App\Http\Controllers;

use App\Sale;
use App\PayPal;
use App\Payment;
use App\Partial;
use App\Subscription;
use App\CardInformation;
use PayPal\Api\CreditCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Traits\S3ImageManager;



class PaymentsController extends Controller
{

    use S3ImageManager;
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
        return view('payments/index');
       }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment = Payment::with('product')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->type == 2) {
                $adapter = Storage::disk('s3')->getDriver()->getAdapter();
                $image = file_get_contents($request->file('image')->path());
                $base64Image = base64_encode($image);
                $path = 'payment-tickets';
                $consulta = Partial::orderby('id','desc')
                ->take(1) 
                ->get();
                $conteo =$consulta[0]->id +1;
                $imagen = $this->saveImages($base64Image, $path, $conteo);
                $partial = Partial::create([
                    'sale_id' => $request->sale_id,
                    'amount' => $request->amount,
                    'type' => Partial::CARD,
                    'image' => $imagen,
                ]);
        }else{
            $partial = Partial::create([
                'sale_id' => $request->sale_id,
                'amount' => $request->amount,
                'type' => Partial::CASH,
            ]);
        }



        $sale = Sale::find($request->sale_id);
        
        if($request->type == 3)
        {
            $sale->positive_balance = null;
        }
        
        $sale->paid_out += $request->amount;
        $sale->save(); 

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
