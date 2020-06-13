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
                    <h2 class="text-center panel-title">Lineas de mi grupo</h2>
                    <div class="panel-actions float-right">
                        <div class="container-fluid row float-right">
                            <div class="col-6">
                                <button onclick="window.location.href='/lineas/create'" type="button" class=" btn btn-sm small btn-floating
                    toggler-left  btn-info waves-effect waves-light waves-round float-left" data-toggle="tooltip"
                                    data-original-title="Agregar">
                                    <i class="icon md-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table id='lines' class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Precio compra</th>
                            <th>Precio venta</th>
                            <th>Descuento</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Precio compra</th>
                            <th>Precio venta</th>
                            <th>Descuento</th>
                            <th>Opciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($lines as $line)
                        <tr>
                            <td>{{ $line->id}}</td>
                            <td>{{ $line->name }}</td>
                            <td>$ {{$line->purchase_price}}</td>
                            <td>$ {{ $line->sale_price }}</td>
                            <td>% {{ $line->discount_percentage }}</td>
                            <td>
                                <a type="button" href="/lineas/{{$line->id}}/edit"
                                    class="btn btn-icon btn-info waves-effect waves-light waves-round"
                                    data-toggle="tooltip" data-original-title="Editar">
                                    <i class="icon md-edit" aria-hidden="true"></i></a>
                                <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                                    alt="{{$line->id}}" role="button" data-toggle="tooltip"
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
</div>@endsection

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
        $("#lines").DataTable({
            retrieve: true,
        });
    });
</script>
@endsection

<!-- Función Sweet Alert para eliminar linea-->
@section('delete-lineas')
<script type="text/javascript">
    $(document).ready(function () {
        $('#lines').on('click', '.delete', function(){
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
