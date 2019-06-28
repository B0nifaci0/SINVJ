
@extends('layout.layoutdas')
@section('title')
ALTA PRODUCTO
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
      <h2 align="center">Nuevo Producto</h2>
      <br>  
      <form class="" action="/productos" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }} 
      <div class='row'>
          <div class="form-group form-material col-md-6">
              <label>Nombre</label>
              <input type="text" class="form-control" name="name"  value="{{old('name')}}" required>
            </div>
            <div class="form-group form-material col-md-6">
              <label>Descripcion</label>
              <input type="text" class="form-control" name="description"  value="{{old('description')}}" required>
            </div>
            <div class="form-group form-material col-md-6">
              <label>Peso</label>
              <input type="text" class="form-control" name="weigth"  value="{{old('weigth')}}" required>
            </div>
            <div class="form-group form-material col-md-6">
              <label>Observaciones</label>
              <input type="text" class="form-control" name="observations"  value="{{old('observations')}}" required>
            </div>
            <div class="form-group form-material col-md-6">
              <label>Precio</label>
              <input type="text" class="form-control" name="price"  value="{{old('price')}}" required>
            </div>
    
              <div class="form-group form-material col-md-6">
                <label>Selecciona imagen del producto</label>
                <br>
                <label for="image" class="btn btn-primary">Explorar</label>
                <input type="file" name="image" id="image" class="hidden" required>
              </div>

           <div class="col-md-6  col-md-offset-1 visible-md visible-lg">
              <label>Categoria</label>
              <select  name="category_id" class="form-control round">
                @foreach($categories as $category)            
                  <option value="{{ $category->id }}" required>{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
    
            <div class="col-md-6  col-md-offset-1 visible-md visible-lg">
              <label>Linea</label>
              <select  name="line_id" class="form-control round">
                @foreach($lines as $line)            
                  <option value="{{ $line->id }}" required>{{ $line->name }}</option>
                @endforeach
              </select>
            </div>
           <div class="col-md-6  col-md-offset-1 visible-md visible-lg">
                <label>Tienda</label>
                <select  name="shop_id" class="form-control round">
                  @foreach($shops as $shop)            
                    <option value="{{ $shop->id }}" required>{{ $shop->name }}</option>
                  @endforeach
                </select>
              </div>
    
            <div class="col-md-6  col-md-offset-1 visible-md visible-lg">
               <label>Sucursal</label>
               <select name="branch_id" class="form-control round">
               @php  
                  $branches = $user->shop->branches;
              
               @endphp
                 @foreach($branches as $branch)
                  <option value="{{ $branch->id }}" required>{{ $branch->name }}</option>
                 @endforeach
               </select>
            </div>
    
           <div class="col-md-6  col-md-offset-1 visible-md visible-lg">
              <label>Status</label>
              <select  name="status_id" class="form-control round">
                @foreach($statuses as $status)            
                  <option value="{{ $status->id }}" required>{{ $status->name }}</option>
                @endforeach
              </select>
            </div>
    <br>
      </div>
      <br>
        <div class="form-group col-md-12">
          <button id="submit" type="submit" name="button" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
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