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
        <div class="panel-body">
            <div class="example-wrap">
              <h1 class="text-center panel-title">Lineas</h1>
              <div class="panel-actions float-right">
                <div class="container-fluid row float-right">
                  @if(Auth::user()->type_user == 1 )
                  <!-- Botón para Generar PDF de productos-->
                  <div class="col-6">
                    <button onclick="window.location.href='lineaspdf'"
                    type="button" class=" btn btn-sm small btn-floating
                    toggler-left  btn-danger waves-effect waves-light waves-round float-right"
                    data-toggle="tooltip" data-original-title="Generar reporte PDF">
                    <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                  </button>
                  </div>
                  <!--<div class="col-6">
                    <button onclick="window.location.href='/lineas/create'"
                    type="button" class=" btn btn-sm small btn-floating
                    toggler-left  btn-info waves-effect waves-light waves-round float-left"
                    data-toggle="tooltip" data-original-title="Agregar">
                    <i class="icon md-plus" aria-hidden="true"></i>
                  </button>
                  </div>-->
                  <!-- END Botón-->
                  @endif
                </div>
              </div>
            </div>
          </div>
        <div class="panel-body">

        <!-- Tabla para listar lineas-->
          <table id='example'  class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
            <thead>
              <tr>
                <th>Clave</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descuento</th>
                @if(Auth::user()->type_user == 1 )
                <th>Opciones</th>
                @endif
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Clave</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descuento</th>
                @if(Auth::user()->type_user == 1 )
                <th>Opciones</th>
                @endif
              </tr>
            </tfoot>
            <tbody>
              @foreach ($lines as $line)
                <tr id = "row{{ $line->id }}">
                  <td>{{ $line->id}}</td>
                  <td>{{ $line->name }}</td>
                  <td>$ {{ $line->sale_price }}</td>
                  <!--discount_percentage descuenta dinero-->
                  <td>% {{ $line->discount_percentage }}</td>
                  @if(Auth::user()->type_user == 1 )
                  <td>
                    <!-- Botón para editar linea-->
                    <a type="button" href="/lineas/{{$line->id}}/edit"
                      class="btn btn-icon btn-info waves-effect waves-light waves-round"
                      data-toggle="tooltip" data-original-title="Editar">
                      <i class="icon md-edit" aria-hidden="true"></i></a>

                    <!-- END Botón-->
                    <!-- Botónpara eliminar linea-->
                    <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                      alt="{{$line->id}}" role="button"
                      data-toggle="tooltip" data-original-title="Borrar">
                      <i class="icon md-delete" aria-hidden="true"></i>
                    </button>
                    <!-- END Botón-->
                  </td>
                  @endif
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
@section('edit-lineas')
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
              window.location.href = '/lineas/' + id + '/edit';
            }
      });
    });},1000);
  });
</script>
@endsection-->

<!-- Función Sweet Alert para eliminar linea-->
@section('delete-lineas')
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
          url:  '/lineas/' + id,
          method: 'DELETE',

          success: function (response) {
            if(response.success) {
              $("#row" + id).remove();
              Swal.fire(
                'Eliminado',
                'El registro ha sido eliminado.',
                'success'
              )
            }else{
                Swal.fire(
                  'No Eliminado',
                  'El registro no ha sido eliminado por que tiene productos activos',
                  'error'
                )
            }

          },
          error: function(error){
              Swal.fire(
                  'No Eliminado',
                  'El registro no ha sido eliminado por que tiene productos activos',
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
