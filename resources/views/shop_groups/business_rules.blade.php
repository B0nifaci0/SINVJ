@extends('layout.layoutdas')
@section('title')
LISTA DE REGLAS
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
                    <h2 class="text-center panel-title">Reglas de Negocio de mi grupo</h2>
                    <div class="panel-actions float-right">
                        <div class="container-fluid row float-right">
                            <div class="col-6">
                                <button onclick="window.location.href='/businessrules/create'" type="button"
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
                <table id="rules" class="table table-hover dataTable table-striped w-full text-center"
                    data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>Operador</th>
                            <th>Multiplicador</th>
                            <th>Porcentaje de Descuento</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Operador</th>
                            <th>Multiplicador</th>
                            <th>Porcentaje de Descuento</th>
                            <th>Opciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($rules as $rule)
                        <tr id="row{{$rule->id}}" class="row{{$rule->id}}">
                            <td><strong> {{ $rule->operator }} </strong></td>
                            <td> {{ $rule->price }} </td>
                            <td> {{ $rule->discount_percentage }} %</td>
                            <td>
                                <!-- Botón para mostrar el Modal de editar regla-->
                                <div class="col-md-12 form-group">
                                    <button class="btn btn-icon btn-info waves-effect waves-light waves-round"
                                        data-target="#exampleTabs{{$rule->id}}" data-toggle="modal"
                                        data-original-title="Editar"><i class="icon md-edit"
                                        aria-hidden="true"></i></button>
                                <!-- END Botón-->
                                <!-- Botón para borrar una regla-->
                                    <button
                                        class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                                        alt="{{$rule->id}}" role="button" data-toggle="tooltip"
                                        data-original-title="Borrar">
                                        <i class="icon md-delete" aria-hidden="true"></i>
                                    </button>
                                <!-- END Botón-->
                                </div>
                            </td>
                        </tr>
                        <div class="col-xl-4 col-lg-6">
                            <!-- Example Tab In Modal -->
                            <div class="example-wrap">
                                <div class="example">
                                    <!-- Modal -->
                                    <div class="modal fade modal-success" id="exampleTabs{{$rule->id}}"
                                        aria-hidden="true" aria-labelledby="exampleModalTabs" role="dialog"
                                        tabindex="-1">
                                        <div class="modal-dialog modal-simple">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <h4 class="modal-title" id="exampleModalTabs">Editar Regla</h4>
                                                </div>
                                                <div class="modal-body">
                                                    @if($categories->count() > 0 || $rule->category->count() > 0)
                                                        <h1 class="text-center panel-title">Añadir/Quitar Categorias</h1>
                                                    @else
                                                        <h1 class="text-center panel-title">No hay Categorias Asignadas o Disponibles</h1>
                                                    @endif
                                                    <form action="{{route('businessrule.update',['id' => $rule->id])}}"
                                                        method="post">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label class="form-control-label"> Operador:</label>
                                                                <select class="form-control round" name="operator"
                                                                    required>
                                                                    <option value="+">+</option>
                                                                    <option value="-">-</option>
                                                                    <option value="*">*</option>
                                                                    <option value="/">/</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group form-material col-md-4">
                                                                <label
                                                                    class="form-control-label">Multiplicador:</label>
                                                                <input type="text" class="form-control" id="price{{$rule->id}}" 
                                                                    name="price"
                                                                    value="{{$rule->price}}" required
                                                                    placeholder="4" />
                                                            </div>

                                                            <div class="form-group form-material col-md-4">
                                                                <label class="form-control-label">Porcentaje de
                                                                    Descuento:</label>
                                                                <input type="text" id="discount_percentage{{$rule->id}}" 
                                                                    class="form-control discount"
                                                                    name="discount_percentage" required
                                                                    value="{{$rule->discount_percentage}}"
                                                                    placeholder="%" />
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                            <button
                                                                class="btn btn-primary save"
                                                                alt="{{$rule->id}}" role="button" data-toggle="tooltip"
                                                                data-original-title="Guardar">
                                                                Guardar
                                                            </button>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </div>
                            </div>
                            <!-- End Example Tab In Modal -->
                        </div>
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

@endsection 

@section('barcode-product')
<script type="text/javascript">
    //inicializa la tabla para resposnive
    $(document).ready(function () {
        $("#rules").DataTable({
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

@section('listado-productos')
<script type="text/javascript">
    $(document).ready(function () {

        $('button.save').click(function(e){
            let id = $(this).attr("alt");
            console.log(id);
            let discount = $('#discount_percentage'+id).val();

            if(discount < 0 || discount > 50)
            {
              Swal.fire(
                  'No permitido',
                  'El descuento mínimo es 0 y el máximo es el 50',
                  'error'
              );
              e.preventDefault();
              return
            }

            if(discount.length == 0)
            {
              Swal.fire(
                  'No permitido',
                  'Introduce un porcentaje de descuento',
                  'error'
              );
              e.preventDefault();
              return
            }
            if($('#price'+id).val().length == 0)
            {
              Swal.fire(
                  'No permitido',
                  'Introduce un multiplicador válido',
                  'error'
              );
              e.preventDefault();
              return
            }
        });

        $('#rules').on('click', '.delete', function(){
            let id = $(this).attr("alt");
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
                        url: "/businessrules/" + id,
                        method: "DELETE",

                        success: function (response) {
                            if (response.success) {
                                $('#rules').DataTable()
                                .rows('.row' + id)
                                .remove()
                                .draw();
                                Swal.fire(
                                    "Eliminado",
                                    "El registro ha sido eliminado.",
                                    "success"
                                );
                            } else {
                                Swal.fire(
                                    "No Eliminado",
                                    "El registro no ha sido eliminado porque tiene categorias asignadas",
                                    "error"
                                );
                            }
                        },
                        error: function (error) {
                            Swal.fire(
                                "Error",
                                "Ha habido un problema al eliminar el registro",
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