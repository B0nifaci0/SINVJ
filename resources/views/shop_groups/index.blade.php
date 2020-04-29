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

                </div>
            </div>
            <h3 class="panel-title">Grupos de tiendas </h3>
        </header>
        <div class="panel-body">
            @if($shop_group->count() > 0)
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
                    <tr>
                        <td>{{ $shop_group->id }}</td>
                        <td>{{ $shop_group->name }}</td>
                        <td>{{ $shop_group->group_code }}</td>
                        <td>{{ $shop_group->password }}</td>
                        <td>{{ $user->name }}</td>
                    </tr>
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
