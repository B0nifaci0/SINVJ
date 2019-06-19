
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
          <select class="form-control" name="product_id" id="select">
            @foreach($products as $product)            
              <option value="{{ $product->name }}" required>{{ $product->name }}</option>
            @endforeach
          </select><br/><br/>
        <button class="btn btn-primary" onclick="addRow();">Agregar</button><br/><br/>
        </div>


        <div class="panel-body">
        <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
        <thead>
            <tr>
                <th>Producto</th>
            </tr>
            </thead>
              <tfoot>
              <tr>
                <th>Producto</th>
            </tr>
              </tfoot>
              <tr>
                <th>Anillo</th>
            </tr>
        </table>
        
      </form>
    </div>
@endsection

@section('listado-productos')

<script>

function addRow()
            {
                // get input values
                var product_id = document.getElementById('select').value;
                
                  
                  // get the html table
                  // 0 = the first table
                  var table = document.getElementsByTagName('table')[0];
                  
                  // add new empty row to the table
                  // 0 = in the top 
                  // table.rows.length = the end
                  // table.rows.length/2+1 = the center
                  var newRow = table.insertRow(table.rows.length/2+1);
                  
                  // add cells to the row
                  var cel1 = newRow.insertCell(0);
                  
                  // add values to the cells
                  cel1.innerHTML = product_id;
            }
    
  
</script>
@endsection