@extends('layout.layoutdas')
@section('title')
ALTA BITACORAS
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="page-content container-fluid">
    <form autocomplete="off" method="POST" action="/mayoristas">
        {{ csrf_field() }}
        <div class="panel">
            <div class="panel-body">
                @if (session('mesage'))
                    <div class="alert alert-success">
                        <strong>{{ session('mesage') }}</strong>
                    </div>
                @endif
                @if($errors->count() > 0)
                    <div class="alert alert-danger" role="alert">
                        <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-4">
                        <h2 class="panel-title">Perfil de {{ $client->name }} {{ $client->first_lastname }} {{ $client->second_lastname }}</h2>                    
                        <h4 class="panel-title">Número telefónico: {{ $client->phone_number }}</h4>                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mt-40">
                        <p>
                            <strong>Compras realizadas:</strong> {{ $client->sales->count() }}
                        </p>
                    </div>
                    <div class="col-md-3 mt-40">
                        <p>
                            <strong>Total comprado: </strong>$ {{ $client->sales->sum('total') }}
                        </p>
                    </div>
                    <div class="col-md-3 mt-40">
                        <p>
                            <strong>Pagado: </strong>$ {{ $client->sales->sum('paid_out') }}
                        </p>
                    </div>
                    <div class="col-md-3 mt-40">
                        <p>
                            <strong>Por pagar: </strong>$ {{ $client->sales->sum('total') - $client->sales->sum('paid_out') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-body">
                <h3>Historial de compras</h3>    
            </div>
            @foreach($client->sales as $sale)
            <div class="panel-body">
                <div class="offset-md-2 col-md-8">
                    <h2 class="panel-title">Fecha de compra: {{ date('d/m/Y', strtotime($sale->created_at)) }}</h2>
                </div>
                <div class="row">
                    <div class="offset-md-2 col-md-8">
                        <strong>Productos comprados</strong>
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>Clave</th>
                                    <th>Descripción</th>
                                    <th>Peso</th>
                                    <th class="text-right">Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sale->itemsSold as $item)
                                <tr>
                                    <td>{{ $item->clave }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->weigth }} g</td>
                                    <td class="text-right">$ {{ $item->price }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="text-right">
                                        <strong>$ {{ $sale->total }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-md-2 col-md-8">
                        <strong>Abonos realizados</strong>
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Tipo de pago</th>
                                    <th>Referencia</th>
                                    <th class="text-right">Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sale->partials as $partial)
                                <tr>
                                    <td>{{ $partial->created_at }}</td>
                                    <td>{{ ($partial->type == 1) ? 'Efectivo' : 'Tarjeta' }} </td>
                                    <td>{{ $partial->reference }}</td>
                                    <td class="text-right">$ {{ $partial->amount }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="text-right">
                                        <strong>$ {{ $sale->partials->sum('amount') }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </form>
</div>
@endsection