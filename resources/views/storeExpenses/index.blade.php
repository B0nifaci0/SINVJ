@extends('layout.layoutdas')
@section('title')
LISTA DE  GASTOS
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
  <div class="panel-body">
    @if (session('mesage'))	
      <div class="alert alert-success">
        <strong>{{ session('mesage') }}</strong>
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
      <div class="alert alert-danger">
        <strong>{{ session('mesage-delete') }}</strong>
      </div>
    @endif    
    <div class="page-content">
      <!-- Panel Basic -->
      <div class="panel">
        <header class="panel-heading">
          <div class="row panel-actions">
            <!-- Botón para generar PDF de gastos-->
            <div class="col-md-6 col-md-offset-2">
              <button onclick="window.location.href='gastospdf'" 
                type="button" class=" btn btn-sm small btn-floating 
                toggler-left  btn-danger waves-effect waves-light waves-round float-right"
                data-toggle="tooltip" data-original-title="Generar reporte PDF">
                <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
              </button>
            </div>
            <!-- END Botón-->
            <!-- Botón para crear gastos-->
            <div class="col-md-6 col-md-offset-2">
              <button onclick="window.location.href='/gastos/create'" type="button" class=" btn btn-sm small btn-floating  toggler-left  btn-info waves-effect waves-light waves-round float-right"
              data-toggle="tooltip" data-original-title="Agregar">
                <i class="icon md-plus" aria-hidden="true"></i>
              </button>
            </div>
            <!-- END Botón-->
          </div>
          <h3 class="panel-title">Gastos</h3>
        </header>
        <div class="panel-body">
        <!-- Tabla para listar gastos-->
          <table id='example' class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
            <thead>
              <tr>
                <th>Clave</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Sucursal</th>
                <th>Tienda</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Clave</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Sucursal</th>
                <th>Tienda</th>
                <th>Opciones</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($expenses as $expense)
                <tr id = "row{{ $expense->id }}">
                  <td>{{ $expense->id}}</td>
                  <td>{{ $expense->name }}</td>
                  <td>{{ $expense->descripcion }}</td>
                  <td>$ {{$expense->price}}</td>
                  <td>
                    <img width="100px" height="100px" src="{{ $expense->image }}">
                  </td>
                  <td>{{$expense->branch ? $expense->branch->name : '' }}</td>
                  <td>{{$expense->shop ? $expense->shop->name : '' }}</td>
                  <td>  
                     <!-- Botón para editar gasto-->  
                    <a href="/gastos/{{$expense->id}}/edit"><button type="button" 
                      class="btn btn-icon btn-info waves-effect waves-light waves-round" data-toggle="tooltip" data-original-title="Editar">
                      <i class="icon md-edit" aria-hidden="true"></i></button>
                    </a> 
                    <!-- END Botón--> 
                     <!-- Botón para generar ticket PDF de Gastos-->
                   <!--div class="col-md-6 col-md-offset-2"-->
                   <a href="gastopdf/{{$expense->id}}"><button type="button" 
                        class="btn btn-icon btn-danger waves-effect waves-light"
                        data-toggle="tooltip" data-original-title="Generar Ticket">
                        <i class="icon fa-file-pdf-o" aria-hidden="true"></i></button>
                      </a>
                <!-- </div-->
                <!-- END Botón-->
                    <!-- Botón para eliminar gasto-->
                    <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                    data-toggle="tooltip" data-original-title="Borrar"
                      alt="{{$expense->id}}" role="button">
                      <i class="icon md-delete" aria-hidden="true"></i> 
                    </button> 
                    <!-- END Botón-->    
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
<!-- Función Sweet Alert para eliminar gasto-->
@section('delete-gastos')
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
          url:  '/gastos/' + id,
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
@section('footer')
@endsection

@section('barcode-product')
@endsection