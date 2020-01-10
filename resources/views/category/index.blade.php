@extends('layout.layoutdas')
@section('title')
LISTA DE  CATEGORIA
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
              <h1 class="text-center panel-title">Categorias</h1>
              <div class="panel-actions float-right">
                <div class="container-fluid row float-right">
                  @if(Auth::user()->type_user == 1 )
                  <!-- Botón para Generar PDF de productos
                  <div class="col-6">
                    <button onclick="window.location.href='/categorias/create'" type="button"
                class=" btn btn-sm small btn-floating  toggler-left
                btn-info waves-effect waves-light waves-round float-left "
                data-toggle="tooltip" data-original-title="Agregar">
                <i class="icon md-plus" aria-hidden="true"></i>
              </button>
                  </div>
                   END Botón-->
                  @endif
                </div>
              </div>
            </div>
          </div>
        <div class="panel-body">
        <!-- Tabla listar las categorias-->
          <table id='categorias'  class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
            <thead>
              <tr>
                <th>Clave</th>
                <th>Nombre</th>
                <th>Tipo de Producto</th>
                @if(Auth::user()->type_user == 1 )
                <th>Opciones</th>
                @endif
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Clave</th>
                <th>Nombre</th>
                <th>T.Porducto</th>
                @if(Auth::user()->type_user == 1 )
                <th>Opciones</th>
                @endif
              </tr>
            </tfoot>
            <tbody>
              @foreach ($categories as $category)
              <tr id = "row{{ $category->id }}">
                <td>{{ $category->id}}</td>
                <td>{{ $category->name }}</td>
                @if($category->type_product == 1 )
                    <td><span class="text-center badge badge-success">Pieza</span></td>
                @endif
                @if($category->type_product == 2 )
                    <td><span class="text-center badge badge-primary">Gramos</span></td>
                @endif
                @if(Auth::user()->type_user == 1 )
                <td>
                  <!-- Botón Para editar categoria-->
                  <a type="button" href="/categorias/{{$category->id}}/edit"
                    class="btn btn-icon btn-info waves-effect waves-light waves-round"
                    data-toggle="tooltip" data-original-title="Editar">
                    <i class="icon md-edit" aria-hidden="true"></i></a>

                  <!-- END Botón-->
                  <!-- Botón Para eliminar categoria-->
                  <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                    alt="{{$category->id}}" role="button"
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
  <!-- End Panel Basic -->

@endsection



<!-- Función Sweet Alert para eliminar categoria-->
@section('delete-categorias')
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
          url:  'categorias/' + id,
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
                  'Eliminado',
                  'El registro no ha sido eliminado por que tiene productos activos',
                  'error'
                )
            }

          },
          error: function(error){
              Swal.fire(
                  'error',
                  'Error de conexión',
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
