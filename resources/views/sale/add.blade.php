@extends('layout.layoutdas')
@section('title')
ALTA VENTA
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="panel-body">
    @if (session('mesage'))
    <div class="alert alert-success">
        <strong>{{ session('mesage') }}</strong>
    </div>
    @endif
    <div class="page-content">
        <div class="panel">
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
                <form id="form" method="POST" action="/ventas" enctype="multipart/form-data">
                    <center>
                        <h3>Venta</h3>
                    </center>
                    {{ csrf_field() }}
                    <div class="row mb-10">
                        <div class="col-md-3">
                            <label for="user-type">Tipo de venta</label>
                            <select name="user_type" id="user-type" class="form-control">
                                <option value="1">Venta al publico</option>
                                <option value="2">Venta a mayorista</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div id="wholesalers" class="col-md-7">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Input para Ingresar Nombre del cliente-->
                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicFirstName">Nombre del Cliente:
                                        </label>
                                        <input type="text" class="form-control" required="required" name="customer_name" value="{{old('customer_name')}}" placeholder="Fernando Bonifacio" />
                                    </div>
                                    <!-- END Input-->
                                </div>
                                <div class="col-md-6">
                                    <!-- Input para Ingresar telefono del cliente-->
                                    <div class="form-group form-material">
                                        <label class="form-control-label" for="inputBasicLastName">Teléfono:</label>
                                        <input type="text" class="form-control" required="required" name="telephone" value="{{old('telephone')}}" placeholder="7225674569" />
                                    </div>
                                    <!-- END Input-->
                                </div>
                            </div>
                        </div>

                        <div id="normal-client" class="d-none">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="user-type">Seleccionar cliente</label>
                                    <select name="client_id" id="user-id" class="form-control">
                                        @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}
                                            {{ $client->first_lastname }} {{ $client->second_lastname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Select para Seleccionar  producto-->
                        <div class="form-group form-material col-10 col-md-4">
                            <label>Producto</label>
                            <select id="current_product" name="product_id" class="form-control" data-plugin="select2" data-placeholder="Seleccione Producto" data-allow-clear="true">
                                <option></option>
                                <optgroup label="Productos">
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}" required>
                                        {{$product->clave}}-{{$product->description}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="col-1 form-group">
                            <br>
                            <button type="button" class="btn btn-primary" id="btn-add">+</button>
                        </div>
                        <!-- END Select-->
                        <!-- Botón para agregar producto-->

                    </div>

                    <!-- END Botón-->
                    <div class="panel-body ">
                        <!-- Tabla para listar productos agregados-->
                        <table id="ventas" class=" display table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                            <thead>
                                <tr>
                                    <th>Clave</th>
                                    <th>Nombre</th>
                                    <th>Peso</th>
                                    <th>Categoría</th>
                                    <th>Linea</th>
                                    <th>Sucursal</th>
                                    <th>Precio Max</th>
                                    <th>Precio Min</th>
                                    <th>Precio final</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Clave</th>
                                    <th>Nombre</th>
                                    <th>Peso</th>
                                    <th>Categoría</th>
                                    <th>Linea</th>
                                    <th>Sucursal</th>
                                    <th>Precio Max</th>
                                    <th>Precio Min</th>
                                    <th>Precio final</th>
                                    <th>Eliminar</th>
                                </tr>
                            </tfoot>
                        </table>
                        <table>
                            <tr>
                                <td colspan="6"></td>
                                <th>
                                    <strong>Total:</strong>
                                </th>
                                <td><strong id="total"></strong><input type="hidden" class="form-control" name="price" id="pagar" /> </td>
                            </tr>

                            <tr>
                                <td colspan="6"></td>
                                <th>
                                    <strong>Importe:</strong>
                                </th>
                                <td><strong id="amount"></strong><input type="hidden" class="form-control" name="income" id="monto" /> </td>
                            </tr>

                            <tr>
                                <td colspan="6"></td>
                                <th>
                                    <strong>Cambio:</strong>
                                </th>
                                <td><strong id="change"></strong><input type="hidden" class="form-control" name="change" id="cambio" /> </td>
                            </tr>
                        </table>

                        <!-- END Tabla-->
                    </div>
                    <br>
                <input type="file" name="image" id="image" class="invisible">
                    <div class="row">
                        <!-- Botón para mostar el Modal de Tipos de pago-->
                        <div class="col-6 form-group">
                            <button class="btn btn-success" data-target="#exampleTabs" data-toggle="modal" type="button">$ Registro de pago</button>
                        </div>
                        <!-- END Botón-->
                        <input type="hidden" class="form-control" name="partial_pay" id="faltan" />
                        <input type="hidden" class="form-control" name="total_pay" id="totalPay" />
                        <!-- Botón para guardar venta-->

                        <input type="hidden" class="form-control" name="products_list" id="productsList" />
                        <input type="hidden" class="form-control" name="cash_income" id="cashPayment" />
                        <input type="hidden" class="form-control" name="card_income" id="cardPayment" />

                        <div class="form-group col-6">
                            <a id="submit" type="button" class="btn btn-primary text-white float-right">Terminar
                                compra</a>
                        </div>
                        <!-- END Botón-->
                    </div>
            </div>
            </form>
            <div class="col-xl-4 col-lg-6">
                <!-- Example Tab In Modal -->
                <div class="example-wrap">
                    <div class="example">
                        <!-- Modal -->
                        <div class="modal fade modal-success" id="exampleTabs" aria-hidden="true" aria-labelledby="exampleModalTabs" role="dialog" tabindex="-1">
                            <div class="modal-dialog modal-simple">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" id="exampleModalTabs">Agregar pago</h4>
                                    </div>
                                    <div class="modal-body">
                                        <!-- CONTADO-->

                                        <div class="row mt-5">
                                            <div class="form-group form-material col-md-6">
                                                <label class="form-control-label" for="inputBasicFirstName">Efectivo:</label>
                                                <input type="text" class="form-control income" name="" id="cashIncome" required="required" placeholder="$" required />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- Input para ingresar cantidad a pagar-->
                                            <div class="form-group form-material col-md-6">
                                                <label class="form-control-label">Tarjeta:</label>
                                                <input type="text" class="form-control income" id="cardIncome" placeholder="$" required="required" />
                                            </div>
                                            <!-- END Input-->
                                            <!-- Input para seleccionar Imagen del ticket-->
                                            <div class="form-group form-material col-md-6">
                                                <label>Selecciona Ticket de la venta</label>
                                                <br>
                                                <label for="image" class="btn btn-success">Explorar</label>
                                            </div>
                                            <!-- END Input-->
                                        </div>
                                        <div class="row">
                                            <div class="form-group form-material col-md-6">
                                                <label class="form-control-label" for="inputBasicLastName">Total a
                                                    Pagar:</label>
                                                $ <label id="totalCash"></label>
                                                <br>
                                                <strong>Restan:</strong> <label class="cashRest"></label>
                                            </div>
                                        </div>
                                        <hr class="mb-4">
                                        <button type="button" name="continuar" data-dismiss="modal" class="btn btn-success btn-lg btn-block" aria-label="Close">Continuar</button>
                                        <!-- END PAGO CON TARJETA-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    </div>
                </div>
                <!-- End Example Tab In Modal -->
            </div>
        </div>
        <div>
        </div>
    </div>
    @endsection
    <!-- Función para agregar a la tabla el producto
seleccionado con sus respectivos datos-->
    @section('listado-productos')

    <script>
        var products = {!! $products !!};
        var selectedProducts = [];
        var overDiscount = [];
        var overDiscountAuth = null;
        var total = 0;

        var cashIncome = 0;
        var cardIncome = 0;
        var totalIncome = 0;


        $(function() {

            let SALETYPE = {
                NORMAL: 1,
                WHOLESALERS: 2
            }

            // setInterval(() => {
            //     console.log("------------------>overDiscount", overDiscount.length, overDiscountAuth);
            // }, 4000);

            $('#user-type').change(function() {
                let type = $(this).val();
                if (SALETYPE.NORMAL == type) {
                    $('#wholesalers').addClass('col-md-7');
                    $('#wholesalers').removeClass('d-none');

                    $('#normal-client').removeClass('col-md-7');
                    $('#normal-client').addClass('d-none');
                } else {
                    $('#normal-client').addClass('col-md-7');
                    $('#normal-client').removeClass('d-none');

                    $('#wholesalers').removeClass('col-md-7');
                    $('#wholesalers').addClass('d-none');
                }
            });

            $('#submit').click(function(e) {
                e.preventDefault();
                overDiscount = [];
                console.log("selectedProducts", selectedProducts);

                if (!overDiscountAuth) {
                    selectedProducts.forEach(element => {
                        var product = products.filter(p => p.id == element.id);
                        var selectedPrice = Number($(`#finalPrice${element.id}`).val());
                        if (!product) return;
                        product = product[0]

                        if (selectedPrice < product.discount) {
                            overDiscount.push(product)
                            overDiscountAuth = false;
                        }

                        var priceLinit = Number(products.filter(p => p.id == element.id)[0])
                    });
                }

                if (overDiscount.length > 0 && !overDiscountAuth) {
                    var message = `${overDiscount.length} producto${(overDiscount.length == 1) ? '' : 's'} tiene un descuento superior al permitido.
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
                            overDiscountAuth = true;
                            console.log("overDiscountAuth", overDiscountAuth);
                        }
                    })
                    return;
                }

                if (!Number($('#cashIncome').val()) && !Number($('#cardIncome').val())) {
                    Swal.fire(
                        'No permitido',
                        'Debe agregar un monto de pago',
                        'error'
                    );
                    e.preventDefault();
                    return
                }

                let productIds = selectedProducts.map(p => {
                    console.log({
                        id: p.id,
                        price: $(`#finalPrice${p.id}`).val()
                    });
                    return {
                        id: p.id,
                        price: $(`#finalPrice${p.id}`).val()
                    }
                });

                $('#productsList').val(JSON.stringify(productIds));

                let cashPayment = $('#cashIncome').val();
                let cardPayment = $('#cardIncome').val();

                $('#cashPayment').val(cashPayment);
                $('#cardPayment').val(cardPayment);
                console.log("productsList", $('#productsList').val());

                $('#form').submit();
            });

            $(document).ready(function() {
                $('#ventas').DataTable({
                    retrieve: true,
                    //  responsive: true,
                    //paging: false,
                    //searching: false
                });

                $('.income').on('input', function() {
                    let id = $(this).attr('id');
                    let val = $(this).val();
                    if (!Number(val)) {
                        $(this).val(val.replace(/[^0-9.]/, ''));
                    }

                    if (id == 'cashIncome') {
                        cashIncome = $(`#${id}`).val();
                    } else if (id == 'cardIncome') {
                        cardIncome = $(`#${id}`).val();
                    }

                    totalIncome = Number(cashIncome) + Number(cardIncome);

                    $('#amount').html(`$ ${totalIncome}`)
                    $('#monto').val(totalIncome);

                    rest = total - totalIncome;

                    if (rest < 0) {
                        $('#change').html(`$ ${rest * -1} `)
                        $('#cambio').val(rest * -1);
                        $('.cashRest').html(`$ 0`);
                    } else {
                        $('#change').html(`$ 0 `)
                        $('#cambio').val(0);
                        $('.cashRest').html(`$ ${rest}`);
                    }
                })

            });



            $(document).ready(function() {
                var _tr = $('#ventas').DataTable();

                $('#btn-add').click(function() {
                    var tempPrice = 0;
                    var lastPrice = 0;
                    var currentPrice = 0;

                    var productId = $('#current_product').val();
                    if (!productId) return
                    var product = products.filter(p => p.id == productId)[0];

                    var exist = selectedProducts.filter(p => p.id == product.id);
                    if (exist.length) {
                        Swal.fire(
                            'No permitido',
                            'Este producto ya se ha agregado',
                            'error'
                        );
                        return;
                    }

                    selectedProducts.push(product);
                    _tr.row.add([
                        product.clave,
                        product.description,
                        product.weigth,
                        product.category.name,
                        product.line ? product.line.name : '',
                        product.branch.name,
                        product.price,
                        product.discount,
                        `<input class="finalPrice income" id="finalPrice${product.id}" alt="${product.id}" type="text" value="${product.price}"/>`,
                        `<button type="button" class="btn btn-danger deletr" alt="${product.id}">-</button>`
                    ]).draw(false);

                    // var _tr = `<td><div class="col-md-1 form-group"><button type="button" class="btn btn-danger deletr" alt="${product.id}">-</button></div></td>`;
                    //END Función//

                    //Hacer suma de productos seleccionados en imprimirlos en Total//
                    $('tbody').append(_tr);
                    total += Number(product.price);
                    $("#total").html(`$ ${total}`);
                    //END Función//

                    $('#pagar').val(`${total}`);
                    $('#totalCash').html(total);
                    $('#totalCard').html(total);
                    $('#totalpayment').val(`${total}`);
                    $('#totalPay').val(`${total}`);
                    // $('#vari').val(cambio);
                    $('#tabl').val(_tr);

                    $('#ventas').off('click');
                    $('#ventas').off('input');
                    $('#ventas').off('focusin');
                    // $(".finalPrice").unbind();
                    var product
                    // $('.finalPrice').keydown(function() {
                    //   var productId = $(this).attr('alt');
                    //   product = products.filter(p => p.id == productId)[0];

                    //   tempPrice = Number($(`#finalPrice${product.id}`).val());
                    //   // console.log("valor anterior", tempPrice)
                    // });

                    $('#ventas').on('focusin', '.finalPrice', function() {
                        // $('.finalPrice').on('focusin', function () {
                        var productId = $(this).attr('alt');
                        product = products.filter(p => p.id == productId)[0];

                        lastPrice = Number($(this).val());
                        console.log("entra focusin", lastPrice)
                    });

                    // $('#ventas').on('change', '.finalPrice', function(){
                    // // $('.finalPrice').on('change', function () {
                    //     console.log("cahnge test")
                    //     var productId = $(this).attr('alt');
                    //     product = products.filter(p => p.id == productId)[0];

                    //     tempPrice = Number($(this).val());

                    // });

                    $('#ventas').on('input', '.finalPrice', function() {
                        let val = $(this).val();
                        if (!Number(val)) {
                            $(this).val(val.replace(/[^0-9.]/, ''));
                        }

                        console.log("=================== Enta el evento Input ===================")
                        var productId = $(this).attr('alt');
                        product = products.filter(p => p.id == productId)[0];

                        currentPrice = Number($(this).val());

                        // IMPORTANTE Asignarl el precio actual al input oculto
                        $(`#finalPrice${product.id}`).val(currentPrice);

                        if (lastPrice > currentPrice) {
                            console.log(`Entra uno por que ${lastPrice} > ${currentPrice}`)
                            total = total - lastPrice + currentPrice;
                        } else if (lastPrice < currentPrice) {
                            console.log(`Entra dos por que ${lastPrice} > ${currentPrice}`)
                            total = total - lastPrice + currentPrice;
                        }

                        console.log("Current", currentPrice);
                        console.log("Last", lastPrice);


                        console.log(total);
                        $("#total").html(`$ ${total}`);
                        $("#totalPay").val(total);

                        $('#totalCash').html(total);
                        $('#totalCard').html(total);

                        $("#amount").val(total);
                        $("#change").val(total);


                        lastPrice = Number($(this).val());
                        if (!lastPrice) {
                            lastPrice = 0;
                            $(`#finalPrice${product.id}`).val()
                        }
                    });

                    $('#ventas').on('click', '.deletr', function() {
                        console.log("========> entra función", $(this).attr('alt'))
                        var table = $('#ventas').DataTable();
                        var row = $(this).parents('tr');



                        var productId = $(this).attr('alt');
                        var product = products.filter(p => p.id == productId)[0];

                        var index = selectedProducts.map(p => p.id).indexOf(selectedProducts.filter(p => p.id == productId)[0].id)
                        selectedProducts.splice(index, 1);

                        console.log(JSON.stringify(selectedProducts))
                        console.log("buscar " + productId + " en", selectedProducts.map(p => p.id))
                        console.log("Indice", index);

                        total -= Number($(`#finalPrice${product.id}`).val());
                        $("#totalCash").val(total);

                        $(`#raw-${product.id}`).remove();

                        $("#total").html(`$ ${total}`);
                        if ($(row).hasClass('child')) {
                            table.row($(row).prev('tr')).remove().draw();
                        } else {
                            table
                                .row($(this).parents('tr'))
                                .remove()
                                .draw();
                        }
                    });

                });
            });

            // $('#resta').keyup(function() {
            //   var cambio =  $(this).val() - $('#totalCash').val();
            //   $('#cambio').val(cambio);
            //   console.log(cambio);
            // });

            $('#apartado').keyup(function() {
                var falta = $('#totalpayment').val() - $(this).val();
                $('#falta').val(falta);
                $('#faltan').val(falta);

            });


            // $('#continuar').click(function(e) {
            // e.preventDefault();
            // if('El dinero recibido debe ser mayor al total a pagar'){
            //   $('#form').submit();
            // }

            // });
        });
    </script>
    @endsection
    <!-- END Función-->

    @section('agregar-cliente')

    <style>
        .modal-open .select2-container {
            z-index: 1000 !important;
        }
    </style>

    @endsection
