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
        <header class="panel-heading">
          <div class="panel-actions">
            <div class="row">
              <!-- Botón para generar PDF de traspaso-->
              <div class="col-md-6 col-md-offset-2">
                <button onclick="window.location.href='traspasospdf'" 
                  type="button" class=" btn btn-sm small btn-floating 
                  toggler-left  btn-danger waves-effect waves-light waves-round float-right"
                  data-toggle="tooltip" data-original-title="Generar reporte PDF">
                  <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                </button>
              </div>
              <!-- END Botón-->
              <!-- Botón para crear traspaso-->
              <div class="col-md-6 col-md-offset-2">
                <button onclick="window.location.href='/traspasos/create'" type="button" class=" btn btn-sm small btn-floating  toggler-left 
                  btn-info waves-effect waves-light waves-round float-right "
                  data-toggle="tooltip" data-original-title="Agregar">
                  <i class="icon md-plus" aria-hidden="true"></i>
                </button>
              </div>
              <!-- END Botón-->
            </div>
          </div>
          <h3 class="panel-title">Traspasos</h3>
        </header>
        <div class="panel-body">
          <!-- Tabla para Listar Traspasos-->
          <table id='example'  class="table table-hover dataTable table-striped w-full">
            <thead>
              <tr>
                <th>id</th>
                <th>Clave Del Producto</th>
                <th>Producto</th>
                <th>Peso</th>
                <th>Categoría</th>
                <th>Linea</th>
                <th>Sucursal</th>
                <th>Quien lo mando</th>
                <th>Destino</th>
                <th>Quien recibio</th>
                <th>Fecha</th>
                <th>Status</th>
                <th>Opciones</th>
                <th>Reporte</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>id</th>
                <th>Clave Del Producto</th>
                <th>Producto</th>
                <th>Peso</th>
                <th>Categoría</th>
                <th>Linea</th>
                <th>Sucursal</th>
                <th>Quien lo mando</th>
                <th>Destino</th>
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
                  <td>{{ $transfer->id }}</td> 
                  <td>{{ $transfer->product->clave }}</td> 
                  <td>{{ $transfer->product->name }}</td>
                  <td>{{ $transfer->product->weigth }}</td>
                  <td>{{ $transfer->product->category->name }}</td>
                  <td>{{ $transfer->product->line->name }}</td>
                  <td>{{ $transfer->lastBranch->name}}</td>
                  <td>{{ $transfer->user->name}}</td>
                  <td>{{ $transfer->newBranch->name}}</td>
                  <td>{{ $transfer->destinationUser->name}}</td>
                  <td>{{ $transfer->created_at->format('m-d-Y')}}</td>
                  <td>
                    @if($transfer->status_product === 1)
                      Aceptado
                    @elseif($transfer->status_product === 0)
                      Rechazado
                    @else
                      Pendiente
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
                        @if(Auth::user()->id == $transfer->user_id)
                          <button class="btn btn-success paid" alt="{{ $transfer->id }}">Pagado</button>
                        @else
                          Por pagar
                        @endif
                      @else
                        Pagado
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
@endsection

@section('traspaso')
<script>
$(document).ready(function(){

  $(".paid").click(function() {
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

  $('.accept').click(function() {
    var id = $(this).attr('alt');
    $('#transfer_id').val(id);
    $('#answer').val(1);
    $('#form').submit();
  })

  $('.cancel').click(function() {
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

