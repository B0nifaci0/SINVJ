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
      @if ($reetiquetado)
      <h2 class="text-center">Reetiquetar Producto</h2>
      @else
      <h2 class="text-center">Editar Producto</h2>
      @endif
      <br>
      <form id="multiplicar" class="" action="{{route('productos.update', $product->id) }} " method="post"
        enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class='row'>
          <!-- Select para Seleccionar categoria-->
          <div class="col-md-3">
            <label>Seleccione Categoría </label>
            <select id="categorie_id" name="category_id" class="form-control round">
              <option value="{{$product->category->id}}" selected>{{$product->category->name}}</option>
              @foreach($categories as $category)
              @if($category->id != $product->category->id)
              <option value="{{($category->id) ? $category->id: old('$product->category->id')}}" required>
                {{ $category->name }}</option>
              @endif
              @endforeach
            </select>
          </div>
          <!-- END Select-->

          <!-- Input para ingresar clave del producto-->
          <div class="form-group form-material col-md-3">
            <label>Clave</label>
            <input type="text" class="form-control" name="clave"
              value="{{($product->clave) ? $product->clave: old('clave')}}" required>
          </div>
          <!-- Input para ingresar descripcion-->
          <div class="form-group form-material col-md-3">
            <label>Descripción</label>
            <input type="text" class="form-control" name="description"
              value="{{($product->description) ? $product->description: old('description')}}" required>
          </div>
          <!-- END Input-->
          <!-- Select para Seleccionar linea-->
          <div class="col-md-3 remove">
            <label class="control-label">Seleccione Línea</label>
            <select id="line_id" name="line_id" class="form-control round">
              @if($product->category->type_product == 2)
              <option value="{{$product->line->id}}" selected> {{$product->line->name}}</option>
              @foreach($lines as $line)
              @if($line->id != $product->line->id)
              <option value="{{ $line->id }}" required>{{($line->name) ? $line->name :old('$line->name')}}</option>
              @endif
              @endforeach
            </select>
            @endif
          </div>
          <!-- END Select-->

          <!-- Input para ingresar precio del producto pz-->
          <div id="pricecp" class="form-group form-material col-md-3 remove">
            <label>Precio Compra</label>
            <input type="text" class="form-control" id="pricePurchase" name="price_purchase"
              value="{{($product->price_purchase) ? $product->price_purchase :old('$product->price_purchase')}}">
          </div>
          <!-- END Input-->

          <!-- Input para ingresar precio del producto pz-->
          <div id="pricepz" class="form-group form-material col-md-3">
            <label>Precio del Producto</label>
            <input type="text" id="pricepzt" class="form-control" name="pricepzt"
              value="{{($product->price) ? $product->price: old('pricepzt')}}">
          </div>

          <!-- Input para ingresar precio con descuento-->
          <div id="discountpz" class="form-group form-material col-md-3 remove">
            <label>Precio con descuentopz</label>
            <input type="text" class="form-control" id="pcdpz" name="max_discountpz"
              value="{{($product->discount) ? $product->discount :old('max_discountpz')}}">
          </div>
          <!-- END Input-->
          <div class="col-md-3 form-material remove">
            <label class="control-label">Precio de la línea</label>
            <input type="text" name="" id="line_price" class="form-control" readonly>
          </div>
          <!-- END Select-->
          <!-- Input para ingresar Peso del producto-->
          <div class="form-group form-material col-md-3 remove">
            <label>Gramos</label>
            <input type="text" id="multiplicador" class="form-control" name="weigth"
              value="{{($product->weigth) ? $product->weigth :old('$product->weigth')}}">
          </div>
          <!-- END Input-->
          <!-- Input para ingresar precio del producto-->
          <div id="show" class="form-group form-material col-md-3 remove">
            <label>Precio del Producto</label>
            <input type="text" class="form-control" id="total" readonly name="price"
              value="{{($product->price) ? $product->price :old('price')}}">
          </div>
          <!-- END Input-->
          <!-- Input para ingresar Tope de descuento -->
          <div class="form-group form-material col-md-3 remove">
            <label>Precio con descuentogr</label>
            <input type="text" class="form-control" id="discount" readonly name="max_discount"
              value="{{($product->discount) ? $product->discount :old('max_discount')}}">
          </div>
          <!-- END Input-->
          <div>
            <input type="hidden" name="shop_id" value="{{$shop->id}}">
          </div>
          <div>
            <input type="hidden" name="shop_id" value="{{$shop->id}}">
          </div>
          <!-- Select para Seleccionar sucursal-->
          <div class="col-md-3">
            <label>Seleccione Sucursal</label>
            <select name="branch_id" class="form-control round">
              <option value="{{$product->branch->id}}" selected>{{$product->branch->name}}</option>
              @foreach($branches as $branch)
              @if($branch->id != $product->branch->id)
              <option value="{{ $branch->id }}" required>{{ $branch->name }}</option>
              @endif
              @endforeach
            </select>
          </div>
          <!-- END Select-->
          <!-- Select para Editar Estatus-->
          <div class="col-md-3">
            <label>Seleccionar estatus actual</label>
            <select name="status_id" class="form-control round">
              <option value="{{$product->status->id}}" selected>{{$product->status->name}}</option>
              @foreach($statuses as $status)
              @if ($status->id != $product->status->id)
              <option value="{{ $status->id }}" required>{{ $status->name }}</option>
              @endif
              @endforeach
            </select>
          </div>
          <!-- END Select-->
          <!-- Input para ingresar Observaciones-->
          <div class="form-group form-material col-md-3">
            <label>Observaciones</label>
            <input type="text" class="form-control" name="observations"
              value="{{($product->observations) ? $product->observations :old('$product->observations')}}">
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
  var categoryTypeproduct = {!! $categories !!};
  let category_id =  $('#categorie_id').val();
let defaul = categoryTypeproduct.filter(c => c.id == category_id)[0];
  console.log('defecto: '+ defaul.type_product)
    if(defaul.type_product == 1){
    $('.remove').css('display', 'none');
    $('#pricepz').css('display', 'initial');
    $('#discountpz').css('display', 'initial');

    }else if(defaul.type_product == 2){
     console.log()
    $('.remove').css('display', 'initial');
    $('#pricepz').css('display', 'none');
    $('#discountpz').css('display', 'none');

  }

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

$('#line_price').val(lines[0].sale_price);

$('#line_id').change(function() {
  var id = $(this).val();
  line = lines.filter(l => l.id == id)[0];
  $('#line_price').val(line.sale_price);
  total = $('#multiplicador').val()*line.sale_price
  $('#total').val(total);
  var discount = total - (total * (Number(line.discount_percentage) / 100))
  $('#discount').val(discount);
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