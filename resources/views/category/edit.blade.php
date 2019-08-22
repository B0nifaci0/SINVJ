
@extends('layout.layoutdas')
@section('title')
EDITAR CATEGORIA
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
      <center><h3> Categoria</h3></center>
      <form action="{{ route('categorias.update', ['id' => $category->id]) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="row">
          <!-- Input Para editar Nombre de categoria-->
          <div class="form-group form-material col-md-6">
            <label class="form-control-label" for="inputBasicLastName"> Nombre Categoria:</label>
            <input type="text" class="form-control" value="{{$category->name}}" name="name">
          </div>
          <!-- END Input-->
          <!-- Input Para ingresar Type Product-->
          <div class="form-group form-material col-md-6">
            <label class="form-control-label" for="inputBasicLastName"> Tipo De Producto:</label>
              <ul class="list-unstyled list-inline m-0">
                @if($category->type_product == 1)
                <li class="list-inline-item mb-20">
                    <input type="radio" value="{{$category->type_product}}" class="iradio_flat-blue checked hover" id="inputRadiosChecked" name="type_product" data-plugin="iCheck" data-checkbox-class="iradio_flat-blue" checked />
                    <label for="inputColorPrimary">PZS</label>
                </li>
                <li class="list-inline-item mb-20">
                    <input type="radio" value="2" class="iradio_flat-blue checked hover" id="inputColorGreen" name="type_product" data-plugin="iCheck" data-checkbox-class="iradio_flat-blue">
                    <label for="inputColorGreen">GRS</label>
                </li>
                @endif
                @if($category->type_product == 2)
                <li class="list-inline-item mb-20">
                    <input type="radio" value="1" class="iradio_flat-blue checked hover" id="inputRadiosChecked" name="type_product" data-plugin="iCheck" data-checkbox-class="iradio_flat-blue" />
                    <label for="inputColorPrimary">PZS</label>
                </li>
                <li class="list-inline-item mb-20">
                    <input type="radio" value="{{$category->type_product}}" class="iradio_flat-blue checked hover" id="inputColorGreen" name="type_product" data-plugin="iCheck" data-checkbox-class="iradio_flat-blue" checked />
                    <label for="inputColorGreen">GRS</label>
                </li>
                @endif
              </ul>
          </div>
          <!-- END Input-->
          <!-- Botón Para guardar cambios--> 
          <div class="form-group col-md-12">
            <button type="submit" name="button" class="btn btn-primary">Guardar</button>
          </div>
          <!-- END Botón-->
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
