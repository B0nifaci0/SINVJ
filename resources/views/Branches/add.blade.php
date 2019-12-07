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
    {{ csrf_field() }}
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
            <h2 class="panel-title">Registar Sucursal</h2>
             <div class="row">
                <!-- Input Para ingresar Nombre-->
                <div class="form-group form-material col-md-6">
                  <label class="form-control-label">Nombre Sucursal: </label>
                  <input type="text" class="form-control" name="name"  required="required" placeholder="Joyeria AB" />
                </div>
                <!-- END Input-->
                <!-- Input Para ingresar Nombre De Representante Legal-->
                <div class="form-group form-material col-md-6">
                  <label class="form-control-label">Representante Legal: </label>
                  <input type="text" class="form-control" name="name_legal_re"  required="required" placeholder="Francisco J" />
                </div>
                <!-- END Input-->
                <!-- Input Para ingresar email de sucursal-->
                <div class="form-group form-material col-md-6">
                  <label class="form-control-label">Correo: </label>
                  <input type="text" class="form-control" name="email"  required="required" placeholder="Francisco J" />
                </div>
                <!-- END Input-->
                <!-- Input Para ingresar rfc-->
                <div class="form-group form-material col-md-6">
                  <label class="form-control-label">RFC: </label>
                  <input type="text" class="form-control" name="rfc"  required="required" placeholder="FADB0203..." />
                </div>
                <!-- END Input-->
                <!-- Input Para ingresar telefono-->
                <div class="form-group form-material col-md-6">
                  <label class="form-control-label">Telefono: </label>
                  <input type="text" class="form-control" name="phone_number"  required="required" placeholder="0203..." />
                </div>
                <!-- END Input-->
                <!-- Input Para ingresar direción-->
                <div class="form-group form-material col-md-6">
                  <label class="form-control-label">Dirección: </label>
                  <input type="text" class="form-control" name="address"  required="required" placeholder="123456789" />
                </div>
                <!-- END Input-->
                <!-- Input Para ingresar direción-->
                <div class="form-group form-material col-md-6">
                  <label class="form-control-label">otros: </label>
                  <input type="text" class="form-control" name="other"  required="required" placeholder="123456789" />
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