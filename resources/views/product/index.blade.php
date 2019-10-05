@extends('layout.layoutdas')
@section('title')
LISTA PRODUCTO
@endsection


@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
  <div class="panel-body">
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
		<div class="page-content">
      <!-- Panel Basic -->
      <div class="panel">
        <header class="panel-heading">
          <div class="panel-actions">
            <div class="row">
              @if(Auth::user()->type_user == 1 )
                <!-- Botón para Generar PDF de productos-->
                <div class="col-md-4 col-md-offset-2">
                  <button onclick="window.location.href='productospdf'" 
                    type="button" id='pdf01' name='pdf01'class=" btn btn-sm small btn-floating 
                    toggler-left  btn-danger waves-effect waves-light waves-round float-right"
                    data-toggle="tooltip" data-original-title="Generar reporte PDF">
                    <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                  </button>
                </div>
                <!-- END Botón-->
                <!-- Botón para generar Excel-->
                <div class="col-md-4 col-md-offset-2">
                  <button onclick="window.location.href='#'" 
                    type="button" class=" btn btn-sm small btn-floating 
                    toggler-left  btn-success waves-effect waves-light waves-round float-right"
                    data-toggle="tooltip" data-original-title="Generar reporte Excel">
                    <i class="icon fa-file-excel-o" aria-hidden="true"></i>
                  </button>
                </div>
                <!-- END Botón-->
                <!-- Botón para agregar productos-->
                <div class="col-md-4 col-md-offset-2">
                  <button onclick="window.location.href='/productos/create'" 
                    type="button" class=" btn btn-sm small btn-floating 
                    toggler-left  btn-info waves-effect waves-light waves-round float-right"
                    data-toggle="tooltip" data-original-title="Agregar">
                    <i class="icon md-plus" aria-hidden="true"></i>
                  </button>
                </div>
                <!-- END Botón-->
              @endif
            </div>
          </div> 
        </div>
          <h3 class="panel-title">Productos </h3>
        <!-- Example Tabs -->
        <div class="example-wrap">
          <div class="nav-tabs-horizontal" data-plugin="tabs">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#exampleTabsOne"
                  aria-controls="exampleTabsOne" role="tab">Productos Gr</a></li>
              <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleTabsTwo"
                  aria-controls="exampleTabsTwo" role="tab">Productos Pz</a></li>
            </ul>
            <div class="tab-content pt-20">
              <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                    <form action="entradasproducto">
                      <div class="panel panel-bordered">
                          <div class="panel-body row col-12">
                            <div class="row col-12">
        <div class="panel-body">
        <!-- Tabla para listar productos-->
          <table id="example"  class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
            <thead>
              {{ csrf_field() }}
              <tr>  
                <th>Clave</th>
                <th>Descripción</th>
                <th>Peso</th>
                <th>Observaciónes</th>
                <th>Imagen</th>
                <th>Categoría</th>
                <th>Linea</th>
                <th>Sucursal</th>
                <th>Status</th>
                @if(Auth::user()->type_user == 1 )
                  <th>Opciones</th>
                @endif
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Clave</th>
                <th>Descripción</th>
                <th>Peso</th>
                <th>Observaciónes</th>
                <th>Imagen</th>
                <th>Categoría</th>
                <th>Linea</th>
                <th>Sucursal</th>
                <th>Status</th>
                @if(Auth::user()->type_user == 1 )
                <th>Opciones</th>
                @endif
              </tr> 
            </tfoot>
            <tbody>
              @foreach ($products as $i => $product)
                <tr id="row{{$product->id}}">
                  <td>{{ $product->clave }}</td> 
                  <td>{{ $product->description }}</td>
                  <td>{{ $product->weigth }}</td>
                  <td>{{ $product->observations }}</td>
                  <td>
                    @php
                    $image = route('images',"app/public/upload/products/$product->image")
                    @endphp
                    <img width="100px" height="100px" src="{{ $image }}">
                  </td>
                  <td>{{ $product->category->name }}</td>
                
                  <td>{{ ($product->line) ? $product->line->name : '' }}</td>
                  <td>{{ $product->branch->name }}</td>
                  <td>{{ $product->status->name }}</td>
                  @if(Auth::user()->type_user == 1 )
                    <td>   
                      <!-- Botón para editar producto-->
                      <a href="/productos/{{$product->id}}/edit"<button type="button" 
                        class="btn btn-icon btn-info waves-effect waves-light waves-round"
                        data-toggle="tooltip" data-original-title="Editar">
                        <i class="icon md-edit" aria-hidden="true"></i></button>
                      </a>
                      <!-- END Botón-->
                      <!-- Botón para eliminar producto -->
                      <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                        alt="{{$product->id}}" role="button" 
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
                     </div>
                <!-- End Example Tabs -->
                    </div>
                </div>
            </div>
        </div>
      </div>
  </div>
  
  <!-- End Panel Basic -->
</div>

@endsection

@section('barcode-product')

@endsection

<!-- Función Sweet Alert para eliminar producto-->
@section('delete-productos')
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
        $.ajaxSetup({
         headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
           }
      });
        $.ajax({
          url:  '/productos/' + id,
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


