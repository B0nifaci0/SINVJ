@extends('layout.layoutdas')
@section('title')
ALTA PRODUCTO
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="page-content">
    <div class="panel">
        <div class="panel-body">
            @if (session('mesage'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('mesage') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if($errors->count() > 0)
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <center>
                <h3>Traspaso Sucursal</h3>
            </center>
            <form class="" action="" method="POST">
                {{ csrf_field() }}
                <div class="form-group col-md-12">
                <div class='row'>
                    <!-- Select para Seleccionar producto-->
                    <div class="form-group form-material  col-md-4  col-md-offset-1 visible-md visible-lg">
                        <label>Sucursal Destino</label>
                        <select id="branch"  class="form-control " data-plugin="select2"
                            data-placeholder="Sucursal destino" data-allow-clear="true" required>
                            <option></option>
                            <optgroup label="Sucursales">
                                @foreach($branches as $branch)
                                <option value="{{ $branch->name }}" required>
                                    {{$branch->name}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        <!--<input type="text" name="product_id" class="invisible" id="product_id">
                        <input type="text" name="product_id" class="invisible" id="product_id">-->
                    </div>
                    <!-- END Select-->
                    <!-- Select para Seleccionar Sucursal Destino-->
                    <div class="form-group  col-md-4  col-md-offset-1 visible-md visible-lg">
                        <label>Ingresa clave del producto</label><br>
                        <input type="text" name="product_id" class="form-control" placeholder="A100" required>
                    </div>
                    <!-- END Select-->
                    <!-- Select para Seleccionar Quien Recibe (Usuario) -->
                    <div class="form-group  col-md-3 col-md-offset-1 visible-md visible-lg">
                        <label>¿Quien Recibe? </label><br>
                        <input type="text" name="recibe" class="form-control" placeholder="Marco" required>
                    </div>
                    <!-- END Select-->
                    <div class="col-md-1">
                        <label>.</label><br>
                        <button id="submit" type="submit" name="button" class="btn btn-primary">+</button>
                    </div>
                </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Clave</th>
                                    <th>Descripción</th>
                                    <th>Observaciones</th>
                                    <th>Suc.Origen</th>
                                    <th>Suc.Destino</th>
                                    <th>¿Quien Recibe?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>A100</td>
                                    <td>Virgen</td>
                                    <td>#10</td>
                                    <td>77-argollas</td>
                                    <td>L-37</td>
                                    <td>Marco</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Botón para guardar traspaso-->
                <div class="form-group col-md-12">
                    <button id="submit" type="submit" name="button" class="btn btn-primary">Guardar</button>
                </div>
                <!-- END Botón-->
            </form>
        </div>
    </div>
</div>
@endsection