@extends('layout.layoutdas')
@section('title')
Panel Principal
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<!-- Page -->
<div class="page">
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
    </div>
      @endif
  <div class="page-content container-fluid">
    <div class="row" data-plugin="matchHeight" data-by-row="true">
      <div class="col-md-12">
        <div class="panel">
          <div class="panel-heading bg-primary  text-center text-white" id="exampleHeadingDefaultTwo" role="tab">
            <div class="row">
              <div class="col-md-3">   
                  <img align = "left" width="90px" height="90px" src="{{ $shop->image }}">
              </div>
              <div class="col-md-6">
                  <h2 style="color:white">
                      {{$shop->name}}
                  </h2>
              </div>
              <div class="row aling-right">
                  <div class="col-md-3 col-md-offset-3">
                      <button onclick="window.location.href='/tiendas'"
                        type="button" class="btn btn-sm small btn-floating toggler-left  btn-success waves-effect waves-light waves-round float-right"

                        data-toggle="tooltip" data-original-title="Ver Más">
                        <i class="icon md-eye" aria-hidden="true"></i>
                      </button>
                  </div>
                  <div class="col-md-3 col-md-offset-3">
                      <button onclick="window.location.href='/tiendas/{{$shop->id}}/edit'"
                        type="button" class="btn btn-sm small btn-floating
                        toggler-left  btn-primary waves-effect waves-light waves-round float-right"
                        data-toggle="tooltip" data-original-title="Editar Tienda">
                        <i class="icon md-edit" aria-hidden="true"></i>
                      </button>
                  </div>
              </div>
            </div>
          </div>
          <div class="panel-collapse collapse" id="exampleCollapseDefaultTwo" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel" style="">
            <div class="panel-body">
            <form action="/">
              <div class=" col-12">
                  <div class="panel panel-bordered">
                    <div class="panel-body row col-12">
                      <div class="row">
                          <div class="col-3">
                            <label>Seleccione Sucursal</label>
                          </div>
                          <div class="col-3">
                            <label>Seleccione Linea</label>
                          </div>
                        </div>
                      </div>
                      <div class="input-group col-3">
                          <button id="submit" type="submit" name="button" class="btn btn-primary">Generar reporte</button>
                      </div>
                  </div>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6">
        <!-- Widget Linearea One-->
        <div class="card card-shadow" id="widgetLineareaOne">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>  14 kl Nacional
              </div>
              <span class="float-right grey-700 font-size-30">60 gr</span>
            </div>
            <div class="mb-20 grey-500">
              <i class="icon md-long-arrow-up green-500 font-size-16"></i>                  15% Ventas
            </div>
            <div class="ct-chart h-50"></div>
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      <div class="col-xl-3 col-md-6">
        <!-- Widget Linearea Two -->
        <div class="card card-shadow" id="widgetLineareaTwo">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-pizza grey-600 font-size-24 vertical-align-bottom mr-5"></i>              10 kl Italiano
              </div>
              <span class="float-right grey-700 font-size-30">30 gr</span>
            </div>
            <div class="mb-20 grey-500">
              <i class="icon md-long-arrow-up green-500 font-size-16"></i>                  10% Ventas
            </div>
            <div class="ct-chart h-50"></div>
          </div>
        </div>
        <!-- End Widget Linearea Two -->
      </div>
      <div class="col-xl-3 col-md-6">
        <!-- Widget Linearea Three -->
        <div class="card card-shadow" id="widgetLineareaThree">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-notifications-active grey-600 font-size-24 vertical-align-bottom mr-5"></i>                    18 kl Frances
              </div>
              <span class="float-right grey-700 font-size-30">100 gr</span>
            </div>
            <div class="mb-20 grey-500">
              <i class="icon md-long-arrow-down red-500 font-size-16"></i>                  5% Ventas
            </div>
            <div class="ct-chart h-50"></div>
          </div>
        </div>
        <!-- End Widget Linearea Three -->
      </div>
      <div class="col-xl-3 col-md-6">
        <!-- Widget Linearea Four -->
        <div class="card card-shadow" id="widgetLineareaFour">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-label grey-600 font-size-24 vertical-align-bottom mr-5"></i>                    Productos
              </div>
              <span class="float-right grey-700 font-size-30">500</span>
            </div>
            <div class="mb-20 grey-500">
              <i class="icon md-long-arrow-up green-500 font-size-16"></i>                  $30,000 en Productos
            </div>
            <div class="ct-chart h-50"></div>
          </div>
        </div>
        <!-- End Widget Linearea Four -->

        </div>
      </div>
    </div>

@endsection
