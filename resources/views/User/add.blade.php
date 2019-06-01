@extends('layout.layoutdas')
@section('title')
ALTA USUARIOS
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="page-content container-fluid">
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
                        <div class="form-group form-material col-md-6">
                            <label class="form-control-label" for="inputBasicFirstName">Nombre: </label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}" required="required" placeholder="El nombre del Usuario" />
                        </div>
                        <div class="form-group form-material col-md-6">
                            <label class="form-control-label" for="inputBasicLastName"> Coreo Electronico:</label>
                            <input type="text" class="form-control" name="email" value="{{old('email')}}" required="required" placeholder="example@hotmail.com" />
                        </div>
                        <div class="form-group form-material col-md-6">
                            <label class="form-control-label" for="inputBasicFirstName">Contraseña : </label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group form-material col-md-6">
                            <label class="form-control-label" for="inputBasicFirstName">Confirmar Contraseña: </label>
                            <input type="password" name="password_confirm" class="form-control">
                        </div>
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputShop">Seleccione una Tienda</label>
                          <select id="shops" class="form-control round tiendas" name="shop_id" >
                          <option value="*">Seleccione Tienda</option>
                            @foreach ($shops as $shop)
                              <option value="<?= $shop->id ?>"><?= $shop->name ?></option>
                            @endforeach
                          </select>
                        </div> 
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputTypeUser">Tipo de Usuario: </label>
                          <select id="type_user" class="form-control round type_user" name="type_user" >
                            <option value="*">Seleccione Tipo de Usuario</option>
                            <option value="1" name='type_user'>Sub-Administrador</option>
                            <option value="2" name='type_usyer'>Colaborador</option>
                          </select>
                        </div>        
                    <div class="col-md-12 form-group">
                      <button type="submit" name="button" class="btn btn-info">Guardar</button>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
  </form>
</div>
@endsection