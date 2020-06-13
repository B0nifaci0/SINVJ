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
    <div class="">
      <!-- Panel Basic -->
      <div class="panel">
        <div class="panel-body">
            <div class="example-wrap">
              <h2 class="text-center panel-title">Usuarios</h2>
              <div class="panel-actions float-right">
                <div class="container-fluid row float-right">
                  @if(Auth::user()->type_user == 1 )
                  <!-- Botón para Generar PDF de productos-->
                  <div class="col-6">
                    <button onclick="window.location.href='/usuarios/create'"
                  type="button" class=" btn btn-sm small btn-floating  toggler-left
                  btn-info waves-effect waves-light waves-round float-right"
                  data-toggle="tooltip" data-original-title="Agregar">
                  <i class="icon md-plus" aria-hidden="true"></i>
                </button>
                  </div>
                  <div class="col-6">
                    <button onclick="window.location.href='recibospdf'"
                type="button" class=" btn btn-sm small btn-floating
                toggler-left  btn-danger waves-effect waves-light waves-round float-right"
                data-toggle="tooltip" data-original-title="Generar recibos PDF">
                <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
              </button>
                  </div>
                  <!-- END Botón-->
                  @endif
                </div>
              </div>
            </div>
          </div>
        <div class="panel-body">
          <!-- Tabla para listar usuarios-->
          <table id='usuarios'  class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Email</th>
                <!-- <th>Tienda</th> -->
                <th>Tipo de Usuario</th>
                <th>Sucursal</th>
                <th>Salario</th>
                @if(Auth::user()->type_user == 1 )
                <th>Opciones</th>
                @endif
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Nombre</th>
                <th>Email</th>
                <!-- <th>Tienda</th> -->
                <th>Tipo de Usuario</th>
                <th>Sucursal</th>
                <th>Salario</th>
                <!-- IF Si es Admin Mostrar Opciones,Si es SA y CO no mostar-->
                @if(Auth::user()->type_user == 1 )
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
                  <!-- Definir si la tienda se tiene que mostrar o se puede omitir
                  <td>{{$user->shop->name }}</td> -->
                  @if( $user->type_user == 1 )
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
                    <td>$ {{$user->salary }}</td>
                  @if(Auth::user()->type_user == 1 )
                    <td>
                      <!-- Botón para editar usuario-->
                      <a type="button" href="/usuarios/{{$user->id}}/edit"
                        class="btn btn-icon btn-info waves-effect waves-light waves-round"
                        data-toggle="tooltip" data-original-title="Editar">
                        <i class="icon md-edit" aria-hidden="true"></i></a>

                      <!-- END Botón-->
                      <!-- Botón para eliminar usuario-->
                      <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                        alt="{{$user->id}}" role="button"
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


  <!-- Función Sweet Alert para eliminar categorias-->
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
              url: '/usuarios/' + id,
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
  <!-- END Función-->


<!--Funcíón Sweet Alert para editar usuario-->
@section('editar-usuarios')
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
              window.location.href = '/usuarios/' + id + '/edit';
            }
      });
    });},1000);
  });
</script>
@endsection
<!-- END Función-->

