@extends('layout.layoutdas')
@section('title')
MODIFICACIÓ PRODUCTO
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
      <form id="multiplicar" class="" action="{{route('productos.update',['id' => $product->id])}}" method="post"
        enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class='row'>
          <!-- Input para ingresar clave del producto-->
          <div class="col-md-3  col-md-offset-1 visible-md visible-lg">
            <label>Categoria</label>
            <select id="categorie_id" name="category_id" class="form-control round">
              @foreach($categorys as $category)
              <option value="{{ $category->id }}" required>{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
          <!-- END Input-->
          <div class="form-group form-material col-md-3">
            <label>Clave</label>
            <input type="text" class="form-control" name="clave" value="{{$product->clave}}" required>
          </div>
          <!-- Input para ingresar descripcion-->
          <div class="form-group form-material col-md-3">
            <label>Descripcion</label>
            <input type="text" class="form-control" value="{{$product->description}}" name="description">
          </div>
          <!-- END Input-->
          <!-- Select para Seleccionar linea-->
          <div class="col-md-3 remove">
            <label class="control-label">Seleccione Linea</label>
            <select id="line_id" name="line_id" class="form-control round">
              @foreach($lines as $line)
              <option value="{{ $line->id }}" required>{{ $line->name }}</option>
              @endforeach
            </select>
          </div><!-- END Select-->
          <!-- Input para ingresar precio de la linea para el producto-->
          <div class="col-md-3 form-material">
            <label class="control-label">Precio de la linea</label>
            <input type="text" name="" id="line_price" class="form-control" readonly value="">
          </div>
          <!-- END Input-->
          <!-- Input para ingresar Peso del producto-->
          <div class="form-group form-material col-md-3">
            <label>Gramos</label>
            <input type="text" id="multiplicador" class="form-control" name="weigth" value="{{$product->weigth}}">
          </div><!-- END Input-->
          <!-- Input para ingresar precio del producto-->
          <div class="form-group form-material col-md-3">
            <label>Precio del Producto</label>
            <input type="text" readonly="readonly" class="form-control" id="total" readonly name="price"
              value="{{($product->price) ? $product->price: old('price')}}">
          </div>
          <div class="form-group form-material col-md-3">
            <label>Precio con Descuento</label>
            <input type="text" readonly="readonly" class="form-control" id="discount" readonly name="discountmax"
              value="{{($product->discount) ? $product->discount: old('discountmax')}}">
          </div>
          <!-- END Input-->
          <!-- Select para Seleccionar categoria-->
          <!-- END Select-->
          <div>
            @foreach ($shops as $shop)
            <input type="hidden" name="shop_id" value="{{$shop->id}}">
            @endforeach
          </div>
          <!-- Select para Seleccionar sucursal-->
          <div class="col-md-3  col-md-offset-1 visible-md visible-lg">
            <label>Sucursal</label>
            <select name="branch_id" class="form-control round">
              @foreach($branches as $branch)
              <option value="{{ $branch->id }}" required>{{ $branch->name }}</option>
              @endforeach
            </select>
          </div>
          <!-- END Select-->
          <!-- Select para Seleccionar status-->
          <div class="col-md-3  col-md-offset-1 visible-md visible-lg">
            <label>Status</label>
            <select name="status_id" class="form-control round">
              @foreach($statuses as $status)
              <option value="{{ $status->id }}" required>{{ $status->name }}</option>>
              @endforeach
            </select>
          </div>
          <!-- END Select-->
          <!-- Input para ingresar Observaciones-->
          <div class="form-group form-material col-md-3">
            <label>Observaciones</label>
            <input type="text" class="form-control" value="{{$product->observations}}" name="observations">
          </div><!-- END Input-->
          <!-- Input para Seleccionar Imagen del producto-->
          <div class="form-group form-material col-md-3">
            <label>Selecciona imagen del producto</label>
            <br>
            <label for="image" class="btn btn-primary">Explorar</label>
            <input type="file" name="image" id="image" class="hidden">
          </div>
          <!-- END Input-->
          <br>
          <br>
          <!-- Botón para guardar Producto-->
          <div class="form-group col-md-12">
            <button id="submit" type="submit" name="button" class="btn btn-primary">Guardar</button>
          </div>
          <!-- END Botón-->
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

<!-- Función para obtener el precio de linea-->


@section('precio-linea')
<script type="text/javascript">
  //detecta el tipo de categoria y cambia el formulario
  var categoryTypeproduct = {!! $categorys !!};

  let defaul = categoryTypeproduct[0]
    if(defaul.type_product == 1){
      //alert(JSON.stringify('pz'+defaul.type_product));
    $('.remove').css('display', 'none');
    $('#pricepz').css('display', 'initial'); 
    // $('#pricecp').css('display', 'initial');

    //$('.removeClass').removeClass('invisible');
    //$('#s').toggle();
    }else if(defaul.type_product == 2){
     //alert(JSON.stringify('pz'+defaul.type_product));
     console.log()
    $('.remove').css('display', 'initial');  
    $('#pricepz').css('display', 'none');
    // $('#pricecp').css('display', 'none');
 
  
  }
  setTimeout(() => {
  var categoryTypeproduct = {!! $categorys !!};
  
  categoryTypeproduct = categoryTypeproduct[0];  
  if(categoryTypeproduct.type_product == 1){
      $('.remove').css('display', 'none');
      $('#pricepz').css('display', 'initial'); 
      $('#pricecp').css('display', 'initial'); 
    } else if(categoryTypeproduct.type_product == 2){
      console.log('<p>agregar campos</p>');
      $('.remove').css('display', 'initial');  
      $('#pricepz').css('display', 'none');
      $('#pricecp').css('display', 'none');
    }  
}, 1000);

$('#categorie_id').change(function(){
    $('#pricepz').val(0);
    $('#pricecp').val(0)


    var categoryTypeproduct = {!! $categorys !!};
    var categoryId = $(this).val();
    var categoryTypeproduct = categoryTypeproduct.filter(l => l.id == categoryId)[0];
    if(categoryTypeproduct.type_product == 1){
      // PZA
      $('.remove').css('display', 'none');
      $('#pricepz').css('display', 'initial'); 
      $('#pricecp').css('display', 'initial'); 
      // set purchase price for Pza products
      console.log("pricePurchase", Number($('#line_price').val()) * Number($('#multiplicador').val()))
      console.log( Number($('#line_price').val()), Number($('#multiplicador').val()))
      $('#pricePurchase').val( Number($('#line_price').val()) * Number($('#multiplicador').val()) );
    } else if(categoryTypeproduct.type_product == 2){
      // Gramos
      $('.remove').css('display', 'initial');  
      $('#pricepz').css('display', 'none');
      $('#pricecp').css('display', 'none');
    }
});


var lines = {!! $lines !!};
var line = lines[0];
//console.log("lines", lines);

$('#line_price').val(lines[0].sale_price);

$('#line_id').change(function() {
  var id = $(this).val();
  line = lines.filter(l => l.id == id)[0];
  $('#line_price').val(line.sale_price);
}); 

$(document).ready(function(){
$('#multiplicador').keyup(function(){
  // alert('multi');
  var total = $('#line_price').val() * $(this).val();
  // var discount = total - (total * (Number(line.discount_percentage) / 100))
  var discount = total - Number(line.discount_percentage)
  $('#discount').val(discount);
  $('#total').val(total);

  // set purchase price for Pza products
  console.log("pricePurchase", Number($('#line_price').val()) * Number($('#multiplicador').val()))
  console.log( Number($('#line_price').val()), Number($('#multiplicador').val()))
  $('#pricePurchase').val( Number($('#line_price').val()) * Number($('#multiplicador').val()) );
  });
});
setTimeout(() => {
  multiplicar();
},2000);
</script>
@endsection
<!-- END Función-->
<!-- Función para calcular el  
(peso del producto por el precio de la linea)-->
@section('calcular-precio')
<script type="text/javascript">
  multiplicar(){
  m1 = document.getElementById("secondary").value;
  m2 = document.getElementById("multiplicador").value;
  r = m1*m2;
  document.getElementById("resultado").value = r;
  });
setTimeout(() => {
 // alert('entra a set');
  multiplicar();
},2000);
</script>
@endsection
<!-- END Función-->