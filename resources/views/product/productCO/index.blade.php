@extends('layout.layoutdas')
@section('title')
LISTA PRODUCTO
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
  <div class="panel-body">
    @if (session('mesage'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>{{ session('mesage') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    @if (session('mesage-update'))	
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>{{ session('mesage-update') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
	    </div>
		@endif
		@if (session('mesage-delete'))	
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>{{ session('mesage-delete') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
        </button>
	    </div>
		@endif
		<div class="page-content">
      <!-- Panel Basic -->
      <div class="panel">
        <header class="panel-heading">
          <div class="panel-actions">
            <div class="row">
              @if(Auth::user()->type_user == 1 )
                <!-- Botón para generar reporte PDF-->
                <div class="col-md-4 col-md-offset-2">
                  <button onclick="window.location.href='productospdf'" 
                  type="button" class=" btn btn-sm small btn-floating 
                  toggler-left  btn-danger waves-effect waves-light waves-round float-right"
                  data-toggle="tooltip" data-original-title="Generar reporte PDF">
                  <i class="icon fa-file-pdf-o" aria-hidden="true"></i></button>
                </div>
                <!-- END Botón-->
                <!-- Botón para generar Excel-->
                <div class="col-md- col-md-offset-2">
                  <button onclick="window.location.href='#'" 
                    type="button" class=" btn btn-sm small btn-floating 
                    toggler-left  btn-success waves-effect waves-light waves-round float-right"
                    data-toggle="tooltip" data-original-title="Generar reporte Excel">
                    <i class="icon fa-file-excel-o" aria-hidden="true"></i>
                  </button>
                  <!-- END Botón-->
                </div>
              @endif
            </div>
          </div>
          <h3 class="panel-title">Productos</h3>
        </header>
        <div class="panel-body">
          <!-- Tabla para listar productos-->
          <table id='example'  class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
            <thead>
              {{ csrf_field() }}
              <tr>  
                <th>Clave</th>
                <th>Descripción</th>
                <th>Peso</th>
                <th>Observaciónes</th>
                <th>Imagen</th>
                <th>Categoría</th>
                <th>Linea</th>
                <th>Sucursal</th>
                <th>Status</th>
              </tr>
            </thead>
            <tfoot>
             <tr>
                <th>Clave</th>
                <th>Descripción</th>
                <th>Peso</th>
                <th>Observaciónes</th>
                <th>Imagen</th>
                <th>Categoría</th>
                <th>Linea</th>
                <th>Sucursal</th>
                <th>Status</th>
              </tr> 
            </tfoot>
            <tbody>
             @foreach ($products as $i => $product)
              <tr id="row{{$product->id}}">
                 <td>{{ $product->clave }}</td> 
                 <td>{{ $product->description }}</td>
                 <td>{{ $product->weigth }}</td>
                 <td>{{ $product->observations }}</td>
                 <td>
                  @php
                  $image = route('images',"app/public/upload/products/$product->image")
                  @endphp
                  <img width="100px" height="100px" src="{{ $image }}">
                 </td>
                 <td>{{ $product->category->name }}</td>
                 <td>{{ $product->line->name }}</td>
                 <td>{{ $product->branch->name }}</td>
                 <td>{{ $product->status->name }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <!-- END Tabla-->
        </div>
      </div>
    </div>
  </div>
<!-- End Panel Basic -->
@endsection

@section('barcode-product')
<script>
$(document).ready(function() {
        $('#example').dataTable( {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            }
        });
    });
    </script>
@endsection

@section('delete-productos')

@endsection
