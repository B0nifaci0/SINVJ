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
                <div class="col-md-4 col-md-offset-2">
                  <button onclick="window.location.href='lineaspdf'" 
                  type="button" class=" btn btn-sm small btn-floating 
                   toggler-left  btn-danger waves-effect waves-light waves-round float-right"
                   data-toggle="tooltip" data-original-title="Generar reporte PDF">
                   <i class="icon fa-file-pdf-o" aria-hidden="true"></i></button>
                </div>
                <div class="col-md-4 col-md-offset-2">
                  <button onclick="window.location.href='#'" 
                  type="button" class=" btn btn-sm small btn-floating 
                   toggler-left  btn-success waves-effect waves-light waves-round float-right"
                   data-toggle="tooltip" data-original-title="Generar reporte Excel">
                   <i class="icon fa-file-excel-o" aria-hidden="true"></i></button>
                </div>
                <div class="col-md-4 col-md-offset-2">
                  <button onclick="window.location.href='/lineas/create'" 
                  type="button" class=" btn btn-sm small btn-floating 
                   toggler-left  btn-info waves-effect waves-light waves-round float-right"
                   data-toggle="tooltip" data-original-title="Agregar">
                   <i class="icon md-plus" aria-hidden="true"></i></button>
                </div>
        </div>
        </div>
        <h3 class="panel-title">Lineas</h3>

      </header>
      <div class="panel-body">
            <table id='example'  class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
              <thead>
                <tr>
                  <th>Clave</th>
                  <th>Nombre</th>
                  <th>Precio Compra</th>
                  <th>Precio Venta</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tfoot>
              <tr>
                  <th>Clave</th>
                  <th>Nombre</th>
                  <th>Precio</th>
                  <th>Opciones</th>
                </tr>
              </tfoot>
              <tbody>
                  @foreach ($lines as $line)
                  <tr id = "row{{ $line->id }}">
                    <td>{{ $line->id}}</td>
                    <td>{{ $line->name }}</td>
                    <td>$ {{ $line->purchase_price }}</td>
                    <td>$ {{ $line->sale_price }}</td>

                    <td>    
                    <a href="/lineas/{{$line->id}}/edit"<button type="button" 
                      class="btn btn-icon btn-info waves-effect waves-light waves-round"
                              data-toggle="tooltip" data-original-title="Editar">
                      <i class="icon md-edit" aria-hidden="true"></i></button></a>
                      <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                       alt="{{$line->id}}" role="button"
                       data-toggle="tooltip" data-original-title="Borrar">
                        <i class="icon md-delete" aria-hidden="true"></i>
                    </button>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
        <!-- End Panel Basic -->
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
        $.ajax({
           headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url:  '/lineas/' + id,
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

@section('barcode-product')

@endsection