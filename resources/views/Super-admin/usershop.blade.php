@extends('layout.layoutdas') @section('title') LISTA DE USUARIOS TIENDA
@endsection @section('nav') @endsection @section('menu') @endsection
@section('content')
<div class="panel-body">
    @if (session('mesage'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('mesage') }}</strong>
        <button
            type="button"
            class="close"
            data-dismiss="alert"
            aria-label="Close"
        >
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif @if (session('mesage-update'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('mesage-update') }}</strong>
        <button
            type="button"
            class="close"
            data-dismiss="alert"
            aria-label="Close"
        >
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif @if (session('mesage-delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('mesage-delete') }}</strong>
        <button
            type="button"
            class="close"
            data-dismiss="alert"
            aria-label="Close"
        >
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
            <div class="panel-body">
                <div class="example-wrap">
                    <h1 class="text-center panel-title">Usuarios de tienda</h1>
                    <div class="panel-actions float-right">
                        <div class="container-fluid row float-right">
                            <!-- Botón para Generar PDF de productos-->
                            <div class="col-6">
                                <button
                                    onclick="window.location.href='/tiendas-admin'"
                                    type="button"
                                    class="btn btn-sm small btn-floating toggler-left btn-primary waves-effect waves-light waves-round float-left"
                                    data-toggle="tooltip"
                                    data-original-title="Ir a tiendas"
                                >
                                    <i
                                        class="icon fa-reply-all"
                                        aria-hidden="true"
                                    ></i>
                                </button>
                            </div>
                            <!-- END Botón-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <!-- Tabla para listar usuarios-->
                <table
                    id="usershop"
                    class="table table-hover dataTable table-striped w-full"
                    data-plugin="dataTable"
                >
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Tienda</th>
                            <th>Tipo de Usuario</th>
                            <th>Sucursal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Tienda</th>
                            <th>Tipo de Usuario</th>
                            <th>Sucursal</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($users as $user)
                        <tr id="row{{$user->id}}">
                            <td>{{$user->name }}</td>
                            <td>{{$user->email }}</td>
                            <td>{{$user->shop->name }}</td>
                            @if($user->type_user == 2)
                            <td>Sub-Administracion</td>
                            @endif @if($user->type_user == 3)
                            <td>Colaborador</td>
                            @endif @if($user->branch_id == '')
                            <td>Sin sucursal es Administrador</td>
                            @endif @if($user->branch_id != 0)
                            <td>{{$user->branch->name}}</td>
                            @endif
                            <td>
                                @if($user->deleted_at == NULL)
                                <span class="text-center badge badge-success"
                                    >Activo</span
                                >
                                @elseif($user->deleted_at == !NULL)
                                <span class="text-center badge badge-warning"
                                    >Inactivo</span
                                >
                                @endif
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
@endsection @section('barcode-product')
<script type="text/javascript">
    //inicializa la tabla para resposnive
    $(document).ready(function () {
        $("#usershop").DataTable({
            retrieve: true,
        });

        $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
            $($.fn.dataTable.tables(true))
                .DataTable()
                .columns.adjust()
                .responsive.recalc();
        });
    });
</script>
@endsection
