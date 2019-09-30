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
    @if($client)
      <form autocomplete="off" method="post" action="/mayoristas/{{ $client->id }}">
      {{ method_field('PUT') }}
    @else
      <form autocomplete="off" method="post" action="/mayoristas">
    @endif
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
            <h2 class="panel-title">Registar nuevo cliente mayorista</h2>

            <div class="row">
                <div class="form-group form-material col-md-6">
                    <label class="form-control-label" for="inputShop">Nombre</label>
                    <input type="text" name="name"
                        value="{{ ($client->name) ? $client->name : old('name') }}" class="form-control">
                </div>
                <div class="form-group form-material col-md-6">
                    <label class="form-control-label" for="inputShop">Primer apellido</label>
                    <input type="text" name="first_lastname"
                        value="{{ ($client->first_lastname) ? $client->first_lastname : old('first_lastname') }}" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group form-material col-md-6">
                    <label class="form-control-label" for="inputShop">Segundo apellido</label>
                    <input type="text" name="second_lastname"
                        value="{{ ($client->second_lastname) ? $client->second_lastname : old('second_lastname') }}" class="form-control">
                </div>
                <div class="form-group form-material col-md-6">
                    <label class="form-control-label" for="inputShop">Número telefónico</label>
                    <input type="text" name="phone_number"
                        value="{{ ($client->phone_number) ? $client->phone_number : old('phone_number') }}" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <button type="submit" name="button" class="btn btn-info">Guardar</button>
                </div>
            </div>
      </div>
    </div>
  </form>
</div>
@endsection