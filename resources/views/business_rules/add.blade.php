@extends('layout.layoutdas')
@section('title')
ALTA CONFIGURACIÓN DE NEGOCIO
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
      <center><h3>Registrar Configuración</h3></center>
      <br><br>
      <center><h3>Categorias</h3></center>

      <form class="" action="/businessrules" method="post">
      {{ csrf_field() }} 
        <div class="row">

        @foreach($categories as $category)
        <div class="checkbox-custom checkbox-primary col-md-2">
          <input type="checkbox" id="category" name="category_id[]" value="{{$category->id}}">
          <label class="form-control-label">{{$category->name}}</label>
        </div>
        @endforeach
        </div>

        <br>

        <div class="row">
        <div class="col-md-4">
            <label class="form-control-label"> Operador:</label>
            <select class="form-control round" name="operator" required>
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
            </select>
        </div> 

        <div class="form-group form-material col-md-4">
            <label class="form-control-label">Multiplicador:</label>
            <input type="text" class="form-control" name="price" value="{{old('price')}}" required placeholder="4" />
        </div>

        <div class="form-group form-material col-md-4">
            <label class="form-control-label">Porcentaje de Descuento:</label>
            <input type="text" class="form-control" id="discount_percentage" name="discount_percentage" required value="{{old('discount_percentage')}}" placeholder="%" />
        </div>

        <div class="form-group col-md-12">
          <button type="submit" id="save" class="btn btn-primary">Guardar</button>
        </div>

      </form>
    </div>
  </div>
</div>
</div>
@endsection

@section('listado-productos')
<script type="text/javascript">
    $(document).ready(function () {

      $('#save').click(function(e) {
        let discount = $('#discount_percentage').val();
        console.log("Descuento:",discount);

        if(discount < 0 || discount > 50)
        {
          Swal.fire(
              'No permitido',
              'El descuento mínimo es 0 y el máximo es el 50',
              'error'
          );
          e.preventDefault();
          return
        }

      });

    });
</script>
@endsection

