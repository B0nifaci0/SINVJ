@extends('layout.layoutdas') @section('title') LISTA DE CATEGORIA @endsection
@section('nav') @endsection @section('menu') @endsection @section('content')
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
                    <h1 class="text-center panel-title">Reglas de Negocios</h1>
                    <div class="panel-actions float-right">
                        <div class="container-fluid row float-right">
                            <div class="col-6">
                                <button onclick="window.location.href='/businessrules/create'" type="button"
                                    class="btn btn-sm small btn-floating btn-info waves-effect waves-light waves-round float-left"
                                    data-toggle="tooltip" data-original-title="Crear Regla">
                                    <i class="icon md-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="container-fluid">
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
                            <tr class="rules">
                                <td><strong> {{ $rule->operator }} </strong></td>
                                <td> {{ $rule->price }} </td>
                                <td> {{ $rule->discount_percentage }} %</td>
                                <td>
                                    <!-- Botón para mostar el Modal de editar regla-->
                                    <div class="col-6 form-group">
                                        <button class="btn btn-icon btn-info waves-effect waves-light waves-round"
                                            data-target="#exampleTabs{{$rule->id}}" data-toggle="modal"
                                            data-original-title="Editar"><i class="icon md-edit"
                                                aria-hidden="true"></i></button>
                                    </div>
                                    <!-- END Botón-->
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
                                                        <h1 class="text-center panel-title">Añadir/Quitar Categorias
                                                        </h1>
                                                        <form action="{{route('businessrule.update',['id' => $rule->id])}}"
                                                            method="post">
                                                            {{ csrf_field() }}
                                                            {{ method_field('PUT') }}
                                                            <div class="row">

                                                                @foreach($categories as $category)
                                                                <div class="checkbox-custom checkbox-primary col-md-3">
                                                                    <input type="checkbox" id="category"
                                                                        name="category_id[]" value="{{$category->id}}">
                                                                    <label
                                                                        class="form-control-label">{{ $category->name }}</label>
                                                                </div>
                                                                @endforeach

                                                                @foreach($rule->category as $c)
                                                                <div class="checkbox-custom checkbox-primary col-md-3">
                                                                    <input type="checkbox" id="category" checked
                                                                        name="category_id[]"
                                                                        value="{{$c->category_id}}">
                                                                    <label
                                                                        class="form-control-label">{{$c->category_name}}</label>
                                                                </div>
                                                                @endforeach

                                                            </div>

                                                            <br>

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
                                                                    <input type="text" class="form-control" name="price"
                                                                        value="{{$rule->price}}" required
                                                                        placeholder="4" />
                                                                </div>

                                                                <div class="form-group form-material col-md-4">
                                                                    <label class="form-control-label">Porcentaje de
                                                                        Descuento:</label>
                                                                    <input type="text" class="form-control discount"
                                                                        name="discount_percentage" required
                                                                        value="{{$rule->discount_percentage}}"
                                                                        placeholder="%" />
                                                                </div>

                                                                <div class="form-group col-md-12">
                                                                    <button
                                                                        class="btn btn-primary save">Guardar</button>
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
</div>
<!-- End Panel Basic -->

@endsection @section('barcode-product')
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
    var rules = {!! $rules !!};
    $(document).ready(function () {

        $('.save').click(function (e) {

            let discount = $('.discount').val();
            console.log("Descuento:", discount);

            if (discount < 0 || discount > 50) {
                Swal.fire(
                    'No permitido',
                    'El descuento mínimo es 0 y el máximo es el 50',
                    'error'
                );
                e.preventDefault();
                return
            }

        });

    });
</script>
@endsection