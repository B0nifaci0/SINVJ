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
          <form id="form" method="POST" action="/ventas">
            <center><h3>Registrate Venta</h3></center>
            {{ csrf_field() }}
            <div class="row mb-10">
                <div class="col-md-3">
                    <label for="user-type">Tipo de venta</label>
                    <select name="user_type" id="user-type" class="form-control">
                        <option value="1">Venta normal</option>
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
                                <label class="form-control-label" for="inputBasicFirstName">Nombre del Cliente: </label>
                                <input type="text" class="form-control" name="customer_name" placeholder="Fernando Bonifacio" />
                            </div>
                            <!-- END Input-->
                        </div>
                        <div class="col-md-6">
                            <!-- Input para Ingresar telefono del cliente-->
                            <div class="form-group form-material">
                                <label class="form-control-label" for="inputBasicLastName">Teléfono:</label>
                                <input type="text" class="form-control" name="telephone" value="{{old('telephone')}}" placeholder="7225674569" />
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
                                    <option value="{{ $client->id }}">{{ $client->name }} {{ $client->first_lastname }} {{ $client->second_lastname }}</option>
                                @endforeach
                            </select> 
                        </div>
                    </div>
                </div>

                  <!-- Select para Seleccionar  producto-->
                  <div class="form-group form-material col-md-4">
                      <label>Producto</label>
                    <select id="current_product" name="product_id" class="form-control" data-plugin="select2"
                        data-placeholder="Seleccione Producto" data-allow-clear="true">
                        <option></option>
                      <optgroup label="Productos">
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" required>{{$product->clave}}-{{$product->description}}</option>
                        @endforeach
                      </optgroup>
                    </select>
                  </div>
                  <!-- END Select-->
                  <!-- Botón para agregar producto-->
                  <div class="col-md-1 form-group">
                    <br>
                    <button type="button" class="btn btn-primary" id="btn-add">+</button>
                  </div>
                </div>

              <!-- END Botón-->
              <div class="panel-body">
              <!-- Tabla para listar productos agregados-->
                <table class="table table-hover dataTable table-striped w-full" id="tabla">
                  <thead>
                    <tr>
                      <th>Clave</th>
                      <th>Nombre</th>
                      <th>Peso</th>
                      <th>Categoría</th>
                      <th>Linea</th>
                      <th>Sucursal</th>
                      <th>Status</th>
                      <th>Precio de linea</th>
                      <th>Precio final</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="6"></td>
                        <th>
                          <strong>Total</strong>
                        </th>
                      <td><strong id="total"></strong><input type="hidden" class="form-control" name="price" id="pagar"/> </td>
                    </tr>
                  </tfoot>
                </table>
                <!-- END Tabla-->
              </div>
              <br>
              <div class="row">
                <!-- Botón para mostar el Modal de Tipos de pago-->
                <div class="col-md-2 form-group">
                  <button class="btn btn-success"  data-target="#exampleTabs" data-toggle="modal"type="button">$ Registro de pago</button>
                </div>
                <!-- END Botón-->
                  <input type="hidden" class="form-control" name="parcial_pay" id="faltan"/>
                  <input type="hidden" class="form-control" name="total_pay" id="totalPay"/>
                <!-- Botón para guardar venta-->

                <input type="hidden" class="form-control" name="products_list" id="productsList"/>
                <input type="hidden" class="form-control" name="cash_income" id="cashPayment"/>
                <input type="hidden" class="form-control" name="card_income" id="cardPayment"/>

                <div class="form-group col-md-1">
                  <button  id="submit" type="submit" class="btn btn-primary">Terminar compra</button>
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
                <div class="modal fade modal-success" id="exampleTabs" aria-hidden="true" aria-labelledby="exampleModalTabs"
                  role="dialog" tabindex="-1">
                  <div class="modal-dialog modal-simple">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalTabs">Tipo de Pago</h4>
                      </div>
                        <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                          <li class="nav-item " role="presentation"><a class="nav-link active" data-toggle="tab" href="#exampleLine1"
                            aria-controls="exampleLine1" role="tab">Contado</a>
                          </li>
                          <!-- <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleLine2"
                            aria-controls="exampleLine2 " role="tab">Apartado</a>
                          </li> -->
                          <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleLine3"
                            aria-controls="exampleLine3" role="tab">Pago con Tarjeta</a>
                          </li>
                        </ul>
                      <div class="modal-body">
                        <div class="tab-content">
                          <!-- CONTADO-->
                          <div class="tab-pane active" id="exampleLine1" role="tabpanel">
                            <div class="row">
                              <!-- Input para Ingresar cantidad a pagar-->
                              <div class="form-group form-material col-md-3">
                                <label class="form-control-label" for="inputBasicFirstName">Recibo:</label>
                                  <input type="text" class="form-control" name="" id="cashIncome" required="required" placeholder="$"required />
                              </div>
                              <!-- END Input-->
                              <!-- Input para mostar el total a pagar-->
                              <div class="form-group form-material col-md-3">
                                <label class="form-control-label" for="inputBasicLastName">Total a Pagar:</label>
                                <input type="text" class="form-control" name="price" id="totalCash" required="required" readonly="readonly"/>
                              </div>
                              <!-- END Input-->
                              <!-- Input para mostar cambio-->
                              <!-- <div class="form-group form-material col-md-3">
                                <label class="form-control-label" for="inputBasicLastName">Tu Cambio es:</label>
                                <input type="text" class="form-control" name="" id="cambio" required="required" />
                              </div> -->
                              <!-- END Input-->
                            </div>
                            <button type="button" name="continuar" data-dismiss="modal" class="btn btn-success btn-lg btn-block" aria-label="Close" >Continuar</button>
                          </div>
                          <!-- END CONTADO-->

                          <!-- APARTADO-->
                          <!-- <div class="tab-pane" id="exampleLine2" role="tabpanel">
                            <div class="row">
                              <div class="form-group form-material col-md-3">
                                <label class="form-control-label" for="inputBasicFirstName">Recibo:</label>
                                <input type="text" class="form-control" name="" id="apartado" required="required" placeholder="$"required />
                              </div>
                              <div class="form-group form-material col-md-3">
                                <label class="form-control-label" for="inputBasicFirstName">Restan</label>
                                <input type="text" class="form-control" name="parcial" id="falta" required="required" placeholder="$"required />
                              </div>
                              <div class="form-group form-material col-md-3">
                                <label class="form-control-label">Total a Pagar:</label>
                                <input type="text" class="form-control" id="totalpayment"  required="required" readonly="readonly" />
                              </div>
                            </div>
                            <button class="btn btn-success btn-lg btn-block" type="button">Continuar</button>
                          </div> -->
                          <!-- END APARTADO-->

                          <!-- PAGO CON TARJETA-->
                          <div class="tab-pane" id="exampleLine3" role="tabpanel">
                            <div class="row">
                              <!-- Input para ingresar cantidad a pagar-->
                              <div class="form-group form-material col-md-3">
                                <label class="form-control-label">Recibo:</label>
                                <input type="text" class="form-control" id="cardIncome" placeholder="$"  required="required"/>
                              </div>
                              <!-- END Input-->
                              <!-- Input para mostar total a pagar-->
                              <div class="form-group form-material col-md-3">
                                <label class="form-control-label">Total a Pagar:</label>
                                <input type="text" class="form-control" id="totalCard"  required="required" readonly="readonly" />
                              </div>
                              <!-- END Input-->
                              <!-- Input para seleccionar Imagen del ticket-->
                              <div class="form-group form-material col-md-6">
                                <label>Selecciona Ticket de la venta</label>
                                <br>
                                <label for="image" class="btn btn-success">Explorar</label>
                                <input type="file" name="image" id="image" class="hidden">
                              </div>
                              <!-- END Input-->
                            </div>
                            <hr class="mb-4">
                            <button class="btn btn-success btn-lg btn-block" type="button">Continuar</button>
                          </div>
                          <!-- END PAGO CON TARJETA-->
                        </div>
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
var total = 0;


$(function(){

    let SALETYPE = {
        NORMAL: 1,
        WHOLESALERS: 2
    }

    $('#user-type').change(function() {
        let type = $(this).val();
        if(SALETYPE.NORMAL == type) {
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

  $('#form').submit(function(e) {

    if(!Number($('#cashIncome').val()) && !Number($('#cardIncome').val())) {
      Swal.fire(
        'No permitido',
        'Debe agregar un monto de pago',
        'error'
      );
      e.preventDefault();
      return
    }

    let productIds = selectedProducts.map(p => {
      console.log({ id: p.id, price: $(`#finalPrice${p.id}`).val() });
      return { id: p.id, price: $(`#finalPrice${p.id}`).val() }
    });

    $('#productsList').val(JSON.stringify(productIds));

    let cashPayment = $('#cashIncome').val();
    let cardPayment = $('#cardIncome').val();
    $('#cashPayment').val(cashPayment);
    $('#cardPayment').val(cardPayment);
    console.log($('#productsList').val());

    return true;
  });


 $('#btn-add').click(function(){
   var tempPrice = 0;
   var currentPrice = 0;

  var productId = $('#current_product').val();
  if(!productId) return
  var product = products.filter(p => p.id == productId)[0];

  var exist = selectedProducts.filter(p => p.id == product.id);
  if(exist.length) {
    Swal.fire(
      'No permitido',
      'Este producto ya se ha agregado',
      'error'
    );
    return;
  }

  selectedProducts.push(product);
  var _tr = `<tr id="raw-${product.id}">
    <td>${product.id}</td>
    <td>${product.description}</td>
    <td>${product.weigth}</td>
    <td>${product.category.name}</td>
    <td>${product.line.name}</td>
    <td>${product.branch.name}</td>
    <td>${product.status.name}</td>
    <td>$ ${product.price}</td>
    <td><input class="finalPrice" id="finalPrice${product.id}" alt="${product.id}" type="text" value="${product.price}"/></td>
    <td><div class="col-md-1 form-group"><button type="button" class="btn btn-danger deletr" alt="${product.id}">-</button></div></td>
  </tr>`;

//END Función//

//Hacer suma de productos seleccionados en imprimirlos en Total//
  $('tbody').append(_tr);
  total += Number(product.price);
  $("#total").html("$" + total);
//END Función//

  $('#totalCash').val(total);
  $('#pagar').val(total);
  $('#totalCard').val(total);
  $('#totalpayment').val(total);
  $('#totalPay').val(total);
  // $('#vari').val(cambio);
  $('#tabl').val(_tr);

  $(".deletr").unbind();
  $(".finalPrice").unbind();

  $('.finalPrice').keydown(function() {
    var productId = $(this).attr('alt');
    var product = products.filter(p => p.id == productId)[0];

    tempPrice = Number($(`#finalPrice${product.id}`).val());
    // console.log("valor anterior", tempPrice)
  });

  $('.finalPrice').keyup(function() {
    var productId = $(this).attr('alt');
    var product = products.filter(p => p.id == productId)[0];

    currentPrice = Number($(`#finalPrice${product.id}`).val());
    // console.log("valor nuevo ", currentPrice)
    if(tempPrice == currentPrice) {
      console.log("entra return", tempPrice, currentPrice)
      return
    }


    if(tempPrice > currentPrice) {
      console.log(`${total} = ${total} - ${currentPrice}`)
      total = total - tempPrice + currentPrice;
    } else if(tempPrice < currentPrice) {
      console.log(`${total} = ${total} + ${currentPrice}`)
      total = total - tempPrice + currentPrice;
    }

    console.log(total);
    $("#total").html("$" + total);
    $("#totalPay").val(total);
    $("#totalCash").val(total);
    $("#totalCard").val(total);
  });


  $('.deletr').click(function() {

    var productId = $(this).attr('alt');
    var product = products.filter(p => p.id == productId)[0];

    var index = selectedProducts.map(p => p.id).indexOf(selectedProducts.filter(p => p.id == productId)[0].id)
    selectedProducts.splice(index, 1);

    console.log(JSON.stringify(selectedProducts))
    console.log("buscar " + productId + " en", selectedProducts.map(p => p.id))
    console.log("Indice", index);

    total -= Number($(`#finalPrice${product.id}`).val());
    $(`#raw-${product.id}`).remove();
    $("#total").html("$" + total);
  });

});

  // $('#resta').keyup(function() {
  //   var cambio =  $(this).val() - $('#totalCash').val();
  //   $('#cambio').val(cambio);
  //   console.log(cambio);
  // });

$('#apartado').keyup(function() {
  var falta = $('#totalpayment').val() -$(this).val();
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