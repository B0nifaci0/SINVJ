@extends('layout.layoutdas')
@section('title')
ALTA SUCURSALES
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="page-content container-fluid">
  <form autocomplete="off" method="POST" action="/sucursales" enctype="multipart/form-data">
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
            <h2 class="panel-title">Registar Sucursal</h2>
                  <div class="row">
                        <div class="form-group form-material col-md-6">
                            <label class="form-control-label" for="inputBasicFirstName">Nombre: </label>
                            <input type="text" class="form-control" name="name"  required="required" placeholder="Joyeria AB" />
                        </div>
                          </select>
                        </div> 
                    <div class="col-md-12 form-group">
                      <button type="submit" name="button" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
  </form>
</div>
@endsection