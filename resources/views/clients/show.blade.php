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
                <div class=" col-lg">
                <div class="panel-primary">
                <div class="panel-heading">
                <h2 class="panel-title" style="color:white" align="center"> Perfil Cliente Mayorista</h2>
                </div>
                </div>
                </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h2 class="panel-title"> Cliente: {{ $client->name }} {{ $client->first_lastname }} {{ $client->second_lastname }}</h2>                    
                    </div>
                    <div class="col-md-6">    
                        <h2 class="panel-title"> Telefono: {{ $client->phone_number }}</h2>                    
                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-3 mt-40" align="center">
                        <p>
                            <strong class=" badge-info col-md-3" >Compras realizadas: {{ $client->sales->count() }}</strong>
                        </p>
                    </div>
                    <div class="col-md-2 mt-40" align="center">
                        <p>
                            <strong class=" badge-primary col-md-3" >Total comprado: {{ $client->sales->sum('total') }}</strong>
                        </p>
                    </div>
                    <div class="col-md-2 mt-40" align="center">
                        <p>
                            <strong class=" badge-success col-md-3" >Pagado: $ {{ $client->sales->sum('paid_out') }} </strong>
                        </p>
                    </div>
                    <div class="col-md-2 mt-40">
                        <p>
                            <strong class=" badge-warning col-md-3">Por pagar: $ {{ $client->sales->sum('total') - $client->sales->sum('paid_out') }} </strong>
                        </p>
                    </div>
                    <div class="col-md-2 mt-40">
                        <p>
                            <strong class=" badge-secondary col-md-3">Saldo a favor: $ @if($client->positive_balance) {{ $client->positive_balance }} @else 0 @endif </strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-body">
                <div class="row">
                  <div class=" col-lg">
                    <div class="panel-info">
                      <div class="panel-heading">
                        <h2 class="panel-title" style="color:white" align="center"> Historial de Compras y Abonos</h2>
                      </div>
                    </div>
                  </div>
                </div>   
            </div>
            @foreach($client->sales as $sale)
            <div class="panel-body">
                <div class=" col-md-12">
                    <h2 class="panel-title" align="left">Fecha de compra: {{ date('d/m/Y', strtotime($sale->created_at)) }}</h2>
                </div>
                <div class="row">
                    <div class=" col-md-12">
                        <div class="row">
                        <div class=" col-lg">
                        <div class="panel-warning">
                        <div class="panel-heading">
                        <h2 class="panel-title" style="color:white" align="center"> Productos Comprados</h2>
                        </div>
                        </div>
                        </div>
                        </div>
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
                                    <td>{{ $item->weigth ? $item->weigth . ' g' : 'Pieza' }}</td>
                                    <td class="text-right">$ {{ $item->final_price }}</td>
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
                    <!--TABLA DE PRODUCTOS DEVUELTOS-->
                  <div class="row">  
                    <div class=" col-md-12">
                        <div class="row">
                        <div class=" col-lg">
                        <div class="panel-danger">
                        <div class="panel-heading">
                        <h2 class="panel-title" style="color:white" align="center"> Productos Devueltos</h2>
                        </div>
                        </div>
                        </div>
                        </div>
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
                                @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->clave }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->weigth }}</td>
                                    <!--<td> {{ $product->updated_at }} </td>-->
                                    <td class="text-right">${{ $product->price }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th colspan="3"> Total devuelto</th>
                                    <td class="text-right">
                                        <strong>$ {{ $products->sum('total') }} </strong>
                                    </td>
                                </tr>    
                            </tbody>
                        </table>
                    </div>
                   </div> 
		<!-- FIN TABLA PRODUCTOS DEVUELTOS-->
                <div class="row">
                    <div class=" col-md-12">
                        <div class="row">
                          <div class=" col-lg">
                            <div class="panel-success">
                              <div class="panel-heading">
                                 <h2 class="panel-title" style="color:white" align="center"> Abonos Realizados</h2>
                              </div>
                            </div>
                          </div>
                        </div>
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