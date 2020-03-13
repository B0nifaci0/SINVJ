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
                    <h1 class="text-center panel-title">Traspasos Externos</h1>
                    <div class="panel-actions float-right">
                        <div class="col-6">
                            <button onclick="window.location.href='/traspasosExt/create'" type="button" class=" btn btn-sm small btn-floating  toggler-left
                                          btn-info waves-effect waves-light waves-round float-left "
                                data-toggle="tooltip" data-original-title="Agregar">
                                <i class="icon md-plus" aria-hidden="true"></i>
                            </button>
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
                                                <th>Fecha</th>
                                                <th>Clave</th>
                                                <th>Peso</th>
                                                <th>Categoría</th>
                                                <th>Linea</th>
                                                <th>S.Origen</th>
                                                <th>Quien lo mando</th>
                                                <th>S.Destino</th>
                                                <th>Quien recibio</th>
                                                <th>Status</th>
                                                <th>Opciones</th>
                                                <th>Ticket</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Clave</th>
                                                <th>Peso</th>
                                                <th>Categoría</th>
                                                <th>Linea</th>
                                                <th>S.Origen</th>
                                                <th>Quien lo mando</th>
                                                <th>S.Destino</th>
                                                <th>Quien recibio</th>
                                                <th>Status</th>
                                                <th>Opciones</th>
                                                <th>Ticket</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr>
                                                <td>Fecha</td>
                                                <td>Clave</td>
                                                <td>Peso</td>
                                                <td>Categoría</td>
                                                <td>Linea</td>
                                                <td>S.Origen</td>
                                                <td>Quien lo mando</td>
                                                <td>S.Destino</td>
                                                <td>Quien recibio</td>
                                                <td>Status</td>
                                                <td>Opciones</td>
                                                <td>Ticket</td>
                                            </tr>
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
                                            <th>Fecha</th>
                                            <th>Clave</th>
                                            <th>Peso</th>
                                            <th>Categoría</th>
                                            <th>Linea</th>
                                            <th>S.Origen</th>
                                            <th>Quien lo mando</th>
                                            <th>S.Destino</th>
                                            <th>Quien recibio</th>
                                            <th>Status</th>
                                            <th>Opciones</th>
                                            <th>Ticket</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Clave</th>
                                            <th>Peso</th>
                                            <th>Categoría</th>
                                            <th>Linea</th>
                                            <th>S.Origen</th>
                                            <th>Quien lo mando</th>
                                            <th>S.Destino</th>
                                            <th>Quien recibio</th>
                                            <th>Status</th>
                                            <th>Opciones</th>
                                            <th>Ticket</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>Fecha</td>
                                            <td>Clave</td>
                                            <td>Peso</td>
                                            <td>Categoría</td>
                                            <td>Linea</td>
                                            <td>S.Origen</td>
                                            <td>Quien lo mando</td>
                                            <td>S.Destino</td>
                                            <td>Quien recibio</td>
                                            <td>Status</td>
                                            <td>Opciones</td>
                                            <td>Ticket</td>
                                        </tr>
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

@endsection

@section('barcode-product')
<script type="text/javascript">
    $(document).ready(function(){
        //inicializa la tabla para resposnive

        $('#incoming_transfers').DataTable({
            retrieve: true,
            });
            $('#outgoing_transfers').DataTable({
            retrieve: true,
            });

            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust()
            .responsive.recalc();
            });
    })

</script>
@endsection
