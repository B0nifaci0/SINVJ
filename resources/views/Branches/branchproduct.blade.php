@extends('layout.layoutdas')
@section('title')
LISTA DE PRODUCTOS POR SUCURSAL
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
  <div class="panel-body">
	<div class="page-content">
        <!-- Panel Basic -->
    <div class="panel">
      <header class="panel-heading">
        <h3 class="panel-title">Productos de la sucursal</h3>
      </header>
      <div class="panel-body">
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
            <thead>
            {{ csrf_field() }}
               <tr>  
                     <th>Clave</th>
                     <th>Nombre</th>
                     <th>Descripción</th>
                     <th>Peso</th>
                     <th>Observaciónes</th>
                     <th>Precio</th>
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
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Peso</th>
                        <th>Observaciónes</th>
                        <th>Precio</th>
                        <th>Imagen</th>
                        <th>Categoría</th>
                        <th>Linea</th>
                        <th>Sucursal</th>
                        <th>Status</th>
                </tr>
            </tfoot>
            <tbody>

      @foreach ($products as $branchproduct)
      <tr id="row{{$branchproduct->id}}">

                 <td>{{ $branchproduct->id }}</td> 
                 <td>{{ $branchproduct->name }}</td>
                 <td>{{ $branchproduct->description }}</td>
                 <td>{{ $branchproduct->weigth }}</td>
                 <td>{{ $branchproduct->observations }}</td>
                 <td>{{ $branchproduct->price }}</td>
                 
                  <td>
							@php
              $image = route('images',"app/public/upload/products/$branchproduct->image")
							@endphp
							<img width="100px" height="100px" src="{{ $image }}">
						</td>
                 <td>{{ $branchproduct->category->name }}</td>
                 <td>{{ $branchproduct->line->name }}</td>
                 <td>{{ $branchproduct->branch->name }}</td>
                 <td>{{ $branchproduct->status->name }}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection