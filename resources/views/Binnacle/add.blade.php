@extends('layout.layoutdas')
@section('title')
ALTA BITACORAS
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="page-content container-fluid">
  <form autocomplete="off" method="POST" action="/binnacle" enctype="multipart/form-data">
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
            <h2 class="panel-title">Registar Bitacora</h2>
                  <div class="row">
                        <div class="form-group form-material col-md-6">
                                <label class="form-control-label" for="inputShop">Seleccione una Tienda</label>
                                <select id="users" class="form-control round usuarios" name="user_id" >
                                <option value="*">Seleccione Usuario</option>
                                  @foreach ($users as $user)
                                    <option value="<?= $user->id ?>"><?= $user->name ?></option>
                                  @endforeach
                                </select>
                              </div> 
                        <div class="form-group form-material col-md-6">
                                <label class="form-control-label" for="inputShop">Seleccione una Sucursal</label>
                                <select id="branches" class="form-control round Sucursales" name="branch_id" >
                                <option value="*">Seleccione Sucursal</option>
                                  @foreach ($branches as $branch)
                                    <option value="<?= $branch->id ?>"><?= $branch->name ?></option>
                                  @endforeach
                                </select>
                              </div> 
                        <div class="form-group form-material col-md-6">
                          <label class="form-control-label" for="inputShop">Seleccione una Tienda</label>
                          <select id="products" class="form-control round productos" name="product_id" >
                          <option value="*">Seleccione Producto</option>
                            @foreach ($products as $product)
                              <option value="<?= $product->id ?>"><?= $product->name ?></option>
                            @endforeach
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