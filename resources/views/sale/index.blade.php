@extends('layout.layoutdas')
@section('title')
LISTA DE  VENTAS
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
  <div class="page-content">
        <!-- Panel Basic -->
    <div class="panel">
      <header class="panel-heading">
        <div class="panel-actions">
          <div class="row">
            <div class="col-md-4 col-md-offset-2">
              <button onclick="window.location.href='ventaspdf'" 
              type="button" class=" btn btn-sm small btn-floating 
                toggler-left  btn-danger waves-effect waves-light waves-round float-right"
                data-toggle="tooltip" data-original-title="Generar reporte PDF">
                <i class="icon fa-file-pdf-o" aria-hidden="true"></i></button>
            </div>
            <div class="col-md-14 col-md-offset-2">
              <button onclick="window.location.href='/ventas/create'" type="button" class=" btn btn-sm small btn-floating  toggler-left  btn-info waves-effect waves-light waves-round float-right">
              <i class="icon md-plus" aria-hidden="true"></i></button>
            </div>
          </div>
        </div>
        <h3 class="panel-title">Ventas</h3>
      </header>
      <div class="panel-body">
            <table id='example'  class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
              <thead>
                <tr>
                  <th>Clave</th>
                  <th>Nombre del cliente</th>
                  <th>Teléfono</th>
                  <th>Productos</th>
                  <th>Total a pagar</th>
                  <th>Fecha</th>
                </tr>
              </thead>
              <tfoot>
              <tr>
              <th>Clave</th>
                  <th>Nombre del cliente</th>
                  <th>Teléfono</th>
                  <th>Productos</th>
                  <th>Total a pagar</th>
                  <th>Fecha</th>
                </tr>
              </tfoot>
              <tbody>
                  @foreach ($sales as $sale)
                  <tr id = "row{{ $sale->id }}">
                    <td>{{ $sale->id}}</td>
                    <td>{{ $sale->customer_name }}</td>
                    <td>{{ $sale->telephone }}</td>
                    <td>{{ $sale->product->name }}</td>
                    <td>$ {{ $sale->price }}</td>
                    <td>{{ $sale->created_at->format('m-d-Y')}}</td>
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
@section('barcode-product')
<script type="text/javascript">
        $('#example').dataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            }
        });
    </script>
@endsection