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
            <button onclick="window.location.href='/productos/create'" 
            type="button" class=" btn btn-sm small btn-floating 
             toggler-left  btn-info waves-effect waves-light waves-round float-right"
             data-toggle="tooltip" data-original-title="Agregar">
             <i class="icon md-plus" aria-hidden="true"></i></button>
          </div>
        </div>
        <h3 class="panel-title">Productos</h3>
      </header>
      <div class="panel-body">
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
            <thead>
            {{ csrf_field() }}

          <tr>  <th>Clave</th>
                <th>Nombre</th>
                 <th>Descripción</th>
                 <th>Peso</th>
                 <th>Observaciónes</th>
                 <th>Imagen</th>
                 <th>Categoría</th>
                 <th>Linea</th>
                 <th>Sucursal</th>
                 <th>Status</th>
                 <th>Opciones</th>
              </tr>
            </thead>
            <tfoot>
            <tr>
            <th>Clave</th>
            <th>Nombre</th>
                 <th>Descripción</th>
                 <th>Peso</th>
                 <th>Observaciónes</th>
                 <th>Imagen</th>
                 <th>Categoría</th>
                 <th>Linea</th>
                 <th>Sucursal</th>
                 <th>Status</th>
                 <th>Opciones</th>
              </tr>
            </tfoot>
            <tbody>

      @foreach ($products as $i => $product)
        <tr id="row{{$product->id}}">
                 <td>{{ $product->id }}</td> 
                <td>{{ $product->name }}</td>
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
                 <td>    
                
                 <a href="/productos/{{$product->id}}/edit"<button type="button" 
                      class="btn btn-icon btn-info waves-effect waves-light waves-round"
                      data-toggle="tooltip" data-original-title="Editar">
                      <i class="icon md-edit" aria-hidden="true"></i></button></a>
                      

                      <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                       alt="{{$product->id}}" role="button" 
                        data-toggle="tooltip" data-original-title="Borrar">
                        <i class="icon md-delete" aria-hidden="true"></i>
                    </button>   

                    <a href="productospdf">
          <button  name="button" class="btn btn-danger">PDF</button>
          </a>
        
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
<!--
@section('edit-categorias')
<script type="text/javascript">
$(document).ready(function(){
  setTimeout(function () {  
    $(".edit").click(function() {
    var id = $(this).attr("alt");
      swal.fire({
        title: 'Confirmación',
        text: "¿Seguro que desea editar este registro?",
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: "#357ebd",
        cancelButtonColor: '#d33',
        confirmButtonText: 'Editar!'
      }).then(
      function(result){
        console.log('entra');
        if(result.value){
          console.log('entraalif');
              window.location.href = '/productos/' + id + '/edit';
            }
      }); 
    });},1000); 
  });
</script>
@endsection-->

@section('delete-productos')
<script type="text/javascript">
console.log("a")
$(document).ready(function() {
  console.log("b")
  $(".delete").click(function() {
    var id = $(this).attr("alt");
    console.log(id);
    Swal.fire({
      title: 'Confirmación',
      text: "¿Seguro que desea eliminar este registro?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Borralo!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
           headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url:  '/productos/' + id,
          method: 'DELETE',
          success: function () {
            $("#row" + id).remove();
            Swal.fire(
              'Eliminado',
              'El registro ha sido eliminado.',
              'success'
            )
          }, 
          error: function () {
            Swal.fire(
              'Eliminado',
              'El registro no ha sido eliminado.'+ id,
              'error'
            )
          }
        })
      }
    })

  });
});

</script>
@endsection
