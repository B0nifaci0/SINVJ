@extends('layout.layoutdas') @section('title') LISTA DE GASTOS @endsection
@section('nav') @endsection @section('menu') @endsection @section('content')
<div class="panel-body">
  @if (session('mesage'))
  <div class="alert alert-success">
    <strong>{{ session('mesage') }}</strong>
  </div>
  @endif @if (session('mesage-update'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{ session('mesage-update') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif @if (session('mesage-delete'))
  <div class="alert alert-danger">
    <strong>{{ session('mesage-delete') }}</strong>
  </div>
  @endif
  <div class="">
    <div class="panel">
      <div class="panel-body">
        <div class="example-wrap">
          <h1 class="text-center panel-title">Gastos</h1>
          <div class="panel-actions float-right">
            <div class="container-fluid row float-right">
              <div class="col-6">
                <button onclick="window.location.href='/gastos/create'" type="button"
                  class="btn btn-sm small btn-floating toggler-left btn-info waves-effect waves-light waves-round float-left"
                  data-toggle="tooltip" data-original-title="Nuevo Gasto">
                  <i class="icon md-plus" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="example-wrap">
        <div class="page-content panel-body container-fluid">
          <table id="expenses" class="table display responsive nowrap" style="width: 100%">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Imagen</th>
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
@endsection @section('barcode-product')
<script type="text/javascript">
  var user = {!! $user !!};

  $(document).ready(() => {
    expenses = $("#expenses").DataTable({
      serverSide: true,
      pagingType: "simple",
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
      ajax: "expenses",
      columns: [
        { data: "name" },
        { data: "descripcion" },
        { data: "price" },
        {
          data: "image",
          render: (data, type, row, meta) => {
            return `
          <img class="img-fluid zoom" src="`+ data + `" alt="..." width="200" height="150" />`;
          }
        },
        { data: "branch.name" },
        {
          data: "id",
          render: (data) => {
            return `
          <a type="button" href="/gastos/`+ data + `/edit" class="btn btn-icon btn-info waves-effect waves-light waves-round"
                              data-toggle="tooltip" data-original-title="Editar Gasto">
                              <i class="icon md-edit" aria-hidden="true"></i></a>

                            <a class="btn btn-icon btn-danger waves-effect waves-light" data-toggle="tooltip" data-original-title="Generar Ticket"
                              href="gastopdf/`+ data + `">
                              <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                            </a>

                            <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete" data-toggle="tooltip"
                              data-original-title="Borrar" alt="`+ data + `" role="button">
                              <i class="icon md-delete" aria-hidden="true"></i>
                            </button>`
          }
        }
      ],
    });

    $("#expenses").on('click', '.delete', function () {
      var id = $(this).attr("alt");
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
            url: '/gastos/' + id,
            method: 'DELETE',
            success: function () {
            expenses.ajax.reload()
              Swal.fire(
                'Eliminado',
                'El registro ha sido eliminado.',
                'success'
              )
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