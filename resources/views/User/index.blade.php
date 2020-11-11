@extends('layout.layoutdas')
@section('title')
LISTA DE USUARIOS
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
          <h1 class="text-center panel-title">Usuarios</h1>
          <div class="panel-actions float-right">
            <div class="container-fluid row float-right">
              @if(Auth::user()->type_user == 1 )
              <!-- Botón para Generar PDF de productos-->
              <div class="col-6">
                <button onclick="window.location.href='/usuarios/create'" type="button" class=" btn btn-sm small btn-floating  toggler-left
                  btn-info waves-effect waves-light waves-round float-right" data-toggle="tooltip"
                  data-original-title="Agregar">
                  <i class="icon md-plus" aria-hidden="true"></i>
                </button>
              </div>
              <div class="col-6">
                <button onclick="window.location.href='recibospdf'" type="button" class=" btn btn-sm small btn-floating
                toggler-left  btn-danger waves-effect waves-light waves-round float-right" data-toggle="tooltip"
                  data-original-title="Generar recibos PDF">
                  <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                </button>
              </div>
              <!-- END Botón-->
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="example-wrap">
        <div class="page-content panel-body container-fluid">
          <table id="users" class="table display responsive nowrap" style="width: 100%">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Tipo de Usuario</th>
                <th>Sucursal</th>
                <th>Salario</th>
                <th>Opciones</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('barcode-product')
<script type="text/javascript">
  $(document).ready(() => {
    users = $("#users").DataTable({
      serverSide: true,
      pagingType: "simple",
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
      ajax: "users",
      columns: [
        { data: "name" },
        { data: "email" },
        {
          data: "type_user",
          render: (data) => {
            if (data == 1)
              return `Administracion`;
            else if (data == 2)
              return `Sub-Administracion`;
            return `Colaborador`;
          }
        },
        {
          data: "branch.name",
          render: (data) => {
            if (data)
              return data;
            return 'N/A';
          }
        },
        {
          data: "salary",
          render: (data) => {
            return '$' + data;
          }
        },
        {
          data: "id",
          render: (data, type, row, meta) => {
            return `<a type="button" href="/usuarios/` + data + `/edit" class="btn btn-icon btn-info waves-effect waves-light waves-round"
            data-toggle="tooltip" data-original-title="Editar">
            <i class="icon md-edit" aria-hidden="true"></i></a>
          
          <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete" alt="`+ data + `" role="button"
            data-toggle="tooltip" data-original-title="Borrar">
            <i class="icon md-delete" aria-hidden="true"></i>
          </button>`;
          }
        },
      ],
    });

    $('#users').on('click', '.delete', function () {
      var id = $(this).attr("alt");
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
            users.ajax.reload()
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
  });
</script>
@endsection