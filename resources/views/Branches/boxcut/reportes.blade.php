@extends('layout.layoutdas')
@section('title')
Panel Principal
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<!-- Formulario de Reporte de Productos por estatus-->
<div class="">
    <div class="page-content container-fluid">
        <div class="examle-wrap">
            <h4 class="example-title">Panel De Reportes de Cortes Por Sucursal</h4>
            <div class="example">
                <div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
                    <div class="panel">
                        <div class="panel-heading bg-info  text-center text-white" id="exampleHeadingDefaultOne"
                            role="tab">
                            <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultOne"
                                data-parent="#exampleAccordionDefault" aria-expanded="false"
                                aria-controls="exampleCollapseDefaultOne">
                                Reporte De Corte De Caja
                            </a>
                        </div>
                        <div class="panel-collapse collapse" id="exampleCollapseDefaultOne"
                            aria-labelledby="exampleHeadingDefaultOne" role="tabpanel" style="">
                            <div class="panel-body">
                                @if (session('mesage'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('mesage') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                @if (session('mesage-update'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>{{ session('mesage-update') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                @if (session('mesage-delete'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ session('mesage-delete') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    @endif
                                    <form action="sucursalcorte">
                                        <div class="panel panel-bordered">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-12 col-sm-6">
                                                        <label>Seleccione Sucursal</label>
                                                        <select id="sucursales_1" name="branch_id" alt="1"
                                                            class="form-control round sucursales">
                                                            <!-- <option value="*">Seleccione Sucursal</option> -->
                                                            @foreach($branches as $branch)
                                                            <option value="{{$branch->id}}" required>
                                                                {{$branch->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="input-group">
                                                            <div class="row container"><label>De la Fecha:</label>
                                                            </div>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="icon md-calendar"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                                <input name="fecini" type="text"
                                                                    class="form-control fecini round"
                                                                    data-plugin="datepicker" required>
                                                            </div>
                                                        </div>
                                                        <div class="input-group">
                                                            <div class="row container"><label>Hasta la
                                                                    Fecha:</label></div>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="icon md-calendar" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                            <input name="fecter" type="text" class="form-control round"
                                                                data-plugin="datepicker" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <button id="submit" type="submit" name="button"
                                                        class="btn btn-primary">Generar reporte</button>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Termina formulario de Prueba -->
@endsection
