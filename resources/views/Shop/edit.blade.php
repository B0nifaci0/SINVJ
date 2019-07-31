
@extends('layout.layoutdas')
@section('title')
MODIFICACIÓN TIENDA
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
      <h2 align="center">Editar Tienda</h2>
      <form id="multiplicar" class="" action="{{route('tiendas.update',['id' => $shop->id])}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class='row'>
            <div class="form-group form-material col-md-6">
                <label>Nombre</label>
                <input type="text" class="form-control" name="name"  value="{{$shop->name}}" required>
            </div>
            <div class="form-group form-material col-md-6">
                    <label>Descripcion</label>
                    <input type="text" class="form-control" name="description"  value="{{$shop->description}}" required>
                </div>
                <div class="form-group form-material col-md-6">
                        <label>Correo</label>
                        <input type="text" class="form-control" name="email"  value="{{$shop->email}}" required>
                    </div>
                    <div class="form-group form-material col-md-6">
                            <label>Telefono</label>
                            <input type="text" class="form-control" name="phone_number"  value="{{$shop->phone_number}}" required>
                        </div>
            <div class="form-group form-material col-md-6">
              <label>Selecciona imagen del producto</label>
              <br>
              <label for="image" class="btn btn-primary">Explorar</label>
              <input type="file" name="image" id="image" class="hidden" required>
            </div> 
          <br>
          <div>
            <br>
        <div class="form-group col-md-12">
          <button id="submit" type="submit" name="button" class="btn btn-primary">Guardar</button> 
        </div>
      </form>
    </div>
  </div>
</div>
@endsection