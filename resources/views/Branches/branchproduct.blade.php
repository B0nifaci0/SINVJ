@extends('layout.layoutdas') @section('title') LISTA DE PRODUCTOS POR SUCURSAL
@endsection @section('nav') @endsection @section('menu') @endsection
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
  <div class="panel">
    <div class="panel-body">
      <div class="example-wrap">
        <h1 class="text-center panel-title">Productos {{$branch->name}} </h1>
        <div class="panel-actions float-right">
          <div class="container-fluid row float-right">
            @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
            <!-- Botón para Generar PDF de productos-->
            @if(Auth::user()->type_user == 1)
            <div class="col-4">
              <button onclick="window.location.href='/sucursal/{{$branch->id}}/productos-gramo'" type="button"
                class="btn btn-sm small btn-floating btn-danger waves-effect waves-light waves-round float-right"
                data-toggle="tooltip" data-original-title="Reporte productos gramo">
                <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
              </button>
            </div>
            <div class="col-4">
              <button onclick="window.location.href='/sucursal/{{$branch->id}}/productos-pieza'" type="button"
                class="btn btn-sm small btn-floating btn-danger waves-effect waves-light waves-round float-right"
                data-toggle="tooltip" data-original-title="Reporte productos pieza">
                <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
              </button>
            </div>
            @endif
            <div class="col-4">
              <button onclick="window.location.href='/productos/create'" type="button"
                class="btn btn-sm small btn-floating btn-info waves-effect waves-light waves-round float-left"
                data-toggle="tooltip" data-original-title="Agregar Nuevo Producto">
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
<input type="hidden" name="branch" id="branch" value="{{$branch->id}}" />
@endsection

@section('delete-productos')
<script>
  $(document).ready(function(){
      
       function search(page, query, branch)
       {
        $.ajax({
         url:"/buscadorsucursal?page="+page+"&query="+query+"&branch="+branch,
         success:function(data)
         {
          $('tbody').html('');
          $('tbody').html(data);
         }
        })
       }
             
       $(document).on('keyup', '#search', function(){
        var query = $('#search').val();
        var branch = $('#branch').val();
        console.log('branch= '+branch)
        search(1, query, branch);
       });
      
       $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var branch = $('#branch').val();
        $('#hidden_page').val(page);
        var query = $('#search').val();
      
        $('li').removeClass('active');
              $(this).parent().addClass('active');
        search(page, query, branch);
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