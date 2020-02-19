@extends('layout.layoutdas')
@section('title')
TRANSFERENCIAS
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
                    <h1 class="text-center panel-title"> Mis Traspasos</h1>
                    <div class="panel-actions float-right">
                        <div class="container-fluid row float-right">
                            @if(Auth::user()->type_user == 1 )
                            <!-- Botón para Generar PDF de productos-->
                            @if(Auth::user()->type_user == 1)
                            <div class="col-6">
                                <button onclick="window.location.href='traspasospdf'" type="button" class=" btn btn-sm small btn-floating
                  toggler-left  btn-danger waves-effect waves-light waves-round float-right" data-toggle="tooltip"
                                    data-original-title="Generar reporte PDF">
                                    <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                                </button>
                            </div>
                            @endif
                            <div class="col-6">
                                <button onclick="window.location.href='/traspasos/create'" type="button" class=" btn btn-sm small btn-floating  toggler-left
                  btn-info waves-effect waves-light waves-round float-left " data-toggle="tooltip"
                                    data-original-title="Agregar">
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
                                    href="#exampleTabsOne" aria-controls="exampleTabsOne" role="tab">Entrantes</a>
                            </li>
                            <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab"
                                    href="#exampleTabsTwo" aria-controls="exampleTabsTwo" role="tab">Salientes</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                                <div class="page-content panel-body container-fluid">
                                    <table id='incoming_transfers'
                                        class="table table-hover dataTable table-striped w-full"
                                        data-plugin="dataTable">
                                        <thead>
                                            <tr>
                                                <th>Clave</th>
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
                                                <th>Clave</th>
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
                                            @foreach ($trans2 as $transferin)
                                            <tr id="row{{$transferin->id}}">
                                                <td>{{ $transferin->product->clave }}</td>
                                                <td>{{ $transferin->product->weigth }}</td>
                                                <td>{{ $transferin->product->category->name }}</td>
                                                <td>{{ $transferin->product->line ? $transferin->product->line->name : '' }}
                                                </td>
                                                <td>{{$transferin->lastBranch->name}}</td>
                                                <td>{{$transferin->user->name}}</td>
                                                <td>{{$transferin->newBranch->name}}</td>
                                                <td>{{$transferin->destinationUser->name}}</td>
                                                <td>{{$transferin->created_at->format('m-d-Y')}}</td>
                                                <td>
                                                    @if($transferin->status_product === 1 || $transferin->paid_at)
                                                    @if($transferin->paid_at)
                                                    <span class="text-center badge badge-success">Pagado</span>
                                                    @else
                                                    <span class="text-center badge badge-success">Aceptado</span>
                                                    @endif
                                                    @elseif($transferin->status_product === 0)
                                                    <span class="text-center badge badge-secondary">Rechazado</span>
                                                    @elseif($transferin->status_product === 3)
                                                    <span class="text-center badge badge-danger">Devuelto</span>
                                                    @else
                                                    <span class="text-center badge badge-primary">Pendiente</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <!-- Botón para Aceptar o Rechazar Traspaso -->
                                                    @if($transferin->status_product === null)
                                                    @if(Auth::user()->id == $transferin->user_id)
                                                    <button class="btn btn-warning cancel"
                                                        alt="{{ $transferin->id }}">Cancelar</button>
                                                    @else
                                                    <button class="btn btn-primary accept"
                                                        alt="{{ $transferin->id }}">Aceptar</button>
                                                    <button class="btn btn-warning reject"
                                                        alt="{{ $transferin->id }}">Rechazar</button>
                                                    @endif
                                                    @else
                                                    @if(!$transferin->paid_at)
                                                    @if(Auth::user()->id == $transferin->user_id &&
                                                    $transferin->status_product == 1)
                                                    <button class="btn btn-danger give-back"
                                                        alt="{{ $transferin->id }}">Devolver</button>
                                                    @else
                                                    @if($transferin->status_product === null)
                                                    <span class="text-center badge badge-success">Pendiente</span>
                                                    @elseif($transferin->status_product == 1)
                                                    <span class="text-center badge badge-warning">Por pagar</span>
                                                    @elseif($transferin->status_product == 0 ||
                                                    $transferin->status_product
                                                    == 3)
                                                    <span class="text-center badge badge-info">No se paga</span>
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
                                                    <a href="traspasopdf/{{$transferin->id}}"><button type="button"
                                                            class="btn btn-icon btn-danger waves-effect waves-light"
                                                            data-toggle="tooltip"
                                                            data-original-title="Generar reporte PDF">
                                                            <i class="icon fa-file-pdf-o"
                                                                aria-hidden="true"></i></button>
                                                    </a>
                                                    <!-- END Botón-->
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="exampleTabsTwo" role="tabpanel">
                            <div class="page-content panel-body container-fluid">
                                <table id='outgoing_transfers' class="table table-hover dataTable table-striped w-full"
                                    data-plugin="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Clave</th>
                                            <th>Peso</th>
                                            <th>Categoría</th>
                                            <th>Linea</th>
                                            <th>S.Origen</th>
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
                                            <th>Clave</th>
                                            <th>Peso</th>
                                            <th>Categoría</th>
                                            <th>Linea</th>
                                            <th>S.Origen</th>
                                            <th>S.Destino</th>
                                            <th>Quien recibio</th>
                                            <th>Fecha</th>
                                            <th>Status</th>
                                            <th>Opciones</th>
                                            <th>Reporte</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($trans1 as $transferout)
                                        <tr id="row{{$transferout->id}}">
                                            <td>{{ $transferout->product->clave }}</td>
                                            <td>{{ $transferout->product->weigth }}</td>
                                            <td>{{ $transferout->product->category->name }}</td>
                                            <td>{{ $transferout->product->line ? $transferout->product->line->name : '' }}
                                            </td>
                                            <td>{{$transferout->user->name}}</td>
                                            <td>{{$transferout->newBranch->name}}</td>
                                            <td>{{$transferout->destinationUser->name}}</td>
                                            <td>{{$transferout->created_at->format('m-d-Y')}}</td>
                                            <td>
                                                @if($transferout->status_product === 1 || $transferout->paid_at)
                                                @if($transferout->paid_at)
                                                <span class="text-center badge badge-success">Pagado</span>
                                                @else
                                                <span class="text-center badge badge-warning">Por pagar</span>
                                                @endif
                                                @elseif($transferout->status_product === 0)
                                                <span class="text-center badge badge-secondary">Rechazado</span>
                                                @elseif($transferout->status_product === 3)
                                                <span class="text-center badge badge-danger">Devuelto</span>
                                                @else
                                                <span class="text-center badge badge-primary">Pendiente</span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Botón para Aceptar o Rechazar Traspaso -->
                                                @if($transferout->status_product === null)
                                                @if(Auth::user()->id == $transferout->user_id)
                                                <button class="btn btn-warning cancel"
                                                    alt="{{ $transferout->id }}">Cancelar</button>
                                                @else
                                                <button class="btn btn-primary accept"
                                                    alt="{{ $transferout->id }}">Aceptar</button>
                                                <button class="btn btn-warning reject"
                                                    alt="{{ $transferout->id }}">Rechazar</button>
                                                @endif
                                                @else
                                                @if(!$transferout->paid_at)
                                                @if(Auth::user()->id == $transferout->user_id &&
                                                $transferout->status_product
                                                == 1)
                                                <button class="btn btn-danger give-back"
                                                    alt="{{ $transferout->id }}">Devolver</button>
                                                @else
                                                @if($transferout->status_product === null)
                                                <span class="text-center badge badge-success">Pendiente</span>
                                                @elseif($transferout->status_product == 1)
                                                <span class="text-center badge badge-warning">Por pagar</span>
                                                @elseif($transferout->status_product == 0 ||
                                                $transferout->status_product ==
                                                3)
                                                <span class="text-center badge badge-info">No se paga</span>
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
                                                <a href="traspasopdf/{{$transferout->id}}"><button type="button"
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


<form method="post" action="/traspasos/respuesta" id="form" class="d-none">
    {{ csrf_field() }}
    <input type="text" name="transfer_id" id="transfer_id_r">
    <input type="text" name="answer" id="answer">
</form>

<form method="post" action="/traspasos/cancelar" id="give-back" class="d-none">
    {{ csrf_field() }}
    <input type="text" name="transfer_id" id="transfer_id_gb">
</form>



@endsection

@section('barcode-product')
<script type="text/javascript">
    //inicializa la tabla para resposnive
    $(document).ready(function(){
        $('#incoming_transfers').DataTable({
            retrieve: true,
        });
        $('#outgoing_transfers').DataTable({
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

<!-- Función Sweet Alert para eliminar producto-->

@section('traspaso')
<script>
    $(document).ready(function(){

    $('#incoming_transfers').on('click', '.paid', function(){
      let id = $(this).attr("alt");
      console.log("es:", id)
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
          $('#transfer_id_p').val(id);
          $('#payment-form').submit();
        }
      })
  });

    $('#incoming_transfers').on('click', '.give-back', function(){
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
          $('#transfer_id_gb').val(id);
          $('#give-back').submit();
        }
      })
  });

    $('#incoming_transfers').on('click', '.accept', function(){
    var id = $(this).attr('alt');
    $('#transfer_id_r').val(id);
    $('#answer').val(1);
    $('#form').submit();
  })

  $('#incoming_transfers').on('click', '.cancel', function(){
    var id = $(this).attr('alt');
      $('#transfer_id_r').val(id);
      $('#answer').val(null);
      $('#form').submit();
  })

   $('#incoming_transfers').on('click', '.reject', function(){
    var id = $(this).attr('alt');
      $('#transfer_id_r').val(id);
      $('#answer').val(0);
      $('#form').submit();
  })
});

</script>

<script>
    $(document).ready(function(){

    $('#outgoing_transfers').on('click', '.paid', function(){
      let id = $(this).attr("alt");
      console.log("es:", id)
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
          $('#transfer_id_p').val(id);
          $('#payment-form').submit();
        }
      })
  });

    $('#outgoing_transfers').on('click', '.give-back', function(){
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
          $('#transfer_id_gb').val(id);
          $('#give-back').submit();
        }
      })
  });

    $('#outgoing_transfers').on('click', '.accept', function(){
    var id = $(this).attr('alt');
    $('#transfer_id_r').val(id);
    $('#answer').val(1);
    $('#form').submit();
  })

  $('#outgoing_transfers').on('click', '.cancel', function(){
    var id = $(this).attr('alt');
      $('#transfer_id_r').val(id);
      $('#answer').val(null);
      $('#form').submit();
  })

   $('#outgoing_transfers').on('click', '.reject', function(){
    var id = $(this).attr('alt');
      $('#transfer_id_r').val(id);
      $('#answer').val(0);
      $('#form').submit();
  })
});

</script>
@endsection

@section('barcode-product')
<script type="text/javascript">
    $('#example').dataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            }
        });
</script>
@endsection
