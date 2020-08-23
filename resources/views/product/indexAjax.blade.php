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
        <div class="example-wrap">
          <div class="nav-tabs-horizontal" data-plugin="tabs">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" data-toggle="tab" href="#exampleTabsOne" aria-controls="exampleTabsOne"
                  role="tab">Productos Gr</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" data-toggle="tab" href="#exampleTabsTwo" aria-controls="exampleTabsTwo"
                  role="tab">Productos Pz</a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                <div class="page-content panel-body container-fluid">
                  <table id="product_table_gr" class=" display table table-hover dataTable table-striped w-full">
                    <thead>
                      {{ csrf_field() }}
                      <tr>
                        <th>Clave</th>
                        <th>Descripción</th>
                        <th>Peso</th>
                        <th>Observaciones</th>
                        <th>Imagen</th>
                        <th>Categoría</th>
                        <th>Línea</th>
                        <th>Sucursal</th>
                        <th>Status</th>
                        {{-- @if(Auth::user()->type_user == 1 )
                        <th data-hide="phone, tablet">Precio Compra</th>
                        @endif --}}
                        <th>Precio Venta</th>
                        <th>Opciones</th>
                        {{-- @if(Auth::user()->type_user == 1 )
                        <th data-hide="phone, tablet">Precio Descuento</th>
                        @endif --}}
                      </tr>
                    </thead>
                  </table>
                  <!-- END Table-->
                </div>
              </div>
            </div>
            <div class="tab-pane" id="exampleTabsTwo" role="tabpanel">
              <div class="page-content panel-body container-fluid">
                <!-- Tabla para listar productos-->
                <table id="product_table_pz" class="table table-hover dataTable table-striped w-full">
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
                      @if(Auth::user()->type_user == 1 )
                      <th data-hide="phone, tablet">Precio Compra</th>
                      @endif
                      <th data-hide="phone, tablet">Precio Venta</th>
                      @if(Auth::user()->type_user == 1 )
                      <th data-hide="phone, tablet">Precio Descuento</th>
                      <th data-hide="phone, tablet">Opciones</th>
                      @endif
                    </tr>
                  </thead>
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
@endsection @section('barcode-product')
<script type="text/javascript">
  //inicializa la tabla para resposnive
  $(document).ready(()=>{
    table_gr = $('#product_table_gr').DataTable({
      // processing: true,
      serverSide: true,
      responsive: true,
      ajax: '{!! route('get.products') !!}',
      columns: [
      { data: 'clave', name: 'clave' },
      { data: 'description', name: 'description' },
      { data: 'weigth', name: 'weigth' },
      { data: 'observations', name: 'observations' },
      {
        "data": "image",
        "render": (data)=> {
          return  `<a class="inline-block" href="`+ data +`"
           data-plugin="magnificPopup" data-close-btn-inside="false"
            data-fixed-contentPos="true" data-main-class="mfp-margin-0s mfp-with-zoom"
            data-zoom='{"enabled": "true","duration":"300"}'>
            <img class="img-fluid" src="`+ data + ` " alt="..." width="200" height="150"></a>`
            // '<img src="' + data + '" class="img-fluid" width="200" height="150" />';
        }
      },
      { data: 'category_id', name: 'category_id' },
      { data: 'line_id', name: 'line_id' },
      { data: 'branch_id', name: 'branch_id' },
      { data: 'status_id', name: 'status_id' },
      { data: 'price', name: 'price' },
      {
        "defaultContent": `<button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"> <i class="icon md-delete" aria-hidden="true"></i> </button> 
        
        <a type="button" href="/productos/` + `/edit" class="btn btn-icon btn-info waves-effect waves-light waves-round" data-toggle="tooltip" data-original-title="Editar"> <i class="icon md-edit" aria-hidden="true"></i></a>`
      },
    ]
  });

  $('a[data-toggle="tab"]').on('shown.bs.tab',  (e) =>{
    $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust()
      .responsive.recalc();
  });

  $('#product_table_gr').on('click', '.delete', function(){
    row = $(this).parents('tr');
    if (row.hasClass('child')) {
      row = row.prev();
    }
    var data = table_gr.row(row).data();
    // console.log(data.id )
    id = data.id
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
        success: (response) =>{
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
        error: () => {
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