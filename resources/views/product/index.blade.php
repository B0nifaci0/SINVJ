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
		<div class="page-content">
        <!-- Panel Basic -->
    <div class="panel">
      <header class="panel-heading">
        <div class="panel-actions">
          <div class="col-md-14 col-md-offset-2">
            <button onclick="window.location.href='/productos/create'" type="button" class=" btn btn-sm small btn-floating  toggler-left  btn-info waves-effect waves-light waves-round float-right">
             <i class="icon md-plus" aria-hidden="true"></i></button>
          </div>
        </div>
        <h3 class="panel-title">Productos</h3>
      </header>
      <div class="panel-body">
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
              <thead>
					

						<tr>
						      <th>Nombre</th>
                   <th>Pureza</th>
                   <th>Peso</th>
                   <th>Precio</th>
                   <th>Imagen</th>
                   <th>Activación-Admin </th>
                   <th>Opciones</th>
                </tr>
              </thead>
              <tfoot>
              <tr>
							     <th>Nombre</th>
                   <th>Pureza</th>
                   <th>Peso</th>
                   <th>Precio</th>
                   <th>Imagen</th>
                   <th>Activación-Admin </th>
                   <th>Opciones</th>
                </tr>
              </tfoot>
              <tbody>
			<!--	{{ csrf_field() }}
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
											</form>
										<button class="btn btn-xs btn-icon btn-danger delete" alt="<?= $product->id ?>" role="button"  id="confirmacion">
												<i class="icon md-delete" aria-hidden="true"></i>
										</button>


								</div>
							</td>
					</tr>
				@endforeach-->

				@foreach ($products as $product)
                  <tr id = "row{{ $product->id }}">
									<td>{{ $product->name }}</td>
						       <td>{{ $product->purity }}</td>
						       <td>{{ $product->weigth }}</td>
						       <td>{{ $product->price }}</td>
						       <td> 
							@php 
						<td>
              @if($product->deleted_at != null)
               <span class="label label-danger">Desactivado</span>

             @else

               <span class="label label-primary">Activado</span>
            </td>
              @endif
						<td>
										  
                      <a href="/productos/{{$product->id}}/edit"<button type="button" 
                      class="btn btn-icon btn-info waves-effect waves-light waves-round">
                      <i class="icon md-edit" aria-hidden="true"></i></button></a>
                      
                      <a href="{{ route('productos.destroy',$product->id)}}"<button type="button" 
                      onclick="return confirm('¿Seguro que deseas eliminar este registro?')"
                      class="btn btn-icon btn-danger waves-effect waves-light waves-round" >
                      <i class="icon md-delete" aria-hidden="true"></i></button></a>      
                    </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Panel Basic -->

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
