@extends('layout.layoutdas')
@section('title')
ALTA PRODUCTO
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="page-content">
    <div class="panel">
        <div class="panel-body">
            @if (session('mesage'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('mesage') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if($errors->count() > 0)
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if($user->type_user == 1)
            <h3 class="text-center">Traspaso {{$user->shop->name}}</h3>
            @else
            <h3 class="text-center">Traspaso Sucursal {{$user->branch->name}}</h3>
            @endif
            <form id="form" method="POST" action="/traspasos">
                {{ csrf_field() }}
                <div class="form-group col-md-12">
                    <div class='row'>
                        <div class="form-group form-material  col-md-4  col-md-offset-1 visible-md visible-lg">
                            <label>Sucursal Destino</label>
                            <select id="branch" class="form-control " data-plugin="select2"
                                data-placeholder="Sucursal destino" name="new_branch" data-allow-clear="true" required>
                                <option></option>
                                <optgroup label="Sucursales">
                                    @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" required>
                                        {{$branch->name}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group  col-md-4 col-md-offset-1 visible-md visible-lg">
                            <label class="floating-label" for="inputBranch">{{ __('Usuario Destino') }}</label>
                            <select id="users" class="form-control" name="destination_user" data-plugin="select2"
                                data-placeholder="Seleccione Destinatario" data-allow-clear="true" required>
                                <option> </option required>
                            </select>
                        </div>
                        <div class="form-group  col-md-4  col-md-offset-1 visible-md visible-lg">
                            <label for="product_id" class="floating-label">Clave del producto</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="product_id">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" id="search_product"><i
                                            class="icon fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="page-content panel-body container-fluid">
                        <table id="productsInTranfer" class="table display responsive nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Clave</th>
                                    <th>Descripcion</th>
                                    <th>Categoria</th>
                                    @if ($user->type_user == 1)
                                    <th>Sucursal Origen</th>
                                    @endif
                                    <th>Linea</th>
                                    <th>Peso</th>
                                    <th>Precio</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <a id="submit" type="button" name="button" class="btn btn-primary text-white">Guardar</a>
                </div>
                <input type="hidden" class="form-control" name="products" id="products" />
            </form>
        </div>
    </div>
</div>
@endsection
@section('branch-user')
<script type="text/javascript">
    var products = {!! $products !!};
    var branches = {!! $branches !!};
    var users = {!! $users !!};
    var user = {!! $user !!};
    var selectedProducts = [];
    var p_t = $('#productsInTranfer').DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        searching: false
    });
    var branch_id
    $('#branch').val('');

    $('#branch').change(function () {
        branch_id = $(this).val();
        var url = '/sucursales/' + branch_id + '/usuarios';
        $.get(url, function (json) {
            $('#users').empty();
            $('#users').append('<option value=""></option>');
            $.each(json, function (i, user) {
                $('#users').append('<option value=' + user.id + '>' + user.name + '</option>')
            });
        });
    });

    $('#search_product').click(function () {
        var clave = $('#product_id').val();
        var product = products.filter(p => p.clave == clave)[0];
        if (!product) {
            swal.fire({
                title: 'Error',
                text: 'Producto no encontrado!',
                type: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar!'
            });
            return;
        }
        var exist = selectedProducts.filter(p => p == product.id);
        if (exist.length) {
            Swal.fire(
                'No permitido',
                'Este producto ya se ha agregado',
                'error'
            );
            return;
        }

        selectedProducts.push(product.id);
        $('#product_id').val('');
        if (user.type_user == 1) {
            p_t.row.add([
                product.clave,
                product.description,
                product.category.name,
                product.branch.name,
                product.line ? product.line.name : `<span class="text-center badge badge-primary">Pieza</span>`,
                product.weigth ? product.weigth + ' gr' : 'N/A',
                '$ ' + product.price,
                `<button type="button" class="btn btn-danger remove" alt="${product.id}"><i class="icon fa-remove"></i>
        </button>`
            ]).draw(false);
        } else {
            p_t.row.add([
                product.clave,
                product.description,
                product.category.name,
                product.line ? product.line.name : `<span class="text-center badge badge-primary">Pieza</span>`,
                product.weigth ? product.weigth + ' gr' : 'N/A',
                '$ ' + product.price,
                `<button type="button" class="btn btn-danger remove" alt="${product.id}"><i class="icon fa-remove"></i>
                </button>`
            ]).draw(false);
        }

    });

    $('#productsInTranfer').on('click', '.remove', function () {
        var id = $(this).attr('alt');
        var row = $(this).parents('tr');
        var index = selectedProducts.map(p => p).indexOf(selectedProducts.filter(p => p == id)[0])
        selectedProducts.splice(index, 1);
        if ($(row).hasClass('child')) {
            p_t.row($(row).prev('tr')).remove().draw();
        }
        else {
            p_t.row($(this).parents('tr')).remove().draw();
        }
    });

    $('#submit').click(function (e) {
        if ($('#form')[0].checkValidity()) {
            $('#products').val(JSON.stringify(selectedProducts));
            if (selectedProducts.length < 1) {
                Swal.fire(
                    'No permitido',
                    'Debes agregar por lo menos un producto',
                    'error'
                );
                return;
            }
            $('#form').submit();
        }
    });

</script>
@endsection