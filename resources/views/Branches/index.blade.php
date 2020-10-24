@extends('layout.layoutdas')
@section('title')
LISTA DE SUCURSALES
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
  <div class="">
    <div class="panel">
      <div class="panel-body">
        <div class="example-wrap">
          <h1 class="text-center panel-title">Sucursales</h1>
          <div class="panel-actions float-right">
            <div class="container-fluid row float-right">
              @if(Auth::user()->type_user == 1 )
              <div class="col-6">
                <button onclick="window.location.href='/sucursales/create'" type="button"
                  class="btn btn-sm small btn-floating  toggler-left  btn-info waves-effect waves-light waves-round float-left "
                  data-toggle="tooltip" data-original-title="Agregar Sucursal">
                  <i class="icon md-plus" aria-hidden="true"></i></button>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="example-wrap">
        <div class="page-content panel-body container-fluid">
          <table id="branches" class="table display responsive nowrap" style="width: 100%">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Representate Legal</th>
                <th>RFC</th>
                <th>Correo</th>
                <th>Teléfono </th>
                <th>Dirección</th>
                <th>Estado</th>
                <th>Municipio</th>
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
  //inicializa la tabla para resposnive

  var user = {!! $user !!};

  console.log("usuario= " + user.id)

  $(document).ready(() => {
    branches = $("#branches").DataTable({
      serverSide: true,
      pagingType: "simple",
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
      ajax: "branches",
      columns: [
        { data: "name" },
        { data: "name_legal_re" },
        { data: "rfc" },
        { data: "email", },
        { data: "phone_number" },
        { data: "address" },
        { data: "municipality.state.name", },
        { data: "municipality.name" },
        {
          data: "id",
          render: (data, type, row, meta) => {
            if (user.type_user == 1)
              return `<a href="/sucursales/` + data + `/edit"><button type="button"
                class="btn btn-icon btn-primary waves-effect waves-light waves-round" data-toggle="tooltip"
                data-original-title="Editar">
                <i class=" icon md-edit" aria-hidden="true"></i></button></a>
                
                <a href="/sucursales/`+ data + `/producto"><button type="button"
                    class="btn btn-icon btn-warning waves-effect waves-light waves-round" data-toggle="tooltip"
                    data-original-title="Productos">
                    <i class="icon md-label-heart" aria-hidden="true"></i></button></a>

                <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete" alt="`+ data + `" role="button"
                        data-toggle="tooltip" data-original-title="Borrar">
                        <i class="icon md-delete" aria-hidden="true"></i>
                      </button>
                `;
            else
              return `<a href="/sucursales/` + data + `/producto"><button type="button"
                    class="btn btn-icon btn-warning waves-effect waves-light waves-round" data-toggle="tooltip"
                    data-original-title="Productos">
                    <i class="icon md-label-heart" aria-hidden="true"></i></button></a>
                `;
          }
        },
      ],
    });

    $("#branches").on('click', '.delete', function () {
      var id = $(this).attr("alt");
      console.log(id);
      Swal.fire({
        title: 'Confirmación',
        text: "¿Seguro que desea eliminar este registro?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
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
            url: '/sucursales/' + id,
            method: 'DELETE',
            success: function (response) {
              if (response.success) {
branches.ajax.reload()
                Swal.fire(
                  'Eliminado',
                  'El registro ha sido eliminado.',
                  'success'
                );
              } else {
                Swal.fire(
                  'error',
                  response.message
                )
              }
            }
          })
        }
      })
    });
  });
</script>
@endsection