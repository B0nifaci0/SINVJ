@extends('layout.layoutdas')
@section('title')
ALTA ESTATUS
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="page-content container-fluid">
  <form autocomplete="off" method="POST" action="/status" enctype="multipart/form-data">
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
        <h2 class="panel-title">Registar Estatus</h2>
        <div class="row">
          <!-- Input para ingresar Nombre del Estatus-->
          <div class="form-group form-material col-md-6">
            <label class="form-control-label" for="inputBasicFirstName">Nombre: </label>
            <input type="text" class="form-control" name="name" required="required" placeholder="Stock" />
          </div> 
          <!-- END Input-->
          <!-- Botón para guardar Estatus-->
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