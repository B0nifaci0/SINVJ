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
            <h2 class="text-center">Nuevo Traspaso Externo</h2>
            <br>
            <form action="/traspasosExt" method="POST">
                {{ csrf_field() }}
                <div class="row justify-content-md-center ">
                    <div class="col-md-3 col-md-offset-1">
                        <label>Enviar a </label>
                        <select name="type" id="type" class="form-control">
                            <option value="1" selected="selected" id="cash">Tienda con codigo</option>
                            <option value="2" id="card">Tienda sin Codigo</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-md-offset-1 code">
                        <label for="shop_code" class="floating-label">Codigo tienda destino</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="shop_code" id="shop_code">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" id="validar">Buscar</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <!-- Select para Seleccionar producto-->
                    <div class="col-md-3 col-md-offset-1">
                        <label>Producto</label>
                        <select id="product" class="form-control" data-plugin="select2"
                            data-placeholder="Seleccione Producto" data-allow-clear="true" required>
                            <option></option>
                            <optgroup label="Productos">
                                @foreach($products as $product)
                                <option value="{{ $product->description }}" required>
                                    {{$product->clave}}-{{ $product->description }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        <input type="text" name="product_id" class="invisible" id="product_id">
                    </div>
                    <div class="col-md-3  col-md-offset-1 visible-md visible-lg">
                        <label class="floating-label" for="inputBranch">{{ __('Sucursal Origen') }}</label>
                        <input type="text" class="form-control" id="branch" readonly>
                        <input type="text" class="form-control invisible" name="branch_id" id="branch_id" readonly>
                    </div>
                    <div class="col-md-3 col-md-offset-1 visible-md visible-lg code">
                        <label class="floating-label" for="inputBranch">{{ __('Destino') }}</label>
                        <select id="branches" class="form-control" name="new_branch_id" data-plugin="select2"
                            data-placeholder="Seleccione Sucursal" data-allow-clear="true" required>
                            <option> </option required>
                        </select>
                    </div>
                    <!-- Select para Seleccionar Quien lo recibe (Usuario)-->
                    <div class="col-md-3 col-md-offset-1 visible-md visible-lg mb-4 code">
                        <label class="floating-label" for="inputUser">{{ __('Quien lo recibe') }}</label>
                        <input type="text" class="form-control" id="destination" readonly>
                        <input type="text" class="form-control invisible" name="destination_user_id"
                            id="destination_user_id" readonly>
                    </div>
                    <!-- END Select-->

                    <div class="col-md-3 col-md-offset-1 visible-md visible-lg remove">
                        <label class="floating-label" >{{ __('Destino') }}</label>
                        <input id="newBranch" type="text" class="form-control" name="new_branch" required>
                    </div>
                    <!-- Select para Seleccionar Quien lo recibe (Usuario)-->
                    <div class="col-md-3 col-md-offset-1 visible-md visible-lg mb-4 remove">
                        <label class="floating-label" >{{ __('Quien lo recibe') }}</label>
                        <input id="newUser" type="text" class="form-control" name="destination_user" required>
                    </div>

                </div>
                <div class="form-group col-md-12 mt-5">
                    <button id="submit" type="submit" name="button" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('branch-user')
<script type="text/javascript">
    var products = {!! $products !!};
    var shops = {!! $shops !!};
    var branches = {!! $branches !!}
    var users = {!! $users !!}


    $(document).ready(function(){

        $('#destination').val('');

        $('#product').change(function() {
            var name = $(this).val();
            var p = products.filter(p => p.description == name)[0];
            $('#branch').val(p.branchName)
            $('#branch_id').val(p.branchId)
            $('#product_id').val(p.id);
            console.log('Product id: ',p.id)
        });

        $('#validar').click(function(){
            var code = $('#shop_code').val();
            var validate = false;
            var shop = shops.filter(s => s.shop_code == code)[0];
            if(shop != undefined){
                var branchesList = branches.filter(b => b.shop_id == shop.id);
                var user = users.filter(u => u.shop_id == shop.id )[0];
                $('#destination').val(user.name);
                $('#destination_user_id').val(user.id)
                $('#branches').empty();
                branchesList.forEach(element => {
                $('#branches').append(new Option(element.name, element.id));
                validate = true;
                });

            }
            if(!validate){
                $('#branches').empty();
                $('#destination').val('');
                swal.fire({
                title: 'Error',
                text: 'Codigo de tienda no encontrado!',
                type: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar!'
                });
                return;
            }

        });
        $('.code').show();
        $('.remove').hide();
        $('#branches').prop("required", true);
        $('#destination').prop("required", true);
        $('#newBranch').removeAttr("required");
        $('#newUser').removeAttr("required");

         $('#type').change(function(){
            var type = $(this).val();
            if(type == 1 ){
                console.log("Con codigo");
                $('.code').show();
                $('.remove').hide();
                $('#branches').prop("required", true);
                $('#destination').prop("required", true);
                $('#newBranch').removeAttr("required");
                $('#newUser').removeAttr("required");
            }else{
                console.log("Sin codigo");
                $('.code').hide();
                $('.remove').show();
                $('#branches').removeAttr("required");
                $('#destination').removeAttr("required");
                $('#newBranch').prop("required", true);
                $('#newUser').prop("required", true);
                //$('.code').prop('disabled',false);
            }
        });

    });

</script>
@endsection
<!-- END Función-->
