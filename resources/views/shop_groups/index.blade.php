@extends('layout.layoutdas')
@section('title')
GRUPOS
@endsection


@section('nav')

@endsection
@section('menu')

@endsection
@section('content')

	@if (session('mesage'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('mesage') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

<div class="page-content">
        <!-- Panel Basic -->
    <div class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <div class="row">
         
                </div>
            </div>
            <h2 class="panel-title" align="center">Grupos de tiendas </h2>
        </header>
        <div class="panel-body">
            @if($shop_groups->count() > 0)
                <table class="table table-hover dataTable table-striped w-full">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Código de grupo</th>
                            <th>Contraseña</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shop_groups as $shop_group)
                        <tr>
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
