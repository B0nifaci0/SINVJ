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
                <th>Producto</th>
                <th>Status</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Producto</th>
                <th>Status</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($inventory->products as $item)
                <tr id = "row{{ $inventory->id }}">
                  <td>{{ $item->product->description }}</td>
                  <td>
                    @if( $item->status === null )
                        Pendiente
                    @elseif( $item->status === true)
                        Listado
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
           <!-- END Tabla-->
        </div>
      </div>
    </div>
  </div>
@endsection

<!-- Función Sweet Alert para eliminar linea-->
@section('delete-inventarios')
<script type="text/javascript">
console.log("a")
$(document).ready(function() {
  console.log("b")
  $(".delete").click(function() {
    var id = $(this).attr("alt");
    console.log(id);
    Swal.fire({
      title: 'Confirmación',
      text: "¿Seguro que desea eliminar este registro?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33' ,
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
          url:  '/inventarios/' + id,
          method: 'DELETE',
          success: function () {
            $("#row" + id).remove();
            Swal.fire(
              'Eliminado',
              'El registro ha sido eliminado.',
              'success'
            )
          }, 
          error: function () {
            Swal.fire(
              'Eliminado',
              'El registro no ha sido eliminado.'+ id,
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
@section('barcode-product')

@endsection