
@extends('layout.layoutdas')
@section('title')
ALTA LíNEAS
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="panel-body">
 @if (session('mesage'))
    <div class="alert alert-success">
      <strong>{{ session('mesage') }}</strong>
    </div>
  @endif
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
        <center><h3>Registrar Linea</h3></center>
        <form class="" action="/lineas" method="post">
          {{ csrf_field() }} 
          <div class="row">
            <!-- Input para ingresar Nombre de la linea-->
            <div class="form-group form-material col-md-6">
              <label class="form-control-label" for="inputBasicLastName"> Nombre Linea:</label>
              <input type="text" class="form-control" name="name" value="{{old('name')}}" required="required" placeholder="Linea:" />
            </div>
            <!-- END Input--> 
            <!-- Input para ingresar precio de linea-->
            <div class="form-group form-material col-md-6">
              <label class="form-control-label" for="inputBasicLastName">Precio:</label>
              <input type="text" class="form-control" name="price" value="{{old('price')}}" required="required" placeholder="$1200" />
            </div> 
            <!-- END Input-->
            <!-- Botón para guardar linea-->
            <div class="form-group col-md-12">
             <button type="submit" name="button" class="btn btn-primary">Guardar</button>
            </div>
            <!-- END Botón-->
          </div>
        </form>
      </div> 
    </div>
  </div>
@endsection
