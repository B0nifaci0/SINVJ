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
      <h2 align="center">Nuevo Traspaso</h2>
      <br>  
    <form class="" action="/traspasosAA" method="POST">
      {{ csrf_field() }} 
      <div class='row'>
               <div class="col-md-3  col-md-offset-1 visible-md visible-lg">
                  <label>Producto</label>
                  <select name="product_id" class="form-control" data-plugin="select2" data-placeholder="Seleccione Producto"
                      data-allow-clear="true">
                      <option></option>
                      <optgroup label="Productos">
                      @foreach($products as $product)
                     <option value="{{ $product->id }}" required>{{$product->clave}}-{{ $product->name }}</option>
                     @endforeach
                      </optgroup>
                   </select>
               </div>
            <div class="col-md-3  col-md-offset-1 visible-md visible-lg">
                <label class="floating-label" for="inputBranch">{{ __('Sucursal Origen') }}</label>
                <select id="sucursales_1" class="form-control sucursales" name="last_branch_id" alt="1" >
                <option value="*">Seleccione Sucursal</option>
                @foreach ($branches as $branch)
                    <option value="<?= $branch->id ?>"><?= $branch->name ?></option>
                @endforeach
                </select>
            </div>
            <div class="col-md-3 col-md-offset-1 visible-md visible-lg">
              <label class="floating-label" for="inputUser">{{ __('Quien lo manda') }}</label>
              <select id="usuarios_1" name="user_id" class="form-control "></select>
            </div>

            <div class="col-md-3  col-md-offset-1 visible-md visible-lg">
                <label class="floating-label" for="inputBranch">{{ __('Destino') }}</label>
                <select id="sucursales_1" class="form-control  sucursales1" name="new_branch_id" alt="1" >
                <option value="*">Seleccione Sucursal</option>
                @foreach ($branches as $branch)
                    <option value="<?= $branch->id ?>"><?= $branch->name ?></option>
                @endforeach
                </select>
            </div>
            <div class="col-md-3 col-md-offset-1 visible-md visible-lg">
              <label class="floating-label" for="inputUser">{{ __('Quien lo recibe') }}</label>
              <select id="usuario_1" name="destination_user_id" class="form-control "></select>
            </div>
                <br>
              </div>
             <br>
             
          <div>
              <input type="hidden" name="status_product" value="0">
          </div>   
            <div class="form-group col-md-12">
          <button id="submit" type="submit" name="button" class="btn btn-primary">Guardar</button>
        </form>
    </div>
  </div>
</div>
@endsection
        
@section('branch-user')
<script type="text/javascript">

$(".sucursales").change(function(){
  var selector =  $(this).attr("alt");
  var id_sucursal = $(this).val();
  var url = '/sucursales/' + id_sucursal + '/usuarios';
  $.get(url, function(json){
    $('#usuarios_' + selector).empty();
    //alert('#municipios_' + selector);
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
    //alert('#municipios_' + selector);
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

</script>
@endsection