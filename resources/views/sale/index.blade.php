@extends('layout.layoutdas')
@section('title')
LISTA DE  VENTAS
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
            <button onclick="window.location.href='/ventas/create'" type="button" class=" btn btn-sm small btn-floating  toggler-left  btn-info waves-effect waves-light waves-round float-right">
             <i class="icon md-plus" aria-hidden="true"></i></button>
          </div>
        </div>
        <h3 class="panel-title">Ventas</h3>
      </header>
      <div class="panel-body">
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
              <thead>
                <tr>
                  <th>Clave</th>
                  <th>Fecha</th>
                  <th>Folio_Nota</th>
                  <th>Productos</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tfoot>
              <tr>
              <th>Clave</th>
                  <th>Fecha</th>
                  <th>Folio_Nota</th>
                  <th>Productos</th>
                  <th>Opciones</th>
                </tr>
              </tfoot>
              <tbody>
                  @foreach ($sales as $sale)
                  <tr id = "row{{ $sale->id }}">
                    <td>{{ $sale->id}}</td>
                    <td>{{ $sale->date }}</td>
                    <td>{{ $sale->folio_nota }}</td>
                    <td>    
                    <a href="/ventas/{{$sale->id}}/edit"<button type="button" 
                      class="btn btn-icon btn-info waves-effect waves-light waves-round">
                      <i class="icon md-edit" aria-hidden="true"></i></button></a>
                  

                      <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                       alt="{{$sale->id}}" role="button">
                        <i class="icon md-delete" aria-hidden="true"></i>      
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

@section('footer')
@endsection

@section('delete-ventas')
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
          url:  '/ventas/' + id,
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