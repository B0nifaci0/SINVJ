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

<div class="page">
    <div class="page-content container-fluid">
        @if (session('message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="examle-wrap">
            <h4 class="example-title">Panel De Reportes de Productos</h4>
            <div class="example">
                <div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
                    @if(Auth::user()->type_user == 1 )
                    <div class="panel">
                        <div class="panel-heading bg-info  text-center text-white" id="exampleHeadingDefaulttwo"
                            role="tab">
                            <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultOne"
                                data-parent="#exampleAccordionDefault" aria-expanded="false"
                                aria-controls="exampleCollapseDefaultOne">Productos Por Estatus</a>
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
                                                    aria-controls="producstatusOne" role="tab">Gramos</a></li>
                                            <li class="nav-item" role="presentation"><a class="nav-link"
                                                    data-toggle="tab" href="#producstatusTwo"
                                                    aria-controls="producstatusTwo" role="tab">Pieza</a></li>
                                            <li class="nav-item" role="presentation"><a class="nav-link"
                                                    data-toggle="tab" href="#exampleTabsThree"
                                                    aria-controls="exampleTabsThree" role="tab">General Gramos</a></li>
                                            <li class="nav-item" role="presentation"><a class="nav-link"
                                                    data-toggle="tab" href="#exampleTabsFour"
                                                    aria-controls="exampleTabsFour" role="tab">General Pieza</a></li>
                                        </ul>
                                        <div class="tab-content pt-20">
                                            <div class="tab-pane active" id="producstatusOne" role="tabpanel">
                                                <form action="estatus">
                                                    <div class="panel panel-bordered">
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-12 col-sm-6">
                                                                    <label>Seleccione Sucursal</label>
                                                                    <select id="sucursales_1" name="branch_id" alt="1"
                                                                        class="form-control round sucursales">
                                                                        @foreach($branches as $branch)
                                                                        <option value="{{$branch->id}}" required>
                                                                            {{$branch->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <label>Seleccione Estatus</label>
                                                                    <select id="" name="status_id" alt="1"
                                                                        class="form-control round sucursales">
                                                                        @foreach($statuses as $status)
                                                                        <option value="{{$status->id}}" required>
                                                                            {{$status->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <label>Seleccione Categoria</label>
                                                                    <select id="" name="category_id" alt="1"
                                                                        class="form-control round sucursales">
                                                                        @foreach($categories as $category)
                                                                        @if($category->type_product == 2 )
                                                                        <option value="{{$category->id}}" required>
                                                                            {{$category->name}}</option>
                                                                        @endif
                                                                        @endforeach
                                                                    </select>
                                                                    <input type="int" name="type_product"
                                                                        class="form-control invisible round"
                                                                        data-plugin="datepicker" value="2" required>
                                                                </div>
                                                                <div class="col-12 col-sm-6">
                                                                    <label>Seleccione Linea</label>
                                                                    <select id="" name="line_id" alt="1"
                                                                        class="form-control round sucursales">
                                                                        @foreach($lines as $linea)
                                                                        <option value="{{$linea->id}}" required>
                                                                            {{$linea->name}}</option>
                                                                        @endforeach
                                                                    </select>
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
                                                                                data-plugin="datepicker">
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
                                                                            data-plugin="datepicker">
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
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Inicia TAB2 STATUS PRODUCT-->
                                        <div class="tab-pane" id="producstatusTwo" role="tabpanel">
                                            <form action="estatus">
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
                                                                <label>Seleccione Estatus</label>
                                                                <select id="" name="status_id" alt="1"
                                                                    class="form-control round sucursales">
                                                                    @foreach($statuses as $status)
                                                                    <option value="{{$status->id}}" required>
                                                                        {{$status->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label>Seleccione Categoria</label>
                                                                <select id="" name="category_id" alt="1"
                                                                    class="form-control round sucursales">
                                                                    @foreach($categories as $category)
                                                                    @if($category->type_product == 1 )
                                                                    <option value="{{$category->id}}" required>
                                                                        {{$category->name}}</option>
                                                                    @endif
                                                                    @endforeach
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
                                                                            data-plugin="datepicker">
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
                                                                        data-plugin="datepicker">
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
                                            <form action="general-estatus">
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
                                                                            data-plugin="datepicker">
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
                                                                        class="form-control round"
                                                                        data-plugin="datepicker">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="int" name="cat"
                                                            class="form-control invisible round"
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
                                            <form action="general-estatus">
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
                                                                        class="form-control round"
                                                                        data-plugin="datepicker">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="int" name="cat"
                                                            class="form-control invisible round"
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
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-heading bg-primary  text-center text-white" id="exampleHeadingDefaultTwo"
                            role="tab">
                            <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultTwo"
                                data-parent="#exampleAccordionDefault" aria-expanded="false"
                                aria-controls="exampleCollapseDefaultTwo">Gramos y precio por Linea</a>
                        </div>
                        <div class="panel-collapse collapse" id="exampleCollapseDefaultTwo"
                            aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel" style="">
                            <div class="panel-body">
                                <!-- Example Tabs -->
                                <div class="example-wrap">
                                    <div class="nav-tabs-horizontal" data-plugin="tabs">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item" role="presentation"><a class="nav-link active"
                                                    data-toggle="tab" href="#exampleTabsOne"
                                                    aria-controls="exampleTabsOne" role="tab">Gramos</a></li>
                                            <li class="nav-item" role="presentation"><a class="nav-link"
                                                    data-toggle="tab" href="#exampleTabsTwo"
                                                    aria-controls="exampleTabsTwo" role="tab">General Gramos</a></li>
                                            <li class="nav-item" role="presentation"><a class="nav-link"
                                                    data-toggle="tab" href="#exampleTabsThree"
                                                    aria-controls="exampleTabsThree" role="tab">Pieza</a></li>
                                            <li class="nav-item" role="presentation"><a class="nav-link"
                                                    data-toggle="tab" href="#exampleTabsFour"
                                                    aria-controls="exampleTabsFour" role="tab">General Pieza</a></li>
                                        </ul>
                                        <div class="tab-content pt-20">
                                            <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                                                <form action="reportLinea">
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
                                                                    <label>Seleccione Linea</label>
                                                                    <select id="" name="line_id" alt="1"
                                                                        class="form-control round sucursales">
                                                                        <!-- <option value="">Selecciona Linea</option> -->
                                                                        <!-- <option value="*">Tod@s</option> -->
                                                                        @foreach($lines as $line)
                                                                        <option value="{{$line->id}}" required>
                                                                            {{$line->name}}</option>
                                                                        @endforeach
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
                                                                                data-plugin="datepicker">
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
                                                                            data-plugin="datepicker">
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
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="exampleTabsTwo" role="tabpanel">
                                            <form action="reportLineaG">
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
                                                                            data-plugin="datepicker">
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
                                                                        class="form-control round"
                                                                        data-plugin="datepicker">
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
                                        <div class="tab-pane" id="exampleTabsThree" role="tabpanel">
                                            <form action="reportPz">
                                                <div class="panel panel-bordered">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-6">
                                                                <label>Seleccione Sucursal</label>
                                                                <select id="sucursales_1" name="branch_id" alt="3"
                                                                    class="form-control round sucursales">
                                                                    <!-- <option value="*">Seleccione Sucursal</option> -->
                                                                    @foreach($branches as $branch)
                                                                    <option value="{{$branch->id}}" required>
                                                                        {{$branch->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label>Seleccione Categoria</label>
                                                                <select id="" name="category_id" alt="1"
                                                                    class="form-control round sucursales">
                                                                    @foreach($categories as $category)
                                                                    @if($category->type_product == 1 )
                                                                    <option value="{{$category->id}}" required>
                                                                        {{$category->name}}</option>
                                                                    @endif
                                                                    @endforeach
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
                                                                            data-plugin="datepicker">
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
                                                                        data-plugin="datepicker">
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
                                        <div class="tab-pane" id="exampleTabsFour" role="tabpanel">
                                            <form action="reportPzG">
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
                                                                            data-plugin="datepicker">
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
                                                                        class="form-control round"
                                                                        data-plugin="datepicker">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="panel">
                        <div class="panel-heading bg-success  text-center text-white" id="exampleHeadingDefaultThree"
                            role="tab">
                            <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultThree"
                                data-parent="#exampleAccordionDefault" aria-expanded="false"
                                aria-controls="exampleCollapseDefaultThree">Entradas De Productos</a>
                        </div>
                        <div class="panel-collapse collapse" id="exampleCollapseDefaultThree"
                            aria-labelledby="exampleHeadingDefaultThree" role="tabpanel">
                            <div class="panel-body">
                                <div class="example-wrap">
                                    <div class="nav-tabs-horizontal" data-plugin="tabs">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item" role="presentation"><a class="nav-link active"
                                                    data-toggle="tab" href="#exampleTabsOne"
                                                    aria-controls="exampleTabsOne" role="tab">Gramos</a></li>
                                            <li class="nav-item" role="presentation"><a class="nav-link"
                                                    data-toggle="tab" href="#exampleTabsTwo"
                                                    aria-controls="exampleTabsTwo" role="tab">General Gramos</a></li>
                                            <li class="nav-item" role="presentation"><a class="nav-link"
                                                    data-toggle="tab" href="#exampleTabsThree"
                                                    aria-controls="exampleTabsThree" role="tab">Pieza</a></li>
                                            <li class="nav-item" role="presentation"><a class="nav-link"
                                                    data-toggle="tab" href="#exampleTabsFour"
                                                    aria-controls="exampleTabsFour" role="tab">General Pieza</a></li>
                                        </ul>
                                        <div class="tab-content pt-20">
                                            <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                                                <form action="entradas-linea">
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
                                                                    <label>Seleccione Linea</label>
                                                                    <select id="" name="line_id" alt="1"
                                                                        class="form-control round sucursales">
                                                                        @foreach($lines as $line)
                                                                        <option value="{{$line->id}}" required>
                                                                            {{$line->name}}</option>
                                                                        @endforeach
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
                                                                                data-plugin="datepicker">
                                                                        </div>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <div class="row  container"><label>Hasta la
                                                                                Fecha:</label></div>
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="icon md-calendar"
                                                                                    aria-hidden="true"></i>
                                                                            </span>
                                                                        </div>
                                                                        <input name="fecter" type="text"
                                                                            class="form-control round"
                                                                            data-plugin="datepicker">
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
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="exampleTabsTwo" role="tabpanel">
                                            <form action="entradas-general-gramos">
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
                                                                            data-plugin="datepicker">
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
                                                                        data-plugin="datepicker">
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
                                        <div class="tab-pane" id="exampleTabsThree" role="tabpanel">
                                            <form action="reportEntradaspz">
                                                <div class="panel panel-bordered">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-6">
                                                                <label>Seleccione Sucursal</label>
                                                                <select id="sucursales_1" name="branch_id" alt="3"
                                                                    class="form-control round sucursales">
                                                                    <!-- <option value="*">Seleccione Sucursal</option> -->
                                                                    @foreach($branches as $branch)
                                                                    <option value="{{$branch->id}}" required>
                                                                        {{$branch->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label>Seleccione Categoria</label>
                                                                <select id="" name="category_id" alt="1"
                                                                    class="form-control round sucursales">
                                                                    @foreach($categories as $category)
                                                                    @if($category->type_product == 1 )
                                                                    <option value="{{$category->id}}" required>
                                                                        {{$category->name}}
                                                                    </option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <div class="input-group">
                                                                    <div class="row container"><label>De la
                                                                            Fecha:</label>
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
                                                                            data-plugin="datepicker">
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
                                                                        data-plugin="datepicker">
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
                                        <div class="tab-pane" id="exampleTabsFour" role="tabpanel">
                                            <form action="reportEntradasPrgppz">
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
                                                                    <div class="row container"><label>De la
                                                                            Fecha:</label>
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
                                                                            data-plugin="datepicker">
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
                                                                        data-plugin="datepicker">
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
                                    </div>
                                </div>
                                <!-- End Example Tabs -->
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->type_user == 1 )
                    <div class="panel">
                        <div class="panel-heading bg-warning  text-center text-white" id="exampleHeadingDefaultFour"
                            role="tab">
                            <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultFour"
                                data-parent="#exampleAccordionDefault" aria-expanded="false"
                                aria-controls="exampleCollapseDefaultFour">Reporte
                                de Utilidad</a>
                        </div>
                        <div class="panel-collapse collapse" id="exampleCollapseDefaultFour"
                            aria-labelledby="exampleHeadingDefaultFour" role="tabpanel">
                            <div class="panel-body">
                                <!-- Example Tabs -->
                                <div class="example-wrap">
                                    <div class="nav-tabs-horizontal" data-plugin="tabs">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item" role="presentation"><a class="nav-link active"
                                                    data-toggle="tab" href="#exampleTabsOne"
                                                    aria-controls="exampleTabsOne" role="tab">Gramos</a></li>
                                            <li class="nav-item" role="presentation"><a class="nav-link"
                                                    data-toggle="tab" href="#exampleTabsTwo"
                                                    aria-controls="exampleTabsTwo" role="tab">Pieza</a></li>
                                            <li class="nav-item" role="presentation"><a class="nav-link"
                                                    data-toggle="tab" href="#exampleTabsThree"
                                                    aria-controls="exampleTabsThree" role="tab">General</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content pt-20">
                                            <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                                                <form action="reportUtility">
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
                                                                            {{$branch->name}}
                                                                        </option>
                                                                        @endforeach
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
                                                                                data-plugin="datepicker">
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
                                                                            data-plugin="datepicker">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="int" name="cat" class="form-control invisible round"
                                                        value="2" required>
                                                    <div class="input-group col-3 col-6 col-12">
                                                        <button id="submit" type="submit" name="button"
                                                            class="btn btn-primary">Generar
                                                            reporte</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-content pt-20">
                                            <div class="tab-pane" id="exampleTabsTwo" role="tabpanel">
                                                <form action="reportUtility">
                                                    <div class="panel panel-bordered">
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-12 col-sm-6">
                                                                    <label>Seleccione Sucursal</label>
                                                                    <select id="sucursales_1" name="branch_id" alt="3"
                                                                        class="form-control round sucursales">
                                                                        @foreach($branches as $branch)
                                                                        <option value="{{$branch->id}}" required>
                                                                            {{$branch->name}}
                                                                        </option>
                                                                        @endforeach
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
                                                                                data-plugin="datepicker">
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
                                                                            class="form-control round date"
                                                                            data-plugin="datepicker">
                                                                    </div>
                                                                    <input type="int" name="cat"
                                                                        class="form-control invisible round" value="1"
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
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="exampleTabsThree" role="tabpanel">
                                            <form action="reportUtilityGeneral">
                                                <div class="panel panel-bordered">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-6">
                                                                <label>Seleccione Sucursal</label>
                                                                <select id="sucursales_1" name="branch_id" alt="2"
                                                                    class="form-control round sucursales">
                                                                    @foreach($branches as $branch)
                                                                    <option value="{{$branch->id}}" required>
                                                                        {{$branch->name}}
                                                                    </option>
                                                                    @endforeach
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
                                                                            data-plugin="datepicker">
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
                                                                        class="form-control round date"
                                                                        data-plugin="datepicker">
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
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('example')
<script type="text/javascript">
    $(document).ready(function() {

        $('.btn').click(function() {
            $(this).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Cargando...`);
        });
    })
</script>
@endsection