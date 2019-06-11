
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
      <h2>Nuevo producto</h2>
      <form class="" action="{{route('productos.update',['id' => $product->id])}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="form-group col-md-6">
          <label>Nombre</label>
          <input type="text" class="form-control" name="name"  value="{{$product->name}}" required>
        </div>
        <div class="form-group col-md-6">
          <label>Descripcion</label>
          <input type="text" class="form-control" name="description"  value="{{$product->description}}">
        </div>
        <div class="form-group col-md-6">
          <label>Peso</label>
          <input type="text" class="form-control" name="weigth"  value="{{$product->weigth}}">
        </div>

        <div class="form-group col-md-6">
          <label>Observaciónes</label>
          <input type="text" class="form-control" name="observations"  value="{{$product->observations}}">
        </div>
        <div class="form-group col-md-6">
          <label>Precio</label>
          <input type="text" class="form-control" name="price"  value="{{$product->price}}">
        </div>

        <div class="form-group col-md-6">
          <label>Imagen:</label><br>
          <label for="file" class="btn btn-info">Seleccionar imagen</label>
          <input id="file" class="hidden" type="file" name="image" required>
          <div class="form-group col-md-6">
							@php
              $image = route('images',"app/public/upload/products/$product->image")
							@endphp
							<img width="100px" height="100px" src="{{ $image }}">
        </div>

        <div class="form-group col-md-6">
          <label>Categoria</label>
          <select id="categories" name="category_id" class="form-control">
                      @foreach($categorys as $category)
            <option value="">Seleccione uno</option>
              <option value="{{$product->category_id}}">{{$category->name}}</option>
                @endforeach
          </select>
        </div>
        <div class="form-group col-md-6">
          <label>Lineas</label>
          <select id="lines" name="line_id" class="form-control">
                      @foreach($lines as $line)
            <option value="">Seleccione uno</option>
              <option value="{{$product->line_id}}">{{$line->name}}</option>
                @endforeach
          </select>
        </div>

        <div class="form-group col-md-6">
          <label>Tienda</label>
          <select id="shop" name="shop_id" class="form-control">
                      @foreach($shops as $shop)
            <option value="">Seleccione uno</option>
              <option value="{{$product->shop_id}}">{{$shop->name}}</option>
                @endforeach
          </select>
        </div>
 
        <div class="form-group col-md-6">
          <label>Sucursal</label>
          <select id="brach" name="branch_id" class="form-control">
                      @foreach($branches as $branch)
            <option value="">Seleccione uno</option>
              <option value="{{$product->branch_id}}">{{$branch->name}}</option>
                @endforeach
          </select>
        </div>

        <div class="form-group col-md-6">
          <label>Status</label>
          <select id="status" name="status_id" class="form-control">
                      @foreach($statuses as $status)
            <option value="">Seleccione uno</option>
              <option value="{{$product->status_id}}">{{$status->name}}</option>
                @endforeach
          </select>
        </div>

        <div class="form-group col-md-12">
          <button id="submit" type="submit" name="button" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
  alert('hola mundo si entro');
  $("#categories").change(function(){
    if ($(this).val() == "" || $("#file").val() == "") {
      $("#submit").prop("disabled", true);
    }else{
      $("#submit").prop("disabled", false);
    }
  });

  $("#file").change(function(){
    if ($("#categories").val() == "" || $(this).val() == "") {
      $("#submit").prop("disabled", true);
    }else{
      $("#submit").prop("disabled", false);
    }
  });

  $("#file").change(function(){
    $("#preview-box").attr("class", "");
    render(this);
    $("#image_name").html($(this).val().split("\\").pop());
  });

  function render(image) {
    if (image.files && image.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#preview").attr("src", e.target.result);
      }
    reader.readAsDataURL(image.files[0]);
    }
  }

});
</script>
@endsection
