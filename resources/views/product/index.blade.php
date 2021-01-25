@extends('layout.layoutdas') @section('title') TRANSFERENCIAS @endsection
@section('nav') @endsection @section('menu') @endsection @section('content')
<div class="panel-body">
  <div class="">
    <!-- Mesage-Muestra mensaje De que el producto se a agregado exitosamente-->
    @if (session('mesage'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ session('mesage') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    <!-- END Mesage-->
    <!-- Mesage-Muestra mensaje De que el producto se a modificado exitosamente-->
    @if (session('mesage-update'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{ session('mesage-update') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    <!-- END Mesage-->
    <!-- Mesage-Muestra mensaje De que el producto se a eliminado exitosamente-->
    @if (session('mesage-delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>{{ session('mesage-delete') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    <!-- END Mesage-->
    <div class="panel">
      <div class="panel-body">
        <div class="example-wrap">
          <h1 class="text-center panel-title">Productos
            @if ($user->type_user == 1)
            De Tienda
            @else
            {{$user->branch->name}}
            @endif

          </h1>
          <div class="panel-actions float-right">
            <div class="container-fluid row float-right">
            <div class="col-6">
                <button onclick="window.location.href='/Grafico-productos'" type="button" class=" btn btn-sm small btn-floating
                       btn-success waves-effect waves-light waves-round float-left" data-toggle="tooltip"
                  data-original-title="Grafico de Productos">
                  <i class="icon md-chart" aria-hidden="true"></i>
                </button>
              </div>
              @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
              <div class="col-6">
                <button onclick="window.location.href='/productos/create'" type="button" class=" btn btn-sm small btn-floating
                       btn-info waves-effect waves-light waves-round float-left" data-toggle="tooltip"
                  data-original-title="Agregar Nuevo Producto">
                  <i class="icon md-plus" aria-hidden="true"></i>
                </button>
              </div>
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
                  <th>Sucursal</th>
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
</div>
@endsection
@section('barcode-product')
<script type="text/javascript">
  //inicializa la tabla para resposnive

  var user = {!! $user !!};

  console.log("usuario= " + user.id)

  $(document).ready(() => {
    products = $("#products").DataTable({
      serverSide: true,
      pagingType: "simple",
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
      ajax: "products",
      columns: [
        { data: "clave" },
        { data: "description" },
        { data: "category.name" },
        { data: "observations" },
        { data: "branch.name" },
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
            if((user.type_user == 1 || user.type_user == 2) && (row.status_id!=1 && row.status_id!=3))
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
          </button>`;
          return `<a type="button" href="/productos/` + data + `"
                        class="btn btn-icon btn-primary waves-effect waves-light waves-round" data-toggle="tooltip"
                        data-original-title="Info producto">
                        <i class="icon fa-search" aria-hidden="true"></i></a>`;
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
                if(response.cause){
                Swal.fire(
                  'No Eliminado',
                  'El producto no ha sido eliminado por que esta activo en un traspaso',
                  'error'
                )
                }else
                Swal.fire(
                'No Eliminado',
                'El producto no ha sido eliminado por que se encuentra en una venta',
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
  });
</script>
@endsection