@extends('layout.layoutdas')
@section('title')
VERIFICACION DE ESTATUS
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
              @if(Auth::user()->type_user == 1 )
              <!-- Botón para crear Estatus-->
              <div class="col-md-14 col-md-offset-2">
                <button onclick="window.location.href='/status/create'" 
                  type="button" class=" btn btn-sm small btn-floating  toggler-left 
                  btn-info waves-effect waves-light waves-round float-right "
                  data-toggle="tooltip" data-original-title="Agregar">
                  <i class="icon md-plus" aria-hidden="true"></i>
                </button>
              </div>
              <!-- END Botón-->
              @endif
            </div>
            <h3 class="panel-title">Estatus</h3>
          </header>
          <div class="panel-body">
          <!-- Tabla para listar Estatus-->
            <table id='example' class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Tienda</th>
                  @if(Auth::user()->type_user == 1 )
                  <th>Opciones</th>
                  @endif
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Tienda</th>
                  @if(Auth::user()->type_user == 1 )
                  <th>Opciones</th>
                  @endif
                </tr> 
              </tfoot>  
              <tbody>
                @foreach ($sta as $tsd)
                  <tr id = "row{{$tsd->id}}">
                    <td>{{$tsd->id}}</td>
                    <td>{{$tsd->name}}</td>
                    <td>{{$tsd->shop->name}}</td>
                    @if(Auth::user()->type_user == 1 )
                      <td>  
                        <!-- Botón para editar gasto-->  
                        <a type="button" href="/status/{{$tsd->id}}/edit"
                          class="btn btn-icon btn-info waves-effect waves-light waves-round"
                          data-toggle="tooltip" data-original-title="Editar">
                          <i class="icon md-edit" aria-hidden="true"></i>
                        </a>
                        <!-- END Botón-->
                        <!-- Botón para eliominar gasto-->
                        <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                          alt="{{$tsd->id}}" role="button"
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
      <!-- End Panel Basic -->
    </div>
@endsection
<!-- Función Sweet Alert para eliminar gasto-->
@section('delete-status')
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
          url:  '/status/' + id,
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