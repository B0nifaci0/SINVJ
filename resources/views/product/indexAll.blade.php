@extends('layout.layoutdas') @section('title') LISTA PRODUCTO @endsection
@section('nav') @endsection @section('menu') @endsection @section('content')
<div class="panel-body">
  <div class="">
    <!-- Mesage-Muestra mensaje De que el producto se a agregado exitosamente-->
    @if (session('mesage'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ session('mesage') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    <!-- END Mesage-->
    <!-- Mesage-Muestra mensaje De que el producto se a modificado exitosamente-->
    @if (session('mesage-update'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{ session('mesage-update') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    <!-- END Mesage-->
    <!-- Mesage-Muestra mensaje De que el producto se a eliminado exitosamente-->
    @if (session('mesage-delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>{{ session('mesage-delete') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    <!-- END Mesage-->
    <div class="panel">
      <div class="panel-body">
        <div class="example-wrap">
          <h1 class="text-center panel-title">Productos De Tienda</h1>
          <div class="panel-actions float-right">
            <div class="container-fluid row float-right">
              @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
              <!-- Botón para Generar PDF de productos-->
              <div class="col-6">
                <button onclick="window.location.href='/productos/create'" type="button" class=" btn btn-sm small btn-floating
                 btn-info waves-effect waves-light waves-round float-left" data-toggle="tooltip"
                  data-original-title="Agregar Nuevo Producto">
                  <i class="icon md-plus" aria-hidden="true"></i>
                </button>
              </div>
              <!-- END Botón-->
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-12 col-md-12 col-sl">
        {{-- <div class="input-group mb-3" id="actualizar">

        </div> --}}

        <div class="col-md-3">
          <div class="input-group">
            <input type="text" name="search" id="search" class="form-control" placeholder="Search" />
          </div>
        </div>
        <div class="example-wrap">
          <table class="table table-striped midatatable">
            <thead>
              <tr>
                <th class="tablet"></th>
                <th>Clave</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Observaciónes</th>
                <th class="desktop">Sucursal</th>
                <th class="desktop">Estatus</th>
                <th class="desktop">Linea</th>
                <th class="desktop">Precio compra</th>
                <th class="desktop">Precio</th>
                @if(Auth::user()->type_user == 1)
                <th class="desktop">Precio descuento</th>
                <th class="desktop">Opciones</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @include('product.table')
            </tbody>
          </table>
          <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
        </div>
      </div>
    </div>
  </div>
  <!-- End Example Tabs -->
</div>
@endsection

@section('delete-productos')
<script>
  $(document).ready(function(){

 function search(page, query)
 {
  $.ajax({
   url:"/buscador?page="+page+"&query="+query,
   success:function(data)
   {
    $('tbody').html('');
    $('tbody').html(data);
   }
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $('#search').val();
  search(1, query);
 });

 $(document).on('click', '.pagination a', function(event){
  event.preventDefault();
  var page = $(this).attr('href').split('page=')[1];
  $('#hidden_page').val(page);
  var query = $('#search').val();

  $('li').removeClass('active');
        $(this).parent().addClass('active');
  search(page, query);
 });

 $(document).on('click','.delete', function(){
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
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
    });
    $.ajax({
    url: '/productos/' + id,
    method: 'DELETE',
    success: function (response) {
    if(response.success){
    Swal.fire(
    'Eliminado',
    'El registro ha sido eliminado.',
    'success'
    )
    }else{
    Swal.fire(
    'No Eliminado',
    'El producto no ha sido eliminado por que esta activo en un traspaso',
    'error'
    )
    }
    },
    error: function () {
    Swal.fire(
    'Eliminado',
    'El registro no ha sido eliminado.' + id,
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