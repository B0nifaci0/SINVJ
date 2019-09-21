@extends('layout.layoutdas')
@section('title')
ALTA LíNEAS
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="panel-body">
@if (session('mesage'))
<div class="alert alert-success">
      <strong>{{ session('mesage') }}</strong>
    </div>
  @endif
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
      <center><h3>Creación de inventario</h3></center>

      <form class="" action="/inventarios" method="post">
      {{ csrf_field() }}
      <div class="row">
        <div class="form-group col-md-12">
        @if($date)
            <button type="submit" name="button" class="mx-auto d-block btn btn-lg btn-primary">Crear inventario de {{ $date }}</button>
        @else
            <h4>El inventario de hoy ya ha sido creado</h4>        
        @endif
        </div>
      </form>
    </div>
  </div>
</div>
</div>
@endsection