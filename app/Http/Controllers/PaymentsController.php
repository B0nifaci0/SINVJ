<?php

namespace App\Http\Controllers;

use App\PayPal;
use App\Payment;
use App\Subscription;
use App\CardInformation;
use PayPal\Api\CreditCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
       {
        $subscription = new Subscription();

        $paypal = new PayPal($subscription);

        $payment = $paypal->generate();

        return redirect($payment->getApprovalLink());
       }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
           return view('pagos/pagos');
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
        $subscription = new Subscription();
        $paypal = new PayPal($subscription);
        $response = $paypal->execute($request->paymentId, $request->PayerID);
        if ($response->state =="approved") {
          $details = Payment::createFromPaypalResponse($response, Auth::user()->id);
          return redirect('/realizarpago')->with('mesage', 'El pago se ha realizado exitosamente!');

          //dd($response);
        }else{
          return redirect('/realizarpago')->with('mesage-error', 'Ocurrio un error en el pago!');
        }
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
