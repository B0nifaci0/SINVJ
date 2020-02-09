@extends('layout.layoutdas')
@section('title')
SUCURSAl
@endsection

@section('nav')
@endsection
@section('menu')

@endsection
@section('content')

<div class="page-content">
    <div class="panel panel-primary panel-bordered" data-plugin="appear" data-animate="fade">
        <header class="panel-heading">
            <div class="row">
                <h1 class=" panel-title col-9">Detalle de ventas</h1>
                {{-- <div class="panel-actions float-right col-">
                    <a href="/ventas/{{$sale->id}}/edit">
                        <button class="btn btn-sm small btn-floating
                     btn-primary waves-light float-right" data-toggle="tooltip" data-original-title="Editar Venta">
                            <i class="icon md-edit " aria-hidden="true"></i>
                        </button>
                    </a>
                </div> --}}
            </div>
        </header>
        <div class="table-responsive">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <p class="">
                            <strong>Nombre: </strong>{{ ($sale->client_id) ? $sale->client->full_name : $sale->customer_name }}
                        </p>
                        <p class="">
                            <strong>Teléfono: </strong>{{ ($sale->client) ? $sale->client->phone_number : $sale->telephone}}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="text-right">
                            <strong>Productos comprados: </strong>{{ $sale->itemsSold->count() }}
                        </p>
                        <p class="text-right">
                            <strong>Abonos realizados: </strong>{{ $sale->partials->count() }}
                        </p>
                    </div>
                    <div class="offset-md-2 col-md-3">
                        <table>
                            <tbody>
                                <tr>
                                    <td><strong class="text-center badge badge-warning" >Total:</strong></td>
                                    <td>$ {{ $sale->total }}</td>
                                </tr>
                                <tr>
                                    <td><strong class="text-center badge badge-danger" >Pagado:</strong></td>
                                    <td>$ {{ $sale->partials->sum('amount') }}</td>
                                </tr>
                                <tr>
                                    <td><strong class="text-center badge badge-success">Restan:</strong></td>
                                    <td>$ {{ $sale->total - $sale->paid_out }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Descripción</th>
                            <th>Linea</th>
                            <th>Categoria</th>
                            <th>Peso</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->itemsSold as $item)
                        <tr>
                            <td>{{ $item->clave }}</td>
                            <td>{{ $item->description }}</td>
                            <td>@if($item->line_id)
                                @foreach ($lines as $line)
                                    @if ($item->line_id == $line->id)
                                       {{$line->name}}
                                    @endif
                                @endforeach
                             @else  N/A @endif</td>
                            <td>{{$item->category_name}}</td>
                            <td>{{ ($item->weigth) ? $item->weigth  : 0 }}g</td>
                            <td>$ {{ $item->final_price }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="5"></td>
                            <td><strong>$ {{ $sale->total }}</strong></td>
                        </tr>
                    </tbody>
                </table>

        </div>
    </div>
</div>

<div class="page-content">
    <div class="panel panel-info panel-bordered" data-plugin="appear" data-animate="fade">
        <header class="panel-heading">
            <div class="row">
                <h3 class="panel-title col-9">Historial de pagos</h3>
                <div class="panel-actions float-right col-">
                    @if($sale->total > $sale->partials->sum('amount'))
                    <button id="newPayment" class="btn btn-sm small btn-floating
                    btn-primary waves-light float-right" data-toggle="modal" data-target="#myModal">  <i class="icon md-plus " aria-hidden="true"></i></button>
                    @endif
                </div>
            </div>
        </header>
        <div class="table-responsive container-fluid">
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-3">
                        <p>
                            <strong>Abonos totales: </strong>{{ $sale->partials->count() }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p>
                            <strong>Total abonado: </strong>$ {{ $sale->partials->sum('amount') }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p>
                            <strong>Restan: </strong>$ {{ $sale->total - $sale->partials->sum('amount') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Tipo de pago</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->partials as $partial)
                        <tr>
                            <td>{{ $partial->created_at }}</td>
                            <td>{{ ($partial->type === "1") ? 'Efectivo' : 'Tarjeta' }} </td>
                            <td>$ {{ $partial->amount }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="2"></td>
                            <td><strong>$ {{ $sale->partials->sum('amount') }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nuevo pago</h4>
            </div>
            <div class="modal-body">
                <form action="/pagos" method="post" id="saleForm">
                    <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label>Método de pago</label>
                            <select name="type" id="" class="form-control">
                                <option value="1">Efectivo</option>
                                <option value="2">Tarjeta</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>Monto</label>
                            <input type="text" id="amount" name="amount" class="form-control" alt="{{$sale->total - $sale->partials->sum('amount')}}">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="savePartial" type="button" class="btn btn-primary">Guardar pago</button>
                <!-- <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button> -->
            </div>
        </div>

    </div>
</div>

@section('listado-productos')
<script>
    $('#savePartial').click(function(e) {
        e.preventDefault();
        let amount = Number($('#amount').val());
        let max = Number($('#amount').attr('alt'));
        console.log(amount, max);
        if(amount > max) {
            alert('No puede pagar más de $ ' + max);
            return;
        }
        $('#saleForm').submit();
    })
</script>
@endsection

@endsection
