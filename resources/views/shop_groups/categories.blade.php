@extends('layout.layoutdas') @section('title') Categorias del Grupo @endsection
@section('nav') @endsection @section('menu') @endsection @section('content')
<div class="panel-body">
    <div class="page-content">
        @if (session('mesage-update'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('mesage-update') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="panel">
            <div class="panel-body">
                <div class="example-wrap">
                    <h1 class="text-center panel-title">
                        Categorias del Grupo
                    </h1>
                    <div class="panel-actions float-right">
                        <div class="container-fluid row float-right"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-md-12 col-sl">
                <div class="example-wrap">
                    <div class="nav-tabs-horizontal" data-plugin="tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-toggle="tab" href="#exampleTabsOne"
                                    aria-controls="exampleTabsOne" role="tab">Activos</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-toggle="tab" href="#exampleTabsTwo"
                                    aria-controls="exampleTabsTwo" role="tab">No Activos</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                                <div class="page-content panel-body container-fluid">
                                    <table id="activeCategories"
                                        class="table table-hover dataTable table-striped w-full text-center"
                                        data-plugin="dataTable">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre</th>
                                                <th>Tienda Origen</th>
                                                <th>Tipo de Producto</th>
                                                <th>Opciónes</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre</th>
                                                <th>Tienda Origen</th>
                                                <th>Tipo de Producto</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach ($activeCategories as
                                            $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>
                                                    @foreach ($shops as $shop)
                                                    @if($category->shop_id ==
                                                    $shop->id) {{$shop->name}}
                                                    @endif
                                                    @endforeach
                                                </td>
                                                @if($category->type_product == 1
                                                )
                                                <td>
                                                    <span class="text-center badge badge-success">Pieza</span>
                                                </td>
                                                @else
                                                <td>
                                                    <span class="text-center badge badge-primary">Gramos</span>
                                                </td>
                                                @endif
                                                <td>
                                                    <button class="btn btn-outline-danger to-disable"
                                                        alt="{{ $category->id }}">
                                                        Deshabilitar
                                                    </button>
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
                                <table id="non-activeCategories"
                                    class="table table-hover dataTable table-striped w-full text-center"
                                    data-plugin="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Tienda Origen</th>
                                            <th>Tipo de Producto</th>
                                            <th>Opción</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Tienda Origen</th>
                                            <th>Tipo de Producto</th>
                                            <th>Opcion</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($nonActiveCategories as
                                        $category)
                                        @if(!$category->shop_group_id)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                @foreach ($shops as $shop)
                                                @if($category->shop_id ==
                                                $shop->id) {{$shop->name}}
                                                @endif @endforeach
                                            </td>
                                            @if($category->type_product == 1 )
                                            <td>
                                                <span class="text-center badge badge-success">Pieza</span>
                                            </td>
                                            @else
                                            <td>
                                                <span class="text-center badge badge-primary">Gramos</span>
                                            </td>
                                            @endif
                                            <td>
                                                <button class="btn btn-outline-success enable"
                                                    alt="{{ $category->id }}">
                                                    Habilitar
                                                </button>
                                            </td>
                                        </tr>
                                        @endif
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

<form method="post" action="/groupCategories/enable" id="activate-form" class="d-none">
    {{ csrf_field() }}
    <input type="text" name="category_id" id="category_id" />
</form>

@endsection @section('barcode-product')
<script type="text/javascript">
    //inicializa la tabla para resposnive
    $(document).ready(function () {
        $("#activeCategories").DataTable({
            retrieve: true,
        });
        $("#non-activeCategories").DataTable({
            retrieve: true,
        });

        $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
            $($.fn.dataTable.tables(true))
                .DataTable()
                .columns.adjust()
                .responsive.recalc();
        });

        $("#non-activeCategories").on("click", ".enable", function () {
            let id = $(this).attr("alt");
            console.log("es:", id);
            Swal.fire({
                title: "Confirmación",
                text: "¿Quieres habilitar esta categoria?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#4caf50",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si",
            }).then((result) => {
                if (result.value) {
                    $("#category_id").val(id);
                    $("#activate-form").submit();
                }
            });
        });

        $("#activeCategories").on("click", ".to-disable", function () {
            let id = $(this).attr("alt");
            console.log("es:", id);
            Swal.fire({
                title: "Confirmación",
                text: "¿Quieres deshabilitar esta categoria?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#4caf50",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si",
            }).then((result) => {
                if (result.value) {
                    $("#category_id").val(id);
                    $("#activate-form").submit();
                }
            });
        });
    });
</script>

@endsection @section('barcode-product')
<script type="text/javascript">
    $("#example").dataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
        },
    });
</script>
@endsection
