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
                    <div class="col-md-4 col-md-offset-2">
                        <a href="/grupos/crear" class="btn btn-sm small btn-floating 
                            toggler-left  btn-info waves-effect waves-light waves-round float-right"
                            data-toggle="tooltip" data-original-title="Agregar">
                            <i class="icon md-plus" aria-hidden="true"></i>
                        </a>
                    </div>
                    -->
                </div>
            </div>
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