@extends('layout.layoutdas')
@section('title')
LISTA DE  USUARIOS
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
              <h1 class="text-center panel-title">Usuarios</h1>
            </div>
          </div>
        <div class="panel-body">
          <!-- Tabla para listar usuarios-->
          <table id='usuarios'  class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Tienda</th>
                <th>Tipo de Usuario</th>
                <th>Sucursal</th>
                <th>Status</th>
                @if(Auth::user()->type_user == 0 )
                <th>Opciones</th>
                @endif
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Tienda</th>
                <th>Tipo de Usuario</th>
                <th>Sucursal</th>
                <th>Status</th>
                <!-- IF Si es Admin Mostrar Opciones,Si es SA y CO no mostar-->
                @if(Auth::user()->type_user == 0 )
                 <th>Opciones</th>
                @endif
                <!--END-IF -->
              </tr>
            </tfoot>
            <tbody>
              @foreach($users as $user)
                <tr id = "row{{$user->id}}">
                  <td>{{$user->name }}</td>
                  <td>{{$user->email }}</td>
                  <td>{{$user->shop->name }}</td>
                  @if( $user->type_user == 1  || $user->type_user == 0 )
                    <td>Administracion</td>
                  @endif
                  @if($user->type_user  == 2)
                    <td>Sub-Administracion</td>
                  @endif
                  @if($user->type_user == 3)
                    <td>Colaborador</td>
                  @endif
                  @if($user->branch_id == '')
                    <td>Sin sucursal es Administrador</td>
                  @endif
                  @if($user->branch_id != 0)
                    <td>{{$user->branch->name}}</td>
                  @endif
                    <td>
                  @if($user->deleted_at == NULL)
                      <span class="text-center badge badge-success">Activo</span>
                  @elseif($user->deleted_at == !NULL)
                      <span class="text-center badge badge-warning">Inactivo</span> 
                  @endif 
                    </td>
                  @if(Auth::user()->type_user == 0 )
                    <td>
                      <!-- Botón para eliminar usuario-->
                      @if($user->deleted_at == NULL)
                      <!-- Botón para restaurar usuario eliminado-->
                      <a type="button" href="/usuarios/{{$user->id}}/delete"
                      class="btn btn-icon btn-danger waves-effect waves-light waves-round fas fa-trash"
                      data-toggle="tooltip"
                      data-original-title="Eliminar"></a>
                      <!-- END Botón-->
                      <!--fin boton-->
                      @else
                      <!-- Botón para restaurar usuario eliminado-->
                      <a type="button" href="/usuarios/{{$user->id}}/restore"
                      class="btn btn-icon btn-success waves-effect waves-light waves-round fas md-redo"
                      data-toggle="tooltip"
                      data-original-title="Restaurar"></a>
                      <!-- END Botón-->
                      @endif
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
        $('#usuarios').DataTable({
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


  <!-- Función Sweet Alert para eliminar categorias--
  @section('delete-productos')
  <script type="text/javascript">
  $(document).ready(function () {
  setTimeout(() => {
    console.log("config datatable")
    $('#usuarios').on('click', '.delete', function(){
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
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              }
            });
            $.ajax({
              url: '/Super-admin-users/' + id,
              method: 'DELETE',
               success: function () {
                $('#usuarios').DataTable()
                .rows('.row' + id)
                .remove()
                .draw();
                Swal.fire(
                  'Eliminado',
                  'El registro ha sido eliminado.',
                  'success'
                );
              },
              error: function () {
                Swal.fire(
                  'Eliminado',
                  'El registro no ha sido eliminado.' + id,
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



