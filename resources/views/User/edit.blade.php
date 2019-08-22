@extends('layout.layoutdas')
@section('title')
EDITAR USUARIOS
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
  <div class="page-content container-fluid">
    <form action="{{ route('usuarios.update', ['id' => $users->id]) }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
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
          <h2 class="panel-title">Editar Usuario</h2>
          <div class="row">
            <!-- Input para editar Nombre-->
            <div class="form-group form-material col-md-6">
              <label>Nombre:</label>
              <input type="text" class="form-control" value="{{$users->name}}" name="name" required> 
            </div>
            <!-- END Input-->
            <!-- Input para editar Correo Electronico-->
            <div class="form-group form-material col-md-6">
              <label>Correo electronico:</label>
              <input type="text" class="form-control" value="{{$users->email}}" name="email" required>
            </div>
            <!-- END Input-->
            <!-- Input para editar Contraseña-->
            <div class="form-group form-material col-md-6">
              <label>Contraseña:</label>
              <input type="password" class="form-control" value="" name="password" required>
            </div>
            <!-- END Input-->
            <!-- Input para editar Contraseña-->
            <div class="form-group form-material col-md-6">
              <label>Confirmar contraseña:</label>
              <input type="password" class="form-control" value="" name="password_confirm" required>
            </div>
            <!-- END Input-->
            <div>
                @foreach ($shops as $shop)
                <input type="hidden" name="shop_id" value="{{$shop->id}}">
                @endforeach 
            </div> 
             <!-- Select para Seleccionar Sucursal-->
            <div class="col-md-offset-1 visible-md visible-lg col-md-6">
                <label class="form-control-label" for="inputBranch">Seleccione una Sucursal</label>
                <select id="branches" class="form-control round sucursales" name="branch_id" >
                <option value=" ">Seleccione Sucursal</option>
                  @foreach ($branches as $branch)
                    <option value="<?= $branch->id ?>"><?= $branch->name ?></option>
                  @endforeach
                </select>
            </div> 
            <!-- END Select-->
             <!-- Select para Seleccionar Tipo de Usuario-->
            <div class="col-md-6  visible-md visible-lg">
              <label>Tipo de Usuario</label>
              <select id="type_user" class="form-control round type_user" name="type_user" required >
                <option value="*">Seleccione Tipo de Usuario</option>
                <option value="2" name='type_user'>Sub-Administrador</option>
                <option value="3" name='type_usyer'>Colaborador</option>
              </select>
            </div> 
            <!-- END Select-->
             <!-- Input para editar salario-->
            <div class="form-group form-material col-md-6">
              <label class="form-control-label" for="inputBasicFirstName">Salario : </label>
              <input type="text" name="salary" class="form-control"  value="{{$users->salary}}" placeholder="$ 1000">
            </div>
            <!-- END Input-->
            <br>
             <!-- Botón para guardar cambios -->
            <div class="form-group col-md-12">
              <button type="submit" name="button"  class="btn btn-primary">Guardar</button>
            </div>
            <!-- END Botón-->
          </div>
        </div> 
      </div>
    </form>
  </div>
@endsection
