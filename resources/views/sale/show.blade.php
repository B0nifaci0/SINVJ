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
    @if (session('mesage'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('mesage') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if (session('mesage-givedback'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('mesage-givedback') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="panel panel-primary panel-bordered" data-plugin="appear" data-animate="fade">
        <header class="panel-heading">
            <div class="row">
                <h1 class=" panel-title col-md-12" align="center">Detalle de ventas</h1>
                <div class="panel-actions float-right col-">
                    <button onclick="window.location.href='/ventas'" class="btn btn-sm small btn-floating
                    btn-primary waves-light float-right" data-toggle="tooltip" data-original-title="Ir a mis ventas">
                        <i class="icon fa-reply-all " aria-hidden="true"></i></button>
                </div>
            </div>
        </header>
        <div class="table-responsive">
            <div class="panel-body">
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
                        <p class="">
                            <strong>Fecha venta:</strong>{{$sale->created_at->format(' d/m/Y  H:i:s')}}
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="">
                            <strong>Nombre:
                            </strong>{{ ($sale->client_id) ? $sale->client->full_name : $sale->customer_name }}
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="">
                            <strong>Teléfono:
                            </strong>{{ ($sale->client) ? $sale->client->phone_number : $sale->telephone}}
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="">
                            <strong>Tipo cliente: </strong>@if( $sale->client->type_client == 0)
                            <span class="text-center badge badge-success">Menudeo</span>
                            @endif
                            @if( $sale->client->type_client == 1)
                            <span class="text-center badge badge-success">Mayorista</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="">
                            <strong>Productos comprados: </strong>{{ $sale->itemsSold->count() }}
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="">
                            <strong>Abonos realizados: </strong>{{ $sale->partials->count() }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p class="">
                            <strong class="text-center badge badge-warning"> Total: </strong>$ {{ $sale->total }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="">
                            <strong class="text-center badge badge-danger"> Pagado: </strong>$ {{ $sale->paid_out }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="">
                            <strong class="text-center badge badge-primary">Saldo a Favor:</strong>
                            $ @if($sale->client->positive_balance == null)
                            0
                            @else
                            {{ $sale->client->positive_balance }}
                            @endif
                        </p>
                    </div>
                    @if($sale->client->type_client == 1)
                    <div class="col-md-3">
                        <p class="">
                            <strong class="text-center badge badge-secondary">Límite de crédito: </strong>
                            $ {{ $sale->client->credit }}
                        </p>
                    </div>
                    @endif
                    @if($sale->change > 0 && $sale->client->type_client == 0)
                    <div class="col-md-3">
                        <p class="">
                            <strong class="text-center badge badge-secondary">Cambio:</strong>
                            $ {{ $sale->change }}
                        </p>
                    </div>
                    @endif
                    <div class="col-md-3">
                        <p class="">
                            <strong class="text-center badge badge-success">Restan:</strong>
                            @if(($sale->total - $sale->partials->sum('amount')) > 0)
                            $ {{$sale->total - $sale->partials->sum('amount')}}
                            @else
                            $ 0
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <div class="panel">
            <div class="panel-success">
                <div class="panel-heading">
                    <h2 class="panel-title" style="color:white" align="center"> Productos Comprados</h2>
                    @if($sale->paid_out != $sale->total)
                    <div class="panel-actions float-right">
                        <button id="products" class="btn btn-sm small btn-floating
                    btn-success waves-light float-right" data-toggle="modal" data-original-title="Agregar Producto"
                            data-target="#productModal"> <i class="icon fa-plus " aria-hidden="true"></i></button>
                    </div>
                    @endif
                </div>
            </div>
            <table id="items" class="table">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Descripción</th>
                        <th>Línea</th>
                        <th>Categoría</th>
                        <th>Peso</th>
                        <th>Precio</th>
                        @if($sale->paid_out != $sale->total)
                        @if($sale->change == 0)
                        <th colspan="2">Opciones</th>
                        @endif
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($sale->itemsSold as $item)
                    <tr>
                        <td>{{ $item->clave }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{$item->line->name ? $item->line->name : 'N/A'}}</td>
                        <td>{{$item->category_name}}</td>
                        <td>{{ $item->weigth ? $item->weigth . ' g' : 'Pieza' }}</td>
                        <td>$ {{ $item->final_price }}</td>
                        @if($sale->paid_out != $sale->total)
                        @if (Auth::user()->type_user==1)
                        <td>
                            <button class="btn btn-icon btn-danger waves-effect waves-light waves-round give-back"
                                alt="{{$item->id_product}}" id="{{$item->limit}}" role="button" data-toggle="tooltip"
                                data-original-title="Devolver">
                                <i class="icon fa-reply-all" aria-hidden="true"></i>
                            </button>
                        </td>
                        @endif
                        <td>
                            <button class="btn btn-icon btn-danger waves-effect waves-light waves-round cancel"
                                alt="{{$item->id_product}}" id="{{$item->limit}}" role="button" data-toggle="tooltip"
                                data-original-title="Cancelar">
                                <i class="icon fa-window-close" aria-hidden="true"></i>
                            </button>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" align="center">Total</td>
                        <td><strong>$ {{ $sale->total }}</strong></td>
                        @if($sale->paid_out != $sale->total)
                        @if($sale->change == 0)
                        <td colspan="2">Opciones</td>
                        @endif
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="table-responsive">
        <div class="panel-warning">
            <div class="panel-heading">
                <h2 class="panel-title" style="color:white" align="center"> Productos Devueltos</h2>
            </div>
        </div>
        <div class="panel">
            <table id="items" class="table">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Descripción</th>
                        <th>Línea</th>
                        <th>Categoría</th>
                        <th>Peso</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sale->itemsGivedBack as $item)
                    <tr class="table-active">
                        <td>{{ $item->clave }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{$item->line->name ? $item->line->name : 'N/A'}}</td>
                        <td>{{$item->category_name}}</td>
                        <td>{{ $item->weigth ? $item->weigth . ' g' : 'Pieza' }}</td>
                        <td>$ {{ $item->final_price }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" align="center">Total</td>
                        <td><strong>$ {{ $finalprice }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<div class="page-content">
    <div class="panel panel-info panel-bordered" data-plugin="appear" data-animate="fade">
        <header class="panel-heading">
            <div class="row">
                <h3 class="panel-title col-12" align="center">Historial de pagos</h3>

                <div class="panel-actions float-right">

                    <a href="/ventapdf/{{$sale->id}}"><button type="button"
                            class="btn btn-sm samll btn-floating btn-danger waves-effect waves-light"
                            data-toggle="tooltip" data-original-title="Generar reporte PDF">
                            <i class="icon fa-file-pdf-o" aria-hidden="true"></i></button>
                    </a>

                    @if($sale->total > $sale->paid_out)
                    <button id="newPayment" class="btn btn-sm small btn-floating
                        btn-primary waves-light float-rightleft" data-toggle="modal" data-target="#myModal"> <i
                            class="icon md-plus " aria-hidden="true"></i></button>
                    @endif
                </div>
            </div>
        </header>
        <div class="table-responsive container-fluid">
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-4">
                        <p>
                            <strong>Abonos Realizados: </strong>{{ $sale->partials->count() }}
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p>
                            <strong>Total abonado: </strong>$ {{ $sale->partials->sum('amount') }}
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p>
                            @if(($sale->total - $sale->paid_out) > 0)
                            <strong>Restan: </strong>$ {{ $sale->total - $sale->paid_out }}
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
                            <th>Ticket</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->partials as $partial)
                        <tr>
                            <td>{{ $partial->created_at }}</td>
                            @if($partial->type == "1")
                            <td>Efectivo</td>
                            @elseif($partial->type == "2")
                            <td>Tarjeta</td>
                            @else
                            <td>Saldo a Favor</td>
                            @endif
                            </td>
                            <td>$ {{ $partial->amount }}</td>
                            <td>
                                @if($partial->image)
                                <a class="inline-block" href="{{ $partial->image }}" data-plugin="magnificPopup"
                                    data-close-btn-inside="false" data-fixed-contentPos="true"
                                    data-main-class="mfp-margin-0s mfp-with-zoom"
                                    data-zoom='{"enabled": "true","duration":"300"}'>
                                    <img class="img-fluid" src="{{ $partial->image }}" alt="..." width="200"
                                        height="150" />
                                    @else
                                    Sin Imagen
                                    @endif
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="2"></td>
                            <td><strong>$ {{ $sale->partials->sum('amount') }}</strong></td>
                            <td></td>
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
                <form action="/pagos" method="post" id="saleForm" enctype="multipart/form-data">
                    <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <label>Método de pago</label>
                            <select name="type" id="valor" class="form-control">
                                <option value="1" selected="selected" id="cash">Efectivo</option>
                                <option value="2" id="card">Tarjeta</option>
                                @if(($sale->client_id) ? $sale->client->positive_balance : $sale->positive_balance)
                                <option value="3" id="balance">Saldo a Favor</option>
                                @endif
                            </select>
                        </div>
                        @if(($sale->client_id) ? $sale->client->positive_balance : $sale->positive_balance)
                        <div class="col-md-12 positive">
                            <label>Monto</label>
                            <input type="text" id="amount" name="amount" class="form-control"
                                value="{{($sale->client_id) ? $sale->client->positive_balance : $sale->positive_balance}}"
                                alt="{{$sale->total - $sale->paid_out}} ">
                        </div>
                        @else
                        <div class="col-md-12">
                            <label>Monto</label>
                            <input type="text" id="amount" name="amount" class="form-control"
                                alt="{{$sale->total - $sale->paid_out}}">
                        </div>
                        @endif
                    </div>
                    <div class="form-group form-material col-md-6 remove">
                        <label>Selecciona Ticket de la venta</label>
                        <label for="image" class="btn btn-primary">Explorar</label>
                        <input type="file" name="image" id="image" class="invisible">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="savePartial" type="button" class="btn btn-primary" data-dismiss="modal">Guardar pago
                </button>
            </div>
        </div>

    </div>
</div>

<!-- Modal Products -->
<div id="productModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar Producto</h4>
            </div>
            <div class="modal-body">
                <form action="/pagos" method="post" id="saleForm" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <label>Selecciona un Producto</label>
                            <select id="current_product" name="product_id" class="form-control" data-plugin="select2"
                                data-placeholder="Seleccione Producto" data-allow-clear="true">
                                <option></option>
                                <optgroup label="Productos">
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}" required>
                                        {{$product->clave}}-{{$product->description}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            <div class="row">
                                <div class="col-4">
                                    <label>Precio Maximo</label>
                                    <input id='price' class="form-control" readonly>
                                </div>
                                <div class="col-4">
                                    <label>Precio minimo</label>
                                    <input id='priceDiscount' class="form-control" readonly>
                                </div>
                                <div class="col-4">
                                    <label>Precio Final</label>
                                    <input id='finalPrice' class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="saveProduct" type="button" class="btn btn-primary" data-dismiss="modal">Agregar Producto
                </button>
            </div>
        </div>

    </div>
</div>

<form method="post" action="/ventas/check" id="givedback" class="d-none">
    {{ csrf_field() }}
    <input type="text" name="discar_cause" id="discar_cause">
    <input type="text" name="product_id" id="product_id">
    <input type="text" name="sale_id" id="sale-id" value="{{ $sale->id }}">
</form>

<form method="post" action="/ventas/canceled" id="canceled" class="d-none">
    {{ csrf_field() }}
    <input type="text" name="product_id" id="producto_id">
    <input type="text" name="deleteSale" id="deleteSale">
    <input type="text" name="sale_id" id="sale-id" value="{{ $sale->id }}">
</form>

<form method="post" action="/ventas/addProduct" id="productForm" class="d-none">
    {{ csrf_field() }}
    <input type="text" name="product_id" id="newProduct_id">
    <input type="text" name="product_price" id="product_price">
    <input type="text" name="sale_id" id="sale-id" value="{{ $sale->id }}">
</form>

@section('listado-productos')
<script>
    $(document).ready(function () {

    var saledetails = {!! $sale-> itemsSold -> count() !!};
    console.log('Cantidad:' + saledetails)
    var overLimitAuth = false;

    $('#items').on('click', '.give-back', function () {
        let id = $(this).attr("alt");
        var over = $(this).attr("id");
        if (over == 1 && overLimitAuth == false) {
            var message = `El tiempo de devolucion del producto ha expirado.
		        Ingrese la contraseña de seguridad para continuar`;
            Swal.fire({
                title: message,
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                showLoaderOnConfirm: true,
                preConfirm: (password) => {
                    return fetch(`/check-password`, {
                        method: 'POST',
                        body: JSON.stringify({
                            password: password
                        }),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }
                            return response.json()
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                                `Contraseña incorrecta`
                            )
                        })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        title: `La contraseña es correcta`
                    })
                    overLimitAuth = true;
                    console.log("overLimitAuth: ", overLimitAuth);
                }
            })
            return;
        }
        console.log("ID: ", id, " y Limit: ", over);

        Swal.fire({
            title: 'Confirmación',
            text: "¿Seguro que quieres devolver el producto?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4caf50',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
        }).then((result) => {
            if (result.value) {
                $('#discar_cause').val(3);
                $('#product_id').val(id);
                $('#givedback').submit();
            }
        })

    });

    $('#items').on('click', '.cancel', function () {
        let id = $(this).attr("alt");
        if (saledetails == 1) {
            Swal.fire({
                title: 'Confirmación',
                text: "Si cancelas todos los productos la venta sera eliminada.¿Seguro que quieres hacerlo?.El monto pagado ira a Saldo a favor del cliente.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4caf50',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.value) {
                    $('#producto_id').val(id);
                    $('#deleteSale').val(true)
                    $('#canceled').submit();
                }
            })
        } else {

            Swal.fire({
                title: 'Confirmación',
                text: "¿Seguro que quieres cancelar el producto de la venta?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4caf50',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.value) {
                    $('#producto_id').val(id);
                    $('#deleteSale').val(false)
                    $('#canceled').submit();
                }
            })
        }

    });



    $('#savePartial').click(function (e) {
        console.log("Diste click");
        e.preventDefault();
        let valor = Number($('#valor').val());
        let amount = Number($('#amount').val());
        let max = Number($('#amount').attr('alt'));
        console.log(valor, amount, max);
        if (valor == 1 || valor == 2) {
            if (amount > max || amount <= 0) {
                swal.fire({
                    title: 'Error',
                    text: 'El pago maximo es $ ' + max + ' y el minimo es $ 1',
                    type: 'warning',
                    showAcepptButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar!'
                });
                return;
            }
        }
        $('#saleForm').submit();
    });


    $('#current_product').change(function () {
        product_id = $(this).val();
        console.log('id' + product_id)
        var url = '/products/' + product_id;
        $.get(url, function (product) {
            console.log('pruebita ' + product.id)
            $('#price').val(product.price);
            $('#priceDiscount').val(product.discount);
            $('#finalPrice').val(product.price);
        });
    });

    $('#saveProduct').click(function (e) {
        e.preventDefault();
        let product = Number($('#current_product').val());
        let price = Number($('#price').val())
        let finalPrice = Number($('#finalPrice').val())
        let priceDiscount = Number($('#priceDiscount').val())
        if ((finalPrice > price) || (finalPrice < priceDiscount)) {
            Swal.fire({
                title: 'Ingrese la contraseña de seguridad para continuar',
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                showLoaderOnConfirm: true,
                preConfirm: (password) => {
                    return fetch(`/check-password`, {
                        method: 'POST',
                        body: JSON.stringify({
                            password: password
                        }),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }
                            return response.json()
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                                `Contraseña incorrecta`
                            )
                        })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        title: `La contraseña es correcta`
                    })
                    $('#newProduct_id').val(product);
                    $('#product_price').val(finalPrice)
                    $('#productForm').submit();
                }
            })
            return;
        }
        $('#newProduct_id').val(product);
        $('#product_price').val(finalPrice)
        $('#productForm').submit();
    });

    $('#amount').on('input', function () {
        let id = $(this).attr('id');
        let val = $(this).val();
        $(`#${id}`).val(val.replace(/\s+/, ""));
    })
    $('.remove').hide();
    var guarda = $('#amount').val();
    //console.log("input: ",$('#amount').val());
    $('#amount').val(0)
    $('#amount').removeAttr('readonly');
    $('#amount').removeClass('readOnly');
    console.log("Variable: ", guarda);
    $('#valor').change(function () {
        var partialId = $(this).val();
        console.log("El valor del id es:", partialId)
        if (partialId == 2) {
            //Tarjeta
            //console.log("Entro 1");
            $('.remove').show();
            $('#amount').val(0);
            $('#amount').removeAttr('readonly');
            $('#amount').removeClass('readOnly');
            //$('#amount').prop('disabled',false);
            // console.log($('#amount').value)

        } else if (partialId == 1) {
            //Efectivo
            //console.log("Entro 2");
            $('.remove').hide();
            $('#amount').val(0);
            // $('#amount').prop('disabled',false);
            $('#amount').removeAttr('readonly');
            $('#amount').removeClass('readOnly');
            //  console.log($('#amount').value)
        } else {
            $('.remove').hide();
            $('#amount').val(guarda);
            //$('#amount').prop('disabled',true);
            $('#amount').attr('readonly', 'readonly');
            $('#amount').addClasss('readOnly');
        }
    });
    });
</script>
@endsection

@endsection