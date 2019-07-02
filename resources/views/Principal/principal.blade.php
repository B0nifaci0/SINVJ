@extends('layout.layoutdas')
@section('title')
Panel Principal
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<h1 align="center">Prueba de Panel principal</h1>
<h2 align="center">!!! En Mantenimiento  !!!</h2>

<!-- Page -->
<div class="page">
  <div class="page-content container-fluid">
    <div class="row" data-plugin="matchHeight" data-by-row="true">
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

@endsection