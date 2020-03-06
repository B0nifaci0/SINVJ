<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Client;
use App\PayPal;
use App\Payment;
use App\Partial;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
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
        //return $request;
        $sale = Sale::find($request->sale_id);
        $client = Client::find($sale->client_id);

        $balance = $sale->total - $sale->paid_out;

        $validator = Validator::make($request->all(), [

            'image' => Rule::requiredIf($request->type == 2)


        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'image' => 'imagen',
                'errors' => $validator->errors()->add('imagen', 'La imagen del comprobante es necesaria.'),
                'error' => 'Error en alguno de los campos',
            ];
            return back()->withErrors($validator->errors());
        }
        //CUANDO SE UTILIZA EL SALDO A FAVOR
        if ($request->type == 3) {
            //CUANDO EL SALDO A FAVOR ES MAYOR A LO RESTANTE
            if ($client->positive_balance > $balance) {
                //EL NUEVO SALDO A FAVOR SE RESTARA A LO RESTANTE
                $client->positive_balance = $client->positive_balance - $balance;
                //LO RESTANTE SERA LO MISMO AL TOTAL PARA QUE LA VENTA SEA LIQUIDADA
                $sale->paid_out = $sale->total;
                //EL CLIENTE TODAVIA TENDRA SALDO A FAVOR
                //return $sale;
            } else {
                //SI EL SALDO A FAVOR ES MENOR A LO RESTANTE SE UTILIZARA TODO EL SALDO A FAVOR Y QUEDARA NULO
                $sale->paid_out = $sale->paid_out + $client->positive_balance;
                $sale->positive_balance = null;
                $client->positive_balance = null;
            }
            //return $sale;
        } else {
            $sale->paid_out += $request->amount;
        }

        if ($sale->total == 0) {
            $sale->positive_balance = $sale->paid_out;
            if ($sale->client_id) {
                if ($sale->total < $client->positive_balance) {
                    $client_positive_balance = $client->positive_balance - $sale->paid_out;
                    $client->positive_balance = $sale->paid_out;
                    //return $client;

                }
            }
        }

        $sale->save();

        if ($sale->client_id) {
            $client->save();
        }

        if ($request->type == 2) {
            $adapter = Storage::disk('s3')->getDriver()->getAdapter();
            $image = file_get_contents($request->file('image')->path());
            $base64Image = base64_encode($image);
            $path = 'payment-tickets';
            $consulta = Partial::orderby('id', 'desc')
                ->take(1)
                ->get();
            $conteo = $consulta[0]->id + 1;
            $imagen = $this->saveImages($base64Image, $path, $conteo);
            $partial = Partial::create([
                'sale_id' => $request->sale_id,
                'amount' => $request->amount,
                'type' => Partial::CARD,
                'image' => $imagen,
            ]);
        } else if ($request->type == 1) {
            $partial = Partial::create([
                'sale_id' => $request->sale_id,
                'amount' => $request->amount,
                'type' => Partial::CASH,
            ]);
        } else {
            $partial = Partial::create([
                'sale_id' => $request->sale_id,
                'amount' => $request->amount,
                'type' => Partial::CREDIT,
            ]);
        }
        if($request->type == 3)
        {
            return back()->with('mesage', 'El saldo a favor ha sido utilizado exitosamente!');
        } elseif($request->type == 2) {
            return back()->with('mesage', 'El pago con tarjeta se agrego exitosamente!');
        } else {
            return back()->with('mesage', 'El pago con efectivo se agrego exitosamente!');
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
