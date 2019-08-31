@extends('layout.layoutdas')
@section('title')
LISTA DE  SUCURSALES
@endsection

@section('admin-section')
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
          @if(Auth::user()->type_user == 1 )
          <div class="col-md-14 col-md-offset-2">
            <button onclick="window.location.href='/sucursales/create'" type="button" class="btn btn-sm small btn-floating  toggler-left  btn-info waves-effect waves-light waves-round float-right " data-toggle="tooltip" data-original-title="Agregar">
             <i class="icon md-plus" aria-hidden="true"></i></button>
          </div>
           @endif
        </div>
        <h3 class="panel-title">Sucursales</h3>
      </header>
      <div class="panel-body">
            <!-- Tabla para listar sucursales-->
            <table id='example'  class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
              <thead>
                <tr>
                 <!-- <th>Id</th> -->
                  <th>Nombre</th>
                 <!-- <th>Tienda</th> -->
                  <th>Opciones</th>
                </tr>
              </thead>
              <tfoot>
              <tr>
                  <!-- <th>Id</th> -->
                  <th>Nombre</th>
                  <!-- <th>Tienda</th> -->
                  <th>Opciones</th>
                </tr>
              </tfoot>
              <tbody>
                  @foreach ($branches as $branch)
                  <tr id = "row{{$branch->id}}">
                    <!-- <td>{{$branch->id}}</td>  -->
                    <td>{{$branch->name }}</td>
                      <!-- <td>{{$branch->shop->name }}</td> -->
                    <td>  
                    @if(Auth::user()->type_user == 1 ) 
                      <!-- Botón para editar sucursal--> 
                      <a href="/sucursales/{{$branch->id}}/edit"<button type="button" 
                      class="btn btn-icon btn-primary waves-effect waves-light waves-round"
                      data-toggle="tooltip" data-original-title="Editar">
                      <i class=" icon md-edit" aria-hidden="true"></i></button></a>
                      <!--END Botón -->  
                      <!-- Botón para borrar sucursal-->
                      <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                        alt="{{$branch->id}}" role="button"
                        data-toggle="tooltip" data-original-title="Borrar">
                        <i class="icon md-delete" aria-hidden="true"></i>
                      </button> 
                      <!--END Botón -->  
                      @endif
                      <!-- Botón para ver productos por sucursal-->
                      <a href="/sucursales/{{$branch->id}}/producto" type="button" 
                      class="btn btn-icon btn-warning waves-effect waves-light waves-round"
                      data-toggle="tooltip" data-original-title="Productos">
                      <i class="icon md-label-heart" aria-hidden="true"></i></button></a> 
                      <!--END Botón --> 
                      <!-- Botón para ver corte de venta -->
                      <a href="/sucursales/{{$branch->id}}/corte" type="button" 
                      class="btn btn-icon  waves-effect waves-light waves-ligth 
                      data-toggle="tooltip" data-original-title="Productos">
                      <i class="icon md-money" aria-hidden="true"></i></button></a> 
                      <!--END Botón -->                
                      <!-- Botón para ver corte de venta -->
                      <a href="/sucursales/{{$branch->id}}/inventario" type="button" 
                      class="btn btn-icon btn-success  waves-effect waves-light waves-ligth 
                      data-toggle="tooltip" data-original-title="Productos">
                      <i class="icon md-check" aria-hidden="true"></i></button></a> 
                      <!--END Botón -->                
                    </td> 
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
<!-- Función Sweet Alert para eliminar sucursal-->
@section('delete-sucursales')
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
      if (result.value) 
      {
        $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
        });
        $.ajax({
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
<!--END Función-->

@section('barcode-product')
@endsection