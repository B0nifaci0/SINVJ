
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
          <label>Fecha de la veta:</label>
          <input type="text" class="form-control" value="{{old('date')}}" name="date">
        
          <label>Folio_ota</label>
          <input type="text" class="form-control" value="{{old('folio_nota')}}" name="folio_nota" required>
          
          <div class="form-group col-md-6">
          <label>Producto</label>
          <select  name="product_id" class="form-control">
            @foreach($products as $product)            
              <option value="{{ $product->id }}" required>{{ $product->name }}</option>
            @endforeach
          </select>
        </div>

        </div>
        <div class="form-group col-md-12">
          <button type="submit" name="button" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
