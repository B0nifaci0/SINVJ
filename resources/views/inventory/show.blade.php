@extends('layout.layoutdas')
@section('title')
LISTA DE  LINEA
@endsection

@section('admin-section')
@endsection
@section('nav')

@endsection
@section('menu')

@endsection 
@section('content')
<div class="panel-body">
    <div class="page-content">
      <!-- Panel Basic -->
      <div class="panel">  
        <header class="panel-heading">
          <div class="panel-actions">
            <div class="row">
              @if(Auth::user()->type_user == 1 )
                <!-- Botón para generar PDF de linea-->
                <div class="col-md-4 col-md-offset-2">
                  <button onclick="window.location.href='inventariospdf'" 
                    type="button" class=" btn btn-sm small btn-floating 
                    toggler-left  btn-danger waves-effect waves-light waves-round float-right"
                    data-toggle="tooltip" data-original-title="Generar reporte PDF">
                    <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                  </button>
                </div>  
                <!-- END Botón-->
                <!-- Botón para generar Excel de linea-->
                <div class="col-md-4 col-md-offset-2">
                  <button onclick="window.location.href='#'" 
                    type="button" class=" btn btn-sm small btn-floating 
                    toggler-left  btn-success waves-effect waves-light waves-round float-right"
                    data-toggle="tooltip" data-original-title="Generar reporte Excel">
                    <i class="icon fa-file-excel-o" aria-hidden="true"></i>
                  </button>
                </div>
                <!-- END Función--><!-- Función Sweet Alert para eliminar linea-->
<!-- END Función-->
                <!-- Botón para crear linea-->
                <div class="col-md-4 col-md-offset-2">
                  <button onclick="window.location.href='/inventarios/create'" 
                    type="button" class=" btn btn-sm small btn-floating 
                    toggler-left  btn-info waves-effect waves-light waves-round float-right"
                    data-toggle="tooltip" data-original-title="Agregar">
                    <i class="icon md-plus" aria-hidden="true"></i>
                  </button>
                </div>
                <!-- END Botón-->
              @endif
            </div>
          </div>
          <h3 class="panel-title">Inventarios</h3>
        </header>
        <div class="panel-body">
        <!-- Tabla para listar inventarios-->
          <table id='example'  class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
            <thead>
              <tr>
                <th>Clave</th>
                <th>Producto</th>
                <th>Status</th>
                <th>Operaciones</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Clave</th>
                <th>Producto</th>
                <th>Status</th>
                <th>Opciones</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($inventory->products as $item)
                <tr id = "row{{ $inventory->id }}">
                  <td>{{$item->clave}}</td>
                  <td>{{ $item->description }}</td>
                  <td>
                    @if( $item->status === null )
                        Pendiente
                    @elseif( $item->status === 1)
                        Listado
                    @elseif( $item->status === 0)
                        Eliminado
                    @endif
                  </td>
                  <td>
                    @if( $item->status === null )
                      <button class="btn btn-success exist" alt="{{ $item->id }}">
                        Listo
                        <i class="icon md-check"></i>
                      </button>
                      <button class="btn btn-warning lost" alt="{{ $item->id }}">
                        Dañado
                      </button>
                      <button class="btn btn-danger damaged" alt="{{ $item->id }}">
                        Perdido
                      </button>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
           <!-- END Tabla-->
        </div>
      </div>
      <form method="post" action="/inventory/check" id="form" class="d-none">
          {{ csrf_field() }}
          <input type="text" name="inventory_id" id="inventory_id">
          <input type="text" name="status" id="status">
          <input type="text" name="discar_cause" id="discar_cause">
        </form>
    </div>
  </div>
@endsection

@section('delete-categorias')
<script type="text/javascript"> 
$(document).ready(function() {
  $(".exist").click(function() {
      let id = $(this).attr("alt");

      Swal.fire({
        title: 'Confirmación',
        text: "¿El producto se encuentra en inventario?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#4caf50' ,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
      }).then((result) => {
        if (result.value) 
        {
          $('#inventory_id').val(id);
          $('#status').val(1);
          $('#form').submit();
        }
      })
    });

    $(".lost").click(function() {
      let id = $(this).attr("alt");

      Swal.fire({
        title: 'Confirmación',
        text: "¿El producto se encuentra dañado?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#4caf50' ,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
      }).then((result) => {
        if (result.value) 
        {
          $('#inventory_id').val(id);
          $('#status').val(0);
          $('#discar_cause').val(2);
          $('#form').submit();
        }
      })
    });

    $(".damaged").click(function() {
      let id = $(this).attr("alt");

      Swal.fire({
        title: 'Confirmación',
        text: "¿El producto NO se encuentra en inventario?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#4caf50' ,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
      }).then((result) => {
        if (result.value) 
        {
          $('#inventory_id').val(id);
          $('#status').val(0);
          $('#discar_cause').val(1);
          $('#form').submit();
        }
      })
    });
});
</script>
@endsection
 