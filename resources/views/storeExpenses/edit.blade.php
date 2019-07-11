
@extends('layout.layoutdas')
@section('title')
MODIFICACIÓ PRODUCTO
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
      <h2 align="center">Editar Gasto</h2>
      <form id="multiplicar" class="" action="{{route('gastos.update',['id' => $expense->id])}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class='row'>
            <div class="form-group form-material col-md-4">
              <label>Nombre</label>
              <input type="text" class="form-control"value="{{$expense->name}}" name="name">
            </div>
            <div class="form-group form-material col-md-4 ">
              <label>Descripcion</label>
              <input type="text" class="form-control"value="{{$expense->descripcion}}" name="descripcion">
            </div>
            <div class="form-group form-material col-md-6">
                <label>Selecciona imagen del producto</label>
                <br>
                <label for="image" class="btn btn-primary">Explorar</label>
                <input type="file" name="image" id="image" class="hidden" required>
            </div>
            <div class="form-group form-material col-md-6">
              <label>Precio</label>
              <input type="text" class="form-control"value="{{$expense->price}}" name="price">
            </div>
            <div>
              @foreach ($shops as $shop)
              <input type="hidden" name="shop_id" value="{{$shop->id}}">
              @endforeach 
            </div> 
        <div class="form-group col-md-12">
          <button id="submit" type="submit" name="button" class="btn btn-primary">Guardar</button> 
        </div>
      </form>
    </div>
  </div>
</div>
@endsection