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
                  <div class="col-md-6 col-md-offset-2">
                  <div class= "mt-25" ></div>
                      <button  onclick="window.location.href='/tiendas'"
                        type="button" class="btn btn-sm small btn-floating toggler-left  btn-success waves-effect waves-light waves-round float-right"
                        data-toggle="tooltip" data-original-title="Ver Más" align="right">
                        <i class="icon md-eye" aria-hidden="true"></i>
                      </button>
                  </div>
                   @if(Auth::user()->type_user == 1 )
                  <div class="col-md-6 col-md-offset-2">
                  <div class= "mt-25"></div>
                      <button onclick="window.location.href='/tiendas/{{$shop->id}}/edit'"
                        type="button" class="btn btn-sm small btn-floating
                        toggler-left  btn-primary waves-effect waves-light waves-round float-right"
                        data-toggle="tooltip" data-original-title="Editar Tienda">
                        <i class="icon md-edit" aria-hidden="true" align="right"></i>
                      </button>
                  </div>
                  @endif
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

      @if(Auth::user()->type_user == 1 )
      <div class="col-6">
      <div class="panel-warning">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:white">Total De Gramos</h2>
      </div>
      <div class="row">
      <div class="col-sm-12">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Gramos
              </div>
              <span class="float-right grey-700 font-size-30">@if($total) {{$total}} gr @else 0 gr @endif</span>
            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
          
        </div>
        <!-- End Widget Linearea One -->
      </div>

      </div>
      </div>
      </div>

      <div class="col-6">
      <div class="panel-warning">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:white">Total De Productos Por Gramo</h2>
      </div>
      <div class="row">
      
      <div class="col-sm-12">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Dinero
              </div>
              <span class="float-right grey-700 font-size-30">@foreach($ventas as $v) @if($v->total_p) $ {{number_format($v->total_p,2)}} @else $ 0 @endif @endforeach</span>
            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>

      </div>
      </div>
      </div>

      <div class="col-sm-4">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Gramos Existentes
                <br><br><br>
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Productos Existentes
              </div>
              <span class="float-right grey-700 font-size-30">@foreach($gramos_e as $g) @if($g->total_w) {{$g->total_w}} gr @else 0 gr @endif @endforeach</span>
              <br><br><br>
              <span class="float-right grey-700 font-size-30">@foreach($ventas_e as $g) @if($g->total_p) $ {{number_format($g->total_p,2)}} @else $ 0 @endif @endforeach</span>
            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
          
        </div>
        <!-- End Widget Linearea One -->
      </div>

      <div class="col-sm-4">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Gramos Traspasados
                <br><br><br>
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Productos Traspasados
              </div>
              <span class="float-right grey-700 font-size-30">@foreach($gramos_t as $g) @if($g->total_w) {{$g->total_w}} gr @else 0 gr @endif @endforeach</span>
              <br><br><br>
              <span class="float-right grey-700 font-size-30">@foreach($ventas_t as $g) @if($g->total_p) $ {{number_format($g->total_p,2)}} @else $ 0 @endif @endforeach</span>
            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
          
        </div>
        <!-- End Widget Linearea One -->
      </div>

      <div class="col-sm-4">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Gramos Dañados
                <br><br><br>
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Productos Dañados
              </div>
              <span class="float-right grey-700 font-size-30">@foreach($gramos_d as $g) @if($g->total_w) {{$g->total_w}} gr @else 0 gr @endif @endforeach</span>
              <br><br><br>
              <span class="float-right grey-700 font-size-30">@foreach($ventas_d as $g) @if($g->total_p) $ {{number_format($g->total_p,2)}} @else $ 0 @endif @endforeach</span>
            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
          
        </div>
        <!-- End Widget Linearea One -->
      </div>

      </div>

      <div class="row"> 
      
      <div class="col-6">
      <div class="panel-warning">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:white">Total De Piezas</h2>
      </div>
      <div class="row">
      <div class="col-sm-12">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Piezas
              </div>
              <span class="float-right grey-700 font-size-30">@foreach($piezas as $p) @if($p->total_pzs) {{$p->total_pzs}} pzs @else 0 pzs @endif @endforeach</span>
            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
          
        </div>
        <!-- End Widget Linearea One -->
      </div>

      </div>
      </div>
      </div>

      <div class="col-6">
      <div class="panel-warning">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:white">Total De Productos Por Pieza</h2>
      </div>
      <div class="row">
      
      <div class="col-sm-12">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Dinero
              </div>
              <span class="float-right grey-700 font-size-30">@if($pieza_vent) $ {{number_format($pieza_vent,2)}} @else $ 0 @endif</span>
            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>

      </div>
      </div>
      </div>

      <div class="col-sm-4">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Piezas Existentes
                <br><br><br>
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Productos Por Pieza Existentes
              </div>
              <span class="float-right grey-700 font-size-30">@foreach($piezas_e as $p) @if($p->total_pzse) {{$p->total_pzse}} pzs @else 0 pzs @endif @endforeach</span>
              <br><br><br>
              <span class="float-right grey-700 font-size-30">@if($pieza_vente) $ {{number_format($pieza_vente,2)}} @else $ 0 @endif</span>
            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
          
        </div>
        <!-- End Widget Linearea One -->
      </div>

      <div class="col-sm-4">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Piezas Traspasadas
                <br><br><br>
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Productos Por Pieza Traspasados
              </div>
              <span class="float-right grey-700 font-size-30">@foreach($piezas_t as $p) @if($p->total_pzst) {{$p->total_pzst}} gr @else 0 pzs @endif @endforeach</span>
              <br><br><br>
              <span class="float-right grey-700 font-size-30">@if($pieza_ventt) $ {{number_format($pieza_ventt,2)}} @else $ 0 @endif</span>
            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
          
        </div>
        <!-- End Widget Linearea One -->
      </div>

      <div class="col-sm-4">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Piezas Dañadas
                <br><br><br>
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Productos Por Pieza Dañados
              </div>
              <span class="float-right grey-700 font-size-30">@foreach($piezas_d as $p) @if($p->total_pzsd) {{$p->total_pzsd}} pzs @else 0 pzs @endif @endforeach</span>
              <br><br><br>
              <span class="float-right grey-700 font-size-30">@if($pieza_ventd) $ {{number_format($pieza_ventd,2)}} @else $ 0 @endif</span>
            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
          
        </div>
        <!-- End Widget Linearea One -->
      </div>

      </div>
      </div>

      @endif

      @if(Auth::user()->type_user == 3 OR  Auth::user()->type_user == 2)
      <div class="col-6">
      <div class="panel-warning">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:white">Gramos De La Sucursal @foreach($branches_col as $branch) {{$branch->name}} @endforeach</h2>
      </div>
      <div class="row">
      <div class="col-sm-12">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Gramos
                <br><br>
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Gramos Existentes
                <br><br>
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Gramos Traspasados
                <br><br>
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Gramos Dañados
              </div>
              <span class="float-right grey-700 font-size-30">@if($gramos_col) {{$gramos_col}} gr @else 0 gr @endif
              <br>
              @if($gramos_cole) {{$gramos_cole}} gr @else 0 gr @endif
              <br>
              @if($gramos_colt) {{$gramos_colt}} gr @else 0 gr @endif
              <br>
              @if($gramos_cold) {{$gramos_cold}} gr @else 0 gr @endif</span>
            </div>          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>

      </div>
      </div>
      </div>

      <div class="col-6">
      <div class="panel-warning">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:white">Piezas De La Sucursal @foreach($branches_col as $branch) {{$branch->name}} @endforeach</h2>
      </div>
      <div class="row">
      <div class="col-sm-12">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Piezas
                <br><br>
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Piezas Existentes
                <br><br>
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Piezas Traspasados
                <br><br>
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total de Piezas Dañados
              </div>
              <span class="float-right grey-700 font-size-30">@if($piezas_col) {{$piezas_col}} pzs @else 0 pzs @endif
              <br>
              @if($piezas_cole) {{$piezas_cole}} pzs @else 0 pzs @endif
              <br>
              @if($piezas_colt) {{$piezas_colt}} pzs @else 0 pzs @endif
              <br>
              @if($piezas_cold) {{$piezas_cold}} pzs @else 0 pzs @endif</span>
            </div>          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>

      </div>
      </div>
      </div>

      </div>
      </div>

      @endif

      <br>

      <div class="col-12">
      <div class="panel-success">
      <div class="panel-heading">
        

    @if(Auth::user()->type_user == 1 )
    <h2 class="panel-title" style="color:white">Sucursales Disponibles</h2>
        </div>
        <div class="row">
      @foreach($branches as $branch)
      
      <div class="col-sm-3">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>  {{$branch->name}}
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

    @if(Auth::user()->type_user == 3 OR  Auth::user()->type_user == 2)
    <h2 class="panel-title" style="color:white">Sucursal A La Que Pertenece</h2>
        </div>
        <div>
      @foreach($branches_col as $branch)
      <div class="row">
      <div class="col-sm-3">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>  {{$branch->name}}
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
      </div>
      </div>

      </div>
    </div>

@endsection
