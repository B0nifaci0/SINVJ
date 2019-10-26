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
                  <label class="form-control-label">Nombre: </label>
                  <input type="text" class="form-control" name="name"  required="required" placeholder="Joyeria AB" />
                </div>
                <!-- END Input-->
              </div>
              <div class="row">
                <!-- Input Para ingresar Contraseña-->
                <div class="form-group form-material col-md-6">
                  <label class="form-control-label">Contraseña: </label>
                  <input type="text" class="form-control" name="password"  required="required" />
                </div>
                <!-- END Input-->
                <!-- Input Para ingresar Contraseña-->
                <div class="form-group form-material col-md-6">
                  <label class="form-control-label">Confirmar contraseña: </label>
                  <input type="text" class="form-control" name="confirm_password"  required="required" />
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