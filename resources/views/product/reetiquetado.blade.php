@extends('layout.layoutdas')
@section('title')
MODIFICACIÓ PRODUCTO
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')

<div class="page-content">
    <div class="panel">
        <div class="panel-body">
            @if($errors->count() > 0)
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <h2 align="center">Reetiquetado de productos</h2>
            @foreach($products as $product)
            <form id="multiplicar" class="" action="/productos" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class='row'>
                    <!-- Input para ingresar clave del producto-->
                    <div class="form-group form-material col-md-3">
                        <label>Clave</label>
                        <input type="text" class="form-control" name="clave" value="{{($product->clave) ? $product->clave: old('clave')}}" required>
                    </div>
                    <!-- END Input-->
                    <!-- Input para ingresar descripcion-->
                    <div class="form-group form-material col-md-3">
                        <label>Descripcion</label>
                        <input type="text" class="form-control" name="description" value="{{($product->description) ? $product->description: old('description')}}" required>
                    </div>
                    <!-- END Input-->
                    <!-- Select para Seleccionar linea-->
                    <div class="col-md-3 form-material remove">
                        <label class="control-label">Seleccione Linea</label>
                        <select id="line_id" name="line_id" class="form-control round">
                            @foreach($lines as $line)
                            <option value="{{ $line->id }}" required>{{($line->name) ? $line->name :old('$line->name')}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- END Select-->

                    <!-- Input para ingresar precio del producto pz-->
                    <div id="pricepz" class="form-group form-material col-md-3">
                        <label>Precio del Producto</label>
                        <input type="text" class="form-control" name="price" value="{{($product->price) ? $product->price: old('$product->price')}}">
                    </div>

                    <!-- Input para ingresar precio del producto pz-->
                    <div id="pricecp" class="form-group form-material col-md-3 remove">
                        <label>Precio Compra</label>
                        <input type="text" class="form-control" id="pricePurchase" name="price_purchase" value="{{($product->price_purchase) ? $product->price_purchase :old('$product->price_purchase')}}">
                    </div>
                    <!-- END Input-->
                    <div class="col-md-3 form-material remove">
                        <label class="control-label">Precio de la linea</label>
                        <input type="text" name="" id="line_price" class="form-control" readonly>
                    </div>
                    <div id="line_price" class="form-group form-material col-md-3 remove">
                        <label>Precio del Producto</label>
                        <input type="text" class="form-control" id="pricewhitline" readonly name="price" value="{{($product->price) ? $product->price: old('$product->price')}}">

                    </div>
                    <div class="col-md-3 form-material remove">
                        <label class="control-label">Precio descuento de la linea</label>
                        <input type="text" name="" id="purchase_price" class="form-control" readonly>
                    </div>
                    <!-- END Select-->
                    <!-- Input para ingresar Peso del producto-->
                    <div class="form-group form-material col-md-3 remove">
                        <label>Gramos</label>
                        <input type="text" id="multiplicador" class="form-control" name="weigth" value="{{($product->weigth) ? $product->weigth :old('$product->weigth')}}">
                    </div>
                    <!-- END Input-->
                    <!--
            <div id="show" class="form-group form-material col-md-3 remove">
              <label>Precio del Producto</label>
              <input type="text"readonly="readonly" class="form-control" id="total" readonly name="price">
            </div>
             -->
                    <!-- Input para ingresar Tope de descuento -->


                    <div class="form-group form-material col-md-3 remove">
                        <label>Tope de descuento gr</label>
                        <input type="text" readonly="readonly" class="form-control" id="discount" readonly name="purchase_price">
                    </div>
                    <!-- END Input-->
                    <!-- Select para Seleccionar categoria-->
                    <div class="col-md-3">
                        <label>Seleccione Categoria </label>
                        <select id="categorie_id" name="category_id" class="form-control round">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" required>{{ $category->name }}</option>
                            <!--<option class="invisible" id="categorie_type_product" value="{{ $category->type_product }}" required>{{ $category->type_product }}</option>-->
                            @endforeach
                        </select>
                    </div>
                    <!-- END Select-->
                    <div>
                        @foreach ($shops as $shop)
                        <input type="hidden" name="shop_id" value="{{$shop->id}}">
                        @endforeach
                    </div>
                    <!-- Select para Seleccionar sucursal-->
                    <div class="col-md-3">
                        <label>Seleccione Sucursal</label>
                        <select name="branch_id" class="form-control round">
                            @php
                            $branches = $user->shop->branches;
                            @endphp
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" required>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- END Select-->
                    <!-- Select para Editar Estatus-->
                    <div class="col-md-3">
                        <label>Seleccione El Estatus Actual</label>
                        <select name="status_id" class="form-control round">
                            @foreach($statuses as $status)
                            @if($status->id != 3 && $status->id != 1)
                            <option value="{{ $status->id }}" required>{{ $status->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <!-- END Select-->
                    <!-- Input para ingresar Observaciones-->
                    <div class="form-group form-material col-md-6">
                        <label>Observaciones</label>
                        <input type="text" class="form-control" value="{{$product->observations}}" name="observations">
                    </div><!-- END Input-->
                    <!-- Input para Seleccionar Imagen del producto-->
                    <div class="form-group form-material col-md-6">
                        <label>Selecciona imagen del producto</label>
                        <br>
                        <label for="image" class="btn btn-primary">Explorar</label>
                        <input type="file" name="image" id="image" class="hidden">
                    </div>
                    <!-- END Input-->
                    <br>
                    <br>
                    <!-- Botón para guardar Producto-->
                    <div class="form-group col-md-12">
                        <button id="submit" type="submit" name="button" class="btn btn-primary">Guardar</button>
                    </div>
                    <!-- END Botón-->
                </div>
            </form>
            @endforeach
        </div>
    </div>
</div>
@endsection


@section('disabled-submit')
<script type="text/javascript">
    $(document).ready(function() {

        $("#categories").change(function() {
            if ($(this).val() == "" || $("#file").val() == "") {
                $("#submit").prop("disabled", true);
            } else {
                $("#submit").prop("disabled", false);
            }
        });

        $("#file").change(function() {
            if ($("#categories").val() == "" || $(this).val() == "") {
                $("#submit").prop("disabled", true);
            } else {
                $("#submit").prop("disabled", false);
            }
        });

        $("#file").change(function() {
            $("#preview-box").attr("class", "");
            render(this);
            $("#image_name").html($(this).val().split("\\").pop());
        });

        function render(image) {
            if (image.files && image.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#preview").attr("src", e.target.result);
                }
                reader.readAsDataURL(image.files[0]);
            }
        }

    });
</script>
@endsection

<!-- Función para obtener el precio de linea-->


@section('precio-linea')
<script type="text/javascript">
    //detecta el tipo de categoria y cambia el formulario
    var categoryTypeproduct = {!! $categories !!};

    let defaul = categoryTypeproduct[0]
    if (defaul.type_product == 1) {
        //alert(JSON.stringify('pz'+defaul.type_product));
        $('.remove').css('display', 'none');
        $('#pricepz').css('display', 'initial');
        // $('#pricecp').css('display', 'initial');

        //$('.removeClass').removeClass('invisible');
        //$('#s').toggle();
    } else if (defaul.type_product == 2) {
        //alert(JSON.stringify('pz'+defaul.type_product));
        $('.remove').css('display', 'initial');
        $('#pricepz').css('display', 'none');
        // $('#pricecp').css('display', 'none');


    }

    $('#categorie_id').change(function() {
        $('#pricepz').val(0);
        $('#pricecp').val(0)


        var categoryTypeproduct = {!! $categories !!};
        var categoryId = $(this).val();
        var categoryTypeproduct = categoryTypeproduct.filter(l => l.id == categoryId)[0];
        if (categoryTypeproduct.type_product == 1) {
            // PZA
            $('.remove').css('display', 'none');
            $('#pricepz').css('display', 'initial');
            $('#pricecp').css('display', 'initial');
            // set purchase price for Pza products
            $('#pricePurchase').val(Number($('#line_price').val()) * Number($('#multiplicador').val()));
        } else if (categoryTypeproduct.type_product == 2) {
            // Gramos
            $('.remove').css('display', 'initial');
            $('#pricepz').css('display', 'none');
            $('#pricecp').css('display', 'none');
        }
    });


    var lines = {!! $lines !!};
    var line = lines[0];
    //console.log("lines", lines);

    $('#line_price').val(lines[0].sale_price);
    $('#purchase_price').val(lines[0].purchase_price);


    $('#line_id').change(function() {
        var id = $(this).val();
        line = lines.filter(l => l.id == id)[0];
        $('#line_price').val(line.sale_price);
        $('#purchase_price').val(line.purchase_price);
    });


    $(document).ready(function() {
        // alert('ready');

        setTimeout(() => {
            var total = $('#purchase_price').val() * Number($('#multiplicador').val());
            //var discount = total - (total * (Number(line.discount_percentage) / 100))
            var discount = total
            $('#discount').val(discount);
            //

            // $('#pricepz').val(0);
            // $('#pricecp').val(0)
            var categoryTypeproduct = {!! $categories !!};

            categoryTypeproduct = categoryTypeproduct[0];
            if (categoryTypeproduct.type_product == 1) {
                $('.remove').css('display', 'none');
                $('#pricepz').css('display', 'initial');
                $('#pricecp').css('display', 'initial');
            } else if (categoryTypeproduct.type_product == 2) {
                console.log('<p>agregar campos</p>');
                $('.remove').css('display', 'initial');
                $('#pricepz').css('display', 'none');
                $('#pricecp').css('display', 'none');
            }

        }, 1000);

        $('#multiplicador').keyup(function() {
            // alert('multi');
            var total = $('#purchase_price').val() * $(this).val();
            var total_1 = $('#line_price').val() * $(this).val();
            // var discount = total - (total * (Number(line.discount_percentage) / 100))
            console.log("Lineaa descuento:",total)
            $('#pricewhitline').val(total_1);
            var discount = total
            $('#discount').val(discount);
            $('#total').val(total);


        });
    });
</script>
@endsection
<!-- END Función-->
<!-- Función para calcular el
(peso del producto por el precio de la linea)-->
@section('calcular-precio')
<script type="text/javascript">
    multiplicar() {
    m1 = document.getElementById("secondary").value;
    m2 = document.getElementById("multiplicador").value;
    r = m1 * m2;
    document.getElementById("resultado").value = r;
    });
</script>
@endsection
<!-- END Función-->
