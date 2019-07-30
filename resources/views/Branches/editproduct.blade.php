
@extends('layout.layoutdas')
@section('title')
MODIFICACIÓN DE PRODUCTO
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')

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
      <h2 align="center">Editar producto</h2>
      <form id="multiplicar" class="" action="{{route('sucursal.update',['id' => $product->id])}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class='row'>
          <!-- Input Para editar clave-->
          <div class="form-group form-material col-md-4">
              <label>Clave</label>
              <input type="text" class="form-control" name="clave"  value="{{$product->clave}}" required>
          </div>
          <!-- END Input-->
          <!-- Input Para editar Nombre-->
          <div class="form-group form-material col-md-4">
            <label>Nombre</label>
            <input type="text" class="form-control"value="{{$product->name}}" name="name">
          </div>
          <!-- END Input-->
          <!-- Input Para editar Descripcion-->
          <div class="form-group form-material col-md-4 ">
            <label>Descripcion</label>
            <input type="text" class="form-control"value="{{$product->description}}" name="description">
          </div>
          <!-- END Input-->
          <!-- Select Para editar linea-->
          <div class="col-md-3">
            <label  class="control-label">Seleccione Linea</label>                
            <select id="line_id"   name="line_id"  class="form-control round">
              @foreach($lines as $line)            
                <option value="{{ $line->id }}" required>{{ $line->name }}</option>
              @endforeach
            </select> 
          </div>
          <!-- END Select-->
          <!-- Input Para editar linea-->      
          <div class="col-md-3 form-material">
            <label  class="control-label">Precio de la linea</label>
              <input type="text" name="" id="line_price" class="form-control" readonly>
          </div>
          <!-- END Input-->
          <!-- Input Para editar peso-->
          <div class="form-group form-material col-md-3">
            <label>Peso</label>
            <input type="text" id="multiplicador"  class="form-control" name="weigth" value="{{$product->weigth}}" > 
          </div>
          <!-- END Input-->
          <!-- Input Para editar precio del producto-->
          <div class="form-group form-material col-md-3">
            <label>Precio del Producto</label>
              <input type="text"readonly="readonly" class="form-control" id="total" readonly name="price">
          </div>
          <!-- END Input-->
          <!-- Select Para editar categoria-->   
          <div class="col-md-4  col-md-offset-1 visible-md visible-lg">
            <label>Categoria</label>
              <select  name="category_id" class="form-control round">
                @foreach($categorys as $category)            
                  <option value="{{ $category->id }}" required>{{ $category->name }}</option>
                @endforeach
              </select>
          </div>
          <!-- END Select-->
          <div>
              @foreach ($shops as $shop)
                <input type="hidden" name="shop_id" value="{{$shop->id}}">
              @endforeach 
          </div>
          <!-- Select Para editar sucursal-->    
          <div class="col-md-4  col-md-offset-1 visible-md visible-lg">
              <label >Sucursal</label>
              <select name="branch_id" class="form-control round">
                @foreach($branches as $branch)
                  <option value="{{ $branch->id }}" required>{{ $branch->name }}</option>
                @endforeach
              </select>
          </div>
          <!-- END Select-->
          <!-- Select Para editar status-->   
          <div class="col-md-4  col-md-offset-1 visible-md visible-lg">
            <label >Status</label>
            <select  name="status_id" class="form-control round">
              @foreach($statuses as $status)            
                <option value="{{ $status->id }}" required>{{ $status->name }}</option>>
              @endforeach
            </select> 
          </div>
          <!-- END Select-->
          <!-- Input Para editar observaciones-->   
          <div class="form-group form-material col-md-6">
            <label>Observaciones</label>
            <input type="text" class="form-control"value="{{$product->observations}}" name="observations">
          </div>
          <!-- END Input-->
          <!-- Input Para editar Imagen-->     
          <div class="form-group form-material col-md-6">
            <label>Selecciona imagen del producto</label>
            <br>
            <label for="image" class="btn btn-primary">Explorar</label>
            <input type="file" name="image" id="image" class="hidden" required>
          </div>
          <!-- END Input--> 
          <br>
        <div>
        <br>
        <!-- Botón Para guardar cambios-->   
        <div class="form-group col-md-12">
          <button id="submit" type="submit" name="button" class="btn btn-primary">Guardar</button> 
        </div>
        <!-- END Botón-->
      </form>
    </div>
  </div>
</div>
@endsection

@section('disabled-submit')
<script type="text/javascript">
$(document).ready(function(){
  $("#categories").change(function(){
    if ($(this).val() == "" || $("#file").val() == "") {
      $("#submit").prop("disabled", true);
    }else{
      $("#submit").prop("disabled", false);
    }
  });

  $("#file").change(function(){
    if ($("#categories").val() == "" || $(this).val() == "") {
      $("#submit").prop("disabled", true);
    }else{
      $("#submit").prop("disabled", false);
    }
  });

  $("#file").change(function(){
    $("#preview-box").attr("class", "");
    render(this);
    $("#image_name").html($(this).val().split("\\").pop());
  });

  function render(image) {
    if (image.files && image.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#preview").attr("src", e.target.result);
      }
    reader.readAsDataURL(image.files[0]);
    }
  }

});
</script>

@endsection

<!-- Función para obtener el precio de linea-->   
@section('precio-linea')
<script type="text/javascript">

var lines = {!! $lines !!};

$('#line_id').change(function() {
  var id = $(this).val();
  var line = lines.filter(l => l.id == id)[0];
  $('#line_price').val(line.price);
});

$('#multiplicador').keyup(function() {
  var total = $('#line_price').val() * $(this).val();
  $('#total').val(total);
});
</script>
@endsection
<!-- END Función-->
<!-- Función para calcular el  
(peso del producto por el precio de la linea)-->   
@section('calcular-precio')
<script type="text/javascript">
function multiplicar(){
  m1 = document.getElementById("secondary").value;
  m2 = document.getElementById("multiplicador").value;
  r = m1*m2;
  document.getElementById("resultado").value = r;
}
</script>
@endsection
<!-- END Función-->