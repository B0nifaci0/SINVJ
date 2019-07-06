
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
        <div class="form-group form-material col-md-6">
            <label class="form-control-label" for="inputBasicFirstName">Nombre: </label>
            <div class="input-group">
              <input type="text" class="form-control" name="name" required="required" placeholder="Fernando Bonifacio" />
              <span class="input-group-btn">
               <button type="button" class="btn btn-primary" id="edit-item" data-item-id="1"><span class="icon fa-user"></span></button>
              </span> 
            </div> 
        </div>
         <div class="form-group form-material col-md-5">
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
            <button type="button" class="btn btn-primary" id="btn-add">Agregar</button>
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
                 <th>Total</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <br>
          <div class="col-md-12 form-group">
<button type="button" class="btn btn-success" data-toggle="modal" data-target=".docs-example-modal-lg">$ Forma de Pago</button><br/><br/>
</div>
</div>
<div class="modal fade docs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="attachment-body-content">
        <form id="edit-form" class="form-horizontal" method="POST" action="">
          <div class="card text-dark bg-light mb-0">
            <div class="card-header">
              <h4 class="m-0">Tipo de Pago</h4>
            </div>
            <div class="card-body">
              <!-- name -->
              <div class="form-group">
                <label class="col-form-label" for="modal-input-name">Credito</label>
                <input type="radio" name="modal-input-name" class="form-control" id="modal-input-name" required autofocus>
              </div>
    </div>
  </div>
</div>
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="attachment-body-content">
        <form id="edit-form" class="form-horizontal" method="POST" action="">
          <div class="card text-dark bg-light mb-0">
            <div class="card-header">
              <h4 class="m-0">Crear Cliente</h4>
            </div>
            <div class="card-body">
              <!-- name -->
              <div class="form-group">
                <label class="col-form-label" for="modal-input-name">Nombre del Cliente</label>
                <input type="text" name="modal-input-name" class="form-control" id="modal-input-name" required autofocus>
              </div>
              <!-- /name -->
              <!-- CellPhone -->
              <div class="form-group">
                <label class="col-form-label" for="modal-input-cellphone">Telefono</label>
                <input type="text" name="modal-input-cellphone" class="form-control" id="modal-input-cellphone" required autofocus>
              </div>
              <!-- /CellPhone -->
              <!-- description -->
              <div class="form-group">
                <label class="col-form-label" for="modal-input-description">Email</label>
                <input type="text" name="modal-input-description" class="form-control" id="modal-input-description" required>
              </div>
              <!-- /description -->
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('listado-productos')

<script>

var products = {!! $products !!};



$(function(){
 $('#btn-add').click(function(){

  var productId = $('#current_product').val();
  console.log(productId);
  var product = products.filter(p => p.id == productId)[0];
  console.log(product);
  /*
   var _id = $('select[name="id"]').val();
   var _name = $('input[name="name"]').val();
   var _weigth = $('input[name="weigth"]').val();
   var _category = $('input[name="category"]').val();
   var _line = $('input[name="line"]').val();
   var _branch = $('input[name="branch"]').val();
   var _status = $('input[name="status"]').val();
   */



  var _tr = '<tr><td>'+ product.id +'</td> <td>'+ product.name +'</td><td>'+ product.weigth +'</td> <td>'+ product.category_id +'</td> <td>'+ product.line_id +'</td> <td>'+ product.branch_id +'</td> <td>'+ product.status_id +'</td> <td>$'+ product.price +'</td><td></td></tr>';

  $('tbody').append(_tr);
});  
});


</script>
@endsection


@section('agregar-cliente')
<script>
$(document).ready(function() {
  /**
   * for showing edit item popup
   */

  $(document).on('click', "#edit-item", function() {
    $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

    var options = {
      'backdrop': 'static'
    };
    $('#edit-modal').modal(options)
  })

  // on modal show
  $('#edit-modal').on('show.bs.modal', function() {
    var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
    var row = el.closest(".data-row");

    // get the data
    var name = row.children(".name").text();
    var cellphone = row.children(".cellphone").text();
    var description = row.children(".description").text();

    // fill the data in the input fields
    $("#modal-input-name").val(name);
    $("#modal-input-cellphone").val(cellphone);
    $("#modal-input-description").val(description);

  })

  // on modal hide
  $('#edit-modal').on('hide.bs.modal', function() {
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#edit-form").trigger("reset");
  })
})
</script>
@endsection