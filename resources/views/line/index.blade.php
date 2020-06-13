@extends('layout.layoutdas') @section('title') LISTA DE LINEAS @endsection
@section('nav') @endsection @section('menu') @endsection @section('content')
<div class="panel-body">
    @if (session('mesage'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('mesage') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif @if (session('mesage-update'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('mesage-update') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif @if (session('mesage-delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('mesage-delete') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="">
        <!-- Panel Basic -->
        <div class="panel">
            <div class="panel-body">
                <div class="example-wrap">
                    <h2 class="text-center panel-title">Líneas</h2>
                    <div class="panel-actions float-right">
                        <div class="container-fluid row float-right">
                            @if($user->type_user == 1 )
                            <div class="col-6">
                                <button onclick="window.location.href='lineaspdf'" type="button"
                                    class="btn btn-sm small btn-floating toggler-left btn-danger waves-effect waves-light waves-round float-right"
                                    data-toggle="tooltip" data-original-title="Generar reporte PDF">
                                    <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                                </button>
                            </div>
                            @if (!$user->shop->shop_group_id)
                            <div class="col-6">
                                <button onclick="window.location.href='/lineas/create'" type="button"
                                    class="btn btn-sm small btn-floating btn-info waves-effect waves-light waves-round float-left"
                                    data-toggle="tooltip" data-original-title="Agregar">
                                    <i class="icon md-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                            @else
                            @if($quantity)
                            <div class="col-6">
                                <button onclick="window.location.href='/changeCategoriesAndLines'" type="button"
                                    class="btn btn-sm small btn-floating btn-info waves-effect waves-light waves-round float-left"
                                    data-toggle="tooltip" data-original-title="Actualizar Productos">
                                    <i class="icon md-refresh" aria-hidden="true"></i>
                                </button>

                            </div>
                            @endif
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="example-wrap">
                    <div class="nav-tabs-horizontal" data-plugin="tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            @if (!$user->shop->shop_group_id)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-toggle="tab" href="#exampleTabsOne"
                                    aria-controls="exampleTabsOne" role="tab">Tienda</a>
                            </li>
                            @else
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-toggle="tab" href="#exampleTabsTwo"
                                    aria-controls="exampleTabsTwo" role="tab">Grupo</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-toggle="tab" href="#exampleTabsOne"
                                    aria-controls="exampleTabsOne" role="tab">Tienda</a>
                            </li>
                            @endif
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                                <div class="page-content panel-body container-fluid">
                                    <table id='lines_shop' class="table table-hover dataTable table-striped w-full"
                                        data-plugin="dataTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Precio compra</th>
                                                <th>Precio venta</th>
                                                <th>Descuento</th>
                                                @if($user->type_user == 1 && !$user->shop->shop_group_id)
                                                <th>Opciones</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Precio compra</th>
                                                <th>Precio venta</th>
                                                <th>Descuento</th>
                                                @if($user->type_user == 1 && !$user->shop->shop_group_id) <th>Opciones
                                                </th>
                                                @endif
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach ($lines_shop as $line)
                                            <tr>
                                                <td>{{ $line->id}}</td>
                                                <td>{{ $line->name }}</td>
                                                <td>$ {{$line->purchase_price}}</td>
                                                <td>$ {{ $line->sale_price }}</td>
                                                <td>% {{ $line->discount_percentage }}</td>
                                                @if($user->type_user == 1 && !$user->shop->shop_group_id) <td>
                                                    <a type="button" href="/lineas/{{$line->id}}/edit"
                                                        class="btn btn-icon btn-info waves-effect waves-light waves-round"
                                                        data-toggle="tooltip" data-original-title="Editar">
                                                        <i class="icon md-edit" aria-hidden="true"></i>
                                                    </a>
                                                    <button
                                                        class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                                                        alt="{{$line->id}}" role="button" data-toggle="tooltip"
                                                        data-original-title="Borrar">
                                                        <i class="icon md-delete" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if ($user->shop->shop_group_id)
                        <div class="tab-pane" id="exampleTabsTwo" role="tabpanel">
                            <div class="page-content panel-body container-fluid">
                                <table id='lines_group' class="table table-hover dataTable table-striped w-full"
                                    data-plugin="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Precio compra</th>
                                            <th>Precio venta</th>
                                            <th>Descuento</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Precio compra</th>
                                            <th>Precio venta</th>
                                            <th>Descuento</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($lines_group as $line)
                                        <tr>
                                            <td>{{ $line->id}}</td>
                                            <td>{{ $line->name }}</td>
                                            <td>$ {{$line->purchase_price}}</td>
                                            <td>$ {{ $line->sale_price }}</td>
                                            <td>% {{ $line->discount_percentage }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('barcode-product')
<script type="text/javascript">
    //inicializa la tabla para resposnive
    $(document).ready(function () {
        $("#lines_shop").DataTable({
            retrieve: true,
        });
        $("#lines_group").DataTable({
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

<!-- Función Sweet Alert para eliminar linea-->
@section('delete-lineas')
<script type="text/javascript">
    $(document).ready(function () {
        $('#lines_shop').on('click', '.delete', function(){
            var id = $(this).attr("alt");
            console.log(id);
            Swal.fire({
                title: "Confirmación",
                text: "¿Seguro que desea eliminar este registro?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Si, Borralo!",
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="_token"]').attr(
                                "content"
                            ),
                        },
                    });
                    $.ajax({
                        url: "/lineas/" + id,
                        method: "DELETE",

                        success: function (response) {
                            if (response.success) {
                                $("#row" + id).remove();
                                Swal.fire(
                                    "Eliminado",
                                    "El registro ha sido eliminado.",
                                    "success"
                                );
                            } else {
                                Swal.fire(
                                    "No Eliminado",
                                    "El registro no ha sido eliminado por que tiene productos activos",
                                    "error"
                                );
                            }
                        },
                        error: function (error) {
                            Swal.fire(
                                "No Eliminado",
                                "El registro no ha sido eliminado por que tiene productos activos",
                                "error"
                            );
                        },
                    });
                }
            });
        });
    });
</script>
@endsection
