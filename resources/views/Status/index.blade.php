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
          <div class="col-md-14 col-md-offset-2">
            <button onclick="window.location.href='/status/create'" type="button" class=" btn btn-sm small btn-floating  toggler-left 
            btn-info waves-effect waves-light waves-round float-right "
             data-toggle="tooltip" data-original-title="Agregar">
             <i class="icon md-plus" aria-hidden="true"></i></button>
          </div>
        </div>
        <h3 class="panel-title">Estatus</h3>
      </header>
      <div class="panel-body">
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Tienda</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                     <th>Id</th>
                        <th>Name</th>
                        <th>Tienda</th>
                        <th>Opciones</th>
                </tr> 
              </tfoot>  
              <tbody>
                    @foreach ($sta as $tsd)
                    <tr id = "row{{$tsd->id}}">
                        <td>{{$tsd->id}}</td>
                          <td>{{$tsd->name}}</td>
                          <td>{{$tsd->shop->name}}</td>
                          <td>    
                              <a href="/status/{{$tsd->id}}/edit"<button type="button" 
                                class="btn btn-icon btn-info waves-effect waves-light waves-round"
                                data-toggle="tooltip" data-original-title="Editar">
                                <i class="icon md-edit" aria-hidden="true"></i></button></a>
                                <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                                 alt="{{$tsd->id}}" role="button"
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
  
  <!-- End Panel Basic -->
@endsection

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
        $.ajax({
           headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
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