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
      <form autocomplete="off" id="form" method="post" action="/mayoristas/{{ $client->id }}">
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
            <h2 class="panel-title" align="center">Editar Cliente</h2>
        @else 
            <h2 class="panel-title" align="center">Registrar Nuevo Cliente</h2>
        @endif
        <div class="row mb-10">
            <div class="col-md-3">
                <label for="user-type">Tipo de cliente</label>
                <select name="type_client" id="user-type" class="form-control">
                    <option value="0">Menudista</option>
                    <option value="1">Mayorista</option>
                </select>
            </div>
        </div>
            <div class="row">
                <div class="form-group form-material col-sm-6">
                    <label class="form-control-label" for="inputShop">Nombre</label>
                    <input type="text" name="name" id="name"
                        value="{{ isset($client->name) ? $client->name : old('name') }}" class="form-control">
                </div>
                <div class="form-group form-material col-sm-6">
                    <label class="form-control-label" for="inputShop">Número telefónico</label>
                    <input type="text" name="phone_number" id="phone_number"
                        value="{{ isset($client->phone_number) ? $client->phone_number : old('phone_number') }}" class="form-control">
                </div>
            </div>
        <div id="wholesalers" class="d-none">
            <div class="row">
                <div class="form-group form-material col-sm-6">
                    <label class="form-control-label" for="inputShop">Primer apellido</label>
                    <input type="text" name="first_lastname" id="first_lastname"
                        value="{{ isset($client->first_lastname) ? $client->first_lastname : old('first_lastname') }}" class="form-control">
                </div>
                <div class="form-group form-material col-sm-6">
                    <label class="form-control-label" for="inputShop">Segundo apellido</label>
                    <input type="text" name="second_lastname" id="second_lastname"
                        value="{{ isset($client->second_lastname) ? $client->second_lastname : old('second_lastname') }}" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group form-material col-sm-6">
                    <label class="form-control-label" for="inputShop">Límite de Crédito</label>
                    <input type="text" name="credit" id="credit"
                        value="{{ isset($client->credit) ? $client->credit : old('credit') }}" class="form-control" >
                </div>
                <div class="form-group form-material col-sm-6">
                    <label class="form-control-label" for="inputShop">Sucursal</label>
                    <select name="branch_id" id="branch_id" class="form-control">
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-md-12 form-group">
                    <button type="submit" id="submit" name="button" class="btn btn-info">Guardar</button>
                </div>
            </div>
      </div>
    </div>
  </form>
</div>
@section('listado-productos')

<script>
    $(document).ready(function(){

        var clients = {!! $clients !!};
        var ids = {!! $id !!};

        $('#credit').on('input', function() {
            let id = $(this).attr('id');
            let val = $(this).val();
            $(`#${id}`).val(val.replace(/\s+/, ""));
        });

        $('#phone_number').on('input', function() {
            let id = $(this).attr('id');
            let val = $(this).val();
            $(`#${id}`).val(val.replace(/\s+/, ""));
        });

        $('#user-type').change(function() {
            let type = $('#user-type').val();
            if (type == 1) {
                $('#wholesalers').addClass('col-md-12');
                $('#wholesalers').removeClass('d-none');
            } else {
                $('#wholesalers').removeClass('col-md-12');
                $('#wholesalers').addClass('d-none');
            }
        });

        $('#submit').click(function(e) {
            let type = $('#user-type').val();
            let name = $('#name').val();
            let phone = $('#phone_number').val();
            let client = clients.filter(c => c.phone_number == phone)[0];
            let client_phone = clients.filter(c => c.id == ids)[0];
            console.log(client);
            if(client != undefined && client_phone.phone_number != phone)
            {
                Swal.fire(
                    'No permitido',
                    'El telefono que intentas ingresar ya esta registrado con otro cliente',
                    'error'
                );
                e.preventDefault();
                return
            }
            if(client != undefined && ids == 0)
            {
                Swal.fire(
                    'No permitido',
                    'El telefono que intentas ingresar ya esta registrado con otro cliente',
                    'error'
                );
                e.preventDefault();
                return
            }
            if(name.length == '')
            {
                Swal.fire(
                    'No permitido',
                    'Para continuar, ingresa un nombre válido',
                    'error'
                );
                e.preventDefault();
                return
            }

            if(type == 1)
            {
                let first = $('#first_lastname').val();
                let second = $('#second_lastname').val();
                let credit = $('#credit').val();

                if(credit <= 0)
                {
                    Swal.fire(
                        'No permitido',
                        'Para continuar, ingresa un limite de credito válido',
                        'error'
                    );
                    e.preventDefault();
                    return
                }

                if(phone.length != 10)
                {
                    Swal.fire(
                        'No permitido',
                        'Para continuar, ingresa un numero telefonico válido',
                        'error'
                    );
                    e.preventDefault();
                    return
                }

                if(first.length == '')
                {
                    Swal.fire(
                        'No permitido',
                        'Para continuar, ingresa correctamente el apellido paterno',
                        'error'
                    );
                    e.preventDefault();
                    return
                }

                if(second.length == '')
                {
                    Swal.fire(
                        'No permitido',
                        'Para continuar, ingresa correctamente el apellido materno',
                        'error'
                    );
                    e.preventDefault();
                    return
                }

            } else {
                if(phone.length != 10 && phone.length != 0)
                {
                    Swal.fire(
                        'No permitido',
                        'Para continuar, ingresa un numero telefonico válido',
                        'error'
                    );
                    e.preventDefault();
                    return
                }
            }
            $('#form').submit();
        });

    });
</script>
@endsection
@endsection