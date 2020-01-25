
@extends('layout.layoutdas')
@section('title')
MODIFICACIÓN TIENDA
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
      <h2 align="center">Editar Tienda</h2>
      <form id="multiplicar" class="" action="{{route('tiendas.update', $shop->id) }} " method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        @method('PUT')
        <div class='row'>
            <div class="form-group form-material col-md-6">
                <label>Nombre</label>
                <input type="text" class="form-control" name="name"  value="{{$shop->name}}">
            </div>
            <div class="form-group form-material col-md-6">
                    <label>Descripcion</label>
                    @if($shop->description == "NULL")
                    <input type="text" class="form-control" name="description"  value=" " required="required">
                    @elseif($shop->description != "NULL")
                    <input type="text" class="form-control" name="description"  value="{{$shop->description}}" required="required">
                    @endif
            </div>
            <div class="form-group form-material col-md-6">
                    <label>Correo</label>
                    @if($shop->email == "NULL")
                    <input type="text" class="form-control" name="email"  value=" " required="required">
                    @elseif($shop->email != "NULL")
                    <input type="text" class="form-control" name="email"  value="{{$shop->email}}" required="required">
                    @endif
            </div>
            <div class="form-group form-material col-md-6">
                    <label>Telefono</label>
                    @if($shop->phone_number == "NULL")
                    <input type="text" class="form-control" name="phone_number"  value=" " required="required">
                    @elseif($shop->phone_number != "NULL")
                    <input type="text" class="form-control" name="phone_number"  value="{{$shop->phone_number}}" required="required">
                    @endif
            </div>
                <!-- Input Para ingresar Contraseña-->
                <div class="form-group form-material col-md-6">
                  <label class="form-control-label">Contraseña: </label>
                  <input type="password" class="form-control" name="password"  required="required" />
                </div>
                <!-- END Input-->
                <!-- Input Para ingresar Contraseña-->
                <div class="form-group form-material col-md-6">
                  <label class="form-control-label">Confirmar contraseña: </label>
                  <input type="password" class="form-control" name="confirm_password"  required="required" />
                </div>
                <!-- END Input-->

            <div class="form-group form-material col-md-6">
              <label>Selecciona el logo de tu tienda</label>
              <br>
              <label for="image" class="btn btn-info">Explorar</label>
              <input type="file" name="image" id="image" class="hidden" >
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-12">
              <button id="submit" type="submit" name="button" class="btn btn-primary">Guardar</button>
            </div>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection
