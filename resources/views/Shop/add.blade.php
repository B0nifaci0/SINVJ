@extends('layout.layoutdas')
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
          @if($errors->count() > 0)
              <div class="alert alert-danger" role="alert">
                <ul>
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <h2 class="panel-title">Informacion de la Tienda</h2>
                  <div class="row">
                        <div class="form-group form-material col-md-6">
                            <label class="form-control-label" for="inputBasicFirstName">Nombre: </label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}" required="required" placeholder="El nombre de tu negocio" />
                        </div>
                        <div class="form-group form-material col-md-6">
                            <label class="form-control-label" for="inputBasicLastName">Sitio Web</label>
                            <input type="text" class="form-control" name="web_site" value="{{old('web_site')}}" required="required" placeholder="www.ejemplo.com" />
                        </div>
                        <div class="form-group form-material col-md-6">
                            <label class="form-control-label" for="inputBasicFirstName">Correo Electronico: </label>
                            <input type="text" name="email" class="form-control" value="{{old('email')}}">
                        </div>
                        <div class="form-group form-material col-md-6">
                            <label class="form-control-label" for="inputBasicFirstName">Telefono: </label>
                            <input type="text" name="phone_number" class="form-control" value="{{old('phone_number')}}">
                        </div>
                        <div class="form-group form-material col-md-6">
                            <label class="col-md-3 form-control-label">Descripción: </label>
                            <div class="col-md-12">
                            <textarea name="description" class="form-control" placeholder="Somos...">{{old('description')}}</textarea>
                            </div>
                        </div>
                        <div class='form-group form-material col-md-6'>
                            <div class="example-wrap">
                              <label>Ingresa Imagen de tu Tienda.</label>
                              <input type="file" name="image" data-plugin="dropify"  required>
                        </div>
                  </div>
                    <div class="col-md-12 form-group">
                      <button id="ok" type="submit" class="btn btn-info">Guardar</button>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
  </form>
</div>
@endsection
