@extends('layout.layoutdas')
@section('title')
LISTA DE  USUARIOS
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="page">
  <div class="panel-body">
	@if (session('mesage'))	
	<div class="alert alert-success">
				<strong>{{ session('mesage') }}</strong>
	</div>
		@endif
			@if (session('mesage-update'))	
	<div class="alert alert-warning">
				<strong>{{ session('mesage-update') }}</strong>
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
        <div class="panel-actions">
          <div class="col-md-14 col-md-offset-2">
            <button onclick="window.location.href='/usuarios/create'" 
            type="button" class=" btn btn-sm small btn-floating  toggler-left 
             btn-info waves-effect waves-light waves-round float-right"
              data-toggle="tooltip" data-original-title="Editar">
             <i class="icon md-plus" aria-hidden="true"></i></button>
          </div>
        </div>
        <h3 class="panel-title">Usuarios</h3>
      </header>
      <div class="panel-body">
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Shop_id</th>
                  <th>Type User</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tfoot>
              <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Shop_id</th>
                  <th>Type User</th>
                  <th>Opciones</th>
                </tr>
              </tfoot>
              <tbody>
                  @foreach ($users as $user)
                  <tr id = "row{{$user->id}}">
                        <td>{{$user->name }}</td>
                        <td>{{$user->email }}</td>
                        <td>{{$user->shop_id }}</td>
                        <td>{{$user->type_user }}</td>
                        <td>    

                        <button type="button" 
                      class="btn btn-icon btn-info waves-effect waves-light waves-round edit"
                      alt="{{$user->id}}" role="button" data-toggle="tooltip" data-original-title="Editar">
                      <i class="icon md-edit" aria-hidden="true"></i></button></a>
                  

                      <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                       alt="{{$user->id}}" role="button"
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
@endsection

@section('editar-usuarios')
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
              window.location.href = '/usuarios/' + id + '/edit';
            }
      }); 
    });},1000); 
  });
</script>
@endsection

@section('delete-usuarios')
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
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Borralo!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
           headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url:  '/usuarios/' + id,
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