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
            <div class="panel">
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
                <div class="panel">

                    <div class="panel-primary">
                        <div class="panel-heading">
                            <h2 class="panel-title" style="color:white" align="center"> Perfil De Cliente
                            </h2>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h2 class="panel-title" align="center"> Cliente: {{ $client->name }}
                            {{ $client->first_lastname }}
                            {{ $client->second_lastname }}</h2>
                    </div>
                    <div class="col-md-6">
                        <h2 class="panel-title" align="center"> Telefono: {{ $client->phone_number }}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mt-30">
                        <p>
                            <strong class=" badge-info col-md-2">Compras realizadas:
                                {{ $client->sales->count() }}</strong>
                        </p>
                    </div>
                    <div class="col-md-2 mt-30">
                        <p>
                            <strong class=" badge-warning col-md-2">Total comprado:
                                {{ $client->sales->sum('total') }}</strong>
                        </p>
                    </div>
                    <div class="col-md-2 mt-30">
                        <p>
                            <strong class=" badge-danger col-md-2">Pagado: $ {{ $client->sales->sum('paid_out') }}
                            </strong>
                        </p>
                    </div>
                    <div class="col-md-2 mt-30">
                        <p>
                            <strong class=" badge-primary col-md-2">Saldo a favor: $ @if($client->positive_balance)
                                {{ $client->positive_balance }} @else 0 @endif </strong>
                        </p>
                    </div>
                    <div class="col-md-2 mt-30">
                        <p>
                            <strong class=" badge-success col-md-2">Por pagar: $
                                {{ $client->sales->sum('total') - $client->sales->sum('paid_out') }} </strong>
                        </p>
                    </div>
                    <div class="col-md-2 mt-30">
                        <p>
                            <strong class=" badge-light col-md-2">Límite de Crédito: $ {{ $client->credit }} </strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>



        <div class="panel">
            <div class="panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title" style="color:white" align="center"> Historial de Compras y
                        Abonos</h2>
                </div>
            </div>
        </div>
            @foreach($client->sales as $sale)
            <!--INICIA TABLA PRODUCTOS COMPRADOS-->
        <div class="panel">
            <div class="panel">
                <div class="panel-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title" style="color:white" align="center"> Productos Comprados
                        </h2>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table class="display table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>Fecha compra</th>
                            <th>Clave</th>
                            <th>Descripción</th>
                            <th>Peso</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->itemsSold as $item)
                        <tr>
                            <td>{{ $sale->created_at }}</td>
                            <td>{{ $item->clave }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->weigth ? $item->weigth . ' g' : 'Pieza' }}</td>
                            <td>$ {{ $item->final_price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
             
                <table>
                    <tr>
                        <td colspan="6">
                        <th>
                            <strong>Total Comprado:</strong>
                        </th>
                        <td>
                            <strong>$ {{ $sale->total }}</strong>
                        </td>
                    </tr>
                </table>
            </div>
         </div>
         <!--FIN TABLA PRODUCTOS COMPRADOS-->
         <!--TABLA DE PRODUCTOS DEVUELTOS-->
         <div class="panel">
            <div class="panel">
                <div class="panel-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title" style="color:withe" align="center"> Productos Devueltos
                        </h2>
                    </div>
                </div>
            </div>
            <div clasS="panel-body">
                <table class="display table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>Fecha Devolucion</th>
                            <th>Clave</th>
                            <th>Descripción</th>
                            <th>Peso</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->devol}}</td>
                            <td>{{ $product->clave }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->weigth }}</td>
                            <!--<td> {{ $product->updated_at }} </td>-->
                            <td>${{ $product->price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <table>
                    <tr>
                        <td colspan="6">
                        <th>
                            <strong>Total Devuelto:</strong>
                        </th>
                        <td>
                            <strong>$ {{ $products->sum('total') }}</strong>
                        </td>
                    </tr>
                </table>
            </div>
         </div>
         <!-- FIN TABLA PRODUCTOS DEVUELTOS-->
         <!--INICIA TABLA ABONOS REALIZADOS-->
         <div class="panel">
            <div class=" panel">
                <div class="panel-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title" style="color:dark" align="center"> Abonos Realizados
                        </h2>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table class="display table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Tipo de pago</th>
                            <th>Ticket</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->partials as $partial)
                        <tr>
                            <td>{{ $partial->created_at }}</td>
                            <td>{{ ($partial->type == 1) ? 'Efectivo' : 'Tarjeta' }} </td>
                            <td>
                                <a class="inline-block" href="{{ $partial->image }}" data-plugin="magnificPopup"
                                    data-close-btn-inside="false" data-fixed-contentPos="true"
                                    data-main-class="mfp-margin-0s mfp-with-zoom"
                                    data-zoom='{"enabled": "true","duration":"300"}'>
                                    <img class="img-fluid" src="{{ $partial->image }}" alt="..." width="200"
                                        height="150" />
                            </td>
                            <td>$ {{ $partial->amount }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <table>
                    <tr>
                        <td colspan="6">
                        <th>
                            <strong>Total Abonado:</strong>
                        </th>
                        <td>
                            <strong>$ {{ $sale->partials->sum('amount') }}</strong>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!--TERMINA TABLA DE ABONOS REALIZADOS-->
        @endforeach
</div>
</div>

</form>
@endsection