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
      @if (session('mesage'))
        <div class="alert alert-success">
          <strong>{{ session('mesage') }}</strong>
        </div>
      @endif
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
        <input type="text" value="2" class="form-control d-none"  name="status_id">
        <div class='row'>
        <!-- Select para Seleccionar categoria-->
          <div class="col-md-3">
            <label>Seleccione Categoria </label>
            @if(null !== session('categories'))
            <select id="categorie_id" name="category_id" class="form-control round">
            @foreach( $categories as $category)
            <option value="{{ $category->id}}" required>{{ $category->name }} - @if($category->type_product == 1) pza @else gr @endif</option>
            <!--<option class="invisible" id="categorie_type_product" value="{{ $category->type_product }}" required>{{ $category->type_product }}</option>-->
            @endforeach
            </select>
            @else
            <select  id="categorie_id" name="category_id" class="form-control round">
            @foreach($categories as $category)
            <option value="{{ $category->id }}" required>{{ $category->name }} - @if($category->type_product == 1) pza @else gr @endif</option>
            <!--<option class="invisible" id="categorie_type_product" value="{{ $category->type_product }}" required>{{ $category->type_product }}</option>-->
            @endforeach
            </select>
            @endif
            </div>
            <!-- END Select-->
          <!-- Input para ingresar clave del producto-->
          <div class="form-group form-material col-md-3">
            <label>Clave</label>
            <input type="text" class="form-control" name="clave"  value="{{old('clave')}}" required>
          </div>
            <!-- Input para ingresar descripcion-->
            <div class="form-group form-material col-md-3">
              <label>Descripcion</label>
              <input type="text" class="form-control" name="description"  value="{{old('description')}}" required>
            </div>
            <!-- END Input-->
            <!-- Select para Seleccionar linea-->
            <div class="col-md-3 remove">
               <label  class="control-label">Seleccione Linea</label>
              <select id="line_id"   name="line_id"  class="form-control round">
                @foreach($lines as $line)
                  <option value="{{ $line->id }}" required>{{ $line->name }}</option>
                @endforeach
              </select>
            </div>
            <!-- END Select-->

            <!-- Input para ingresar precio del producto pz-->
            <div id="pricecp" class="form-group form-material col-md-3 remove">
              <label>Precio Compra</label>
              <input type="text"  class="form-control compra" id="pricePurchase"  name="price_purchase" value="{{old('price_purchase')}}">
            </div>
            <!-- END Input-->
            
            <!-- Input para ingresar precio del producto pz-->
            <div id="pricepz" class="form-group form-material col-md-3">
              <label>Precio del Producto</label>
              <input type="text" id="pricepzt" class="form-control" readonly  name="pricepzt" value="{{old('pricepzt')}}" required>
            </div>


            <!-- Input para ingresar precio con descuento-->
            <div id="discountpz" class="form-group form-material col-md-3 remove">
              <label>Precio con descuentopz</label>
              <input type="text"  class="form-control" id="pcdpz" readonly name="max_discountpz" value="{{old('max_discountpz')}}" >
            </div>
            <!-- END Input-->
            <div   class="col-md-3 form-material remove">
              <label  class="control-label">Precio de la linea</label>
              <input type="text" name="" id="line_price" class="form-control" readonly>
            </div>
            <!-- END Select-->
            <!-- Input para ingresar Peso del producto-->
            <div class="form-group form-material col-md-3 remove">
              <label>Gramos</label>
              <input type="text" id="multiplicador"  class="form-control gramoss" name="weigth">
            </div>
            <!-- END Input-->
            <!-- Input para ingresar precio del producto-->
            <div id="show" class="form-group form-material col-md-3 remove">
              <label>Precio del Producto</label>
              <input type="text"readonly="readonly" class="form-control" id="total" readonly name="price" value="{{old('price')}}" required>
            </div>
            <!-- END Input-->
            <!-- Input para ingresar Tope de descuento -->
            <div class="form-group form-material col-md-3 remove">
              <label>Precio con descuentogr</label>
              <input type="text" readonly="readonly" class="form-control" id="discount" readonly name="max_discount" value="{{old('max_discount')}}">
            </div>
            <!-- END Input-->

            <div>
                @foreach ($shops as $shop)
                <input type="hidden" name="shop_id" value="{{$shop->id}}">
                @endforeach
            </div>
            <!-- Select para Seleccionar sucursal-->
            <div class="col-md-3">
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
            <!-- END Select-->
            <!-- Input para ingresar Observaciones-->
            <div class="form-group form-material col-md-3">
              <label>Observaciones</label>
              <input type="text" class="form-control" name="observations"  value="{{old('observations')}}">
            </div>
            <!-- END Input-->
            <!-- Input para Seleccionar Imagen del producto-->
            <div class="form-group form-material col-md-3">
              <label for="image" class="btn btn-primary">Imagen</label>
              <input type="file" name="image" id="image" class="hidden">
            </div>
            <!-- END Input-->
          </div>
          <!-- Botón para guardar Producto-->
          <div class="form-group col-md-4">
           <button id="submit" type="submit" name="button" class="btn btn-primary">Guardar</button>
          </div>
          <!-- END Botón-->
        </div>
      </form>
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
//detecta el tipo de categoria y depediento al tipo renderea el formulario
  var categoryTypeproduct = {!! $categories !!};

  let defaul = categoryTypeproduct[0]
    if(defaul.type_product == 1){
      //alert(JSON.stringify('pz'+defaul.type_product));
    $('.remove').css('display', 'none');
    $('#pricepz').css('display', 'initial');
    $('#discountpz').css('display', 'initial');
    // $('#pricecp').css('display', 'initial');

    //$('.removeClass').removeClass('invisible');
    //$('#s').toggle();
    }else if(defaul.type_product == 2){
     //alert(JSON.stringify('pz'+defaul.type_product));
     console.log()
    $('.remove').css('display', 'initial');
    $('#pricepz').css('display', 'none');
    $('#discountpz').css('display', 'none');
    // $('#pricecp').css('display', 'none');


  }

// var categoryTypeproduct = {!! $categories !!};
// var categoryId = $(this).val();
// var categoryTypeproduct = categoryTypeproduct.filter(l => l.id == categoryId)[0];

// Init category config
setTimeout(() => {
  var categoryTypeproduct = {!! $categories !!};

  categoryTypeproduct = categoryTypeproduct[0];
  if(categoryTypeproduct.type_product == 1){
      $('.remove').css('display', 'none');
      $('#pricepz').css('display', 'initial');
      $('#pricecp').css('display', 'initial');
      $('#discountpz').css('display', 'initial');
    } else if(categoryTypeproduct.type_product == 2){
      console.log('<p>agregar campos</p>');
      $('.remove').css('display', 'initial');
      $('#pricepz').css('display', 'none');
      $('#pricecp').css('display', 'none');
      $('#discountpz').css('display', 'none');
    }
}, 3000);

$('#categorie_id').change(function(){
    $('#pricepz').val(0);
    $('#pricecp').val(0);
    $('#discountpz').val(0);

    var categoryTypeproduct = {!! $categories !!};
    var categoryId = $(this).val();
    var categoryTypeproduct = categoryTypeproduct.filter(l => l.id == categoryId)[0];
    if(categoryTypeproduct.type_product == 1){
      // PZA
      $('.remove').css('display', 'none');
      $('#pricepz').css('display', 'initial');
      $('#pricecp').css('display', 'initial');
      $('#discountpz').css('display', 'initial');

      // set purchase price for Pza products
      console.log("pricePurchase", Number($('#line_price').val()) * Number($('#multiplicador').val()))
      console.log( Number($('#line_price').val()), Number($('#multiplicador').val()))

        console.log(!Number($('#line_price').val()) , !Number($('#multiplicador').val()))
      if(!Number($('#line_price').val()) || !Number($('#multiplicador').val())) {
        $('#pricePurchase').val(0);
      } else {
        $('#pricePurchase').val( Number($('#line_price').val()) * Number($('#multiplicador').val()) );
      }
    } else if(categoryTypeproduct.type_product == 2){
      // Gramos
      $('.remove').css('display', 'initial');
      $('#pricepz').css('display', 'none');
      $('#pricecp').css('display', 'none');
      $('#discountpz').css('display', 'none');

    }
});


var lines = {!! $lines !!};
var line = lines[0];
//console.log("lines", lines);

$('.compra').on('input', function() {
      let id = $(this).attr('id');
      let val = $(this).val();
      $(`#${id}`).val( val.replace(/\s+/, "") );
})

$('.gramos').on('input', function() {
      let id = $(this).attr('id');
      let val = $(this).val();
      $(`#${id}`).val( val.replace(/\s+/, "") );
})

$('#line_price').val(lines[0].sale_price);

$('#line_id').change(function() {
  var id = $(this).val();
  line = lines.filter(l => l.id == id)[0];
  $('#line_price').val(line.sale_price);
});

$('#multiplicador').keyup(function(){
  var total = $('#line_price').val() * $(this).val();
        if(!Number($('#line_price').val()) || !Number($('#multiplicador').val())) {
        $('#total').val(0);
        return;
      }
  var discount = total - (total * (Number(line.discount_percentage) / 100))
  // var discount = total - Number(line.discount_percentage)
  $('#discount').val(discount);
  $('#total').val(total);

  // set purchase price for Pza products
  console.log("pricePurchase", Number($('#line_price').val()) * Number($('#multiplicador').val()))
  console.log( Number($('#line_price').val()), Number($('#multiplicador').val()))
  $('#pricePurchase').val( Number($('#line_price').val()) * Number($('#multiplicador').val()) );
});

//multilicacion para sacar el precio venta por produt pz
$('#pricePurchase').keyup(function(){
  var cuatro = $(this).val();
  var total = $(this).val() * 4 ;
  var descuentoxpz = total / 2;
  console.log("precio xpz",total);
  console.log("descuentoxpz",descuentoxpz );
        if(!Number($('#pricepzt').val()) || !Number($('#pricePurchase').val()) || !Number($('#pcdpz').val())) {
        $('#pricepzt').val(total);
        $('#pcdpz').val(descuentoxpz);
        return;
      }
      
    //console.log("pricePurchase", Number($('#pricepzt').val()) * Number($('#pricePurchase').val()))
  $('#pricepzt').val(total);
  $('#pcdpz').val(descuentoxpz);


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
