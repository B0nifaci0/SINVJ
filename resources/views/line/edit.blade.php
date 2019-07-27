
@extends('layout.layoutdas')
@section('title')
EDITAR LINEA
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
      <center><h3> Linea</h3></center>
      <form action="{{ route('lineas.update', ['id' => $line->id]) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="row">
<<<<<<< HEAD
          <!-- Input para editar precio de linea-->
          <div class="form-group form-material col-md-6">
            <label class="form-control-label" for="inputBasicLastName"> Nombre Linea:</label>
            <input type="text" class="form-control"value="{{$line->name}}" name="name"> 
          </div>
          <!-- END Input--> 
          <!-- Input para editar precio de linea-->
          <div class="form-group form-material col-md-6">
            <label class="form-control-label" for="inputBasicLastName">Precio:</label>
            <input type="text" class="form-control"value="{{$line->price}}" name="price"> 
          </div>
          <!-- END Input-->
          <!-- Botón para guardar cambios-->
          <div class="form-group col-md-12">
           <button type="submit" name="button" class="btn btn-primary">Guardar</button>
          </div>
          <!-- END Botón-->
=======
        <div class="form-group form-material col-md-4">
               <label class="form-control-label" for="inputBasicLastName"> Nombre Linea:</label>
               <input type="text" class="form-control"value="{{$line->name}}" name="name"> 
               </div> 
      <div class="form-group form-material col-md-4">
               <label class="form-control-label" for="inputBasicLastName">Precio Compra:</label>
               <input type="text" class="form-control"value="{{$line->purchase_price}}" name="purchase_price"> 
      </div>
            <div class="form-group form-material col-md-4">
               <label class="form-control-label" for="inputBasicLastName">Precio venta:</label>
               <input type="text" class="form-control" name="sale_price" value="{{old('price')}}" required="required" placeholder="$1200" />
      </div>  


        <div class="form-group col-md-12">
          <button type="submit" name="button" class="btn btn-primary">Guardar</button>
>>>>>>> 837fba63e5f71b5a6f44ff606bc58a87a013f60b
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
