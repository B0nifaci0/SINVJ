@extends('layout.layoutdas')
@section('title')
LISTA DE PRODUCTOS POR SUCURSAL
@endsection

@section('nav')

@endsection
@section('menu')

@endsection 
@section('content')
  <div class="panel-body">
	<div class="page-content">
        <!-- Panel Basic --> 
    <div class="panel">
      <header class="panel-heading">
          <div class="panel-actions">
              <div class="row">
              <!-- Botón Para generar reporte PDF
                @if(Auth::user()->type_user == 1 )
                <div class="col-md-4 col-md-offset-2">
                  <button onclick="window.location.href='sucursalespdf'" 
                  type="button" class=" btn btn-sm small btn-floating 
                    toggler-left  btn-danger waves-effect waves-light waves-round float-right"
                    data-toggle="tooltip" data-original-title="Generar reporte PDF">
                    <i class="icon fa-file-pdf-o" aria-hidden="true"></i></button>
                </div>
                END Botón-->
                @endif
              </div>
            </div>
        <h3 class="panel-title">Productos de la sucursal</h3>
      </header>
            <div class="panel-body">
              <div class="example-wrap">
                <div class="panel-actions">
                  
                  <div class="container-fluid row col-md-12 col-xs-12 col-lg-12">
                    @if(Auth::user()->type_user == 1 )
                      <!-- Botón para Generar PDF de productos-->
                      <div class="col-md-4 col-md-offset-2 col-xs-4 col-xs-offset-2 col-xs-4">
                        <button onclick="window.location.href='productospdf'" 
                          type="button" id='pdf01' name='pdf01'class=" btn btn-sm small btn-floating 
                          toggler-left  btn-danger waves-effect waves-light waves-round float-right"
                          data-toggle="tooltip" data-original-title="Generar reporte PDF">
                          <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                        </button>
                      </div>
                      <!-- END Botón-->
                      <!-- Botón para generar Excel-->
                      <div class="col-md-4 col-md-offset-2  col-xs-4 col-xs-offset-2">
                        <button onclick="window.location.href='#'" 
                          type="button" class=" btn btn-sm small btn-floating 
                          toggler-left  btn-success waves-effect waves-light waves-round float-right"
                          data-toggle="tooltip" data-original-title="Generar reporte Excel">
                          <i class="icon fa-file-excel-o" aria-hidden="true"></i>
                        </button>
                      </div>
                      <!-- END Botón-->
                      <!-- Botón para agregar productos-->
                      <div class="col-md-4 col-md-offset-2  col-xs-4 col-xs-offset-2">
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
            </div>
            <div class="col-xl-12 col-md-12 col-sl">
              <div class="example-wrap">
                <div class="nav-tabs-horizontal" data-plugin="tabs">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#exampleTabsOne"
                          aria-controls="exampleTabsOne" role="tab">Productos Gr</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleTabsTwo"
                            aria-controls="exampleTabsTwo" role="tab">Productos Pz</a></li>
                    </ul>
                        <div class="tab-content">
                          <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                            <div class="page-content panel-body container-fluid">
                              <!-- Tabla para listar productos-->
                                    <table id="example"  class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                                      <thead>
                                      {{ csrf_field() }}
                                        <tr>  
                                          <th>Clave</th>
                                          <th>Descripción</th>
                                          <th>Peso</th>
                                          <th>Observaciónes</th>
                                          <th>Precio</th>
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
                                        <th>Precio</th>
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
                                    @foreach ($products as $i => $branchproduct)
                                        <tr id="row{{$branchproduct->id}}">
                                                <td>{{ $branchproduct->clave }}</td> 
                                                <td>{{ $branchproduct->description }}</td>
                                                <td>{{ $branchproduct->weigth }}</td>
                                                <td>{{ $branchproduct->observations }}</td>
                                                <td>{{ $branchproduct->price }}</td>    
                                                <td>
                                          @php
                                            $image = route('images',"app/public/upload/products/$branchproduct->image")
                                          @endphp
                                          <img width="100px" height="100px" src="{{ $image }}">
                                        </td>
                                        <td>{{ $branchproduct->category->name }}</td>
                                  

                                        @if(Auth::user()->type_user == 1)
                                        <td>
                                            <!-- Botón Para editar producto por sucursal-->    
                                            <a href="/sucursalproducto/{{$branchproduct->id}}/edit"><button type="button"  
                                            class="btn btn-icon btn-primary waves-effect waves-light waves-round"
                                            data-toggle="tooltip" data-original-title="Editar">
                                            <i class=" icon md-edit" aria-hidden="true"></i></button></a>
                                            <!-- END Botón-->
                                            <!-- Botón Para eliminar producto por sucursal-->
                                            <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                                                alt="{{ $branchproduct->id }}" role="button"
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
                                <!-- END Table-->
                          </div>
                        </div>

                      </div>
                      <div class="tab-pane" id="exampleTabsTwo" role="tabpanel">
                            <!-- Tabla para listar productos-->
                                    <table id="example"  class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                                      <thead>
                                      {{ csrf_field() }}
                                        <tr>  
                                          <th>Clave</th>
                                          <th>Descripción</th>
                                          <th>Categoría</th>
                                          <th>Observaciónes</th>
                                          <th>Imagen</th>
                                          <th>Sucursal</th>
                                          <th>Status</th>
                                         <th>Precio Venta</th>
                                          @if(Auth::user()->type_user == 1 )
                                            <th>Precio Compra</th>
                                            <th>Opciones</th>
                                          @endif
                                        </tr>
                                      </thead>
                                    <tfoot>
                                      <tr>
                                        <th>Clave</th>
                                        <th>Descripción</th>
                                        <th>Categoría</th>
                                        <th>Observaciónes</th>
                                        <th>Imagen</th>
                                        <th>Sucursal</th>
                                        <th>Status</th>
                                        <th>Precio Venta</th>
                                        <th>Precio Compra</th>
                                        @if(Auth::user()->type_user == 1 )
                                        <th>Opciones</th>
                                        @endif
                                      </tr> 
                                    </tfoot>
                                    <tbody>
                                    @foreach ($products as $i => $branchproduct)
                                    @if($branchproduct->category->type_product == 1 )
                                      <tr id="row{{$branchproduct->id}}">
                                        <td>{{ $branchproduct->clave }}</td> 
                                        <td>{{ $branchproduct->description }}</td>
                                        <td>{{ $branchproduct->category->name }}</td>
                                        <td>{{ $branchproduct->observations }}</td>
                                        <td>
                                          @php
                                            $image = route('images',"app/public/upload/products/$branchproduct->image")
							            @endphp
							            <img width="100px" height="100px" src="{{ $image }}">
                                        </td>                                      
                                        <td>{{ $branchproduct->status->name }}</td>
                                        <td>{{$branchproduct->pricepzt}}
                                        @if(Auth::user()->type_user == 1)
                                        <td>{{$branchproduct->price_purchase}}
                                        <td>   
                                            <!-- Botón Para editar producto por sucursal-->    
                                            <a href="/sucursalproducto/{{$branchproduct->id}}/edit"><button type="button"  
                                            class="btn btn-icon btn-primary waves-effect waves-light waves-round"
                                            data-toggle="tooltip" data-original-title="Editar">
                                            <i class=" icon md-edit" aria-hidden="true"></i></button></a>
                                            <!-- END Botón-->
                                            <!-- Botón Para eliminar producto por sucursal-->
                                            <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                                                alt="{{ $branchproduct->id }}" role="button"
                                                data-toggle="tooltip" data-original-title="Borrar">
                                                <i class="icon md-delete" aria-hidden="true"></i>
                                            </button>
                                            <!-- END Botón--> 
                                          </td>
                                        @endif
                                      </tr>
                                      @endif
                                    @endforeach
                                  </tbody>
                                </table>
                                <!-- END Table-->
                      </div>
                 </div>
              </div>
            </div>
                <!-- End Example Tabs -->

      </div>
    </div>
  </div>
</div>
@endsection
<!-- Función Sweet Alert Para eliminar producto por sucursal -->
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
      confirmButtonColor: '#d33' ,
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Si, Borralo!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
           headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url:  '/sucursales/' + id,
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