@extends('layout.layoutdas')
@section('title')
GRUPOS
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
</div>

<div class="page-content">
        <!-- Panel Basic -->
    <div class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <div class="row">
                    <!--
                    <div class="col-md-4 col-md-offset-2">
                        <button onclick="window.location.href='productospdf'" 
                        type="button" class=" btn btn-sm small btn-floating 
                        toggler-left  btn-danger waves-effect waves-light waves-round float-right"
                        data-toggle="tooltip" data-original-title="Generar reporte PDF">
                        <i class="icon fa-file-pdf-o" aria-hidden="true"></i></button>
                    </div>
                    <div class="col-md-4 col-md-offset-2">
                        <button onclick="window.location.href='#'" 
                        type="button" class=" btn btn-sm small btn-floating 
                        toggler-left  btn-success waves-effect waves-light waves-round float-right"
                        data-toggle="tooltip" data-original-title="Generar reporte Excel">
                        <i class="icon fa-file-excel-o" aria-hidden="true"></i></button>
                    </div>
                    -->
                    <div class="col-md-4 col-md-offset-2">
                        <a href="/grupos/crear" class="btn btn-sm small btn-floating 
                            toggler-left  btn-info waves-effect waves-light waves-round float-right"
                            data-toggle="tooltip" data-original-title="Agregar">
                            <i class="icon md-plus" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
            <h3 class="panel-title">Grupos de tiendas </h3>
        </header>
        <div class="panel-body">
            @if($shop_groups->count() > 0)
                <table class="table table-hover dataTable table-striped w-full">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Código de grupo</th>
                            <th>Contraseña</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shop_groups as $shop_group)
                        <tr>
                            <td>{{ $shop_group->id }}</td>
                            <td>{{ $shop_group->name }}</td>
                            <td>{{ $shop_group->group_code }}</td>
                            <td>{{ $shop_group->password }}</td>
                            <td>{{ $shop_group->admin_id }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                No perteneces a un grupo
                <br>
                <div class="row justify-content-md-center">
                    <div class="col-md-2">
                        <a href="/grupos/crear" class="btn btn-primary btn-lg">Crear nuevo grupo</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
