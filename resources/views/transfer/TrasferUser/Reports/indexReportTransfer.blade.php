@extends('layout.layoutdas')
@section('title')
Panel Principal
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<!-- Formulario de Reporte de traspasos por estatus-->

<div class="page">
    <div class="page-content container-fluid">
        <div class="examle-wrap">
            <h4 class="example-title">Panel De Reportes de Traspasos</h4>
            <div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
                @if(Auth::user()->type_user == 1 )
                <div class="panel">
                    <div class="panel-heading bg-info  text-center text-white" id="exampleHeadingDefaulttwo" role="tab">
                        <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultOne"
                            data-parent="#exampleAccordionDefault" aria-expanded="false"
                            aria-controls="exampleCollapseDefaultOne">Traspasos Por Estatus</a>
                    </div>
                    <div class="panel-collapse collapse" id="exampleCollapseDefaultOne"
                        aria-labelledby="exampleHeadingDefaultOne" role="tabpanel" style="">
                        <div class="panel-body">
                            <!-- Example Tabs -->
                            <div class="example-wrap">
                                <div class="nav-tabs-horizontal" data-plugin="tabs">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation"><a class="nav-link active"
                                                data-toggle="tab" href="#producstatusOne"
                                                aria-controls="producstatusOne" role="tab"> Gramos</a></li>
                                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab"
                                                href="#producstatusTwo" aria-controls="producstatusTwo"
                                                role="tab">Piezas </a></li>
                                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab"
                                                href="#exampleTabsThree" aria-controls="exampleTabsThree"
                                                role="tab">General Gr</a></li>
                                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab"
                                                href="#exampleTabsFour" aria-controls="exampleTabsFour"
                                                role="tab">General Pz</a></li>
                                    </ul>
                                    <div class="tab-content pt-20">
                                        <div class="tab-pane active" id="producstatusOne" role="tabpanel">
                                            <div class="row">
                                                <div class="col-sm">
                                                    <h4>Reporte Traspasos Por Gramos </h4>
                                                </div>
                                            </div>
                                            <form action="reportStatusTransfer">
                                                <input type="int" name="category_id" class="form-control invisible round" data-plugin="datepicker" value="2" required>
                                                <div class="panel panel-bordered">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-6">
                                                                <label>Seleccione Sucursal</label>
                                                                <select id="sucursales_1" name="branch_id" alt="1"
                                                                    class="form-control round sucursales">
                                                                    <!-- <option value="*">Seleccione Sucursal</option> -->
                                                                    @foreach($tienda as $branch)
                                                                    <option value="{{$branch->id}}" required>
                                                                        {{$branch->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label>Seleccione Estatus</label>
                                                                <select id="" name="status_product" alt="1"
                                                                    class="form-control round sucursales">
                                                                    <!-- <option value="">Selecciona Estatus</option> -->
                                                                    <option value='NULL'>Pendiente</option>
                                                                    <option value="1" selected='selected'>Por Pagar
                                                                    </option>
                                                                    <option value="0" selected='selected'>Devolucion
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <div class="input-group">
                                                                    <div class="row container"><label>De la
                                                                            Fecha:</label></div>
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
                                                                            <i class="icon md-calendar"
                                                                                aria-hidden="true"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input name="fecter" type="text"
                                                                        class="form-control round"
                                                                        data-plugin="datepicker" required>
                                                                </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group col-3 col-6 col-12">
                                                    <button id="submit" type="submit" name="button"
                                                        class="btn btn-primary">Generar
                                                        reporte</button>
                                                </div>
                                        </div>
                                        </form>
                                    </div>
                                    <!-- Inicia TAB2 STATUS PRODUCT-->
                                    <div class="tab-pane" id="producstatusTwo" role="tabpanel">
                                        <form action="reportStatusTransfer">
                                            <div class="panel panel-bordered">
                                                <div class="row">
                                                    <div class="col-md col-sm-12">
                                                        <h4>Reporte Traspasos Por Pieza </h4>
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6">
                                                            <label>Seleccione Sucursal</label>
                                                            <select id="sucursales_1" name="branch_id" alt="1"
                                                                class="form-control round sucursales">
                                                                <!-- <option value="*">Seleccione Sucursal</option> -->

                                                                @foreach($tienda as $branch)
                                                                <option value="{{$branch->id}}" required>
                                                                    {{$branch->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label>Seleccione Estatus</label>
                                                            <select id="" name="status_product" alt="1"
                                                                class="form-control round sucursales">
                                                                <!-- <option value="">Selecciona Estatus</option> -->
                                                                <option value="NULL">Pendiente</option>
                                                                <option value="1" selected='selected'>Por Pagar</option>
                                                                <option value="0" selected='selected'>Devolucion
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-sm-6">
                                                            <div class="input-group">
                                                                <div class="row container"><label>De la
                                                                        Fecha:</label></div>
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
                                                                        <i class="icon md-calendar"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                                <input name="fecter" type="text"
                                                                    class="form-control round" data-plugin="datepicker"
                                                                    required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group col-3 col-6 col-12">
                                                    <button id="submit" type="submit" name="button"
                                                        class="btn btn-primary">Generar
                                                        reporte</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Termina tab 2 de product status-->
                                    <div class="tab-pane" id="exampleTabsThree" role="tabpanel">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h4>Reporte General Traspasos Por Gramos </h4>
                                            </div>
                                        </div>
                                        <form action="reportTransferG">
                                            <div class="panel panel-bordered">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6">
                                                            <div class="input-group">
                                                                <div class="row container"><label>De la
                                                                        Fecha:</label></div>
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
                                                        </div>
                                                        <div class="col-12 col-sm-6">
                                                            <div class="input-group">
                                                                <div class="row container"><label>Hasta la
                                                                        Fecha:</label></div>
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="icon md-calendar"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                                <input name="fecter" type="text"
                                                                    class="form-control round" data-plugin="datepicker">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="int" name="category_id" class="form-control invisible round"
                                                        data-plugin="datepicker" value="2" required>
                                                </div>
                                                <div class="input-group col-3 col-6 col-12">
                                                    <button id="submit" type="submit" name="button"
                                                        class="btn btn-primary">Generar
                                                        reporte</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="exampleTabsFour" role="tabpanel">
                                        <div class="row">
                                            <div class=" col-sm-12">
                                                <h4>Reporte General Traspasos Por Pieza </h4>
                                            </div>
                                        </div>
                                        <form action="reportTransferG">
                                            <div class="panel panel-bordered">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6">
                                                            <div class="input-group">
                                                                <div class="row container"><label>De la
                                                                        Fecha:</label></div>
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
                                                        </div>
                                                        <div class="col-12 col-sm-6">
                                                            <div class="input-group">
                                                                <div class="row container"><label>Hasta la
                                                                        Fecha:</label></div>
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="icon md-calendar"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                                <input name="fecter" type="text"
                                                                    class="form-control round" data-plugin="datepicker"
                                                                    required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="int" name="category_id" class="form-control invisible round"
                                                        data-plugin="datepicker" value="1">
                                                </div>
                                                <div class="input-group col-3 col-6 col-12">
                                                    <button id="submit" type="submit" name="button"
                                                        class="btn btn-primary">Generar
                                                        reporte</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Example Tabs -->
                    </div>
                </div>
                @endif
                <!-- End Example Tabs -->
            </div>
        </div>
    </div>
</div>
<!-- End Example Tabs -->

<!-- Termina formulario de Prueba -->
@endsection
