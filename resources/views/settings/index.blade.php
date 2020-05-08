@extends('layout.layoutdas')
@section('title')
LISTA DE LINEA
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
    <!-- Panel Basic -->
    <div class="panel">
      <div class="panel-body">
        <div class="example-wrap">
          <h2 class="text-center panel-title">Límite de dias para la recolección de productos apartados</h2>
          <div class="panel-actions float-right">
            <div class="container-fluid row float-right">
              @if(Auth::user()->type_user == 1 )
              <!-- Botón para Generar PDF de productos
                  <div class="col-6">
                    <button onclick="window.location.href='lineaspdf'"
                    type="button" class=" btn btn-sm small btn-floating
                    toggler-left  btn-danger waves-effect waves-light waves-round float-right"
                    data-toggle="tooltip" data-original-title="Generar reporte PDF">
                    <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                  </button>
                  </div>-->
              <div class="col-6">
                <button onclick="window.location.href='/ajustes/create'" type="button" class=" btn btn-sm small btn-floating
                    toggler-left  btn-info waves-effect waves-light waves-round float-left" data-toggle="tooltip"
                  data-original-title="Agregar">
                  <i class="icon md-plus" aria-hidden="true"></i>
                </button>
              </div>
              <!-- END Botón-->
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <!-- Tabla para listar lineas-->
        <table id='table_setting' class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
          <thead>
            <th>Minimo de dias</th>
            <th>Maximo de dias</th>
          </thead>
          @foreach($setting as $s)
          <tbody>
            <td>{{$s->min_day_re}}</td>
            <td>{{$s->max_day_re}}</td>
          </tbody>
          @endforeach
          <tfoot>
            <th>Minimo de dias</th>
            <th>Maximo de dias</th>
          </tfoot>
        </table>
        <!-- END Tabla-->
      </div>
    </div>
  </div>
</div>
</div>
@endsection

@section('barcode-product')
<script type="text/javascript">
    //inicializa la tabla para resposnive
    $(document).ready(function(){
        $('#table_setting').DataTable({
            retrieve: true,
            //  responsive: true,
            //paging: false,
            //searching: false
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
              .columns.adjust()
              .responsive.recalc();
        });
    });
</script>
@endsection