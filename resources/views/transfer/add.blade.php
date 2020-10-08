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
            <center>
                <h3>Nuevo Traspaso</h3>
            </center>
            <form class="" action="/traspasos" method="POST">
                {{ csrf_field() }}
                <div class='row'>
                    <!-- Select para Seleccionar producto-->
                    <div class="form-group form-material  col-md-3  col-md-offset-1 visible-md visible-lg">
                        <label>Producto</label>
                        <select id="product" class="form-control " data-plugin="select2"
                            data-placeholder="Seleccione Producto" data-allow-clear="true" required>
                            <option></option>
                            <optgroup label="Productos">
                                @foreach($products as $product)
                                <option value="{{ $product->clave }}" required>
                                    {{$product->clave}}-{{ $product->description }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        <input type="text" name="product_id" class="invisible" id="product_id">
                    </div>
                    <!-- END Select-->
                    <!-- Select para Seleccionar Sucursal Destino-->
                    <div class="form-group  col-md-3  col-md-offset-1 visible-md visible-lg">
                        <label>Sucursal Destino</label>
                        <select id="branches" class="form-control sucursales" name="new_branch_id" alt="1" required>
                            <option value="*">Seleccione Sucursal</option>
                        </select>
                    </div>
                    <!-- END Select-->
                    <!-- Select para Seleccionar Quien Recibe (Usuario) -->
                    <div class="form-group  col-md-3 col-md-offset-1 visible-md visible-lg">
                        <label>Recibe</label>
                        <select id="usuarios_1" name="destination_user_id" class="form-control " required>
                        </select>
                    </div>
                    <!-- END Select-->
                    <div class="col-md-3">
                        <input type="hidden" name="status_product" value="0">
                    </div>
                </div>
                <!-- Botón para guardar traspaso-->
                <div class="form-group col-md-12">
                    <button id="submit" type="submit" name="button" class="btn btn-primary">Guardar</button>
                </div>
                <!-- END Botón-->
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
console.log("PPPP", JSON.stringify(products))

$(".sucursales").change(function(){
  var selector =  $(this).attr("alt");
  var id_sucursal = $(this).val();
  var url = '/sucursales/' + id_sucursal + '/usuarios';
  $.get(url, function(json){
    $('#usuarios_' + selector).empty();
    $('#usuarios_' + selector).append('<option value="" selected disabled>Seleccione un colaborador</option>');
        $.each(json,function(i, user){
          $('#usuarios_' + selector).append('<option value = '+ user.id +'>' + user.name +'</option>'
          );
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

    $('#product').change(function() {
        var clave = $(this).val();
  console.log("===> clave", clave);
  var p = products.filter(p => p.clave == clave)[0];
  console.log(p);
  $('#branch').val(p.branchName)
  $('#branch_id').val(p.branchId)
  $('#product_id').val(p.id);
  let brancehesList = branches.filter(b => b.id != p.branchId);

  $('#branches').empty();
  brancehesList.forEach(element => {
    $('#branches').append(new Option(element.name, element.id, true, true));
  });

});

</script>
@endsection
<!-- END Función-->
@section('traspaso')
<script type="text/javascript">
    $('.accept').click(function(){
  var id = $(this).attr('alt');
  $('#t_product_id').val(id);
  $('#status').val(1)

  $('#form').submit();
});
</script>
@endsection