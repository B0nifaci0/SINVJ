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
<div class="col-sm-12 col-lg-12">
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
      <div class="col-md-12 col-lg-12">
        <div class="panel">
          <div class="panel-heading bg-white  text-center text-white" id="exampleHeadingDefaultTwo" role="tab">
            <div class="row">
              @if(Auth::user()->type_user == 1 )
              <div class="col-md-12 col-lg-12">
                <!-- <button onclick="window.location.href='/tiendas/{{$shop->id}}/edit'"
                        type="button" class="btn btn-lg 
                        toggler-left  btn-primary waves-effect waves-light waves-round float-right"
                        data-toggle="tooltip" data-original-title="Editar Tienda">
                        <i class="icon md-edit" aria-hidden="true" align="right"></i>
                      </button>-->
              </div>
              @endif
              <div class="col-md-12">
                <h2>Sucursal <br> {{$braname->name}}</h2>
                <!-- <img align="left" width="225px" height="160px" src="{{ $shop->image }}">-->
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

      <div class="col-sm-12 col-lg-12">
        <div class="panel-success">
          <div class="panel-heading">
            <h2 class="panel-title" style="color:black">Líneas de Sucursal</h2>
          </div>
          <div>

            <div class="row">
              @foreach($total as $t => $row)
              @if(Auth::user()->type_user == 3 OR Auth::user()->type_user == 2)
              <div class="col-sm-6 col-lg-3">
                <!-- Widget Linearea One-->
                <div class="card card-shadow border-success">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10 card-header">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>{{$row->name_line}}
                      </div><br><br>
                      <span class="grey-700 font-size-16">Gramos: {{$row->totals}} gr
                        <br> <br>
                        <strong class="text-center badge badge-success col-sm-12"> Existente: {{$row->total_exis}}
                          gr</strong>
                        <strong class="text-center badge badge-primary col-sm-12"> Traspasado: {{$row->total_tras}}
                          gr</strong>
                        <strong class="text-center badge badge-warning col-sm-12"> Dañado: {{$row->total_damage}}
                          gr</strong>
                        <strong class="text-center badge badge-danger col-sm-12"> Devuelto: {{$row->total_giveback}}
                          gr</strong>
                      </span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>
                </div>
                <!-- End Widget Linearea One -->
              </div>
              @else
              <div class="col-sm-6 col-lg-3">
                <!-- Widget Linearea One-->
                <div class="card card-shadow border-success">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <center>
                        <div class="grey-800 float-left py-10 card-header col-sm-12">
                          <i
                            class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>{{$row->name_line}}
                        </div>
                      </center><br>
                      <span class="grey-700 font-size-16">Gramos: {{$row->totals}} gr = $
                        {{number_format($row->total_line_p,2)}}
                        <br>Con Descuento: $ {{number_format($row->total_discount,2)}}
                        <br> <br>
                        <strong class="text-center badge badge-success col-sm-12"> Existente: {{$row->total_exis}}
                          gr</strong>
                        <strong class="text-center badge badge-primary col-sm-12"> Traspasado: {{$row->total_tras}}
                          gr</strong>
                        <strong class="text-center badge badge-warning col-sm-12"> Dañado: {{$row->total_damage}}
                          gr</strong>
                        <strong class="text-center badge badge-danger col-sm-12"> Devuelto: {{$row->total_giveback}}
                          gr</strong>
                      </span>
                    </div><br>
                    <div class="row">
                      <div class="mb-20 grey-500 col-sm-6">
                        <i class="icon md-long-arrow-down red-500 font-size-10"></i> - {{$row->descuento}} % De
                        Descuento
                      </div>
                      <div class="mb-20 grey-500 col-sm-6">
                        <i class="icon md-long-arrow-up green-500 font-size-10"></i> Precio De Linea: $
                        {{$row->precio_linea}}
                      </div>
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
              <div class="col-sm-6 col-lg-3">
                <!-- Widget Linearea One-->
                <div class="card card-shadow border-success">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10 card-header">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Gramos Totales
                        Existentes
                      </div><br>
                      <span class="float-right grey-700 font-size-16">Gramos Totales: @if($t->total_we) {{$t->total_we}}
                        gr @else 0 gr @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>
                </div>
                <!-- End Widget Linearea One -->
              </div>
              @endforeach

              @foreach($total_t as $t)
              <div class="col-sm-6 col-lg-3">
                <!-- Widget Linearea One-->
                <div class="card card-shadow border-success">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10 card-header">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Gramos Totales
                        Traspasados
                      </div><br>
                      <span class="float-right grey-700 font-size-16">Gramos Totales: @if($t->total_wt) {{$t->total_wt}}
                        gr @else 0 gr @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>
                </div>
                <!-- End Widget Linearea One -->
              </div>
              @endforeach

              @foreach($total_d as $t)
              <div class="col-sm-6 col-lg-3">
                <!-- Widget Linearea One-->
                <div class="card card-shadow border-success">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10 card-header">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Gramos Totales
                        Dañados
                      </div><br>
                      <span class="float-right grey-700 font-size-16">Gramos Totales: @if($t->total_wd) {{$t->total_wd}}
                        gr @else 0 gr @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>
                </div>
                <!-- End Widget Linearea One -->
              </div>
              @endforeach

              <div class="col-sm-6 col-lg-3">
                <!-- Widget Linearea One-->
                <div class="card card-shadow border-success">
                  <div class="card-block p-20 pt-10">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10 card-header">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Gramos Totales
                        Devueltos
                      </div><br>
                      <span class="float-right grey-700 font-size-16">Gramos Totales: @if($total_devueltos)
                        {{$total_devueltos}} gr @else 0 gr @endif</span>
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

      <div class="col-sm-12 col-lg-12">
        <div class="panel-success">
          <div class="panel-heading">
            <h2 class="panel-title" style="color:black">Categorías de Sucursal</h2>
          </div>
          <div>

            <div class="row">

              @foreach($category as $k => $c)

              <div class="col-sm-6 col-lg-3">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10 card-body text-dark">
                    <div class="clearfix">
                      <center>
                        <div class="grey-800 float-left py-10 card-header col-sm-12">
                          <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>{{$c->cat_name}}
                        </div>
                      </center><br>
                      <span class="grey-700 font-size-16">@if(Auth::user()->type_user == 1) Venta: $ {{$c->total}}
                        @endif
                        <br>Piezas: {{$c->totals}} pzs
                        <br> <br>
                        <strong class="text-center badge badge-success col-sm-12"> Existente: {{$c->total_exis}} pzs
                        </strong>
                        <strong class="text-center badge badge-primary col-sm-12"> Traspasado: {{$c->total_tras}} pzs
                        </strong>
                        <strong class="text-center badge badge-warning col-sm-12"> Dañado: {{$c->total_damage}} pzs
                        </strong>
                        <strong class="text-center badge badge-danger col-sm-12"> Devuelto: {{$c->total_giveback}} pzs
                        </strong>
                      </span>
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
              <div class="col-sm-6 col-lg-3">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10 card-body text-dark">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10 card-header">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total De Piezas
                        Existentes
                      </div><br>
                      <span class="float-right grey-700 font-size-16 card-text">Piezas Totales: @if($c->num_pzex)
                        {{$c->num_pzex}} pzs @else 0 pzs @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>
                </div>
                <!-- End Widget Linearea One -->
              </div>
              @endforeach

              @foreach($cat_t as $c)
              <div class="col-sm-6 col-lg-3">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10 card-body text-dark">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10 card-header">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total De Piezas
                        Traspasadas
                      </div><br>
                      <span class="float-right grey-700 font-size-16 card-text">Piezas Totales: @if($c->num_pzt)
                        {{$c->num_pzt}} pzs @else 0 pzs @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>
                </div>
                <!-- End Widget Linearea One -->
              </div>
              @endforeach

              @foreach($cat_d as $c)
              <div class="col-sm-6 col-lg-3">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10 card-body text-dark">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10 card-header">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total De Piezas
                        Dañadas
                      </div><br>
                      <span class="float-right grey-700 font-size-16 card-text">Piezas Totales: @if($c->num_pzd)
                        {{$c->num_pzd}} pzs @else 0 pzs @endif</span>
                    </div>
                    <!--  <div class="ct-chart h-50"></div>   -->
                  </div>
                </div>
                <!-- End Widget Linearea One -->
              </div>
              @endforeach

              <div class="col-sm-6 col-lg-3">
                <!-- Widget Linearea One-->
                <div class="card card-shadow">
                  <div class="card-block p-20 pt-10 card-body text-dark">
                    <div class="clearfix">
                      <div class="grey-800 float-left py-10 card-header">
                        <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>Total De Piezas
                        Devueltas
                      </div><br>
                      <span class="float-right grey-700 font-size-16 card-text">Piezas Totales: @if($cat_devueltos)
                        {{$cat_devueltos}} pzs @else 0 pzs @endif</span>
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

@endsection