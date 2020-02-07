@extends('layout.layoutdas')
@section('title')
LISTA DE  VENTAS
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
    @if (session('mesage-update'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('mesage-update') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
	    </div>
		@endif
    <div class="page-content">
      <!-- Panel Basic -->
      <div class="panel">
        <div class="panel-body">
            <div class="example-wrap">
              <h1 class="text-center panel-title">Ventas</h1>
              <div class="panel-actions float-right">
                <div class="container-fluid row float-right">
                  <!-- Botón para Generar PDF de productos-->
                  <div class="col-6">
                    <button onclick="window.location.href='ventaspdf'"
                  type="button" class=" btn btn-sm small btn-floating
                  toggler-left  btn-danger waves-effect waves-light waves-round float-right"
                  data-toggle="tooltip" data-original-title="Generar reporte PDF">
                  <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                </button>
                  </div>
                  <div class="col-6">
                    <button onclick="window.location.href='/ventas/create'" type="button" class=" btn btn-sm small btn-floating  toggler-left  btn-info waves-effect waves-light waves-round float-left">
                        <i class="icon md-plus" aria-hidden="true"></i>
                       </button>
                  </div>
                  <!-- END Botón-->
                </div>
              </div>
            </div>
          </div>
        <div class="panel-body">
        <!-- Tabla para listar ventas-->

        <div class="col-xl-12 col-md-12 col-sl">
        <div class="example-wrap">
          <div class="nav-tabs-horizontal" data-plugin="tabs">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab"
                  href="#exampleTabsOne" aria-controls="exampleTabsOne" role="tab">Vendidos</a></li>
              <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleTabsTwo"
                  aria-controls="exampleTabsTwo" role="tab">Apartados</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                <div class="page-content panel-body container-fluid">
                <table id="sale_table_sold"  class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
            <thead>
              <tr>
                <th>Clave</th>
                <th>Nombre del cliente</th>
                <th>Tipo</th>
                <th>Teléfono</th>
                <th>Productos</th>
                <th>Total</th>
                <th>Fecha</th>
                @if(Auth::user()->type_user == 1 )
                <th>Sucursal</th>
                @endif
                <th>Estatus</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Clave</th>
                <th>Nombre del cliente</th>
                <th>Tipo</th>
                <th>Teléfono</th>
                <th>Productos</th>
                <th>Total</th>
                <th>Fecha</th>
                @if(Auth::user()->type_user == 1 )
                <th>Sucursal</th>
                @endif
                <th>Estatus</th>
                <th>Opciones</th>
              </tr>
            </tfoot>
            <tbody>
                @foreach ($sold as $sale)
                  <tr id = "row{{ $sale->id }}">
                    <td>{{$sale->folio}}</td>
                    <td>
                      @if($sale->client)
                      <a href="/mayoristas/{{$sale->client->id}}">
                      {{ "{$sale->client->name} {$sale->client->first_lastname} {$sale->client->second_lastname}" }}
                      </a>
                      @else
                        {{$sale->customer_name}}
                      @endif
                    </td>
                    <td>{{ ($sale->client) ? 'Mayorista' : 'Publico' }}</td>
                    <td>{{ $sale->telephone }}</td>
                    <td>{{ $sale->items->count() }}</td>
                    <td>$ {{ $sale->total }}</td>
                    <td>{{ $sale->created_at->format('m-d-Y')}}</td>
                    @if(Auth::user()->type_user == 1 )
                    <td>{{ $sale->sucursal }}</td>
                    @endif
                    <td><span class="text-center badge badge-success">Liquidado</span></td>
                    <td>
                      <a href="/ventas/{{ $sale->id }}"><button type="button"
                          class="btn btn-icon btn-primary waves-effect waves-light"
                          data-toggle="tooltip" data-original-title="Detalle de la Venta">
                          <i class="icon fa-search" aria-hidden="true"></i></button>
                      </a>
                      <a href="ventapdf/{{$sale->id}}"><button type="button"
                        class="btn btn-icon btn-danger waves-effect waves-light"
                        data-toggle="tooltip" data-original-title="Generar reporte PDF">
                        <i class="icon fa-file-pdf-o" aria-hidden="true"></i></button>
                      </a>
                    </td>
                  </tr>
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
                <table id="sale_table_apart"  class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
            <thead>
              <tr>
                <th>Clave</th>
                <th>Nombre del cliente</th>
                <th>Tipo</th>
                <th>Teléfono</th>
                <th>Productos</th>
                <th>Total a pagar</th>
                <th>Total Pagado</th>
                <th>Fecha</th>
                @if(Auth::user()->type_user == 1 )
                <th>Sucursal</th>
                @endif
                <th>Estatus</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Clave</th>
                <th>Nombre del cliente</th>
                <th>Tipo</th>
                <th>Teléfono</th>
                <th>Productos</th>
                <th>Total a pagar</th>
                <th>Total Pagado</th>
                <th>Fecha</th>
                @if(Auth::user()->type_user == 1 )
                <th>Sucursal</th>
                @endif
                <th>Estatus</th>
                <th>Opciones</th>
              </tr>
            </tfoot>
            <tbody>
                @foreach ($apart as $sale)
                  <tr id = "row{{ $sale->id }}">
                    <td>{{$sale->folio}}</td>
                    <td>
                      @if($sale->client)
                      <a href="/mayoristas/{{$sale->client->id}}">
                      {{ "{$sale->client->name} {$sale->client->first_lastname} {$sale->client->second_lastname}" }}
                      </a>
                      @else
                        {{$sale->customer_name}}
                      @endif
                    </td>
                    <td>{{ ($sale->client) ? 'Mayorista' : 'Publico' }}</td>
                    <td>{{ $sale->telephone }}</td>
                    <td>{{ $sale->items->count() }}</td>
                    <td>$ {{ $sale->total }}</td>
                    <td>$ {{ $sale->payments }}</td>
                    <td>{{ $sale->created_at->format('m-d-Y')}}</td>
                    @if(Auth::user()->type_user == 1 )
                    <td>{{ $sale->sucursal }}</td>
                    @endif
                    <td><span class="text-center badge badge-warning">No Liquidado</span></td>
                    <td>
                      <a href="/ventas/{{ $sale->id }}"><button type="button"
                          class="btn btn-icon btn-primary waves-effect waves-light"
                          data-toggle="tooltip" data-original-title="Detalle de la Venta">
                          <i class="icon fa-search" aria-hidden="true"></i></button>
                      </a>
                      <a href="ventapdf/{{$sale->id}}"><button type="button"
                        class="btn btn-icon btn-danger waves-effect waves-light"
                        data-toggle="tooltip" data-original-title="Generar reporte PDF">
                        <i class="icon fa-file-pdf-o" aria-hidden="true"></i></button>
                      </a>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
                <!-- END Table-->
              </div>
            </div>
          </div>
        </div>
      </div>


            
          <!-- END Tabla-->
        </div>
      </div>
    </div>
  </div>
  <!-- End Panel Basic -->
@endsection

@section('footer')
@endsection

@section('barcode-ventas')
  <script type="text/javascript">
  //inicializa la tabla para resposnive
    $(document).ready(function(){
        $('#sale_table_sold').DataTable({
            retrieve: true,
            //  responsive: true,
            //paging: false,
            //searching: false
        });
        $('#sale_table_apart').DataTable({
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

@section('delete-ventas')
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
        $.ajax({
           headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url:  '/ventas/' + id,
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
@section('barcode-product')
@endsection
