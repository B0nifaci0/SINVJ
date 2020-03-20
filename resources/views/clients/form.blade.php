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
            @if($client)
            <h2 class="panel-title">Editar Cliente</h2>

            <div class="row">
                <div class="form-group form-material col-md-6">
                    <label class="form-control-label" for="inputShop">Nombre</label>
                    <input type="text" name="name"
                        value="{{ isset($client->name) ? $client->name : old('name') }}" class="form-control">
                </div>
                @if($client)
                @if($client->type_client == 1)
                <div class="form-group form-material col-md-6">
                    <label class="form-control-label" for="inputShop">Primer apellido</label>
                    <input type="text" name="first_lastname"
                        value="{{ isset($client->first_lastname) ? $client->first_lastname : old('first_lastname') }}" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group form-material col-md-6">
                    <label class="form-control-label" for="inputShop">Segundo apellido</label>
                    <input type="text" name="second_lastname"
                        value="{{ isset($client->second_lastname) ? $client->second_lastname : old('second_lastname') }}" class="form-control">
                </div>
                @else
                <input type="hidden" name="first_lastname" value="V">
                <input type="hidden" name="second_lastname" value="V">
                @endif
                @endif
                <div class="form-group form-material col-md-6">
                    <label class="form-control-label" for="inputShop">Número telefónico</label>
                    <input type="text" name="phone_number" id="tel"
                        value="{{ isset($client->phone_number) ? $client->phone_number : old('phone_number') }}" class="form-control">
                </div>
            </div>
            @if($client)
            @if($client->type_client == 1)
            <div class="row">
                <div class="form-group form-material col-md-6">
                    <label class="form-control-label" for="inputShop">Límite de Crédito</label>
                    <input type="text" name="credit" id="credit"
                        value="{{ isset($client->credit) ? $client->credit : old('credit') }}" class="form-control" >
            </div>
            <div class="form-group form-material col-md-6">
                <label class="form-control-label" for="inputShop">Sucursal</label>
                <select name="branch_id" id="" class="form-control">
                @foreach($branches as $branch)
                    <option value="<?= $branch->id ?>"><?= $branch->name ?></option>
                @endforeach
                </select>
            </div>
            @else
            <input type="hidden" value="100000" name="credit"> 
            @endif
            @endif
            </div> 
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <button type="submit" name="button" class="btn btn-info">Guardar</button>
                </div>
            </div>
      </div>
    </div>
    @else 
    <h2 class="panel-title">Registar Nuevo Cliente</h2>

<div class="row">
    <div class="form-group form-material col-md-6">
        <label class="form-control-label" for="inputShop">Nombre</label>
        <input type="text" name="name"
            value="{{ isset($client->name) ? $client->name : old('name') }}" class="form-control">
    </div>
    <div class="form-group form-material col-md-6">
        <label class="form-control-label" for="inputShop">Primer apellido</label>
        <input type="text" name="first_lastname"
            value="{{ isset($client->first_lastname) ? $client->first_lastname : old('first_lastname') }}" class="form-control">
    </div>
</div>
<div class="row">
    <div class="form-group form-material col-md-6">
        <label class="form-control-label" for="inputShop">Segundo apellido</label>
        <input type="text" name="second_lastname"
            value="{{ isset($client->second_lastname) ? $client->second_lastname : old('second_lastname') }}" class="form-control">
    </div>
    <div class="form-group form-material col-md-6">
        <label class="form-control-label" for="inputShop">Número telefónico</label>
        <input type="text" name="phone_number" id="tel"
            value="{{ isset($client->phone_number) ? $client->phone_number : old('phone_number') }}" class="form-control">
    </div>
</div>
<div class="row">
    <div class="form-group form-material col-md-6">
        <label class="form-control-label" for="inputShop">Límite de Crédito</label>
        <input type="text" name="credit" id="credit"
            value="{{ isset($client->credit) ? $client->credit : old('credit') }}" class="form-control" >
</div>
<div class="form-group form-material col-md-6">
    <label class="form-control-label" for="inputShop">Sucursal</label>
    <select name="branch_id" id="" class="form-control">
    @foreach($branches as $branch)
        <option value="<?= $branch->id ?>"><?= $branch->name ?></option>
    @endforeach
    </select>
</div>
</div> 
</div>
<div class="row">
    <div class="col-md-12 form-group">
        <button type="submit" name="button" class="btn btn-info">Guardar</button>
    </div>
</div>
</div>
</div>
@endif
  </form>
</div>
@section('listado-productos')

<script>
    $(document).ready(function(){

        $('#credit').on('input', function() {
            let id = $(this).attr('id');
            let val = $(this).val();
            $(`#${id}`).val(val.replace(/\s+/, ""));
        });

        $('#tel').on('input', function() {
            let id = $(this).attr('id');
            let val = $(this).val();
            $(`#${id}`).val(val.replace(/\s+/, ""));
        });

    });
</script>
@endsection
@endsection