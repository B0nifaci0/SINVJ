@extends('layout.layoutdas')
@section('title')
Panel Sucursales
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
                  <div class="col-md-6 col-md-offset-2">
                  <div class= "mt-25"></div>
                      <button onclick="window.location.href='/tiendas/{{$shop->id}}/edit'"
                        type="button" class="btn btn-sm small btn-floating
                        toggler-left  btn-primary waves-effect waves-light waves-round float-right"
                        data-toggle="tooltip" data-original-title="Editar Tienda">
                        <i class="icon md-edit" aria-hidden="true" align="right"></i>
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

      <div class="col-12">
      <div class="panel-success">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:black">Lineas</h2>
        </div>
        <div>

        <div class="row">
      @foreach($total as $t => $row)
      @if(Auth::user()->type_user == 3 OR  Auth::user()->type_user == 2)
      <div class="col-sm-3">
        <!-- Widget Linearea One-->
        <div class="card card-shadow border-success">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10 card-header">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>{{$row->name_line}}
              </div><br>
              <span class="float-right grey-700 font-size-16">Gramos:  {{$row->total_w}} gr </span>
            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      @else
      <div class="col-sm-4">
        <!-- Widget Linearea One-->
        <div class="card card-shadow border-success">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10 card-header">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>{{$row->name_line}}
              </div><br>
              <span class="float-right grey-700 font-size-16">Gramos:  {{$row->total_w}} gr = $ {{number_format($row->total_line_p,2)}}
              <br>Con Descuento: $ {{number_format($row->total_discount,2)}} </span>
            </div>
            <div class="mb-20 grey-500">
              <i class="icon md-long-arrow-down red-500 font-size-16"></i>                 - {{$row->descuento}} % De Descuento
            </div>
            <div class="mb-20 grey-500">
              <i class="icon md-long-arrow-up green-500 font-size-16"></i>               Precio De Linea: $ {{$row->precio_linea}}
            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      @endif
      @endforeach

      
     
      </div>

      <div class="row">

      @foreach($total_e as $t)
      @if($t->total_we)
      <div class="col-sm-4">
        <!-- Widget Linearea One-->
        <div class="card card-shadow border-success">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10 card-header">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Gramos Totales Existentes
              </div><br>
              <span class="float-right grey-700 font-size-16">Gramos Totales: {{$t->total_we}} gr </span>
            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      @endif
      @endforeach

      @foreach($total_t as $t)
      @if($t->total_wt)
      <div class="col-sm-4">
        <!-- Widget Linearea One-->
        <div class="card card-shadow border-success">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10 card-header">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Gramos Totales Traspasados
              </div><br>
              <span class="float-right grey-700 font-size-16">Gramos Totales: {{$t->total_wt}} gr </span>
            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      @endif
      @endforeach

      @foreach($total_d as $t)
      @if($t->total_wd)
      <div class="col-sm-4">
        <!-- Widget Linearea One-->
        <div class="card card-shadow border-success">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10 card-header">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Gramos Totales Dañados
              </div><br>
              <span class="float-right grey-700 font-size-16">Gramos Totales: {{$t->total_wd}} gr </span>
            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      @endif
      @endforeach

      </div>

      </div>
      </div>
      </div>
      
      <div class="col-12">
      <div class="panel-success">
      <div class="panel-heading">
        <h2 class="panel-title" style="color:black">Categorias</h2>
        </div>
        <div>

        <div class="row">

      @foreach($category as $k => $c)
      <div class="col-sm-3">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10 card-body text-dark">
            <div class="clearfix">
              <div class="grey-800 float-left py-10 card-header">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>{{$c->cat_name}}
              </div><br>
              <span class="float-right grey-700 font-size-16 card-text"> @if(Auth::user()->type_user == 1) Venta:  $ {{$c->total}} @endif
              <br>Piezas Totales: {{$c->num_pz}} pzs </span>
            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      @endforeach

      </div>

      <div class="row">

      @foreach($cat_e as $c)
      @if($c->num_pzex)
      <div class="col-sm-4">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10 card-body text-dark">
            <div class="clearfix">
              <div class="grey-800 float-left py-10 card-header">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total De Piezas Existentes
              </div><br>
              <span class="float-right grey-700 font-size-16 card-text"> Piezas Totales: {{$c->num_pzex}} pzs </span>
            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      @endif
      @endforeach

      @foreach($cat_t as $c)
      @if($c->num_pzt)
      <div class="col-sm-4">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10 card-body text-dark">
            <div class="clearfix">
              <div class="grey-800 float-left py-10 card-header">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total De Piezas Traspasadas
              </div><br>
              <span class="float-right grey-700 font-size-16 card-text"> Piezas Totales: {{$c->num_pzt}} pzs </span>
            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      @endif
      @endforeach

      @foreach($cat_d as $c)
      @if($c->num_pzd)
      <div class="col-sm-4">
        <!-- Widget Linearea One-->
        <div class="card card-shadow">
          <div class="card-block p-20 pt-10 card-body text-dark">
            <div class="clearfix">
              <div class="grey-800 float-left py-10 card-header">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total De Piezas Dañadas
              </div><br>
              <span class="float-right grey-700 font-size-16 card-text"> Piezas Totales: {{$c->num_pzd}} pzs </span>
            </div>
          <!--  <div class="ct-chart h-50"></div>   -->
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      @endif
      @endforeach

      </div>

      </div>
       </div>
      </div>
      </div>
      

      </div>
    </div>

@endsection
