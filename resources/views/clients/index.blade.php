@extends('layout.layoutdas') @section('title') LISTA DE SUCURSALES @endsection
@section('admin-section') @endsection @section('nav') @endsection
@section('menu') @endsection @section('content')
<div class="panel-body">
  @if (session('mesage'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('mesage') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif @if (session('mesage-update'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{ session('mesage-update') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif @if (session('mesage-delete'))
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
          <h1 class="text-center panel-title">Clientes</h1>
          <div class="panel-actions float-right">
            <div class="container-fluid row float-right">
              @if(Auth::user()->type_user == 1 )
              <div class="col-6">
                <button onclick="window.location.href='/clientes/create'" type="button"
                  class="btn btn-sm small btn-floating toggler-left btn-info waves-effect waves-light waves-round float-left"
                  data-toggle="tooltip" data-original-title="Nuevo cliente">
                  <i class="icon md-plus" aria-hidden="true"></i>
                </button>
              </div>
              <!-- END Botón-->
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-12 col-md-12 col-sl">
        <div class="example-wrap">
          <div class="nav-tabs-horizontal" data-plugin="tabs">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" data-toggle="tab" href="#exampleTabsOne" aria-controls="exampleTabsOne"
                  role="tab">Menudeo</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" data-toggle="tab" href="#exampleTabsTwo" aria-controls="exampleTabsTwo"
                  role="tab">Mayoristas</a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                <div class="page-content panel-body container-fluid">
                  <table id="retail" class="table display responsive nowrap" style="width: 100%">
                    {{ csrf_field() }}
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Sucursal</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="exampleTabsTwo" role="tabpanel">
              <div class="page-content panel-body container-fluid">
                <table id="wholesale" class="table display responsive nowrap" style="width: 100%">
                  {{ csrf_field() }}
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Primer apellido</th>
                      <th>Segundo apellido</th>
                      <th>Teléfono</th>
                      <th>Límite de Crédito</th>
                      <th>Sucursal</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('barcode-product')
<script type="text/javascript">
  var user = {!! $user !!};

      console.log("usuario= " + user.id)

      $(document).ready(function () {
        retail = $("#retail").DataTable({
          serverSide: true,
          pagingType: "simple",
          language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
          },
          ajax: "clients/retail",
          columns: [
            { data: "name" },
            {
              data: "phone_number",
              render: function (data) {
                if (data) return data;
                else return "Sin Numero";
              },
            },
            {
              data: "clients.branch.name",
              render: function (data) {
                if (data) return data;
                else return "N/A";
              },
            },
            {
              data: "id",
              render: (data, type, row, meta) => {
                return `<a type="button" href="/clientes/` + data + `"
              class="btn btn-icon btn-primary waves-effect waves-light waves-round" data-toggle="tooltip"
              data-original-title="Info producto">
              <i class="icon fa-search" aria-hidden="true"></i></a>
            <a type="button" href="/clientes/`+ data + `/edit" class="btn btn-icon btn-info waves-effect waves-light waves-round"
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

        wholesale = $("#wholesale").DataTable({
          serverSide: true,
          pagingType: "simple",
          language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
          },
          ajax: "clients/wholesale",
          columns: [
            { data: "name" },
            { data: "first_lastname" },
            { data: "second_lastname" },
            { data: "phone_number" },
            { data: "positive_balance" },
            {
              data: "clients.branch.name",
              render: function (data) {
                if (data) return data;
                else return "N/A";
              },
            },
            {
              data: "id",
              render: (data, type, row, meta) => {
                return `<a type="button" href="/clientes/` + data + `"
                class="btn btn-icon btn-primary waves-effect waves-light waves-round" data-toggle="tooltip"
                data-original-title="Info producto">
                <i class="icon fa-search" aria-hidden="true"></i></a>
              <a type="button" href="/clientes/`+ data + `/edit" class="btn btn-icon btn-info waves-effect waves-light waves-round"
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

        $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
          $($.fn.dataTable.tables(true))
            .DataTable()
            .columns.adjust()
            .responsive.recalc();
        });
      });

      $(document).on('click', '.delete', function () {
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
              url: '/clientes/' + id,
              method: 'DELETE',
              success: function (response) {
                if (response.success) {
                  retail.ajax.reload()
                  wholesale.ajax.reload()
                  Swal.fire(
                    'Eliminado',
                    'El registro ha sido eliminado.',
                    'success'
                  )
                } else {
                    Swal.fire(
                      'No Eliminado',
                      'El cliente no ha sido eliminado porqué esta activo en una venta',
                      'error'
                    ) 
                }
              },
              error: function () {
                Swal.fire(
                  'Eliminado',
                  'El registro no ha sido eliminado.',
                  'error'
                )
              }
            })
          }
        })
      });
</script>
@endsection