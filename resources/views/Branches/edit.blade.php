@extends('layout.layoutdas')
@section('title')
EDITAR SUCURSALES
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
      <center><h3>Sucursales</h3></center>
      <form action="{{ route('sucursales.update', ['id' => $branch->id]) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <!-- Input Para editar Nombre-->
        <div class="row">
        <div class="form-group form-material col-md-6">
          <label class="form-control-label">Nombre Sucursal:</label>
          <input type="text" class="form-control" value="{{$branch->name}}" name="name" required> 
        </div>
        <!-- END Input-->
        <!-- Input Para editar Representante-->
        <div class="form-group form-material col-md-6">
          <label class="form-control-label">Representante Legal:</label>
          <input type="text" class="form-control" value="{{$branch->name_legal_re}}" name="name_legal_re"> 
        </div>
        <!-- END Input-->
        <!-- Input Para editar RFC-->
        <div class="form-group form-material col-md-6">
          <label>RFC:</label>
          <input type="text" class="form-control" value="{{$branch->rfc}}" name="rfc" required> 
        </div>
        <!-- END Input-->
        <!-- Input Para editar Correo-->
        <div class="form-group form-material col-md-6">
          <label>Correo:</label>
          <input type="text" class="form-control" value="{{$branch->email}}" name="email" required> 
        </div>
        <!-- END Input-->
        <!-- Input Para editar Telefono-->
        <div class="form-group form-material col-md-6">
          <label>Teléfono:</label>
          <input type="text" class="form-control" value="{{$branch->phone_number}}" name="phone_number" required> 
        </div>
        <!-- END Input-->
        <!-- Input Para editar Direccion-->
        <div class="form-group form-material col-md-6">
          <label>Dirección:</label>
          <input type="text" class="form-control" value="{{$branch->address}}" name="address" required> 
        </div>
        <!-- END Input-->
        <!-- Select para Seleccionar Estado-->
        <div class="col-md-6 col-md-offset-1 visible-md visible-lg">
          <label class="floating-label" for="inputState">{{ __('Estado') }}</label>
          <select id="estados_1" class="form-control round estados" name="state_id" alt="1">
          <option value="*">Seleccione Estado</option>
            @foreach ($states as $state)
            <option value="<?= $state->id ?>"><?= $state->name ?></option>
            @endforeach
          </select>
        </div>
        <!-- END Select-->
        <!-- Select para Seleccionar Municipio-->
        <div class="col-md-6 col-md-offset-1 visible-md visible-lg">
          <label class="floating-label" for="inputMunicipality">{{ __('Municipio') }}</label>
          <select id="municipios_1" name="municipality_id" class="form-control round"></select>
        </div>
        <!-- END Select-->
        <!-- Botón Para guardar cambios-->
        <div class="form-group col-md-12">
          <button type="submit" name="button" class="btn btn-primary">Guardar</button>
        </div>
        <!-- END Botón-->
      </form>
      </div>
    </div>
  </div>
</div>
@endsection 

@section('disabled-submit')
<script type="text/javascript">
  $(document).ready(function () {
    $("#estados_1").change(function () {
      if ($(this).val() == "" {
        $("#register").prop("disabled", true);
      } else {
        $("#register").prop("disabled", false);
      }
    });
  });
</script>
<script type="text/javascript">
$(".estados").change(function(){
  var selector =  $(this).attr("alt");
  var id_estado = $(this).val();
  var url = '/estados/' + id_estado + '/municipios';
  $.get(url, function(json){
    $('#municipios_' + selector).empty();
    //alert('#municipios_' + selector);
        $.each(json,function(i, municipio){
          $('#municipios_' + selector).append('<option value = '+ municipio.id +'>' + municipio.name +'</option>')
        });
  });
});
$(".municipios").change(function(){
      var id_municipio = $(this).val();
      var selector = $(this).attr("alt");
      $("#id_municipio_" + selector).val(id_municipio);
    });
</script>
@endsection