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
                <div class="panel-actions float-right col-">
                    <button onclick="window.location.href='/ventas'" class="btn btn-sm small btn-floating
                    btn-primary waves-light float-right" data-original-title="Ir a mis vent">  <i class="icon fa-reply-all " aria-hidden="true"></i></button>
                </div>         
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
                                    <td>$ {{$sale->paid_out}}</td>
                                </tr>
                                <tr>
                                    <td><strong class="text-center badge badge-success">Restan:</strong></td>
                                    <td> $ {{$sale->total - $sale->partials->sum('amount')}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

                <table id="items" class="table">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Descripción</th>
                            <th>Linea</th>
                            <th>Categoria</th>
                            <th>Peso</th>
                            <th>Precio</th>
                            <th>Devolver</th>
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
                            <td>{{ $item->weigth ? $item->weigth . ' g' : 'Pieza' }}</td>
                            <td>$ {{ $item->final_price }}</td>
                            <td>
                                <button class="btn btn-icon btn-danger waves-effect waves-light waves-round give-back"
                                alt="{{$item->id_product}}" role="button" data-toggle="tooltip" data-original-title="Devolver">
                                <i class="icon md-delete" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="5"></td>
                            <td><strong>$ {{ $sale->total }}</strong></td>
                            <td></td>
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
                            @if(($sale->total - $sale->partials->sum('amount')) >  0)
                            <strong>Restan: </strong>$ {{ $sale->total - $sale->partials->sum('amount') }}
                            @else
                            <strong>Restan: $ 0</strong>
                            @endif
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
                            <select name="type"  class="form-control">
                                <option value="1" id="t">Efectivo</option>
                                <option value="2" id="e">Tarjeta</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>Monto</label>
                            <input type="text" id="amount" name="amount" class="form-control" alt="{{$sale->total - $sale->partials->sum('amount')}}">
                        </div>
                            <!-- Input para seleccionar Imagen del ticket-->
                                <div class="form-group form-material col-md-6"  >
                                    <label>Selecciona Ticket de la venta</label>
                                    <br>
                                    <label for="image" class="btn btn-success">Explorar</label>
                                    <input type="file" name="image" id="image">
                                </div>
                            <!-- END Input-->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="savePartial" type="button" class="btn btn-primary" data-dismiss="modal">Guardar pago  </button>
                <!-- <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button> -->
            </div>
        </div>

    </div>
</div>
<form method="post" action="/ventas/check" id="form" class="d-none">
    {{ csrf_field() }}
    <input type="text" name="discar_cause" id="discar_cause">
    <input type="text" name="product_id" id="product_id">
    <input type="text" name="sale_id" id="sale-id" value="{{ $sale->id }}">
</form>
@section('listado-productos') 
<script>

$(document).ready(function(){

    $('#items').on('click', '.give-back', function () {
        let id = $(this).attr("alt");
        Swal.fire({
            title: 'Confirmación',
            text: "¿El producto ha sido devuelto?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4caf50',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
        }).then((result) => {
            if (result.value) {
                $('#discar_cause').val(3);
                $('#product_id').val(id);
                $('#form').submit();
            }
        })
    });

    $('#savePartial').click(function(e) {
        e.preventDefault();
        let amount = Number($('#amount').val());
        let max = Number($('#amount').attr('alt'));
        console.log(amount, max);
        if(amount > max) {
            swal.fire({
            title: 'Error',
            text: 'El pago maximo es $ ' + max,
            type: 'warning',
            showAcepptButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar!'
            });
            return;
        }
        $('#saleForm').submit();
    }); 


              
    $('#amount').on('input', function() {
                    let id = $(this).attr('id');
                    let val = $(this).val();
                    if(!Number(val)) {
                        $(this).val( val.replace(/[^0-9.]/, '') );
                    }
    })
    $("#t").on( 'select', function() {
			$('#image').show(); //muestro mediante clase
		 });
	$("#e").on( 'select', function() {
			$('#image').hide(); //muestro mediante clase
	    });
});
</script>
@endsection

@endsection
