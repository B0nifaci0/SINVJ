@extends('layout.layoutdas')
@section('title')
TRANSFERENCIAS
@endsection
@section('nav')
@endsection
@section('menu')
@endsection
@section('content')
<div class="panel-body">
    <div class="page-content">
        <!-- Mesage-Muestra mensaje De que el producto se a agregado exitosamente-->
        @if (session('mesage'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('mesage') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <!-- END Mesage-->
        <div class="panel">
            <div class="panel-body">
                <div class="example-wrap">
                    <h1 class="text-center panel-title">Actualiza tus productos</h1>
                </div>
            </div>
            <div class="col-xl-12 col-md-12 col-sl">
                <div class="example-wrap">
                    <div class="nav-tabs-horizontal" data-plugin="tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            @if ($categories->count())
                            <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab"
                                    href="#exampleTabsOne" aria-controls="exampleTabsOne" role="tab">Categorias</a>
                                @if ($lines->count())

                            <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab"
                                    href="#exampleTabsTwo" aria-controls="exampleTabsTwo" role="tab">Lineas</a>
                            </li>
                            @endif
                            </li>
                            @elseif($lines->count())
                            @if ($categories->count())
                            <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab"
                                    href="#exampleTabsOne" aria-controls="exampleTabsOne" role="tab">Categorias</a>
                            </li>
                            @endif
                            <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab"
                                    href="#exampleTabsTwo" aria-controls="exampleTabsTwo" role="tab">Lineas</a>
                            </li>
                            @endif
                        </ul>
                        <div class="tab-content">
                            @if ($categories->count())
                            <div class="tab-pane" id="exampleTabsOne" role="tabpanel">
                                <div class="page-content panel-body container-fluid">
                                    <form action="/updateCategories" method="POST">
                                        {{ csrf_field() }}
                                        <div class='row'>
                                            <!-- Select para Seleccionar producto-->
                                            <div class="col-6">
                                                <label>Categorias actuales con productos existentes</label>
                                                <select id="category" class="form-control" data-plugin="select2"
                                                    data-placeholder="Seleccione Categoria" data-allow-clear="true"
                                                    required>
                                                    <option></option>
                                                    <optgroup label="Categorias">
                                                        @foreach($categories as $category)
                                                        <option value="{{ $category->name }}" required>
                                                            {{$category->id}}-{{ $category->name }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                                <input type="text" name="category_id" class="invisible"
                                                    id="category_id">
                                            </div>
                                            <div class="col-6">
                                                <label class="floating-label">{{ __('Categorias del grupo') }}</label>
                                                <select id="categories" class="form-control" name="new_category_id"
                                                    data-plugin="select2" data-placeholder="Seleccione Categoria"
                                                    data-allow-clear="true" required>
                                                    <option> </option required>
                                                </select>
                                                <input type="text" name="new_category_id" class="invisible"
                                                    id="category_group">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 mt-5">
                                            <button id="submit" type="submit" name="button"
                                                class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif
                            @if ($lines->count())
                            <div class="tab-pane" id="exampleTabsTwo" role="tabpanel">
                                <div class="page-content panel-body container-fluid">
                                    <form action="/updateLines" method="POST">
                                        {{ csrf_field() }}
                                        <div class='row'>
                                            <!-- Select para Seleccionar producto-->
                                            <div class="col-6">
                                                <label>Lineas actuales con productos existentes</label>
                                                <select id="line" class="form-control" data-plugin="select2"
                                                    data-placeholder="Seleccione Linea" data-allow-clear="true"
                                                    required>
                                                    <option></option>
                                                    <optgroup label="Lineas">
                                                        @foreach($lines as $line)
                                                        <option value="{{ $line->name }}" required>
                                                            {{$line->id}}-{{ $line->name }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                                <input type="text" name="line_id" class="invisible" id="line_id">
                                            </div>
                                            <div class="col-6">
                                                <label class="floating-label">{{ __('Lineas del grupo') }}</label>
                                                <select id="lines" class="form-control" data-plugin="select2"
                                                    data-placeholder="Seleccione Linea" data-allow-clear="true"
                                                    required>
                                                    <option></option>
                                                    <optgroup label="Lineas">
                                                        @foreach($lines_group as $line)
                                                        <option value="{{ $line->id }}" required>
                                                            {{$line->id}}-{{ $line->name }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                                <input type="text" name="new_line_id" class="invisible" id="line_group">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 mt-5">
                                            <button id="submit" type="submit" name="button"
                                                class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Example Tabs -->
        </div>
    </div>
</div>
<!-- End Panel Basic -->
@endsection
@section('branch-user')
<script type="text/javascript">
    var categories = {!! $categories !!};
    var categories_group = {!! $categories_group !!}
    var lines = {!! $lines !!};
    var lines_group = {!! $lines_group !!}

    $(document).ready(function(){

        $('#category').change(function() {
            name = $(this).val();
            console.log("El nombre es: ",name)
            c = categories.filter(c => c.name == name)[0];
            console.log("El tipo de la categoria es: ", c.type_product)
            $('#categories').empty();
            $('#category_id').val(c.id);
            catGroup = categories_group.filter(catGroup => catGroup.type_product == c.type_product);
            $('#category_group').val(catGroup[0].id);
            catGroup.forEach(element => {
                            $('#categories').append(new Option(element.name, element.id));
                            });
        });

        $('#categories').change(function(){
            id = $(this).val();
            console.log("El id es: ",id);
            c = categories_group.filter(c => c.id == id)[0];
            $('#category_group').val(c.id);
        });

        $('#line').change(function() {
                name = $(this).val();
                console.log("El nombre es: ",name)
                l = lines.filter(l => l.name == name)[0];
                $('#line_id').val(l.id);
                });

                $('#lines').change(function(){
                id = $(this).val();
                console.log("El id es: ",id);
                l = lines_group.filter(l => l.id == id)[0];
                $('#line_group').val(l.id);
                });
    });

</script>
@endsection
<!-- END Función-->
