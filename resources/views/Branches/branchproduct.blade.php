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
          <div class="panel-actions">
              <div class="row">
              <!-- Botón Para generar reporte PDF--> 
                @if(Auth::user()->type_user == 1 )
                <div class="col-md-4 col-md-offset-2">
                  <button onclick="window.location.href='sucursalespdf'" 
                  type="button" class=" btn btn-sm small btn-floating 
                    toggler-left  btn-danger waves-effect waves-light waves-round float-right"
                    data-toggle="tooltip" data-original-title="Generar reporte PDF">
                    <i class="icon fa-file-pdf-o" aria-hidden="true"></i></button>
                </div>
                <!-- END Botón-->
                @endif
              </div>
            </div>
        <h3 class="panel-title">Productos de la sucursal</h3>
      </header>
      <div class="panel-body">
            <!-- Tabla para listar productos por sucursal-->
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
                     @if(Auth::user()->type_user == 1 )
                     <th>Opciones</th>
                     @endif
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
                        @if(Auth::user()->type_user == 1 )
                        <th>Opciones</th>
                        @endif
                </tr>
            </tfoot>
            <tbody>

      @foreach ($products as $branchproduct)
      <tr id="row{{$branchproduct->id}}">

                 <td>{{ $branchproduct->clave }}</td> 
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
                 @if(Auth::user()->type_user == 1 )
                 <td>
                    <!-- Botón Para editar producto por sucursal-->    
                    <a href="/sucursal/{{$branchproduct->id}}/edit"<button type="button"  
                    class="btn btn-icon btn-primary waves-effect waves-light waves-round"
                    data-toggle="tooltip" data-original-title="Editar">
                    <i class=" icon md-edit" aria-hidden="true"></i></button></a>
                    <!-- END Botón-->
                    <!-- Botón Para eliminar producto por sucursal-->
                    <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                        alt="{{ $branchproduct->id }}" role="button"
                        data-toggle="tooltip" data-original-title="Borrar">
                        <i class="icon md-delete" aria-hidden="true"></i>
                    </button>
                    <!-- END Botón-->                   
                  </td>
                  @endif
                </tr>
                @endforeach
            </tbody>
          </table>
          <!-- END Tabla-->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
<!-- Función Sweet Alert Para eliminar producto por sucursal -->
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
      confirmButtonColor: '#d33' ,
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Si, Borralo!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
           headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url:  '/sucursales/' + id,
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
<!-- END Función-->