@extends('layout.layoutdas')
@section('title')
SUCURSAl
@endsection

@section('nav')
@endsection
@section('menu')

@endsection
@section('content')

<div class="page-content">
  <div class="panel panel-info panel-bordered" data-plugin="appear" data-animate="fade">
    <header class="panel-heading">
      <div class="panel-actions">
        <a href="/productos/{{$product->id}}/edit">
          <button class="btn-raised btn btn-primary btn-floating btn-sm" data-toggle="tooltip" data-original-title="Editar">
            <i class="icon md-edit" aria-hidden="true"></i>
          </button>
        </a>
      </div>
      <h3 class="panel-title">Productos</h3>
    </header>
      <div class="table-responsive container-fluid">
				<div class="panel-body">
			    <table class="table table-hover">
						<tbody>
								<tr>
									<td> <strong>Nombre</strong></td>
									<td>{{$product->name}}</td>
								</tr>
                <tr>
                  <td> <strong>Descripción</strong></td>
                  <td>{{$product->description}}</td>
                </tr>
								<tr>
									<td> <strong>kt</strong></td>
									<td>{{ $product->purity }}</td>
								</tr>
                	<tr>
									<td> <strong>Imagen</strong></td>
                  	@php
									$route = asset("storage/upload/products/$product->image");
								@endphp
                  	<td><img width="120px" height="80px" src="{{ $route }}">
                    </td>
								</tr>
								<tr>
									<td> <strong>Peso</strong></td>
									<td>{{ $product->weigth }}</td>
								</tr>
                	<tr>
									<td> <strong>Precio</strong></td>
									<td>{{ $product->price }}</td>
                  	<tr>

								</tr>
                	<tr>

								</tr>
								</tr>
						</tbody>
					</table>
				</div>
      </div>
  </div>
</div>
@endsection
