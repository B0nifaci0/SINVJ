@extends('layout.layoutdas')
@section('title')
EDITAR USUARIO
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="page">
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
      <center><h3> Usuario</h3></center>
      <form action="{{ route('usuarios.update', ['id' => $user->id]) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="form-group col-md-6">
          <label>Nombre:</label>
          <input type="text" class="form-control" value="{{$user->name}}" name="name">
        </div>
        <div class="form-group col-md-6">
          <label>Usuario:</label>
          <input type="text" class="form-control" value="{{$user->username}}" name="username">
        </div>
        <div class="form-group col-md-6">
          <label>Correo electronico:</label>
          <input type="text" class="form-control" value="{{$user->email}}" name="email">
        </div>
        <div class="form-group col-md-6">
          <label>Contraseña:</label>
          <input type="password" class="form-control" value="{{$user->password}}" name="password">
        </div>
        <div class="form-group col-md-6">
          <label>Confirmar contraseña:</label>
          <input type="password" class="form-control" value="{{$user->password_confirm}}" name="password_confirm">
        </div>
        <div class="col-md-4  visible-md visible-lg">
            <label>Tienda</label>
            <select id="shops" class="form-control round tiendas" name="shop_id" >
            <option value="*">Seleccione Tienda</option>
              @foreach ($shops as $shop)
                <option value="<?= $shop->id ?>"><?= $shop->name ?></option>
              @endforeach
            </select>
        </div> 
        <div class="col-md-4  visible-md visible-lg">
            <label>Tipo de Usuario</label>
            <select id="type_user" class="form-control round type_user" name="type_user" >
                <option value="*">Seleccione Tipo de Usuario</option>
                    <option value="1" name='type_user'>Sub-Administrador</option>
                    <option value="2" name='type_usyer'>Colaborador</option>
            </select>
        </div>
        
        <div class="form-group col-md-12">
          <button type="submit" name="button" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection