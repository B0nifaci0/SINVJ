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
      <div class="container" style="background-color:white"><br>
      <div class="row">
      <div class="col-12">
      <div class="panel-warning">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:white">Informacion De Productos Por Gramos De Todas Las Sucursales</h2>
      </div><br>
</div>
</div>
      <div class="col-6">
      <div class="panel-primary">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:white">Total De Dinero en Productos Por Gramos De Todas Las Sucursales</h2>
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
      <div class="panel-primary">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:white">Total De Productos Por Gramo</h2>
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
              <span class="float-right grey-700 font-size-30">@if($ventas) $ {{number_format($ventas,2)}} @else $ 0 @endif</span>
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
      <div class="panel-primary">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:white">Total De Gramos Existentes</h2>
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
              <span class="float-right grey-700 font-size-30">@if($gramos_existentes) {{$gramos_existentes}} gr @else 0 gr @endif</span>
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
      <div class="panel-primary">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:white">Total De Dinero en Productos Existentes</h2>
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
              <span class="float-right grey-700 font-size-30">@if($ventas_e) $ {{number_format($ventas_e,2)}} @else $ 0 @endif</span>
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
      <div class="panel-primary">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:white">Total De Gramos Traspasados</h2>
      </div>
      <div class="row">
      <div class="col-sm">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Gramos Traspasados              </div>
              <span class="float-right grey-700 font-size-30">@if($gramos_traspasado) {{$gramos_traspasado}} gr @else 0 gr @endif</span>            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
          
        </div>
        <!-- End Widget Linearea One -->
        </div>
      </div>
      </div>
      </div>

      <div class="col-6">
      <div class="panel-primary">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:white">Total De Dinero en Productos Traspasados</h2>
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
              <span class="float-right grey-700 font-size-30">@if($ventas_t) $ {{number_format($ventas_t,2)}} @else $ 0 @endif</span>
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
      <div class="panel-primary">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:white">Total De Gramos Dañados</h2>
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
              <span class="float-right grey-700 font-size-30">@if($gramos_dañados) {{$gramos_dañados}} gr @else 0 gr @endif</span>
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
      <div class="panel-primary">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:white">Total De Dinero en Productos Dañados</h2>
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
              <span class="float-right grey-700 font-size-30">@if($ventas_d) $ {{number_format($ventas_d,2)}} @else $ 0 @endif</span>
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
      </div>
      </div>
      </div>

      
      <div class="container" style="background-color:white"><br>
      <div class="row">
      <div class="col-12">
      <div class="bg-primary">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:white">Informacion De Productos Por Piezas De Todas Las Sucursales</h2>
      </div><br>
</div>
</div>
      <div class="col-6">
      <div class="panel-warning">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:white">Total De Productos Por Piezas De Todas Las Sucursales</h2>
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
              <span class="float-right grey-700 font-size-30">@if($piezas) {{$piezas}} pzs @else 0 pzs @endif </span>
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
        <h2 class="panel-title" style="color:white">Total De Dinero En Piezas</h2>
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

      <div class="col-6">
      <div class="panel-warning">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:white">Total De Piezas Existentes</h2>
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
              <span class="float-right grey-700 font-size-30">@if($piezas_e) {{$piezas_e}} pzs @else 0 pzs @endif</span>
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
        <h2 class="panel-title" style="color:white">Total De Dinero En Piezas Existentes</h2>
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
              <span class="float-right grey-700 font-size-30">@if($pieza_vente) $ {{number_format($pieza_vente,2)}} @else $ 0 @endif</span>
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
        <h2 class="panel-title" style="color:white">Total De Piezas Traspasadas</h2>
      </div>
      <div class="row">
      <div class="col-sm">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Piezas Traspasadas              </div>
                <span class="float-right grey-700 font-size-30">@if($piezas_t) {{$piezas_t}} gr @else 0 pzs @endif</span>          </div>
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
        <h2 class="panel-title" style="color:white">Total De Dinero En Piezas Traspasadas</h2>
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
              <span class="float-right grey-700 font-size-30">@if($pieza_ventt) $ {{number_format($pieza_ventt,2)}} @else $ 0 @endif</span>
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
        <h2 class="panel-title" style="color:white">Total De Piezas Dañadas</h2>
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
              <span class="float-right grey-700 font-size-30">@if($piezas_d) {{$piezas_d}} pzs @else 0 pzs @endif</span>
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
        <h2 class="panel-title" style="color:white">Total De Dinero En Piezas Dañadas</h2>
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
              <span class="float-right grey-700 font-size-30">@if($pieza_ventd) $ {{number_format($pieza_ventd,2)}} @else $ 0 @endif</span>
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
