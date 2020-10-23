@extends('layout.layoutdas')
@section('title')
ALTA SUCURSALES
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="page-content container-fluid">
  <form autocomplete="off" method="POST" action="/sucursales" enctype="multipart/form-data">
    @csrf
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
            <h2 class="panel-title">Registrar Sucursal</h2>
             <div class="row">
                <!-- Input Para ingresar Nombre-->
                <div class="form-group form-material col-md-6">
                  <label class="form-control-label">Nombre Sucursal: </label>
                  <input type="text" class="form-control" name="name" value="{{old('name')}}" required="required" placeholder="Joyeria AB" />
                </div>
                <!-- END Input-->
                <!-- Input Para ingresar Nombre De Representante Legal-->
                <div class="form-group form-material col-md-6">
                  <label class="form-control-label">Representante Legal:</label>
                  <input type="text" class="form-control" name="name_legal_re" value="{{old('name_legal_re')}}" placeholder="Francisco J" />
                </div>
                <!-- END Input-->
                <!-- Input Para ingresar email de sucursal-->
                <div class="form-group form-material col-md-6">
                  <label class="form-control-label">Correo: </label>
                  <input type="text" class="form-control" name="email" value="{{old('email')}}"  required="required" placeholder="Joyeria@gmail.com" />
                </div>
                <!-- END Input-->
                <!-- Input Para ingresar rfc-->
                <div class="form-group form-material col-md-6">
                  <label class="form-control-label">RFC: </label>
                  <input type="text" class="form-control" name="rfc" value="{{old('rfc')}}" required="required" placeholder="FAD0027B203" />
                </div>
                <!-- END Input-->
                <!-- Input Para ingresar telefono-->
                <div class="form-group form-material col-md-6">
                  <label class="form-control-label">Teléfono: </label>
                  <input type="text" class="form-control" name="phone_number" value="{{old('phone_number')}}" required="required" placeholder="5516785248" />
                </div>
                <!-- END Input-->
                <!-- Input Para ingresar direción-->
                <div class="form-group form-material col-md-6">
                  <label class="form-control-label">Dirección: </label>
                  <input type="text" class="form-control" name="address"  required="required" value="{{old('address')}}" placeholder="Av. juárez sur 103 etc." />
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
                <!-- Input Para ingresar direción-->
                <div class="form-group form-material col-md-6">
                  <label class="form-control-label">otros:</label>
                  <input type="text" class="form-control" name="other"   placeholder="" />
                </div>
                <!-- END Input-->
              </div>

              <!-- Botón Para guardar cambios-->
              <div class="col-md-12 form-group">
                <button type="submit" name="button" class="btn btn-primary">Guardar</button>
              </div>
              <!-- END Botón-->
          </div>
      </div>
    </div>
  </form>
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