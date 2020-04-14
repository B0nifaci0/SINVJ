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
          <h1 class="text-center panel-title">Productos Devueltos</h1>
          <div class="panel-actions float-right">
            <div class="container-fluid row float-right">
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
                  <table id="product_table_gr" class=" display table table-hover dataTable table-striped w-full" data-plugin="dataTable">
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
                        @if(Auth::user()->type_user == 1 )
                        <th data-hide="phone, tablet">Precio Compra</th>
                        <th data-hide="phone, tablet">Precio Descuento</th>
                        @endif
                        <th data-hide="phone, tablet">Restaurar</th>
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
                        @if(Auth::user()->type_user == 1 )
                        <th>Precio Compra</th>
                        <th>Precio Descuento</th>
                        @endif
                        <th>Restaurar</th>
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
                        @endif
                        <td>
                            <!-- Botón para restaurar producto devuelto-->
                            <a type="button" href="/productos/{{$product->id}}/reetiquetado"
                                class="btn btn-icon btn-info waves-effect waves-light waves-round" data-toggle="tooltip"
                                data-original-title="Restaurar">Restaurar</a>
                            <!-- END Botón-->
                        </td>
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
                <table id="product_table_pz" class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                  <thead>
                    {{ csrf_field() }}
                    <tr>
                      <th data-toggle="true">Clave</th>
                      <th data-hide="phone, tablet">Descripción</th>
                      <th data-hide="phone, tablet">Categoría</th>
                      <th data-hide="phone, tablet">Observaciónes</th>
                      <th data-hide="phone, tablet">Imagen</th>
                      <th data-hide="phone, tablet">Sucursal</th>
                      <th data-hide="phone, tablet">Status</th>
                      <th data-hide="phone, tablet">Precio Venta</th>
                      @if(Auth::user()->type_user == 1 )
                      <th data-hide="phone, tablet">Precio Compra</th>
                      <th data-hide="phone, tablet">Precio Descuento</th>
                      @endif
                      <th data-hide="phone, tablet">Restaurar</th>
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
                      <th>Precio Descuento</th>
                      @endif
                      <th>Restaurar</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($products as $i => $product)
                    @if($product->category->type_product == 1 )
                    <tr id="row{{$product->id}}" class="row{{$product->id}}">
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
                      <td><span class="text-center badge badge-danger">Devuelto</span></td>
                      <td>${{$product->price }}</td>
                      @if(Auth::user()->type_user == 1)
                        <td>${{$product->price_purchase}}</td>
                        <td>${{$product->discount}}</td>
                      @endif
                      <td>
                            <!-- Botón para restaurar producto devuelto-->
                            <a type="button" href="/productos/{{$product->id}}/reetiquetado"
                                class="btn btn-icon btn-info waves-effect waves-light waves-round" data-toggle="tooltip"
                                data-original-title="Restaurar">Restaurar</a>
                            <!-- END Botón-->
                        </td>
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
               success: function (response) {
                if(response.success){
                $('#product_table_gr').DataTable()
                .rows('.row' + id)
                .remove()
                .draw();
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
              url: '/productos/' + id,
              method: 'DELETE',
              success: function (response) {
                if(response.success){
                $('#product_table_pz').DataTable()
                .rows('.row' + id)
                .remove()
                .draw();
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
  },500)
  });
  </script>
  @endsection
  <!-- END Función-->
 