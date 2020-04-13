@extends('layout.layoutdas')
@section('title')
GRUPOS
@endsection


@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="page-content">
    <!-- Panel Basic -->
    <div class="panel">
        <header class="panel-heading">
            <h3 class="panel-title">Crear nuevo grupo de tiendas </h3>
        </header>
        <div class="panel-body">
            <form action="/grupos" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-material">
                        <label class="form-control-label">Nombre del grupo</label>
                        <input name="name" type="text" class="form-control">
                    </div>
                </div>
                <div>
                    <br>
                    <div class="col-md-12">
                        <button class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
