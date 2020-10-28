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
<div class="col-sm-12 col-lg-12">
  <div class="page-content"></div>
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
  <div class="col-sm-12 col-lg-12">
    <div class="container-fluid">
      <div class="row" data-plugin="matchHeight" data-by-row="true">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-heading bg-white  text-center text-white" id="exampleHeadingDefaultTwo" role="tab">
              <div class="row">
                @if(Auth::user()->type_user == 1 )
                <div class="col-md-12">
                  <button onclick="window.location.href='/tiendas/{{$shop->id}}/edit'" type="button" class="btn btn-lg 
                        toggler-left  btn-primary waves-effect waves-light waves-round float-right"
                    data-toggle="tooltip" data-original-title="Editar Tienda">
                    <i class="icon md-edit" aria-hidden="true" align="right"></i>
                  </button>
                </div>
                @endif
                <div class="col-md-12">
                  <img class="img-responsive " width="225px" height="160px" src="{{ $shop->image }}">
                </div>
                <!--<div class="col-md-6">
                  <h2 style="color:white">
                     {{$shop->name}}
                  </h2>
              </div>-->
                <!--<div class="row aling-right">
                  <div class="col-md-6 col-md-offset-2">
                  <div class= "mt-25" ></div>
                      <button align="right" onclick="window.location.href='/tiendas'"
                        type="button" class="btn btn-sm small btn-floating toggler-left  btn-success waves-effect waves-light waves-round float-right"
                        data-toggle="tooltip" data-original-title="Ver Más" >
                        <i class="icon md-eye" aria-hidden="true"></i>
                      </button>
                  </div>-->

              </div>
            </div>
          </div>
          <div class="panel-collapse collapse" id="exampleCollapseDefaultTwo" aria-labelledby="exampleHeadingDefaultTwo"
            role="tabpanel" style="">
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
    </div>

  </div>

  @if(Auth::user()->type_user == 1 )
  <div class="col-sm-12 col-lg-12">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="panel-warning">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Informacion De Productos Por Gramos De Todas Las
                  Sucursales
                </h2>
              </center>
            </div><br>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total De Gramos</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-15">
                        <i class="icon md-map grey-600 font-size-30 vertical-align-bottom mr-5"></i>Gramos
                      </div>
                      
                      <span class="float-right grey-700 font-size-30">
                        @if($total) {{number_format($total,2)}} gr @else 0 gr
                        @endif
                      </span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>

            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total De Dinero Por Gramo</h2>
              </center>
            </div>
            <div class="row">

              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Dinero
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($ventas) $ {{number_format($ventas,2)}}
                        @else
                        $ 0 @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>
                </div>
                <!-- End Widget Linearea One -->
              </div>

            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total De Gramos Existentes</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Gramos Existentes
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($gramos_existentes) 
                        {{number_format($gramos_existentes,2)}} gr
                        @else 0 gr @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>

            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total en Productos Existentes</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Dinero
                         (Existentes)
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($ventas_e) $ {{number_format($ventas_e,2)}}
                        @else $ 0 @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total De Gramos Traspasados</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Gramos Traspasados
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($gramos_traspasado) 
                        {{number_format($gramos_traspasado,2)}} gr
                        @else 0 gr @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total en Productos Traspasados</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Dinero
                        (Traspasados)
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($ventas_t) $ {{number_format($ventas_t,2)}}
                        @else $ 0 @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total De Gramos Dañados</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Gramos Dañados
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($gramos_dañados) 
                        {{number_format($gramos_dañados,2)}} gr
                        @else
                        0 gr @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total en Productos Dañados</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Dinero (Dañados)
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($ventas_d) $ {{number_format($ventas_d,2)}}
                        @else $ 0 @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total De Gramos Devueltos</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Gramos Devueltos
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($gramos_devueltos) 
                      {{number_format($gramos_devueltos,2)}} gr
                        @else
                        0 gr @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total en Productos Devueltos</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Dinero (Devueltos)
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($ventas_devueltos) $
                        {{number_format($ventas_devueltos,2)}}
                        @else $ 0 @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>

  <div class="col-sm-12 col-lg-12">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="bg-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Informacion De Productos Por Piezas De Todas Las Sucursales
                </h2>
              </center>
            </div>
          </div>
          <br>
        </div>
        <div class="col-sm-6">
          <div class="panel-warning">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total De Productos Por Piezas</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Piezas
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($piezas) {{$piezas}} pzs @else 0 pzs @endif
                      </span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>

            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-warning">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total En Piezas</h2>
              </center>
            </div>
            <div class="row">

              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Dinero
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($pieza_vent) $
                        {{number_format($pieza_vent,2)}}
                        @else $ 0 @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>
                </div>
                <!-- End Widget Linearea One -->
              </div>

            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-warning">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total De Piezas Existentes</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Piezas Existentes
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($piezas_e) {{$piezas_e}} pzs @else 0 pzs
                        @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>

            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-warning">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total En Piezas Existentes</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Dinero (Existentes)
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($pieza_vente) $
                        {{number_format($pieza_vente,2)}}
                        @else $ 0 @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-warning">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total De Piezas Traspasadas</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Piezas Traspasadas
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($piezas_t) {{$piezas_t}} pzs @else 0 pzs
                        @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-warning">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total En Piezas Traspasadas</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Dinero (Traspasados)
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($pieza_ventt) $
                        {{number_format($pieza_ventt,2)}}
                        @else $ 0 @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-warning">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total De Piezas Dañadas</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Piezas Dañadas
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($piezas_d) {{$piezas_d}} pzs @else 0 pzs
                        @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-warning">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total En Piezas Dañadas</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Dinero (Dañados)
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($pieza_ventd) $
                        {{number_format($pieza_ventd,2)}}
                        @else $ 0 @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-warning">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total De Piezas Devueltas</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Piezas Devueltas
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($piezas_devueltos) {{$piezas_devueltos}} pzs
                        @else 0 pzs
                        @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-warning">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total En Piezas Devueltas</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Dinero (Devueltos)
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($piezas_ventdev) $
                        {{number_format($piezas_ventdev,2)}}
                        @else $ 0 @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>


  @endif

  @if(Auth::user()->type_user == 3 OR Auth::user()->type_user == 2)

  <div class="col-sm-12 col-lg-12">
    <div class="container-fluid" style="background-color:white">
      <div class="row">
        <div class="col-12">
          <div class="panel-warning">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Informacion De Productos Por Gramos De La Sucursal
                  @foreach($branches_col as $branch) {{$branch->name}} @endforeach</h2>
              </center>
            </div><br>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total de Gramos</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Gramos
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($gramos_col) {{$gramos_col}} gr @else 0 gr
                        @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>

            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total De Gramos Existentes</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Gramos Existentes
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($gramos_cole) {{$gramos_cole}} gr @else 0 gr
                        @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>

            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total De Gramos Traspasados</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Gramos Traspasados
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($gramos_colt) {{$gramos_colt}} gr @else 0 gr
                        @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total De Gramos Dañados</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Gramos Dañados
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($gramos_cold) {{$gramos_cold}} gr @else 0 gr
                        @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total De Gramos Devueltos</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Gramos Devueltos
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($gramos_coldev) {{$gramos_coldev}} gr @else 0
                        gr
                        @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="col-sm-12 col-lg-12">
    <div class="container-fluid" style="background-color:white">
      <div class="row">
        <div class="col-12">
          <div class="panel-warning">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Informacion De Productos Por Pieza De La Sucursal
                  @foreach($branches_col as $branch) {{$branch->name}} @endforeach</h2>
              </center>
            </div><br>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total de Piezas</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Piezas
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($piezas_col) {{$piezas_col}} pzs @else 0
                        pzs
                        @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>

            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total De Piezas Existentes</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Piezas
                        (Existentes)
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($piezas_cole) {{$piezas_cole}} pzs @else 0
                        pzs
                        @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>

            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total De Piezas Traspasadas</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Piezas
                        (Traspasadas)
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($piezas_colt) {{$piezas_colt}} pzs @else 0
                        pzs
                        @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total De Piezas Dañadas</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Piezas (Dañadas)
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($piezas_cold) {{$piezas_cold}} pzs @else 0
                        pzs
                        @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm">
          <div class="panel-primary">
            <div class="panel-heading">
              <center>
                <h2 class="panel-title" style="color:white">Total De Piezas Devueltas</h2>
              </center>
            </div>
            <div class="row">
              <div class="col-sm">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Piezas (Devueltas)
                      </div>
                      <span class="float-right grey-700 font-size-30">@if($piezas_coldev) {{$piezas_coldev}} pzs @else 0
                        pzs
                        @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>

                </div>
                <!-- End Widget Linearea One -->
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  @endif

  <br>

  <div class="col-sm-12 col-lg-12">
    <div class="container-fluid">
      <div class="panel-success">
        <div class="panel-heading">


          @if(Auth::user()->type_user == 1 )
          <h2 class="panel-title" style="color:white">Sucursales Disponibles</h2>
        </div>
        <div class="row">
          @foreach($branches as $branch)

          <div class="col-sm-4 col-lg-4">
            <!-- Widget Linearea One-->
            <div class="card card-shadow">
              <div class="card-block p-20 pt-10">
                <div class="clearfix">
                  <div class="grey-800 float-left py-10">
                    <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i> {{$branch->name}}
                  </div>
                  <span class="float-right grey-700 font-size-30"></span>
                </div>
                <!--  <div class="ct-chart h-50"></div>   -->
                <a href="/sucursales/{{$branch->id}}/mostrar" class="btn btn-primary">Ver Más</a>
              </div>
            </div>
            <!-- End Widget Linearea One -->
          </div>

          @endforeach
        </div>
      </div>
      @endif

      @if(Auth::user()->type_user == 3 OR Auth::user()->type_user == 2)
      <h2 class="panel-title" style="color:white">Sucursal A La Que Pertenece</h2>
    </div>
  </div>

  <div class="col-sm-12 col-lg-12">
    <div class="container-fluid">
      @foreach($branches_col as $branch)
      <div class="row">
        <div class="col-sm-3">
          <!-- Widget Linearea One-->
          <div class="card card-shadow">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i> {{$branch->name}}
                </div>
                <span class="float-right grey-700 font-size-30"></span>
              </div>
              <!--  <div class="ct-chart h-50"></div>   -->
              <a href="/sucursales/{{$branch->id}}/mostrar" class="btn btn-primary">Ver Más</a>
            </div>
          </div>
          <!-- End Widget Linearea One -->
        </div>
      </div>
      @endforeach
      @endif


    </div>
  </div>

  @endsection


@section('delete-productos')
<script type="text/javascript">
$(document).ready(function () {
    var changed = {!! $price_changed !!};
    console.log(changed);
    if(changed == 1) {
    Swal.fire({
            title: 'Confirmación',
            text: 'El socio mayoritario, ha realizado cambios en los precios de las lineas',
            type: 'info',
            confirmButtonColor: '#4caf50',
            allowOutsideClick: false,
            confirmButtonText: 'Ir a mis lineas'
      }).then((result) => {
        if (result.value)
        {
          location.href ="/lineas";
        }
      });
    }
});
</script>
@endsection