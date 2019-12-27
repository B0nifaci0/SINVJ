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
  <div class="page-content">
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
              @if(Auth::user()->type_user == 1 )
              <!-- Botón para Generar PDF de productos-->
              <div class="col-6">
                <button onclick="window.location.href='productospdf'" type="button" id='pdf01' name='pdf01' class=" btn btn-sm small btn-floating
                 btn-danger waves-effect waves-light waves-round float-right"
                  data-toggle="tooltip" data-original-title="Generar reporte PDF">
                  <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                </button>
              </div>
              <div class="col-6">
                <button onclick="window.location.href='/productos/create'" type="button" class=" btn btn-sm small btn-floating
                 btn-info waves-effect waves-light waves-round float-left"
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
              <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab"
                  href="#exampleTabsOne" aria-controls="exampleTabsOne" role="tab">Productos Gr</a></li>
              <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleTabsTwo"
                  aria-controls="exampleTabsTwo" role="tab">Productos Pz</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                <div class="page-content panel-body container-fluid">
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
                        <th>Linea</th>
                        <th>Sucursal</th>
                        <th>Status</th>
                        <th>precio</th>
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
                        <th></th>
                        <th>Sucursal</th>
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
                        <td>{{ $product->weigth }}</td>
                        <td>{{ $product->observations }}</td>
                        <td>
                          <a class="inline-block" href="{{ $product->image }}" data-plugin="magnificPopup"
                          data-close-btn-inside="false" data-fixed-contentPos="true"
                          data-main-class="mfp-margin-0s mfp-with-zoom" data-zoom='{"enabled": "true","duration":"300"}'>
                          <img class="img-fluid" src="{{ $product->image }}" alt="..." width="200" height="150"
                          />
                        </td>
                        <td>{{ ($product->category) ? $product->category->name: '' }}</td>
                        <td>{{ ($product->line) ? $product->line->name : '' }}</td>
                        <td>{{ ($product->branch) ? $product->branch->name: '' }}</td>
                        @if($product->status)
                        <td><span class="text-center badge badge-primary">{{$product->status->name}}</span></td>
                        @endif
                        <td>${{$product->price }}</td>
                        @if(Auth::user()->type_user == 1)
                        <td>
                          <!-- Botón para editar producto-->
                          <a type="button" href="/productos/{{$product->id}}/edit"
                              class="btn btn-icon btn-info waves-effect waves-light waves-round" data-toggle="tooltip"
                              data-original-title="Editar">
                              <i class="icon md-edit" aria-hidden="true"></i></a>
                          <!-- END Botón-->
                          <!-- Botón para eliminar producto -->
                          <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                            alt="{{$product->id}}" role="button" data-toggle="tooltip" data-original-title="Borrar">
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
              <div class="page-content panel-body container-fluid">
                <!-- Tabla para listar productos-->
                <table id="product_table_pz" class="table table-hover dataTable table-striped w-full table-responsive"
                    data-plugin="dataTable">
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
                      @if(Auth::user()->type_user == 1 )
                      <th>Precio Compra</th>
                      <th>Opciones</th>
                      @endif
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($products as $i => $product)
                    @if($product->category->type_product == 1 )
                    <tr id="row{{$product->id}}">
                      <td>{{$product->clave}}</td>
                      <td>{{ $product->description }}</td>
                      <td>{{ ($product->category) ? $product->category->name : '' }}</td>
                      <td>{{ $product->observations }}</td>
                      <td>
                        <a class="inline-block" href="{{ $product->image }}" data-plugin="magnificPopup"
                          data-close-btn-inside="false" data-fixed-contentPos="true"
                          data-main-class="mfp-margin-0s mfp-with-zoom" data-zoom='{"enabled": "true","duration":"300"}'>
                          <img class="img-fluid" src="{{ $product->image }}" alt="..." width="200" height="150"
                          />
                      </td>
                      <td>{{ ($product->branch) ? $product->branch->name : '' }}</td>
                      @if($product->status)
                      <td><span class="text-center badge badge-primary">{{$product->status->name}}</span></td>
                      @endif
                      <td>${{$product->price }}</td>
                      @if(Auth::user()->type_user == 1)
                      <td>${{$product->price_purchase}}</td>
                      <td>
                        <!-- Botón para editar producto-->
                        <a type="button" href="/productos/{{$product->id}}/edit"
                            class="btn btn-icon btn-info waves-effect waves-light waves-round" data-toggle="tooltip"
                            data-original-title="Editar">
                            <i class="icon md-edit" aria-hidden="true"></i></a>
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
                    @endif
                    @endforeach
                  </tbody>
                </table>
                <!-- END Table-->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Example Tabs -->
    </div>
  </div>
  <!-- End Panel Basic -->
  @endsection
  @section('barcode-product')
  <script>
    $(document).ready(function () {

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
              url: '/productos/' + id,
              method: 'DELETE',
              success: function () {
                $("#row" + id).remove();   
                Swal.fire(
                  'Eliminado',
                  'El registro ha sido eliminado.',
                  'success'
                )
                //Destroy the old Datatable
                $('#product_table_gr').DataTable().clear().destroy();

                //Create new Datatable
                $('#product_table_gr').DataTable()

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
 