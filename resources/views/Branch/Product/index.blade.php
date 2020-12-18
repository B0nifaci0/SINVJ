@extends('layout.layoutdas') @section('title') LISTA DE PRODUCTOS POR SUCURSAL
@endsection @section('nav') @endsection @section('menu') @endsection
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
  <div class="panel">
    <div class="panel-body">
      <div class="example-wrap">
        <h1 class="text-center panel-title">Productos {{$branch->name}} </h1>
        <div class="panel-actions float-right">
          <div class="container-fluid row float-right">
            @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
            <!-- Botón para Generar PDF de productos-->
            @if(Auth::user()->type_user == 1)
            <div class="col-3">
              <button onclick="window.location.href='/sucursal/{{$branch->id}}/productos'" type="button"
                class="btn btn-sm small btn-floating btn-danger waves-effect waves-light waves-round float-right"
                data-toggle="tooltip" data-original-title="Reporte general de productos">
                <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
              </button>
            </div>
            <div class="col-3">
              <button onclick="window.location.href='/sucursal/{{$branch->id}}/productos-gramo'" type="button"
                class="btn btn-sm small btn-floating btn-danger waves-effect waves-light waves-round float-right"
                data-toggle="tooltip" data-original-title="Reporte productos gramo">
                <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
              </button>
            </div>
            <div class="col-3">
              <button onclick="window.location.href='/sucursal/{{$branch->id}}/productos-pieza'" type="button"
                class="btn btn-sm small btn-floating btn-danger waves-effect waves-light waves-round float-right"
                data-toggle="tooltip" data-original-title="Reporte productos pieza">
                <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
              </button>
            </div>
            @endif
            <div class="col-3">
              <button onclick="window.location.href='/productos/create'" type="button"
                class="btn btn-sm small btn-floating btn-info waves-effect waves-light waves-round float-left"
                data-toggle="tooltip" data-original-title="Agregar Nuevo Producto">
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
        <div class="page-content panel-body container-fluid">
          <table id="products" class="table display responsive nowrap" style="width: 100%">
            <thead>
              <tr>
                <th>Clave</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Observaciónes</th>
                <th>status</th>
                <th>Estatus</th>
                <th>Linea</th>
                {{-- <th>Precio compra</th> --}}
                <th>Precio</th>
                <th>Precio descuento</th>
                <th>Opciones</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Example Tabs -->
</div>
@endsection

@section('barcode-product')
<script type="text/javascript">
  //inicializa la tabla para resposnive

  var user = {!! $user !!};
  var branch = {!! $branch !!};

  $(document).ready(() => {
    products = $("#products").DataTable({
      serverSide: true,
      pagingType: "simple",
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
      ajax: "/branch-products/"+ branch.id,
      columns: [
        { data: "clave" },
        { data: "description" },
        { data: "category.name" },
        { data: "observations" },
        { data: "status_id", visible: false },
        {
          data: "status.name",
          render: (data, type, row, meta) => {
            if (row.status_id == 1)
              return `<span class="text-center badge badge-secondary">` + data + `</span>`;
            else if (row.status_id == 2)
              return `<span class="text-center badge badge-success">` + data + `</span>`;
            else if (row.status_id == 3)
              return `<span class="text-center badge badge-primary">` + data + `</span>`;
            else if (row.status_id == 4)
              return `<span class="text-center badge badge-warning">` + data + `</span>`
            else
              return `<span class="text-center badge badge-danger">` + data + `</span>`;
          }
        },
        {
          data: "line.name",
          render: (data) => {
            if (data) return data;
            else return "N/A";
          }
        },
        // { data: "price_purchase" },
        {
          data: "price",
          render: (data) => {
            return '$ ' + data;
          }
        },
        {
          data: "discount",
          render: (data) => {
            return '$ ' + data;
          }
        },
        {
          data: "id",
          render: (data, type, row, meta) => {
            if((user.type_user == 1 || user.type_user == 2) && row.status_id!=1)
            return `<a type="button" href="/productos/` + data + `"
            class="btn btn-icon btn-primary waves-effect waves-light waves-round" data-toggle="tooltip"
            data-original-title="Info producto">
            <i class="icon fa-search" aria-hidden="true"></i></a>
          <a type="button" href="/productos/`+ data + `/edit"
            class="btn btn-icon btn-info waves-effect waves-light waves-round" data-toggle="tooltip" data-original-title="Editar">
            <i class="icon md-edit" aria-hidden="true"></i></a>
          <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete" alt="`+ data + `" role="button"
            data-toggle="tooltip" data-original-title="Borrar">
            <i class="icon md-delete" aria-hidden="true"></i>
          </button>`
          return `<a type="button" href="/productos/` + data + `"
            class="btn btn-icon btn-primary waves-effect waves-light waves-round" data-toggle="tooltip"
            data-original-title="Info producto">
            <i class="icon fa-search" aria-hidden="true"></i></a>`
          }
        },
      ],
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
            url: '/productos/' + id,
            method: 'DELETE',
            success: function (response) {
              if (response.success) {
                products.ajax.reload()
                Swal.fire(
                  'Eliminado',
                  'El registro ha sido eliminado.',
                  'success'
                )
              } else {
                Swal.fire(
                  'No Eliminado',
                  'El producto no ha sido eliminado por que esta activo en un traspaso',
                  'error'
                )
              }
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
<!-- END Función-->