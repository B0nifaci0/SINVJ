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
  <!-- Panel Basic -->
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
                          toggler-left  btn-danger waves-effect waves-light waves-round float-right"
                data-toggle="tooltip" data-original-title="Generar reporte PDF">
                <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
              </button>
              </div>
              <div class="col-6">
                <button onclick="window.location.href='/productos/create'" type="button" class=" btn btn-sm small btn-floating
                          toggler-left  btn-info waves-effect waves-light waves-round float-left"
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
                      <th>Precio Venta</th>
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
                      <th>Precio Venta</th>
                      <th>Status</th>
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
                          data-main-class="mfp-margin-0s mfp-with-zoom"
                          data-zoom='{"enabled": "true","duration":"300"}'>
                          <img class="img-fluid" src="{{ $product->image }}" alt="..." width="220" />
                      </td>
                      <td>{{ ($product->category) ? $product->category->name : '' }}</td>
                      <td>{{$product->line->name}}</td>
                      <td>{{$product->branch->name}}</td>
                      <td>${{($product->price) ? $product->price:''}}</td>
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
                      @if(Auth::user()->type_user == 1)
                      <td>
                        <!-- Botón para editar producto-->
                        <a href="/productos/{{$product->id}}/edit"><button type="button"
                            class="btn btn-icon btn-info waves-effect waves-light waves-round" data-toggle="tooltip"
                            data-original-title="Editar">
                            <i class="icon md-edit" aria-hidden="true"></i></button>
                        </a>
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
              <table id="product_table_pz" class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
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
                    <td>{{ $product->clave }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ ($product->category) ? $product->category->name : '' }}</td>
                    <td>{{ $product->observations }}</td>
                    <td>
                      <a class="inline-block" href="{{ $product->image }}" data-plugin="magnificPopup"
                        data-close-btn-inside="false" data-fixed-contentPos="true"
                        data-main-class="mfp-margin-0s mfp-with-zoom" data-zoom='{"enabled": "true","duration":"300"}'>
                        <img class="img-fluid" src="{{ $product->image }}" alt="..." width="220" />
                    </td>
                    <td>{{ ($product->branch) ? $product->branch->name : '' }}</td>
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
                    <td>${{($product->price) ? $product->price:''}}</td>
                      @if(Auth::user()->type_user == 1)
                    <td>{{$product->price_purchase}}
                    <td>
                      <!-- Botón para editar producto-->
                      <a href="/productos/{{$product->id}}/edit"><button type="button"
                          class="btn btn-icon btn-info waves-effect waves-light waves-round" data-toggle="tooltip"
                          data-original-title="Editar">
                          <i class="icon md-edit" aria-hidden="true"></i></button>
                      </a>
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
      </div>
      <!-- End Example Tabs -->
    </div>
  </div>
</div>
</div>
<!-- End Panel Basic -->
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
