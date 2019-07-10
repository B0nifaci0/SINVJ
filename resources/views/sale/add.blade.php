
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
  <center><h3>Registrate Venta</h3></center>
  {{ csrf_field() }}    
  <div class="row">
        <div class="form-group form-material col-md-3">
            <label class="form-control-label" for="inputBasicFirstName">Nombre del Cliente: </label>
              <input type="text" class="form-control" name="name" required="required" placeholder="Fernando Bonifacio"required /> 
            </div> 
            <div class="form-group form-material col-md-3">
               <label class="form-control-label" for="inputBasicLastName">Teléfono:</label>
               <input type="text" class="form-control" name="telephone" value="{{old('telephone')}}" required="required" placeholder="7225674569" />
      </div> 
         <div class="form-group form-material col-md-3">
             <label>Producto</label>
           <select id="current_product" name="id" class="form-control" data-plugin="select2" 
                 data-placeholder="Seleccione Producto" data-allow-clear="true">
                 <option></option>
               <optgroup label="Productos">
                 @foreach($products as $product)
                 <option value="{{ $product->id }}" required>{{$product->id}}-{{$product->name}}</option>
                  @endforeach
               </optgroup>
           </select>
         </div>
          <div class="col-md-1 form-group">
          <br>
            <button type="button" class="btn btn-primary" id="btn-add">+</button>
          </div> 
    </div>  
      <div class="panel-body">
           <table class="table table-hover dataTable table-striped w-full">
             <thead>
               <tr>
                 <th>Clave</th>
                 <th>Nombre</th>
                 <th>Peso</th>
                 <th>Categoría</th>
                 <th>Linea</th>
                 <th>Sucursal</th>
                 <th>Status</th>
                 <th>Precio</th>
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
                <td><strong id="total"></strong></td>
              </tr>
            </tfoot>
          </table>
          <br>
<div class="col-md-12 form-group">

<button class="btn btn-success"  data-target="#exampleTabs" data-toggle="modal"
                      type="button">$ Tipo de Pago</button>
</div>
</div>


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
                                aria-controls="exampleLine1" role="tab">Contado</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleLine2"
                                aria-controls="exampleLine2 " role="tab">Apartado</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleLine3"
                                aria-controls="exampleLine3" role="tab">Pago con Tarjeta</a></li>
                            
                          </ul>

                          <div class="modal-body">
                            <div class="tab-content">
                              <div class="tab-pane active" id="exampleLine1" role="tabpanel">
                              <div class="row">
                               <div class="form-group form-material col-md-3">
                                        <label class="form-control-label" for="inputBasicFirstName">Recibo:</label>
                                          <input type="text" class="form-control" name="name" id="resta" required="required" placeholder="$"required /> 
                                        </div> 
                                        <div class="form-group form-material col-md-3">
                                          <label class="form-control-label" for="inputBasicLastName">Total a Pagar:</label>
                                          <input type="text" class="form-control" name="" id="totalpay" required="required" readonly="readonly"/>
                                  </div> 
                                  <div class="form-group form-material col-md-3">
                                          <label class="form-control-label" for="inputBasicLastName">Tu Cambio es:</label>
                                          <input type="text" class="form-control" name="" id="cambio" required="required" />
                                  </div>
                                  </div>
                                <button class="btn btn-success btn-lg btn-block" type="submit">Continuar</button>
                              </div>
                              <div class="tab-pane" id="exampleLine2" role="tabpanel"> 
                              <div class="row">
                               <div class="form-group form-material col-md-3">
                                        <label class="form-control-label" for="inputBasicFirstName">Recibo:</label>
                                          <input type="text" class="form-control" name="name" id="apartado" required="required" placeholder="$"required /> 
                                        </div> 
                                        <div class="form-group form-material col-md-3">
                                        <label class="form-control-label" for="inputBasicFirstName">Restan</label>
                                          <input type="text" class="form-control" name="name" id="falta" required="required" placeholder="$"required /> 
                                        </div> 
                                        <div class="form-group form-material col-md-3">
                                          <label class="form-control-label" for="inputBasicLastName">Total a Pagar:</label>
                                          <input type="text" class="form-control" id="totalpayment"  required="required" readonly="readonly" />
                                  </div> 
                                  </div>
                                <button class="btn btn-success btn-lg btn-block" type="submit">Continuar</button>
                              </div>
                              <div class="tab-pane" id="exampleLine3" role="tabpanel">
                              <div class="radio-custom radio-success">
                              <h2>Pago</h2>
                                        <input type="radio" id="inputRadiosChecked" name="inputRadios" checked="">
                                        <label for="inputRadiosChecked">Tarjeta de Credito  <span class="icon fa-cc-mastercard"></span></label>
                                      </div>
                                      <div class="radio-custom radio-success">
                                        <input type="radio" id="inputRadiosChecked" name="inputRadios" checked="">
                                        <label for="inputRadiosChecked">Tarjeta de Debito  <span class="icon fa-cc-visa"></span></label>
                                      </div>
                                      <div class="radio-custom radio-success">
                                        <input type="radio" id="inputRadiosChecked" name="inputRadios" checked="">
                                        <label for="inputRadiosChecked">PayPal   <span class="icon fa-paypal"></span></label>
                                      </div>
                                  <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <label for="cc-name">Nombre de la Tarjeta</label>
                                      <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                                      <small class="text-muted">Nombre completo como se muestra en la tarjeta de vencimiento</small>
                                      <div class="invalid-feedback">
                                        Name on card is required
                                      </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                      <label for="cc-number">Numero de la Tarjeta</label>
                                      <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                                      <div class="invalid-feedback">
                                        El numero de la tarjeta es requerido
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-3 mb-3">
                                      <label for="cc-expiration">Expiracion</label>
                                      <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                                      <div class="invalid-feedback">
                                        Expiration date required
                                      </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                      <label for="cc-expiration">CVV</label>
                                      <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                                      <div class="invalid-feedback">
                                        Security code required
                                      </div>
                                    </div>
                                  </div>
                                <hr class="mb-4">
                                <button class="btn btn-success btn-lg btn-block" type="submit">Continuar</button>
                              </div>
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
@endsection

@section('listado-productos')

<script>

var products = {!! $products !!};
var total = 0;



$(function(){
 $('#btn-add').click(function(){

  var productId = $('#current_product').val();
  console.log(productId);
  var product = products.filter(p => p.id == productId)[0];
  console.log(product);
  var _tr = '<tr><td>'+ product.id +'</td> <td>'+ product.name +'</td><td>'+ product.weigth +'</td> <td>'+ product.category.name +'</td> <td>'+ product.line.name +'</td> <td>'+ product.branch.name +'</td> <td>'+ product.status.name +'</td> <td>$'+ product.price +'</td><td></td></tr>';


  $('tbody').append(_tr);
  total += Number(product.price);
  $("#total").html("$" + total);

  $('#totalpay').val(total);
  $('#totalpayment').val(total);

});
  $('#resta').keyup(function() {
  var cambio = $('#totalpay').val() - $(this).val();
  $('#cambio').val(cambio);
  console.log(cambio);
  
  
});  
$('#apartado').keyup(function() {
  var falta = $('#totalpayment').val() -$(this).val();
  $('#falta').val(falta);
  
  
}); 
});


</script>
@endsection


@section('agregar-cliente')

<style>
.modal-open .select2-container {
    z-index: 1000 !important;
}
</style>

@endsection