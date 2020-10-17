@extends('layout.layoutdas') @section('title') LISTA DE VENTAS @endsection
@section('nav') @endsection @section('menu') @endsection @section('content')
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
  @endif
  <div class="">
    <!-- Panel Basic -->
    <div class="panel">
      <div class="panel-body">
        <div class="example-wrap">
          <h1 class="text-center panel-title">Ventas</h1>
          <div class="panel-actions float-right">
            <div class="container-fluid row float-right">
              <!-- Botón para Generar PDF de productos-->
              <div class="col-6">
                <button onclick="window.location.href='ventaspdf'" type="button"
                  class="btn btn-sm small btn-floating toggler-left btn-danger waves-effect waves-light waves-round float-right"
                  data-toggle="tooltip" data-original-title="Generar reporte PDF">
                  <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                </button>
              </div>
              <div class="col-6">
                <button onclick="window.location.href='/ventas/create'" type="button"
                  class="btn btn-sm small btn-floating toggler-left btn-info waves-effect waves-light waves-round float-left"
                  data-toggle="tooltip" data-original-title="Agregar nueva venta">
                  <i class="icon md-plus" aria-hidden="true"></i>
                </button>
              </div>
              <!-- END Botón-->
            </div>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <!-- Tabla para listar ventas-->

        <div class="col-xl-12 col-md-12 col-sl">
          <div class="example-wrap">
            <div class="nav-tabs-horizontal" data-plugin="tabs">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" data-toggle="tab" href="#exampleTabsOne" aria-controls="exampleTabsOne"
                    role="tab">Vendidos</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" data-toggle="tab" href="#exampleTabsTwo" aria-controls="exampleTabsTwo"
                    role="tab">Apartados</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" data-toggle="tab" href="#exampleTabsThree" aria-controls="exampleTabsThree"
                    role="tab">Devueltos</a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                  <div class="page-content panel-body container-fluid">
                    <table id="sale_table_sold" class="table display responsive nowrap" style="width: 100%">
                      <thead>
                        <tr>
                          <th>Fecha</th>
                          <th>Folio</th>
                          <th>Nombre del cliente</th>
                          <th>Tipo</th>
                          <th>Teléfono</th>
                          <th>Total</th>
                          <th>Total Pagado</th>
                          <th>Sucursal</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                    </table>
                    <!-- END Table-->
                  </div>
                </div>
              </div>
              <div class="tab-content">
                <div class="tab-pane" id="exampleTabsTwo" role="tabpanel">
                  <div class="page-content panel-body container-fluid">
                    <!-- Tabla para listar productos-->
                    <table id="sale_table_apart" class="table display responsive nowrap" style="width: 100%">
                      <thead>
                        <tr>
                          <th>Fecha</th>
                          <th>Folio</th>
                          <th>Nombre del cliente</th>
                          <th>Tipo</th>
                          <th>Teléfono</th>
                          <th>Total</th>
                          <th>Total Pagado</th>
                          <th>Sucursal</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-content">
                <div class="tab-pane" id="exampleTabsThree" role="tabpanel">
                  <div class="page-content panel-body container-fluid">
                    <table id="sale_table_givedback" class="table display responsive nowrap" style="width: 100%">
                      <thead>
                        <tr>
                          <th>Fecha</th>
                          <th>Folio</th>
                          <th>Nombre del cliente</th>
                          <th>Tipo</th>
                          <th>Teléfono</th>
                          <th>Total</th>
                          <th>Total Pagado</th>
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
  </div>
</div>
<!-- End Panel Basic -->
@endsection @section('barcode-product')
<script type="text/javascript">
  $(document).ready(function () {
    $("#sale_table_sold").DataTable({
      serverSide: true,
      ajax: "api/sold",
      columns: [
        { data: "updated_at" },
        { data: "folio" },
        { data: "clientName" },
        {
          data: "type",
          render: function (data) {
            if (data == 0) return "Publico";
            else return "Mayorista";
          },
        },
        { data: "phone" },
        { data: "total" },
        { data: "paid_out" },
        { data: "branch" },
        {
          data: "id",
          render: function (data) {
            return (
              `<a href="/ventas/` + data +`"><button type="button" class="btn btn-icon btn-primary waves-effect waves-light" data-toggle="tooltip" data-original-title="Detalle de la Venta"><i class="icon fa-search" aria-hidden="true"></i></button></a>
                <a href="ventapdf/` + data + `"><button type="button" class="btn btn-icon btn-danger waves-effect waves-light" data-toggle="tooltip" data-original-title="Generar reporte PDF"><i class="icon fa-file-pdf-o" aria-hidden="true"></i></button></a>`
            );
          },
        },
      ],
    });

    $("#sale_table_apart").DataTable({
      serverSide: true,
      ajax: "api/apart",
      columns: [
        { data: "updated_at" },
        { data: "folio" },
        { data: "clientName" },
        {
          data: "type",
          render: function (data) {
            if (data == 0) return "Publico";
            else return "Mayorista";
          },
        },
        { data: "phone" },
        { data: "total" },
        { data: "paid_out" },
        { data: "branch" },
        {
          data: "id",
          render: function (data) {
            return (
              `<a href="/ventas/` +data +`"><button type="button" class="btn btn-icon btn-primary waves-effect waves-light" data-toggle="tooltip" data-original-title="Detalle de la Venta"><i class="icon fa-search" aria-hidden="true"></i></button></a>
              <a href="ventapdf/` +data +`"><button type="button" class="btn btn-icon btn-danger waves-effect waves-light" data-toggle="tooltip" data-original-title="Generar reporte PDF"><i class="icon fa-file-pdf-o" aria-hidden="true"></i></button></a>`
            );
          },
        },
      ],
    });

    $("#sale_table_givedback").DataTable({
      serverSide: true,
      ajax: "api/givedback",
      columns: [
        { data: "updated_at" },
        { data: "folio" },
        { data: "clientName" },
        {
          data: "type",
          render: function (data) {
            if (data == 0) return "Publico";
            else return "Mayorista";
          },
        },
        { data: "phone" },
        { data: "total" },
        { data: "paid_out" },
        { data: "branch" },
        {
          data: "id",
          render: function (data) {
            return (
              `<a href="/ventas/` +
              data +
              `"><button type="button" class="btn btn-icon btn-primary waves-effect waves-light"
                data-toggle="tooltip" data-original-title="Detalle de la Venta">
                <i class="icon fa-search" aria-hidden="true"></i></button>
        </a>
        <a href="ventapdf/` +
              data +
              `"><button type="button" class="btn btn-icon btn-danger waves-effect waves-light"
                data-toggle="tooltip" data-original-title="Generar reporte PDF">
                <i class="icon fa-file-pdf-o" aria-hidden="true"></i></button>
        </a>`
            );
          },
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
</script>
@endsection