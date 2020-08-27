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
              @if(Auth::user()->type_user == 1)
              <div class="col-6">
                <button onclick="window.location.href='productospdf'" type="button" id="pdf01" name="pdf01" class=" btn btn-sm small btn-floating
                 btn-danger waves-effect waves-light waves-round float-right" data-toggle="tooltip"
                  data-original-title="Generar reporte PDF">
                  <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                </button>
              </div>
              @endif
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
        <div class="input-group mb-3" id="actualizar">
          <input class="form-control col-3" type="search" id="text" placeholder="Search" aria-label="Search" />
        </div>
        <div id="mostrar"></div>
        <div id="prueba">
          @include('product.table')
        </div>
      </div>
    </div>
  </div>
  <!-- End Example Tabs -->
</div>
@endsection

@section('delete-productos')
<script type="text/javascript">
  $(document).ready(function () {

    actual = '#prueba'
    document.getElementById('text').addEventListener('keyup',()=>{
    if((document.getElementById('text').value.length)>0){
      console.log(text.value)
      fetch(`/buscador/?text=${document.getElementById("text").value}`,{
        method: 'get'
      })
      .then(response => response.text())
      .then(html => {
        document.getElementById('mostrar').innerHTML = html
        document.getElementById('prueba').hidden = true;
      })

      $("#mostrar li a.page-link").each((index, element) =>{
        console.log($(this).data('href'))
        console.log("hola"+text.value)
        })

    }else{
      document.getElementById('mostrar').innerHTML = ""
      document.getElementById('prueba').hidden = false;
    }   
  })

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
                  ).then(function (isConfirm){
                    if(isConfirm)
                    location.reload()
                  })
                  // location.reload();
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