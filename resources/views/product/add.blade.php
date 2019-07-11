@extends('layout.layoutdas')
@section('title')
ALTA PRODUCTO
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
      <h2 align="center">Nuevo Producto</h2>
      <br>  
      <form id="multiplicar" class="" action="/productos" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }} 
      <div class='row'>
            <div class="form-group form-material col-md-4">
              <label>Clave</label>
              <input type="text" class="form-control" name="clave"  value="{{old('clave')}}" required>
            </div>
          <div class="form-group form-material col-md-4">
              <label>Nombre</label>
              <input type="text" class="form-control" name="name"  value="{{old('name')}}" required>
            </div>
            <div class="form-group form-material col-md-4">
              <label>Descripcion</label>
              <input type="text" class="form-control" name="description"  value="{{old('description')}}" required>
            </div>
            <div class="col-md-3">
        <label  class="control-label">Seleccione Linea</label>
          <select id="line_id"   name="line_id"  class="form-control round">
            @foreach($lines as $line)            
              <option value="{{ $line->id }}" required>{{ $line->name }}</option>
            @endforeach
          </select> 
          </div>      
          <div class="col-md-3 form-material">
          <label  class="control-label">Precio de la linea</label>
          <input type="text" name="" id="line_price" class="form-control" readonly>
        </div>
    
        <div class="form-group form-material col-md-3">
           <label>Peso</label>
           <input type="text" id="multiplicador"  class="form-control" name="weigth" > 
           </div>
		   

        <div class="form-group form-material col-md-3">
              <label>Precio del Producto</label>
          <input type="text"readonly="readonly" class="form-control" id="total" readonly name="price">
        </div> 

        <div class="col-md-4  col-md-offset-1 visible-md visible-lg">
            <label>Seleccione Categoria </label>
            <select  name="category_id" class="form-control round">
              @foreach($categories as $category)            
                <option value="{{ $category->id }}" required>{{ $category->name }}</option>
              @endforeach
            </select>
          </div>

          <div>
              @foreach ($shops as $shop)
              <input type="hidden" name="shop_id" value="{{$shop->id}}">
              @endforeach 
          </div>   
  
          <div class="col-md-4  col-md-offset-1 visible-md visible-lg">
             <label>Seleccione Sucursal</label>
             <select name="branch_id" class="form-control round">
             @php  
                $branches = $user->shop->branches;
             @endphp
               @foreach($branches as $branch)
                <option value="{{ $branch->id }}" required>{{ $branch->name }}</option>
               @endforeach
             </select>
          </div>
  
         <div class="col-md-4  col-md-offset-1 visible-md visible-lg">
            <label>Seleccione Status</label>
            <select  name="status_id" class="form-control round">
              @foreach($statuses as $status)             
                <option value="{{ $status->id }}" required>{{ $status->name }}</option>
              @endforeach
            </select>
          </div>
            
            <div class="form-group form-material col-md-6">
              <label>Observaciones</label>
              <input type="text" class="form-control" name="observations"  value="{{old('observations')}}" required>
            </div>
            
    
             <div class="form-group form-material col-md-6">
                <label>Selecciona imagen del producto</label>
                <br>
                <label for="image" class="btn btn-primary">Explorar</label>
                <input type="file" name="image" id="image" class="hidden" data-default-file="../../../global/photos/placeholder.png">
              </div> 
              <!--
              <div class="col-xl-6 col-md-6"> -->
                  <!-- Example Default Value -->
                  <!--
                  <label  class="control-label">Seleccione Imagen</label>
                  <div class="example-wrap">
                    <div class="example">
                      <input type="file" id="image" data-plugin="dropify" name="image" data-default-file="../../../global/photos/placeholder.png"
                      />
                    </div>
                  </div> -->
                  <!-- End Example Default Value -->
                <!-- </div> --> 
        <div class="form-group col-md-4">
          <button id="submit" type="submit" name="button" class="btn btn-primary">Guardar</button>
        </div>
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


@section('precio-linea')
<script type="text/javascript">

var lines = {!! $lines !!};

$('#line_price').val(lines[0].price);

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