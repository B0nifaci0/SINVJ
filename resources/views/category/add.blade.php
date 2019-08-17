
@extends('layout.layoutdas')
@section('title')
ALTA CATEGORIA
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
      <center><h3>Registrar Categoria</h3></center>
      <form class="" action="/categorias" method="post">
        {{ csrf_field() }}   
        <div class="row">
          <!-- Input Para ingresar Nombre de categoria-->
          <div class="form-group form-material col-md-6">
            <label class="form-control-label" for="inputBasicLastName"> Nombre Categoria:</label>
            <input type="text" class="form-control" name="name" value="{{old('name')}}" required="required" placeholder="Anillo" />
          </div>
          <!-- END Input-->
          <!-- Input Para ingresar Type Product-->
          <div class="form-group form-material col-md-6">
            <label class="form-control-label" for="inputBasicLastName"> Tipo De Producto:</label>
              <ul class="list-unstyled list-inline m-0">
                <li class="list-inline-item mb-20">
                    <input type="radio" value="1" class="iradio_flat-blue checked hover" id="inputRadiosChecked" name="type_product" data-plugin="iCheck" data-checkbox-class="iradio_flat-blue" checked />
                    <label for="inputColorPrimary">PZS</label>
                </li>
                <li class="list-inline-item mb-20">
                    <input type="radio" value="2" class="iradio_flat-blue checked hover" id="inputColorGreen" name="type_product" data-plugin="iCheck" data-checkbox-class="iradio_flat-blue" checked>
                    <label for="inputColorGreen">GRS</label>
                </li>
              </ul>
          </div>
          <!-- END Input-->
          <!-- Botón Para guardar categoria-->
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
