@extends('layout.layoutdas')
@section('title')
LISTA DE  TIENDAS
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
        <div class="panel-body">
            <div class="example-wrap">
              <h1 class="text-center panel-title">Tiendas</h1>
            </div>
          </div>
        <div class="panel-body">
          <!-- Tabla para listar usuarios-->
          <table id='tiendas'  class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Email</th>
                <th>Télefono</th>
                <th>Status</th>
                @if(Auth::user()->type_user == 0 )
                <th>Opciones</th>
                @endif
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Email</th>
                <th>Télefono</th>
                <th>Status</th>
                @if(Auth::user()->type_user == 0 )
                <th>Opciones</th>
                @endif
              </tr>
            </tfoot>
            <tbody>
              @foreach($shops as $shop)
                <tr id = "row{{$shop->id}}">
                  <td>{{$shop->name }}</td>
                  <td>{{$shop->description }}</td>
                  <td>{{$shop->email }}</td>
                  <td>{{$shop->phone_number}}</td>
                  <td>
                    @if($shop->deleted_at == NULL)
                      <span class="text-center badge badge-success">Activo</span>
                    @else 
                      <span class="text-center badge badge-warning">Inactivo</span>
                    @endif
                  </td>
                  
                 @if(Auth::user()->type_user == 0)
                    <td>
                      <!-- Botón para eliminar usuario-->
                      @if($shop->deleted_at == NULL)
                      <!-- Botón para restaurar usuario eliminado-->
                      <a type="button" href="/tiendas/{{$shop->id}}/delete"
                      class="btn btn-icon btn-danger waves-effect waves-light waves-round fas fa-trash "
                      data-toggle="tooltip"
                      data-original-title="Eliminar"></a>
                      <!-- END Botón-->
            
                      @else
                      <!-- Botón para restaurar Tienda eliminado-->
                      <a type="button" href="/tiendas/{{$shop->id}}/restore"
                      class="btn btn-icon btn-success waves-effect waves-light waves-round fas md-redo"
                      data-toggle="tooltip"
                      data-original-title="Restaurar"></a>
                      <!-- END Botón-->
                      @endif
                      <!-- Botón para Ver sucursales-->
                      <a type="button" href="/tiendas/{{$shop->id}}/sucursales"
                      class="btn btn-icon btn-info waves-effect waves-light waves-round md-store "
                      data-toggle="tooltip"
                      data-original-title="Ver sucursales"></a>
                      <!-- END Botón-->
                      <!-- Botón para Ver sucursales-->
                      <a type="button" href="/tiendas/{{$shop->id}}/usuarios"
                      class="btn btn-icon btn-secondary waves-effect waves-light waves-round fa-user "
                      data-toggle="tooltip"
                      data-original-title="Ver usuarios"></a>
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
    <!-- End Panel Basic -->
  </div>
@endsection

@section('barcode-product')
  <script type="text/javascript">
  //inicializa la tabla para resposnive
    $(document).ready(function(){
        $('#tiendas').DataTable({
            retrieve: true,
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
              .columns.adjust()
              .responsive.recalc();
        });
    });
    </script>
 @endsection


  <!-- Función Sweet Alert para eliminar tiendas--
  @section('delete-productos')
  <script type="text/javascript">
  $(document).ready(function () {
    setTimeout(() => {
   console.log("b")
  $("#tiendas").on('click','.delete',function() {
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
        $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
        });
        $.ajax({
          url:  '/tiendas/' + id,
          method: 'DELETE',
          success: function () {
            $('#tiendas').DataTable()
            .rows('.row' + id)
            .remove()
            .draw();
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
 },500)
});
</script>
  @endsection
  <-- END Función-->



