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

    <div class="page-content">
      <!-- Panel Basic -->
      <div class="panel">
        <header class="panel-heading">
          <div class="panel-actions">
            <div class="row">
            </div>
          </div>
          <h3 class="panel-title">Inventarios</h3>
        </header>
        <div class="panel-body">
        <!-- Tabla para listar inventarios-->
          <table id='example'  class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Fecha Del Inventario</th>
                <th>Sucursal</th>
                <th>Status</th>
                <th>Reportes</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Fecha Del Inventario</th>
                <th>Sucursal</th>
                <th>Status</th>
                <th>Reportes</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($inventories as $inventory)
                <tr id = "row{{ $inventory->id }}">
                  <td>{{ $inventory->id }}</td>
                  <td>{{ $inventory->start_date }}</td>
                  <td>{{ $inventory->name_branch }}</td>
                  @if($inventory->status_report == 1)
                    <td><span class="text-center badge badge-primary">No Iniciado</span></td>
                  @elseif($inventory->status_report == 2)
                    <td><span class="text-center badge badge-warning">En Proceso</span></td>
                  @elseif($inventory->status_report == 3)
                    <td><span class="text-center badge badge-success">Finalizado</span></td>
                  @endif
                  <td>
                  <div class="col-md-4 col-md-offset-2">
                  <button onclick="window.location.href='inventariospdf/{{$inventory->id}}'" 
                    type="button" class=" btn btn-sm small btn-floating 
                    toggler-left  btn-danger waves-effect waves-light waves-round float-right"
                    data-toggle="tooltip" data-original-title="Generar reporte PDF">
                    <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                  </button>
                </div>
                    </a>
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
<!--
@section('edit-inventarios')
<script type="text/javascript">
$(document).ready(function(){
  setTimeout(function () {  
    $(".edit").click(function() {
    var id = $(this).attr("alt");
      swal.fire({
        title: 'Confirmación',
        text: "¿Seguro que desea editar este registro?",
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: "#357ebd",
        cancelButtonColor: '#d33',
        confirmButtonText: 'Editar!'
      }).then(
      function(result){
        console.log('entra');
        if(result.value){
          console.log('entraalif');
              window.location.href = '/inventarios/' + id + '/edit';
            }
      }); 
    });},1000); 
  });
</script>
@endsection-->

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