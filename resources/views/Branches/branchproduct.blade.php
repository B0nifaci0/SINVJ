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
  @if (session('mesage'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('mesage') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  <div class="">
    <!-- Panel Basic -->
    <div class="panel">
      <div class="panel-body">
        <div class="example-wrap">
          <h1 class="text-center panel-title">Productos de Sucursal {{$branch->name}}</h1>
          <div class="panel-actions float-right">
            <div class="container-fluid row float-right">
              @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
              <!-- Botón para Generar PDF de productos-->
              @if(Auth::user()->type_user == 1)
              <div class="col-6">
                <button onclick="window.location.href='/productos-sucursal/{{$branch->id}}'" type="button" id='pdf01'
                  name='pdf01' class=" btn btn-sm small btn-floating
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
        <div class="example-wrap">
          <div class="nav-tabs-horizontal" data-plugin="tabs">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab"
                  href="#exampleTabsOne" aria-controls="exampleTabsOne" role="tab">Productos Gr</a></li>
              <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleTabsTwo"
                  aria-controls="exampleTabsTwo" role="tab">Productos Pz</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                <div class="page-content panel-body container-fluid">
                  <!-- Tabla para listar productos-->
                  <table id="product_table_gr" class="table table-hover dataTable table-striped w-full"
                    data-plugin="dataTable">
                    <thead>
                      {{ csrf_field() }}
                      <tr>
                        <th>Clave</th>
                        <th>Descripción</th>
                        <th>Peso</th>
                        <th>Observaciónes</th>
                        <th>Imagen</th>
                        <th>Categoría</th>
                        <th>Sucursal</th>
                        <th>Linea</th>
                        <th>Status</th>
                        <th>Precio</th>
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
                        <th>Sucursal</th>
                        <th>Linea</th>
                        <th>Status</th>
                        <th>Precio</th>
                        @if(Auth::user()->type_user == 1 )
                        <th>Opciones</th>
                        @endif
                      </tr>
                    </tfoot>
                    <tbody>
                      @foreach ($products as $i => $product)
                      @if($product->category->type_product == 2 )
                      <tr id="row{{$product->id}}">
                        <td>{{ $product->clave }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{$product->weigth}}</td>
                        <td>{{ $product->observations }}</td>
                        <td>
                          <img width="100px" height="100px" src="{{ $product->image }}">
                        </td>
                        <td>{{$product->category->name}}</td>
                        <th>{{$product->branch->name}}</th>
                        <td>{{$product->line->name}}</td>
                        @if($product->status_id == 1)
                        <td><span class="text-center badge badge-secondary">{{$product->status->name}}</span></td>
                        @endif
                        @if($product->status_id == 2)
                        <td><span class="text-center badge badge-success">{{$product->status->name}}</span></td>
                        @endif
                        @if($product->status_id == 3)
                        <td><span class="text-center badge badge-primary">{{$product->status->name}}</span></td>
                        @endif
                        @if($product->status_id == 4)
                        <td><span class="text-center badge badge-warning">{{$product->status->name}}</span></td>
                        @endif
                        <td>${{$product->price}}</td>

                        @if(Auth::user()->type_user == 1)
                        <td>
                          <!-- Botón Para editar producto por sucursal-->
                          <a href="/sucursalproducto/{{$product->id}}/edit"><button type="button"
                              class="btn btn-icon btn-primary waves-effect waves-light waves-round"
                              data-toggle="tooltip" data-original-title="Editar">
                              <i class=" icon md-edit" aria-hidden="true"></i></button></a>
                          <!-- END Botón-->
                          <!-- Botón Para eliminar producto por sucursal-->
                          <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                            alt="{{ $product->id }}" role="button" data-toggle="tooltip" data-original-title="Borrar">
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
            <div class="tab-pane" id="exampleTabsTwo" role="tabpanel">
              <!-- Tabla para listar productos-->
              <table id="product_table_pz" class="table table-hover dataTable table-striped w-full"
                data-plugin="dataTable">
                <thead>
                  {{ csrf_field() }}
                  <tr>
                    <th>Clave</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Sucursal</th>
                    <th>Observaciónes</th>
                    <th>Imagen</th>
                    <th>Status</th>
                    <th>Precio venta</th>
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
                    <th>Sucursal</th>
                    <th>Observaciónes</th>
                    <th>Imagen</th>
                    <th>Status</th>
                    <th>Precio venta</th>
                    @if(Auth::user()->type_user == 1 )
                    <th>Precio Compra</th>
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
                    <td>{{ ($branchproduct->category) ? $branchproduct->category->name : '' }}</td>
                    <td>{{ ($product->branch) ? $product->branch->name : '' }}</td>
                    <td>{{ $branchproduct->observations }}</td>
                    <td>
                      <img width="100px" height="100px" src="{{ $product->image }}">
                    </td>
                    @if($product->status_id == 1)
                    <td><span class="text-center badge badge-secondary">{{$product->status->name}}</span></td>
                    @endif
                    @if($product->status_id == 2)
                    <td><span class="text-center badge badge-success">{{$product->status->name}}</span></td>
                    @endif
                    @if($product->status_id == 3)
                    <td><span class="text-center badge badge-primary">{{$product->status->name}}</span></td>
                    @endif
                    @if($product->status_id == 4)
                    <td><span class="text-center badge badge-warning">{{$product->status->name}}</span></td>
                    @endif

                    <td>${{$product->price}}
                      @if(Auth::user()->type_user == 1)
                    <td>${{$branchproduct->price_purchase}}
                    <td>
                      <!-- Botón Para editar producto por sucursal-->
                      <a href="/sucursalproducto/{{$branchproduct->id}}/edit"><button type="button"
                          class="btn btn-icon btn-primary waves-effect waves-light waves-round" data-toggle="tooltip"
                          data-original-title="Editar">
                          <i class=" icon md-edit" aria-hidden="true"></i></button></a>
                      <!-- END Botón-->
                      <!-- Botón Para eliminar producto por sucursal-->
                      <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                        alt="{{ $branchproduct->id }}" role="button" data-toggle="tooltip" data-original-title="Borrar">
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
@endsection

@section('barcode-product')
<script type="text/javascript">
  //inicializa la tabla para resposnive
  $(document).ready(function(){
      $('#product_table_gr').DataTable({
          retrieve: true,
          //  responsive: true,
          //paging: false,
          //searching: false
      });
      $('#product_table_pz').DataTable({
          retrieve: true,
          //responsive: true,
          //paging: false,
          //searching: false
      });

      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
          $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust()
            .responsive.recalc();
      });
  });
</script>
@endsection

<!-- Función Sweet Alert para eliminar producto-->
@section('delete-productos')
<script type="text/javascript">
  $(document).ready(function () {
setTimeout(() => {
  console.log("config datatable")
  $('#product_table_gr').on('click', '.delete', function(){
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
            url: '/sucursales/' + id + '/producto/',
            method: 'DELETE',
             success: function () {
              $('#product_table_gr').DataTable()
              .rows('.row' + id)
              .remove()
              .draw();
              Swal.fire(
                'Eliminado',
                'El registro ha sido eliminado.',
                'success'
              );
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
    $('#product_table_pz').on('click', '.delete', function(){
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
            url: '/sucursales/' + id + '/producto/',
            method: 'DELETE',
            success: function () {
              $('#product_table_pz').DataTable()
              .rows('.row' + id)
              .remove()
              .draw();
              Swal.fire(
                'Eliminado',
                'El registro ha sido eliminado.',
                'success'
              );
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
},500)
});
</script>
@endsection
<!-- END Función-->