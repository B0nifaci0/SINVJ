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
          <input type="text" class="form-control" value="{{$branch->name_legal_re}}" name="name_legal_re" required> 
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
          <label>Telefono:</label>
          <input type="text" class="form-control" value="{{$branch->phone_number}}" name="phone_number" required> 
        </div>
        <!-- END Input-->
        <!-- Input Para editar Direccion-->
        <div class="form-group form-material col-md-6">
          <label>Direccion:</label>
          <input type="text" class="form-control" value="{{$branch->address}}" name="address" required> 
        </div>
        <!-- END Input-->
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