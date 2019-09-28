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
  <form autocomplete="off" method="POST" action="/mayoristas">
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
            <h2 class="panel-title">Perfil de {{ $client->name }} {{ $client->first_lastname }} {{ $client->second_lastname }}</h2>
            <h4 class="panel-title">Número telefónico: {{ $client->phone_number }}</h4>
            <div class="row">
                <div class="form-group form-material col-md-6">
                </div>
            </div>
      </div>
    </div>
    <div class="panel">
        <h2 class="panel-title">Historial de compras</h2>
        <div class="panel-body">
            <div class="row">

            </div>
        </div>
    </div>
  </form>
</div>
@endsection