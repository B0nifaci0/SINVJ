@extends('layout.layoutdas')
@section('title')
LISTA DE CATEGORIA
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
                    <h1 class="text-center panel-title">Categorias de mi grupo</h1>
                    <div class="panel-actions float-right">
                        <div class="container-fluid row float-right">
                            <div class="col-6">
                                <button onclick="window.location.href='/categorias/create'" type="button"
                                    class="btn btn-sm small btn-floating btn-info waves-effect waves-light waves-round float-left"
                                    data-toggle="tooltip" data-original-title="Agregar">
                                    <i class="icon md-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table id='categories' class="table table-hover dataTable table-striped w-full text-center"
                    data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Tipo de Producto</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Tipo de Producto</th>
                            <th>Opciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr id="row{{ $category->id }}">
                            <td>{{ $category->id}}</td>
                            <td>{{ $category->name }}</td>
                            @if($category->type_product == 1 )
                            <td><span class="text-center badge badge-success">Pieza</span></td>
                            @else
                            <td><span class="text-center badge badge-primary">Gramos</span></td>
                            @endif
                            <td>
                                <a type="button" href="/categorias/{{$category->id}}/edit"
                                    class="btn btn-icon btn-info waves-effect waves-light waves-round "
                                    data-toggle="tooltip" data-original-title="Editar">
                                    <i class="icon md-edit" aria-hidden="true"></i></a>
                                <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete "
                                    alt="{{$category->id}}" role="button" data-toggle="tooltip"
                                    data-original-title="Borrar">
                                    <i class="icon md-delete" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Panel Basic -->

@endsection

@section('barcode-product')
<script type="text/javascript">
    //inicializa la tabla para resposnive
    $(document).ready(function(){
        $('#categories').DataTable({
            retrieve: true,
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
              .columns.adjust()
              .responsive.recalc();
        });
    });
</script><!-- End Panel Basic -->

@endsection @section('barcode-product')
<script type="text/javascript">
    //inicializa la tabla para resposnive
    $(document).ready(function () {
        $("#categories").DataTable({
            retrieve: true,
        });
    });
</script>
@endsection

<!-- Función Sweet Alert para eliminar linea-->
@section('delete-lineas')
<script type="text/javascript">
    $(document).ready(function () {
        $('#categories').on('click', '.delete', function(){
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
                        url: "/categorias/" + id,
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
