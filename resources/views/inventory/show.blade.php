@extends('layout.layoutdas')
@section('title')
LISTA DE LINEA
@endsection

@section('admin-section')
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
                <div class="example-wrap">
                    @foreach($name_branch as $branch)
                    <h1 class="text-center panel-title">Inventarios {{$branch->name}}</h1>
                    @endforeach
                    <div class="panel-actions float-right">
                        <div class="container-fluid row float-right">
                            @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
                            <!-- Botón para Generar PDF de productos-->
                            @if(Auth::user()->type_user == 1)
                            <!-- <div class="col-6">
                    <button onclick="window.location.href='inventariospdf'"
                    type="button" class=" btn btn-sm small btn-floating
                    btn-danger waves-effect waves-light waves-round float-right"
                    data-toggle="tooltip" data-original-title="Generar reporte PDF">
                    <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                  </button>
                  </div> -->
                            @endif
                            <!--  <div class="col-6=">
                    <button onclick="window.location.href='/inventarios/create'"
                    type="button" class=" btn btn-sm small btn-floating
                    btn-info waves-effect waves-light waves-round float-left"
                    data-toggle="tooltip" data-original-title="Agregar">
                    <i class="icon md-plus" aria-hidden="true"></i>
                  </button>
                  </div>  !-->
                            <!-- END Botón-->
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <!-- Tabla para listar inventarios-->
                <table id='example' class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Peso</th>
                            <th>Descripcion</th>
                            <th>Status</th>
                            @if($inventory->status_report == 1 OR $inventory->status_report == 2)
                            @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
                            <th>Opciones</th>
                            @endif
                            @endif
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Clave</th>
                            <th>Peso</th>
                            <th>Descripcion</th>
                            <th>Status</th>
                            @if($inventory->status_report == 1 OR $inventory->status_report == 2)
                            @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
                            <th>Opciones</th>
                            @endif
                            @endif
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($inventory->products as $item)
                        <tr id="row{{ $inventory->id }}">
                            <td>{{$item->clave}}</td>
                            @if($item->weigth)
                            <td>{{$item->weigth}} gr</td>
                            @else
                            <td>No Tiene Peso</td>
                            @endif
                            <td>{{ $item->description }}</td>
                            <td>
                                @if( $item->status === null )
                                <span class="text-center badge badge-secondary">Pendiente</span>
                                @elseif( $item->status === 1)
                                <span class="text-center badge badge-success">Existente</span>
                                @elseif( $item->status === 2)
                                <span class="text-center badge badge-warning">Dañado</span>
                                @elseif( $item->status === 3)
                                <span class="text-center badge badge-danger">Faltante</span>
                                @endif
                            </td>
                            @if($inventory->status_report == 1 OR $inventory->status_report == 2)
                            @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
                            <td>
                                @if( $item->status === null )
                                <button class="btn btn-success exist" alt="{{ $item->id }}">
                                    Existente
                                    <i class="icon md-check"></i>
                                </button>
                                <button class="btn btn-warning lost" alt="{{ $item->id }}">
                                    Dañado
                                </button>
                                <button class="btn btn-danger damaged" alt="{{ $item->id }}">
                                    Faltante
                                </button>
                                @else
                                <button class="btn btn-info restart" alt="{{ $item->id }}">
                                    Restaurar
                                </button>
                                @endif
                                @endif
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @foreach ($id_inventory as $i)
                @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
                @if($inventory->status_report == 3)
                <button class="btn btn-primary" name="id_report" disabled>
                    Inventario Terminado
                    @elseif($finalizar > 0)
                    <button class="btn btn-primary" name="id_report" disabled>
                        Aun No Has Acabado El Inventario
                    </button>
                    @elseif($finalizar == 0)
                    <button class="btn btn-primary" name="id_report" onclick=" location.href='terminar/{{$i->id}}' ">
                        Terminar Inventario
                    </button>
                    @endif
                    @endif
                    @endforeach
                    <!-- END Tabla-->
            </div>
        </div>
        <form method="post" action="/inventory/check" id="form" class="d-none">
            {{ csrf_field() }}
            <input type="text" name="inventory_id" id="inventory_id">
            <input type="text" name="status" id="status">
            <input type="text" name="discar_cause" id="discar_cause">
        </form>
    </div>
</div>
@endsection

@section('barcode-product')
<script type="text/javascript">
    //inicializa la tabla para resposnive
    $(document).ready(function () {
        $('#example').DataTable({
            retrieve: true,
            //  responsive: true,
            //paging: false,
            //searching: false
        });
    });
</script>
@endsection

@section('delete-categorias')
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').on('click', '.exist', function () {
            let id = $(this).attr("alt");

            Swal.fire({
                title: 'Confirmación',
                text: "¿El producto se encuentra en inventario?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4caf50',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.value) {
                    $('#inventory_id').val(id);
                    $('#status').val(1);
                    $('#form').submit();
                }
            })
        });

        $('#example').on('click', '.lost', function () {
            let id = $(this).attr("alt");

            Swal.fire({
                title: 'Confirmación',
                text: "¿El producto se encuentra dañado?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4caf50',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.value) {
                    $('#inventory_id').val(id);
                    $('#status').val(2);
                    $('#discar_cause').val(2);
                    $('#form').submit();
                }
            })
        });

        $('#example').on('click', '.damaged', function () {
            let id = $(this).attr("alt");

            Swal.fire({
                title: 'Confirmación',
                text: "¿El producto NO se encuentra en inventario?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4caf50',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.value) {
                    $('#inventory_id').val(id);
                    $('#status').val(3);
                    $('#discar_cause').val(1);
                    $('#form').submit();
                }
            })
        });
        $('#example').on('click', '.restart', function () {
            let id = $(this).attr("alt");

            var message = "¿Desea restablecer este producto?";
            Swal.fire({
                title: message,
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                showLoaderOnConfirm: true,
                preConfirm: (password) => {
                    return fetch(`/check-password`, {
                        method: 'POST',
                        body: JSON.stringify({ password: password }),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }
                            return response.json()
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                                `Contraseña incorrecta`
                            )
                        })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.value) {
                    $('#inventory_id').val(id);
                    $('#status').val(null);
                    $('#discar_cause').val(null);
                    $('#form').submit();
                }
            })
        });
    });
</script>
@endsection
