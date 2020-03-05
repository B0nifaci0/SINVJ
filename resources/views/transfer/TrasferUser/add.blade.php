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
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('mesage') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
            <h2 align="center">Nuevo Traspaso Sucursales</h2>
            <br>
            <form class="" action="/traspasosAA" method="POST">
                {{ csrf_field() }}
                <div class='row'>
                    <!-- Select para Seleccionar producto-->
                    <div class="col-md-3  col-md-offset-1 visible-md visible-lg">
                        <label>Producto</label>
                        <select id="product" class="form-control" data-plugin="select2"
                            data-placeholder="Seleccione Producto" data-allow-clear="true" required>
                            <option></option>
                            <optgroup label="Productos">
                                @foreach($products as $product)
                                <option value="{{ $product->description }}" required>
                                    {{$product->clave}}-{{ $product->description }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        <input type="text" name="product_id" class="invisible" id="product_id">
                    </div>
                    <!-- END Select-->
                    <!-- Select para Seleccionar Sucursal Origen-->
                    <div class="col-md-3  col-md-offset-1 visible-md visible-lg">
                        <label class="floating-label" for="inputBranch">{{ __('Sucursal Origen') }}</label>
                        <input type="text" class="form-control" id="branch" readonly>
                        <input type="text" class="form-control invisible" name="branch_id" id="branch_id" readonly>
                    </div>
                    <!-- END Select-->

                    <!-- Select para Seleccionar Sucursal Destino-->
                    <div class="col-md-3  col-md-offset-1 visible-md visible-lg">
                        <label class="floating-label" for="inputBranch">{{ __('Destino') }}</label>
                        <select id="branches" class="form-control  sucursales1" name="new_branch_id" alt="1" required>
                            <option value="*">Seleccione Sucursal</option>
                        </select>
                    </div>
                    <!-- END Select-->
                    <!-- Select para Seleccionar Quien lo recibe (Usuario)-->
                    <div class="col-md-3 col-md-offset-1 visible-md visible-lg">
                        <label class="floating-label" for="inputUser">{{ __('Quien lo recibe') }}</label>
                        <select id="usuario_1" name="destination_user_id" class="form-control " required>

                        </select>
                    </div>
                    <!-- END Select-->
                    <br>
                </div>
                <br>
                <div>
                    <input type="hidden" name="status_product" value="0">
                </div>
                <div class="form-group col-md-12">
                    <button id="submit" type="submit" name="button" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
<!-- Función para seleccionar solo los usuarios de esa sucursal(Combo dinamico)-->
@section('branch-user')
<script type="text/javascript">
    var products = {!! $products !!};
var branches = {!! $branches !!};
console.log("PPPP", products)


$(".sucursales").change(function(){
  var selector =  $(this).attr("alt");
  var id_sucursal = $(this).val();
  var url = '/sucursales/' + id_sucursal + '/usuarios';
  $.get(url, function(json){
    $('#usuarios_' + selector).empty();
        $.each(json,function(i, user){
          $('#usuarios_' + selector).append('<option value = '+ user.id +'>' + user.name +'</option>')
        });
  });
});
$(".usuarios").change(function(){
      var id_user = $(this).val();
      var selector = $(this).attr("alt");
      $("#id_user_" + selector).val(id_user);
    });

$(".sucursales1").change(function(){
  var selector =  $(this).attr("alt");
  var id_sucursal = $(this).val();
  var url = '/sucursales/' + id_sucursal + '/usuarios';
  $.get(url, function(json){
    $('#usuario_' + selector).empty();
        $.each(json,function(i, user){
          $('#usuario_' + selector).append('<option value = '+ user.id +'>' + user.name +'</option>')
        });
  });
});
$(".usuarios").change(function(){
      var id_user = $(this).val();
      var selector = $(this).attr("alt");
      $("#id_user_" + selector).val(id_user);
});

setInterval(() => {
  console.log($('#product_id').val());
}, 2500);

$('#product').change(function() {
  var name = $(this).val();
  var p = products.filter(p => p.description == name)[0];
  console.log(p);
  $('#branch').val(p.branchName)
  $('#branch_id').val(p.branchId)
  $('#product_id').val(p.id);
  console.log(branches);
  let brancehesList = branches.filter(b => b.id != p.branchId);

  $('#branches').empty();

  $('#branches').append(new Option('Seleccione una opción', null));
  brancehesList.forEach(element => {
    $('#branches').append(new Option(element.name, element.id));
  });

});

// $('#sucursales_1').change(function(){
//   console.log($(this).val());
//   $.ajax({
//     url:
//   })
// });

</script>
@endsection
<!-- END Función-->
