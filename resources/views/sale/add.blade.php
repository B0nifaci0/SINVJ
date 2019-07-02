
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


      {{ csrf_field() }}    
        
          <div class="form-group col-md-6">
          <label>Producto:</label><br/>
          <select id="current_product"  name="id" class="form-control" >
            @foreach($products as $product)            
              <option value="{{ $product->id}}" required>{{ $product->name }}</option>
            @endforeach
          </select><br/>
          


        <button type="button" class="btn btn-primary" id="btn-add">Agregar</button><br/><br/>
        </div>
        <div class="panel-body">
        <table class="table table-hover dataTable table-striped w-full">
        <thead>
        <tr>
            <th>Clave</th>
            <th>Nombre</th>
                 <th>Peso</th>
                 <th>Categoría</th>
                 <th>Linea</th>
                 <th>Sucursal</th>
                 <th>Status</th>
                 <th>Precio</th>
                 <th>Total</th>
              </tr>
            </thead>
              <tbody>
            </tbody>
        </table>
        
      </form>
    </div>
@endsection

@section('listado-productos')

<script>

var products = {!! $products !!};



$(function(){
 $('#btn-add').click(function(){

  var productId = $('#current_product').val();
  console.log(productId);
  var product = products.filter(p => p.id == productId)[0];
  console.log(product);
  /*
   var _id = $('select[name="id"]').val();
   var _name = $('input[name="name"]').val();
   var _weigth = $('input[name="weigth"]').val();
   var _category = $('input[name="category"]').val();
   var _line = $('input[name="line"]').val();
   var _branch = $('input[name="branch"]').val();
   var _status = $('input[name="status"]').val();
   */



  var _tr = '<tr><td>'+ product.id +'</td> <td>'+ product.name +'</td><td>'+ product.weigth +'</td> <td>'+ product.category_id +'</td> <td>'+ product.line_id +'</td> <td>'+ product.branch_id +'</td> <td>'+ product.status_id +'</td> <td>$'+ product.price +'</td><td></td></tr>';

  $('tbody').append(_tr);
});  
});


</script>
@endsection