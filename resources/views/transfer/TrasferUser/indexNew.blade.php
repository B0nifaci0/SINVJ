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
          <h1 class="text-center panel-title">Traspasos de Tienda</h1>
          <div class="panel-actions float-right">
            <div class="container-fluid row float-right">
              @if(Auth::user()->type_user == 1 )
              <!-- Botón para Generar PDF de productos-->
              @if(Auth::user()->type_user == 1)
              <div class="col-6">
                <button onclick="window.location.href='traspasospdf'" type="button"
                  class="btn btn-sm small btn-floating toggler-left btn-danger waves-effect waves-light waves-round float-right"
                  data-toggle="tooltip" data-original-title="Generar reporte PDF">
                  <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                </button>
              </div>
              @endif
              <div class="col-6">
                <button onclick="window.location.href='/traspasosAA/create'" type="button"
                  class="btn btn-sm small btn-floating toggler-left btn-info waves-effect waves-light waves-round float-left"
                  data-toggle="tooltip" data-original-title="Nuevo traspaso">
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
                  role="tab">Entrantes</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" data-toggle="tab" href="#exampleTabsTwo" aria-controls="exampleTabsTwo"
                  role="tab">Salientes</a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                <div class="page-content panel-body container-fluid">
                  <table id="incoming_transfers" class="table display responsive nowrap" style="width: 100%">
                    <thead>
                      <tr>
                        <th>Fecha</th>
                        <th>Clave</th>
                        <th>Peso</th>
                        <th>Categoría</th>
                        <th>Línea</th>
                        <th>S.Origen</th>
                        <th>Quien lo mando</th>
                        <th>S.Destino</th>
                        <th>Quien recibió</th>
                        <th>Status</th>
                        {{-- <th>Opciones</th>
                        <th>Ticket</th> --}}
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="exampleTabsTwo" role="tabpanel">
              <div class="page-content panel-body container-fluid">
                <table id="outgoing_transfers" class="table table-hover dataTable table-striped w-full"
                  data-plugin="dataTable">
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Clave</th>
                      <th>Peso</th>
                      <th>Categoría</th>
                      <th>Línea</th>
                      <th>S.Origen</th>
                      <th>Quien lo mando</th>
                      <th>S.Destino</th>
                      <th>Quien recibió</th>
                      <th>Status</th>
                      <th>Opciones</th>
                      <th>Ticket</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Fecha</th>
                      <th>Clave</th>
                      <th>Peso</th>
                      <th>Categoría</th>
                      <th>Línea</th>
                      <th>S.Origen</th>
                      <th>Quien lo mando</th>
                      <th>S.Destino</th>
                      <th>Quien recibió</th>
                      <th>Status</th>
                      <th>Opciones</th>
                      <th>Ticket</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Example Tabs -->
    </div>
  </div>
</div>
<!-- End Panel Basic -->
<form method="post" action="/traspasos/respuesta" id="form" class="d-none">
  {{ csrf_field() }}
  <input type="text" name="transfer_id" id="transfer_id_r" />
  <input type="text" name="answer" id="answer" />
</form>

<form method="post" action="/traspasos/cancelar" id="give-back" class="d-none">
  {{ csrf_field() }}
  <input type="text" name="transfer_id" id="transfer_id_gb" />
</form>

<form method="post" action="/traspasos/pagar" id="payment-form" class="d-none">
  {{ csrf_field() }}
  <input type="text" name="transfer_id" id="transfer_id_p" />
</form>

@endsection @section('barcode-product')
<script type="text/javascript">
  //inicializa la tabla para resposnive
  $(document).ready(function () {
    $("#incoming_transfers").DataTable({
      serverSide: true,
      ajax: "api/transInt",
      columns: [
        { data: "updated_at" },
        { data: "product.clave"},
        { data: "product.weigth",
                  render: function (data) {
                  if (data) return data;
                  else return "N/A";
                  },
        },
        { data: "product.category.name"},
        { data: "product.line.name",
        render: function (data) {
        if (data) return data;
        else return "N/A";
        },},
        { data: "last_branch.name"},
        { data: "user.name" ,name: 'nameUser'},
        { data: "new_branch.name"},
        { data: "destination_user.name"},
        { data: "id",
          render: function ( data, type, row, meta )
          {
          return "Data 1: " + row.data().status_product + ". Data 2: " + row.data().paid_at ;
          }
        }
      ],
    });

    $("#outgoing_transfers").DataTable({
      retrieve: true,
    });

    $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
      $($.fn.dataTable.tables(true))
        .DataTable()
        .columns.adjust()
        .responsive.recalc();
    });
  });
</script>
@endsection

<!-- Función Sweet Alert para eliminar producto-->

@section('traspaso')
<script>
  $(document).ready(function () {
    $("#incoming_transfers").on("click", ".accept", function () {
      var id = $(this).attr("alt");
      $("#transfer_id_r").val(id);
      $("#answer").val(1);
      $("#form").submit();
    });

    $("#incoming_transfers").on("click", ".reject", function () {
      var id = $(this).attr("alt");
      $("#transfer_id_r").val(id);
      $("#answer").val(0);
      $("#form").submit();
    });
  });
</script>

<script>
  $(document).ready(function () {
    $("#outgoing_transfers").on("click", ".paid", function () {
      let id = $(this).attr("alt");
      console.log("es:", id);
      Swal.fire({
        title: "Confirmación",
        text: "¿Se ha pagado este traspaso?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#4caf50",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
      }).then((result) => {
        if (result.value) {
          $("#transfer_id_p").val(id);
          $("#payment-form").submit();
        }
      });
    });

    $("#outgoing_transfers").on("click", ".give-back", function () {
      let id = $(this).attr("alt");
      Swal.fire({
        title: "Confirmación",
        text: "¿Se ha devuelto este producto?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#4caf50",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
      }).then((result) => {
        if (result.value) {
          $("#transfer_id_gb").val(id);
          $("#give-back").submit();
        }
      });
    });

    $("#outgoing_transfers").on("click", ".cancel", function () {
      var id = $(this).attr("alt");
      $("#transfer_id_r").val(id);
      $("#answer").val(null);
      $("#form").submit();
    });
  });
</script>
@endsection @section('barcode-product')
<script type="text/javascript">
  $("#example").dataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
    },
  });
</script>
@endsection