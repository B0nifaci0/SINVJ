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
            </div>
            <h2 class="panel-title" align="center">Unirse a un grupo </h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="/grupos/invitacion" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Código de grupo</label>
                                <input type="text" name="code" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label>Contraseña</label>
                                <input type="text" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-10">
                            <div class="col-md-12">
                                <button class="btn btn-primary">Aceptar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
