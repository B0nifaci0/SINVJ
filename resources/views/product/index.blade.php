@extends('layout.layoutdas')
@section('title')
LISTAPRODUCTO
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
			@if (session('mesage-update'))
	<div class="alert alert-warning">
				<strong>{{ session('mesage-update') }}</strong>
			</div>
		@endif
			@if (session('mesage-delete'))
	<div class="alert alert-danger">
				<strong>{{ session('mesage-delete') }}</strong>
			</div>
		@endif
		<div class="panel panel-info panel-bordered" data-plugin="appear" data-animate="fade">
      <header class="panel-heading">
        <div class="panel-actions">
          <a href="/productos/create">
            <button class="btn-raised btn btn-primary btn-floating btn-sm" data-toggle="tooltip" data-original-title="Agregar">
            <i class="icon md-plus" aria-hidden="true"></i>
            </button>
          </a>
        </div>
        <h3 class="panel-title">Lista de Productos</h3>
      </header>
  <!-- Panel Filtering -->
  <div class="row">
  	<div class="page-content">
		 <div class="col-md-12 container-fluid">
		 <table class="table table-bordered table-hover toggle-circle" id="exampleFootableFiltering">
				<thead>
					<tr>
						<th data-toggle="true">clave</th>
						<th data-hide="phone, tablet">Nombre</th>
						<th data-hide="phone, tablet">Pureza</th>
						<th data-hide="phone, tablet">Peso</th>
						<th data-hide="phone, tablet">Precio</th>
						<th data-hide="phone, tablet">Imagen</th>
            <th data-hide="phone, tablet">Activación-Admin </th>
						<th data-hide="phone, tablet">Opciones</th>
					</tr>
				</thead>
				<div class="form-inline padding-bottom-15">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<select id="filteringStatus" class="form-control" style="visibility:hidden">
									<option value="">Todos</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6 text-right">
							<div class="form-group">
								<input id="filteringSearch" type="text" placeholder="Busqueda" class="form-control"
									autocomplete="off">
							</div>
						</div>
					</div>
				</div>
				<tbody>
				@foreach ($products as $i => $product)
					<tr id="row{{$product->id}}">
						<td class="">{{ $product->id }}</td>
						<td>{{ $product->name }}</td>
						<td>{{ $product->purity }}</td>
						<td>{{ $product->weigth }}</td>
						<td>{{ $product->price }}</td>
						<td>
							@php
              $image = route('images',"app/public/upload/products/$product->image")
							@endphp
							<img width="100px" height="100px" src="{{ $image }}">
						</td>
						<td>
              @if($product->deleted_at != null)
               <span class="label label-danger">Desactivado</span>

             @else

               <span class="label label-primary">Activado</span>
            </td>
              @endif
             <td>
						  <a href="/productos/{{$product->id}}"<button type="button" class="btn btn-xs btn-icon btn-default"><i class="icon md-search" aria-hidden="true"></i></button></a>
              @if($product->deleted_at != null)
										<a href="/productos/{{$product->id}}/edit" <button type="button" disabled="disabled" class="btn btn-xs btn-icon btn-info edit"><i class="icon md-edit" aria-hidden="true" ></i></button></a>
                    @else
                    <a href="/productos/{{$product->id}}/edit"<button type="button" class="btn btn-xs btn-icon btn-info edit"><i class="icon md-edit" aria-hidden="true"></i></button></a>
                    @endif
                      <!-- <form class="" action="{{route('productos.destroy',['id' => $product->id])}}" method="post">
                      {{csrf_field()}}
                      {{method_field('DELETE')}}
											</form>-->
										<button class="btn btn-xs btn-icon btn-danger delete" alt="<?= $product->id ?>" role="button"  id="confirmacion">
												<i class="icon md-delete" aria-hidden="true"></i>
										</button>


								</div>
							</td>
					</tr>
				@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td colspan="8">
							<div class="text-right">
								<ul class="pagination"></ul>
							</div>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
	</div>
@endsection

<section>
@section('delproduct')
<script type="text/javascript">
$(".delete").click(function() {
   var id = $(this).attr("alt");
	 alert(id);
   alertify.confirm("¿Seguro que desea eliminar este registro?",
     function (e) {
     if (e) {
       $.ajax({
         method: 'DELETE',
         url: '/productos/' + id,
         success: function(){
           $("#row" + id).remove();
           alertify.success("Se ha <strong>eliminado</strong> el registro" + id);
         },
         error: function(){
           alertify.error("<strong>Ha ocurrido un error en la eliminación</strong>");
         }
       });
     }
  });
});
</script>
@endsection
