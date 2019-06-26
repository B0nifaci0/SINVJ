
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
          <select  name="id" class="form-control" >
            @foreach($products as $product)            
              <option value="{{ $product->id}}" required>{{ $product->id }}</option>
            @endforeach
          </select><br/>
          
          <input type="hidden" name="name" value="{{ $product->name}}"> 
          <input type="hidden" name="weigth" value="{{ $product->weigth}}">
          <input type="hidden" name="category" value="{{ $product->category->name}}">
          <input type="hidden" name="line" value="{{ $product->line->name}}">
          <input type="hidden" name="branch" value="{{ $product->branch->name}}">
          <input type="hidden" name="status" value="{{ $product->status->name}}">

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

$(function(){
 $('#btn-add').click(function(){
   var _id = $('select[name="id"]').val();
   var _name = $('input[name="name"]').val();
   var _weigth = $('input[name="weigth"]').val();
   var _category = $('input[name="category"]').val();
   var _line = $('input[name="line"]').val();
   var _branch = $('input[name="branch"]').val();
   var _status = $('input[name="status"]').val();
   
var _tr = '<tr><td>'+ _id +'</td> <td>'+ _name +'</td><td>'+ _weigth +'</td> <td>'+ _category +'</td> <td>'+ _line +'</td> <td>'+ _branch +'</td> <td>'+ _status +'</td> </tr>';

$('tbody').append(_tr);
});  
});


</script>
@endsection