@extends('layout.layoutdas')
@section('title')
LISTA DE  CATEGORIA
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
        <div class="panel-body">         
        <!-- Tabla listar productos devueltos-->
        <table id="devuelto" class=" display table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                    <thead>
                      {{ csrf_field() }}
                      <tr>
                        <th data-toggle="true">Clave</th>
                        <th data-hide="phone, tablet">Descripción</th>
                        <th data-hide="phone, tablet">Peso</th>
                        <th data-hide="phone, tablet">Observaciones</th>
                        <th data-hide="phone, tablet">Imagen</th>
                        <th data-hide="phone, tablet">Categoría</th>
                        <th data-hide="phone, tablet">Linea</th>
                        <th data-hide="phone, tablet">Sucursal</th>
                        <th data-hide="phone, tablet">Status</th>
                        <th data-hide="phone, tablet">Precio Venta</th>
                        <th data-hide="phone, tablet">Precio Compra</th>
                        <th data-hide="phone, tablet">Precio Descuento</th>
                        <th data-hide="phone, tablet">Opciones</th>
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
                        <th>Precio Venta</th>
                        <th>Precio Compra</th>
                        <th>Precio Descuento</th>
                        <th>Opciones</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      @foreach ($products as $i => $product)
                      @if($product->category->type_product == 2 )
                      <tr id="row{{$product->id}}" class="row{{$product->id}}">
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
                        <td><span class="text-center badge badge-danger">Devuelto</span></td>
                        <td>${{$product->price }}</td>
                        @if(Auth::user()->type_user == 1)
                        <td>${{$product->price_purchase }}</td>
                        <td>${{$product->discount }}</td>
                        <td>
                          <!-- Botón para restaurar producto devuelto-->
                          <a type="button" href="/productos/{{$product->id}}/reetiquetado"
                              class="btn btn-icon btn-info waves-effect waves-light waves-round" data-toggle="tooltip"
                              data-original-title="Editar">Restaurar</a>
                          <!-- END Botón-->
                        </td>
                        @endif
                      </tr>
                      @endif
                      @endforeach
                    </tbody>
                  </table>
          <!-- END Tabla-->
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
        $('#devuelto').DataTable({
            retrieve: true,
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
              .columns.adjust()
              .responsive.recalc();
        });
    });
    </script>
  @endsection


