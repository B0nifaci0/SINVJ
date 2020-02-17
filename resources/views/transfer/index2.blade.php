@extends('layout.layoutdas')
@section('title')
TRASFERENCIAS
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
  @if (session('mesage-delete'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session('mesage-delete') }}</strong>
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
              <h1 class="text-center panel-title">Traspasos</h1>
              <div class="panel-actions float-right">
                <div class="container-fluid row float-right">

                  <!-- Botón para Generar PDF de productos-->
                  <div class="col-6">
                    <button onclick="window.location.href='traspasospdf'" type="button" class=" btn btn-sm small btn-floating
                  toggler-left  btn-danger waves-effect waves-light waves-round float-right" data-toggle="tooltip"
                data-original-title="Generar reporte PDF">
                <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
              </button>
                  </div>
                  <div class="col-6">
                    <button onclick="window.location.href='/traspasos/create'" type="button" class=" btn btn-sm small btn-floating  toggler-left
                  btn-info waves-effect waves-light waves-round float-left " data-toggle="tooltip"
                data-original-title="Agregar">
                <i class="icon md-plus" aria-hidden="true"></i>
              </button>
                  </div>
                  <!-- END Botón-->
                </div>
              </div>
            </div>
          </div>
        <div class="panel-body">
          <!-- Tabla para Listar Traspasos-->
          <table id="traspaso" class=" display table table-hover dataTable table-striped w-full" data-plugin="dataTable">
            <thead>
              <tr>
                <th>Clave Del Producto</th>
                <th>Producto</th>
                <th>Peso</th>
                <th>Categoría</th>
                <th>Linea</th>
                <th>S.Origen</th>
                <th>Quien lo mando</th>
                <th>S.Destino</th>
                <th>Quien recibio</th>
                <th>Fecha</th>
                <th>Status</th>
                <th>Opciones</th>
                <th>Reporte</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Clave Del Producto</th>
                <th>Producto</th>
                <th>Peso</th>
                <th>Categoría</th>
                <th>Linea</th>
                <th>S.Origen</th>
                <th>Quien lo mando</th>
                <th>S.Destino</th>
                <th>Quien recibio</th>
                <th>Fecha</th>
                <th>Status</th>
                <th>Opciones</th>
                <th>Reporte</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach  ($trans as $transfer)
                <tr id = "row{{$transfer->id}}">
                  <td>{{ $transfer->product->clave }}</td>
                  <td>{{ $transfer->product ? $transfer->product->description : 'Sin product' }}</td>
                  <td>{{ $transfer->product->weigth }}</td>
                  <td>{{ $transfer->product->category ? $transfer->product->category->name : 'Sin category' }}</td>
                  <td>{{ $transfer->product->line ? $transfer->product->line->name : 'Sin line' }}</td>
                  <td>{{ $transfer->lastBranch ? $transfer->lastBranch->name : 'Sin lastBranch'}}</td>
                  <td>{{ $transfer->user ? $transfer->user->name : 'Sin user'}}</td>
                  <td>{{ $transfer->newBranch ? $transfer->newBranch->name : 'Sin newBranch'}}</td>
                  <td>{{ $transfer->destinationUser ? $transfer->destinationUser->name : 'Sin destinationUser'}}</td>
                  <td>{{ $transfer->created_at->format('m-d-Y')}}</td>
                  <td>
                    @if($transfer->status_product === 1)
                      <span class="text-center badge badge-success">Aceptado</span>
                    @elseif($transfer->status_product === 0)
                      <span class="text-center badge badge-warning">Rechazado</span>
                    @elseif($transfer->status_product === 3)
                      <span class="text-center badge badge-danger">Devuelto</span>
                    @else
                      <span class="text-center badge badge-primary">Pendiente</span>
                    @endif
                  </td>
                  <td>
                    <!-- Botón para Aceptar o Rechazar Traspaso -->
                    @if($transfer->status_product === null)
                      @if(Auth::user()->id == $transfer->user_id)
                        <button class="btn btn-warning cancel" alt="{{ $transfer->id }}">Cancelar</button>
                      @else
                      <button class="btn btn-primary accept" alt="{{ $transfer->id }}">Aceptar</button>
                      <button class="btn btn-warning reject" alt="{{ $transfer->id }}">Rechazar</button>
                      @endif
                    @else
                      @if(!$transfer->paid_at)
                        @if(Auth::user()->id == $transfer->user_id && $transfer->status_product == 1)
                          <button class="btn btn-success paid" alt="{{ $transfer->id }}">Pagar</button>
                          <button class="btn btn-danger give-back" alt="{{ $transfer->id }}">Devolver</button>
                        @else
                          @if($transfer->status_product === null)
                            <span class="text-center badge badge-success">Pendiente</span>
                          @elseif($transfer->status_product == 1)
                            <span class="text-center badge badge-warning">Por pagar</span>
                          @elseif($transfer->status_product == 0 || $transfer->status_product == 3)
                            <span class="text-center badge badge-warning">No se paga</span>
                          @endif
                        @endif
                      @else
                        <span class="text-center badge badge-success">Pagado</span>
                      @endif
                    @endif
                    <!-- END Botón-->
                  </td>
                  <td>
                    <!-- Botón para generar Traspaso por (ID)-->
                    <a href="traspasopdf/{{$transfer->id}}"<button type="button"
                      class="btn btn-icon btn-danger waves-effect waves-light"
                      data-toggle="tooltip" data-original-title="Generar reporte PDF">
                      <i class="icon fa-file-pdf-o" aria-hidden="true"></i></button>
                    </a>
                    <!-- END Botón-->
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <!-- END Tabla-->
        </div>
      </header>

    </div>
  </div>
  <!-- End Panel Basic -->
</div>
<form method="post" action="/traspasos/respuesta" id="form" class="d-none">
  {{ csrf_field() }}
  <input type="text" name="transfer_id" id="transfer_id">
  <input type="text" name="answer" id="answer">
</form>

  <form method="post" action="/traspasos/pagar" id="payment-form" class="d-none">
    {{ csrf_field() }}
    <input type="text" name="transfer_id" id="inventory_id">
  </form>

  <form method="post" action="/traspasos/cancelar" id="give-back" class="d-none">
    {{ csrf_field() }}
    <input type="text" name="transfer_id" id="inventory_id">
  </form>

<form method="post" action="/inventory/check" id="payment-form" class="d-none">
  {{ csrf_field() }}
  <input type="text" name="inventory_id" id="inventory_id">
  <input type="text" name="status" id="status">
  <input type="text" name="discar_cause" id="discar_cause">
</form>
@endsection

@section('barcode-product')
<script type="text/javascript">
//inicializa la tabla para resposnive
  $(document).ready(function(){
      $('#traspaso').DataTable({
          retrieve: true,
          //  responsive: true,
          //paging: false,
          //searching: false
      });

  });
  </script>
@endsection

@section('traspaso')
<script>
  $(document).ready(function () {

  $('#traspaso').on('click', '.paid', function(){
      let id = $(this).attr("alt");
      Swal.fire({
        title: 'Confirmación',
        text: "¿Se ha pagado este traspaso?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#4caf50' ,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
      }).then((result) => {
        if (result.value)
        {
          $('#inventory_id').val(id);
          $('#payment-form').submit();
        }
      })
  });

  $('#traspaso').on('click', '.give-back', function(){

      let id = $(this).attr("alt");
      Swal.fire({
        title: 'Confirmación',
        text: "¿Se ha devuelto este producto?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#4caf50' ,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
      }).then((result) => {
        if (result.value)
        {
          $('#inventory_id').val(id);
          $('#payment-form').submit();
        }
      })
  });

  $('#traspaso').on('click', '.accept', function(){
    var id = $(this).attr('alt');
    $('#transfer_id').val(id);
    $('#answer').val(1);
    $('#form').submit();
  })

  $('#traspaso').on('click', '.cancel', function(){
      var id = $(this).attr('alt');
      $('#transfer_id').val(id);
      $('#answer').val(null);
      $('#form').submit();
    })

  $('#traspaso').on('click', '.reject', function(){
      var id = $(this).attr('alt');
      $('#transfer_id').val(id);
      $('#answer').val(0);
      $('#form').submit();
    })
  });

</script>
@endsection

@section('filter')
<script>
  /*
  $(document).ready(function(){
    $('#filteringStatus').change(function(){
      //alert($(this).val())
      if($(this).val()==''){
          $('.active').each(function(){
              $(this).removeClass('hidden')
          });
          $('.disable').each(function(){
              $(this).removeClass('hidden')
          });
      }else if($(this).val()=='activo'){
          $('.active').each(function(){
              $(this).removeClass('hidden')
          });
          $('.disable').each(function(){
              $(this).addClass('hidden')
          });
      }else{
          $('.disable').each(function(){
              $(this).removeClass('hidden')
          });
          $('.active').each(function(){
              $(this).addClass('hidden')
          });
      }
    });
  });
  */
</script>
@endsection