
@extends('layout.layoutdas')
@section('title')
EDITA VENTA
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
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
      <center><h3> Venta</h3></center>
      <form action="{{ route('ventas.update', ['id' => $sale->id]) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="form-group col-md-6">
          <label>Nombre Venta:</label>
          <input type="text" class="form-control" value="{{$sale->date}}" name="date">
        </div>
        <div class="form-group col-md-12">
          <button type="submit" name="button" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
