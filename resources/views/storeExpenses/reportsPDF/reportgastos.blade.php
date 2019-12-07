 @extends('layout.layoutdas')
@section('title')
Panel Principal
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
    <div class="page">
  <div class="page-content container-fluid">
    <div class="examle-wrap">
      <h4 class="example-title">Panel De Reporte de Gastos</h4>
      <div class="example">
        <div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
          <div class="panel"> <!-- Entrada de productos-->
          <div class="panel-heading bg-success  text-center text-white" id="exampleHeadingDefaultThree" role="tab">
            <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultThree"
              data-parent="#exampleAccordionDefault" aria-expanded="false"
              aria-controls="exampleCollapseDefaultThree">Reporte de Gastos</a>
          </div>
          <div class="panel-collapse collapse" id="exampleCollapseDefaultThree"
            aria-labelledby="exampleHeadingDefaultThree" role="tabpanel">
            <div class="panel-body">
              <!-- Example Tabs -->
              <div class="example-wrap">
                <div class="nav-tabs-horizontal" data-plugin="tabs">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab"
                        href="#exampleTabsOne" aria-controls="exampleTabsOne" role="tab">Gasto Sucursal</a></li>
                        @if (Auth::user()->type_user =='1') 
                    <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab"
                        href="#exampleTabsTwo" aria-controls="exampleTabsTwo" role="tab">Gasto Tienda</a></li>
                        @endif
                  </ul>
                  <div class="tab-content pt-20">
                    <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                      <div class="row">
                        <div class="col-md-4 col-sm-12">
                          <h4>Reporte de Gastos por Sucursal </h4>
                        </div>
                     <!--   @if(Auth::user()->type_user == 1 )
                        <div class="col-md-1 offset-md-7 col-sm-6">
                          <a class="btn btn-icon btn-danger waves-effect waves-light waves-round" data-toggle="tooltip"
                            data-original-title="Reporte General Productos Por Linea" href="/reportEntradasGpgr"><i
                              class="icon fa-file-pdf-o" aria-hidden="true"></i></a>
                        </div>
                        @endif-->
                      </div>
                      <form action="gastosucursal">
                        <div class="panel panel-bordered">
                          <div class="panel-body">
                            <div class="row">
                            @if (Auth::user()->type_user =='1') 
                                <div class="col-sm-6 ">
                                  <label>Seleccione Sucursal</label>
                                  <select id="sucursales_1" name="branch_id" alt="1"
                                    class="form-control round sucursales">
                                    <!-- <option value="*">Seleccione Sucursal</option> -->
                                    @php
                                    $branches = $user->shop->branches;
                                    @endphp
                                    @foreach($branches as $branch)
                                    <option value="{{$branch->id}}" required>{{$branch->name}}</option>
                                    @endforeach
                                  </select>
                                </div> 
                                @endif                           
                                <div class="col-sm-3">
                                  <div class="input-group-3">
                                    <div class="row container"><label>De la Fecha:</label></div>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="icon md-calendar" aria-hidden="true"></i>
                                        </span>
                                      </div>
                                      <input name="fecini" type="text" class="form-control fecini round"
                                        data-plugin="datepicker" required>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-3">
                                  <div class="input-group">
                                    <div class="row container"><label>Hasta la Fecha:</label></div>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                      </span>
                                    </div>
                                    <input name="fecter" type="text" class="form-control round" data-plugin="datepicker"
                                      required>
                                  </div>
                                </div>
                              
                            </div>
                          </div>
                        </div>
                        <div class="input-group col-3 col-6 col-12">
                          <button id="submit" type="submit" name="button" class="btn btn-primary">Generar
                            reporte</button>
                        </div>
                    </div>
                    </form>
                  </div>
                  <div class="tab-pane" id="exampleTabsTwo" role="tabpanel">
                    <form action="gastospdf">
                      <div class="row">
                        <div class="col-md-4 col-sm-12">
                          <h4>Reporte de Gastos Generales por Tienda</h4>
                        </div>
                      </div>
                      <div class="panel panel-bordered">
                        <!--<div class="panel-body ">-->
                          <div class="row">
                            <div class="input-group col-sm-6">
                              <div class="row container"><label>De la Fecha:</label></div>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">
                                    <i class="icon md-calendar" aria-hidden="true"></i>
                                  </span>
                                </div>
                                <input name="fecini" type="text" class="form-control fecini round"
                                  data-plugin="datepicker" required>
                              </div>
                            </div>
                            <div class="input-group col-sm-6">
                              <div class="row container"><label>Hasta la Fecha:</label></div>
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="icon md-calendar" aria-hidden="true"></i>
                                </span>
                              </div>
                              <input name="fecter" type="text" class="form-control round" data-plugin="datepicker"
                                required>
                            </div>
                          </div>
                        </div>
                        <div class="input-group col-3 col-6 col-12">
                          <button id="submit" type="submit" name="button" class="btn btn-primary">Generar
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
@endsection
