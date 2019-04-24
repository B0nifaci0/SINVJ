@extends('layout.layoust')
@section('title')
ALTA TIENDAS
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="page-content container-fluid">
  <form autocomplete="off" method="POST" action="/tiendas" enctype="multipart/form-data">

  <div class="panel">
    <div class="panel-body">
    @if (session('mesage'))
    <div class="alert alert-success">
          <strong>{{ session('mesage') }}</strong>
        </div>
      @endif
      <div class="panel-body container-fluid">
        @if($errors->count() > 0)
        <div class="alert alert-danger" role="alert">
          <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
    @endif
        <h2 class="panel-title">Informacion de la tienda</h2>
             <div class="col-md-6 form-group">
               <label class="floating-label">Nombre: </label>
               <input type="text" class="form-control" name="name" value="{{old('name')}}" required="required" placeholder="El nombre de tu negocio" />
             </div>
            <div class="col-md-6 form-group">
              <label class="floating-label">Sitio web: </label>
              <input type="text" class="form-control" name="web_site" value="{{old('web_site')}}" required="required" placeholder="www.ejemplo.com" />
            </div>


        <div class="col-md-6">
          <label>Correo electrónico</label>
          <input type="text" name="email" class="form-control" value="{{old('email')}}">
        </div>

        <div class="col-md-6">
          <label>Numero telefonico</label>
          <input type="text" name="phone_number" class="form-control" value="{{old('phone_number')}}">
        </div>

        <div class="col-md-6">
          <label>Estado</label>
          <select id="states" class="form-control">
            @foreach($states as $state)
              <option value="{{ $state->id }}">{{ $state->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-6">
        <label>Municipio</label>
          <select id="municipios" name="municipality_id" class="form-control"></select>
        </div>

        <div class="col-md-12">
          <label>Descripción</label>
          <textarea name="description" class="form-control" value="">{{old('description')}}</textarea>
        </div>

        <div class='col-md-12'>
          <div class=" col-md-6 example-wrap">
            <label>Ingresa Imagen de tu Tienda.</label>
              <input type="file" name="image" data-plugin="dropify"  required>
          </div>
        </div>

        <div>
        <!--SE INGRESA LA VISTA PARCIAL-->
        </div>
          <div class="col-md-12 form-group">
              <button id="ok" type="submit" class="btn btn-info">Guardar</button>
          </div>
      </div>
  </div>
  </form>
  </div>

@endsection
