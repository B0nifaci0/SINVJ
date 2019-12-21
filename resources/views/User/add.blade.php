@extends('layout.layoutdas')
@section('title')
ALTA USUARIOS
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
    @if (session('mesage-delete'))	
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('mesage-delete') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	    </div>
		@endif  
  <div class="page-content container-fluid">
    <!-- Form, Method "POST" para enviar los datos del formulario a la base de datos--> 
    <form autocomplete="off" method="POST" action="/usuarios" enctype="multipart/form-data">
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
          <h2 class="panel-title">Registar Usuario</h2>
          <div class="row">
            <!-- Input para ingresar Nombre-->
            <div class="form-group form-material col-md-6">
              <label class="form-control-label" for="inputBasicFirstName">Nombre: </label>
              <input type="text" class="form-control" name="name" value="{{old('name')}}" required="required" placeholder="El nombre del Usuario" />
            </div>
            <!-- END Input-->
            <!-- Input para ingresar Correo Electronico-->
            <div class="form-group form-material col-md-6">
              <label class="form-control-label" for="inputBasicLastName"> Coreo Electronico:</label>
              <input type="text" class="form-control" name="email" value="{{old('email')}}" required="required" placeholder="example@hotmail.com" />
            </div>
            <!-- END Input-->
            <!-- Input para Ingresar Contraseña-->
            <div class="form-group form-material col-md-6">
              <label class="form-control-label" for="inputBasicFirstName">Contraseña : </label>
              <input type="password" name="password" class="form-control" value="{{old('password')}}" required="required" placeholder="Contraseña">
            </div>
            <!-- END Input-->
            <!-- Input para Ingresar Contraseña (Confirmar)-->
            <div class="form-group form-material col-md-6">
              <label class="form-control-label" for="inputBasicFirstName">Confirmar Contraseña: </label>
              <input type="password" name="password_confirmation" class="form-control" value="{{old('password_confirmation')}}" required="required" placeholder="Confirma la Contraseña">
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
                <select id="branches" class="form-control round sucursales" name="branch_id" required="required">
                <option value=" ">Seleccione Sucursal</option>
                  @foreach ($branches as $branch)
                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                  @endforeach
                </select>
            </div> 
            <!-- END Select-->
            <!-- Seleccionar Tipo de Usuario -->
            <div class="col-md-offset-1 visible-md visible-lg col-md-6">
              <label class="form-control-label" for="inputTypeUser">Tipo de Usuario: </label>
              <select id="type_user" class="form-control round type_user" name="type_user" required="required">
                <option value=" ">Seleccione Tipo de Usuario</option>
                <option value="2" name='type_user'>Sub-Administrador</option>
                <option value="3" name='type_usyer'>Colaborador</option>
              </select>
            </div>
            <!-- END Select-->
            <!-- Input para ingresar Salario-->
            <div class="form-group form-material col-md-6">
              <label class="form-control-label" for="inputBasicFirstName">Salario : </label>
              <input type="text" name="salary" class="form-control" required="required" value="{{old('salary')}}" placeholder="$ 1000">
            </div>
            <!-- END Input-->
            <div>
              <input type="hidden" name="terms_conditions" value="1">
            </div>   
          </div>
          <!-- Botón para guardar Usuario-->
          <div class="form-group col-md-12">
            <button type="submit" name="button"  class="btn btn-primary">Guardar</button>
          </div>
          <!-- END Botón-->
        </div>
      </div> 
    </form>
  </div>
@endsection
