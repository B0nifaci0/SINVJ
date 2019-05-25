
@extends('layout.layoutdas')
@section('title')
ALTA VENTA
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
      <center><h3>Registrate Venta</h3></center>

      <form class="" action="/ventas" method="post">
      {{ csrf_field() }}    
        <div class="form-group col-md-6">
          <label>Nombre Venta:</label>
          <input type="text" class="form-control" value="{{old('date')}}" name="date">

          

        </div>
        <div class="form-group col-md-12">
          <button type="submit" name="button" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
