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
    <div class="examle-wrap">
      <h4 class="example-title">Panel De Reportes de Productos</h4>
      <div class="example">
        <div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
          @if(Auth::user()->type_user == 1 )
          <div class="panel">
            <div class="panel-heading bg-info  text-center text-white" id="exampleHeadingDefaulttwo" role="tab">
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
                      <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab"
                          href="#producstatusOne" aria-controls="producstatusOne" role="tab">Productos Gr</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab"
                          href="#producstatusTwo" aria-controls="producstatusTwo" role="tab">Productos Pz</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab"
                          href="#exampleTabsThree" aria-controls="exampleTabsThree" role="tab">Productos GGr</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab"
                          href="#exampleTabsFour" aria-controls="exampleTabsFour" role="tab">Productos GPz</a></li>
                    </ul>
                    <div class="tab-content pt-20">
                      <div class="tab-pane active" id="producstatusOne" role="tabpanel">
                        <div class="row">
                          <div class="col-md-4 col-sm-12">
                            <h4>Reporte Productos Status Por Gramos </h4>
                          </div>
                        </div>
                        <form action="estatusproducto">
                          <div class="panel panel-bordered">
                            <div class="panel-body">
                              <div class="row">
                                <div class="col-12 col-sm-6">
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
                                  <label>Seleccione Estatus</label>
                                  <select id="" name="estatus_id" alt="1" class="form-control round sucursales">
                                    <!-- <option value="">Selecciona Estatus</option>
                                          <option value="*" name="todos">Tod@s</option> -->
                                    @foreach($statuses as $onestatus)
                                    <option value="{{$onestatus->id}}" required>{{$onestatus->name}}</option>  
                                    @endforeach
                                  </select>
                                  <label>Seleccione Categoria</label>
                                  <select id="" name="category_id" alt="1" class="form-control round sucursales">
                                    @foreach($categories as $categories)
                                    @if($categories->type_product == 2 )
                                    <option value="{{$categories->id}}" required>{{$categories->name}}</option>
                                    @endif
                                    @endforeach
                                  </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                  <label>Seleccione Linea</label>
                                  <select id="" name="id" alt="1" class="form-control round sucursales">
                                    @foreach($line as $linea)
                                    <option value="{{$linea->id}}" required>{{$linea->name}}</option>
                                    @endforeach
                                  </select>
                                  <div class="input-group">
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
                                  <div class="input-group">
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
                            </div>
                          </div>
                          <div class="input-group col-3 col-6 col-12">
                            <button id="submit" type="submit" name="button" class="btn btn-primary">Generar
                              reporte</button>
                          </div>
                      </div>
                      </form>
                    </div>
                    <!-- Inicia TAB2 STATUS PRODUCT-->
                    <div class="tab-pane" id="producstatusTwo" role="tabpanel">
                      <form action="estatusproducto">
                        <div class="panel panel-bordered">
                          <div class="row">
                            <div class="col-md-4 col-sm-12">
                              <h4>Reporte Productos Status Por Pieza </h4>
                            </div>
                          </div>
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-12 col-sm-6">
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
                                <label>Seleccione Estatus</label>
                                <select id="" name="estatus_id" alt="1" class="form-control round sucursales">
                                  <!-- <option value="">Selecciona Estatus</option>
                                                <option value="*" name="todos">Tod@s</option> -->
                                  @foreach($statuses as $onestatus)
                                  <option value="{{$onestatus->id}}" required>{{$onestatus->name}}</option>
                                  @endforeach
                                </select>
                                <label>Seleccione Categoria</label>
                                @php
                                $categories = $user->shop->categories;
                                @endphp
                                <select id="" name="category_id" alt="1" class="form-control round sucursales">
                                  @foreach($categories as $categories)
                                  @if($categories->type_product == 1 )
                                  <option value="{{$categories->id}}" required>{{$categories->name}}</option>
                                  @endif
                                  @endforeach
                                </select>
                              </div>
                              <div class="col-12 col-sm-6">
                                <div class="input-group">
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
                                <div class="input-group">
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
                          </div>
                          <div class="input-group col-3 col-6 col-12">
                            <button id="submit" type="submit" name="button" class="btn btn-primary">Generar
                              reporte</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- Termina tab 2 de product status-->
                    <div class="tab-pane" id="exampleTabsThree" role="tabpanel">
                      <div class="row">
                        <div class="col-md-4 col-sm-12">
                          <h4>Reporte General Status Por Gramos </h4>
                        </div>
                      </div>
                      <form action="reportEstatusG">
                        <div class="panel panel-bordered">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-12 col-sm-6">
                                <div class="input-group">
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
                              <div class="col-12 col-sm-6">

                                <div class="input-group">
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
                            <input type="int" name="cat" class="form-control invisible round" data-plugin="datepicker"
                              value="2" required>
                          </div>
                          <div class="input-group col-3 col-6 col-12">
                            <button id="submit" type="submit" name="button" class="btn btn-primary">Generar
                              reporte</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="tab-pane" id="exampleTabsFour" role="tabpanel">
                      <div class="row">
                        <div class="col-md-4 col-sm-12">
                          <h4>Reporte General Status Por Pieza </h4>
                        </div>
                      </div>
                      <form action="reportEstatusG">
                        <div class="panel panel-bordered">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-12 col-sm-6">
                                <div class="input-group">
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
                              <div class="col-12 col-sm-6">
                                <div class="input-group">
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
              </div>
              <!-- End Example Tabs -->
            </div>
          </div>
          @endif
          @if(Auth::user()->type_user == 1 )
          <div class="panel">
            <div class="panel-heading bg-primary  text-center text-white" id="exampleHeadingDefaultTwo" role="tab">
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
                      <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab"
                          href="#exampleTabsOne" aria-controls="exampleTabsOne" role="tab">Productos Gr</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab"
                          href="#exampleTabsTwo" aria-controls="exampleTabsTwo" role="tab">Productos GPGR</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab"
                          href="#exampleTabsThree" aria-controls="exampleTabsThree" role="tab">Productos Pz</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab"
                          href="#exampleTabsFour" aria-controls="exampleTabsFour" role="tab">Productos GPPZ</a></li>
                    </ul>
                    <div class="tab-content pt-20">
                      <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                        <div class="row">
                          <div class="col-md-4 col-sm-12">
                            <h4>Reporte Productos por Linea </h4>
                          </div>
                        </div>
                        <form action="entradasproducto">
                          <div class="panel panel-bordered">
                            <div class="panel-body">
                              <div class="row">
                                <div class="col-12 col-sm-6">
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
                                    <label>Seleccione Linea</label>
                                    <select id="" name="id" alt="1" class="form-control round sucursales">
                                      <!-- <option value="">Selecciona Linea</option> -->
                                      @php
                                      $lines= $user->shop->lines;
                                      @endphp
                                      <!-- <option value="*">Tod@s</option> -->
                                      @foreach($lines as $line)
                                      <option value="{{$line->id}}" required>{{$line->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="input-group">
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
                                    <div class="input-group">
                                      <div class="row container"><label>Hasta la Fecha:</label></div>
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="icon md-calendar" aria-hidden="true"></i>
                                        </span>
                                      </div>
                                      <input name="fecter" type="text" class="form-control round"
                                        data-plugin="datepicker" required>
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
                      <div class="row">
                        <div class="col-md-4 col-sm-12">
                          <h4>Reporte General productos por</h4>
                        </div>
                      </div>
                      <form action="reportEntradasPrgpgr">
                        <div class="panel panel-bordered">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-12 col-sm-6">
                                <label>Seleccione Sucursal</label>
                                <select id="sucursales_1" name="branch_id" alt="2"
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
                              <div class="col-12 col-sm-6">
                                  <div class="input-group">
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
                                  <div class="input-group">
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
                          </div>
                          <div class="input-group col-3 col-6 col-12">
                            <button id="submit" type="submit" name="button" class="btn btn-primary">Generar
                              reporte</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="tab-pane" id="exampleTabsThree" role="tabpanel">
                      <div class="row">
                        <div class="col-md-4 col-sm-12">
                          <h4>Reporte Entradas Productos Por Pieza</h4>
                        </div>
                      </div>
                      <form action="reportEntradasPpz">
                        <div class="panel panel-bordered">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-12 col-sm-6">
                                  <label>Seleccione Sucursal</label>
                                  <select id="sucursales_1" name="branch_id" alt="3"
                                    class="form-control round sucursales">
                                    <!-- <option value="*">Seleccione Sucursal</option> -->
                                    @php
                                    $branches = $user->shop->branches;
                                    @endphp
                                    @foreach($branches as $branch)
                                    <option value="{{$branch->id}}" required>{{$branch->name}}</option>
                                    @endforeach
                                  </select>
                                  <label>Seleccione Categoria</label>
                                  @php
                                  $categories = $user->shop->categories;
                                  @endphp
                                  <select id="" name="category_id" alt="1" class="form-control round sucursales">
                                    <!-- <option value="">Selecciona Categoria</option>
                                                            <option value="*">Tod@s</option> -->
                                    @foreach($categories as $categories)
                                    @if($categories->type_product == 1 )
                                    <option value="{{$categories->id}}" required>{{$categories->name}}</option>
                                    @endif
                                    @endforeach
                                  </select>
                              </div>
                              <div class="col-12 col-sm-6">
                                  <div class="input-group">
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
                                  <div class="input-group">
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
                          </div>
                          <div class="input-group col-3 col-6 col-12">
                            <button id="submit" type="submit" name="button" class="btn btn-primary">Generar
                              reporte</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="tab-pane" id="exampleTabsFour" role="tabpanel">
                      <div class="row">
                        <div class="col-md-4 col-sm-12">
                          <h4>Reporte Entradas Productos General Por Pieza</h4>
                        </div>
                      </div>
                      <form action="reportEntradasPrgppz">
                        <div class="panel panel-bordered">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col">
                                <label>Seleccione Sucursal</label>
                                <select id="sucursales_1" name="branch_id" alt="2"
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
                              <div class="col-12 col-sm-6">
                                  <div class="input-group">
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
                                  <div class="input-group">
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
          @endif
          <div class="panel">
            <div class="panel-heading bg-success  text-center text-white" id="exampleHeadingDefaultThree" role="tab">
              <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultThree"
                data-parent="#exampleAccordionDefault" aria-expanded="false"
                aria-controls="exampleCollapseDefaultThree">Entradas De Productos</a>
            </div>
            <div class="panel-collapse collapse" id="exampleCollapseDefaultThree"
              aria-labelledby="exampleHeadingDefaultThree" role="tabpanel">
              <div class="panel-body">
                <!-- Example Tabs -->
                <div class="example-wrap">
                  <div class="nav-tabs-horizontal" data-plugin="tabs">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab"
                          href="#exampleTabsOne" aria-controls="exampleTabsOne" role="tab">Productos Gr</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab"
                          href="#exampleTabsTwo" aria-controls="exampleTabsTwo" role="tab">Productos GPGR</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab"
                          href="#exampleTabsThree" aria-controls="exampleTabsThree" role="tab">Productos Pz</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab"
                          href="#exampleTabsFour" aria-controls="exampleTabsFour" role="tab">Productos GPPZ</a></li>
                    </ul>
                    <div class="tab-content pt-20">
                      <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                        <div class="row">
                          <div class="col-md-4 col-sm-12">
                            <h4>Reporte Entradas Productos Por Gramos </h4>
                          </div>
                        </div>
                        <form action="entradasproducto">
                          <div class="panel panel-bordered">
                            <div class="panel-body">
                              <div class="row">
                                <div class="col-12 col-sm-6">
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
                                    <label>Seleccione Linea</label>
                                    <select id="" name="id" alt="1" class="form-control round sucursales">
                                      <!-- <option value="">Selecciona Linea</option> -->
                                      @php
                                      $lines= $user->shop->lines;
                                      @endphp
                                      <!-- <option value="*">Tod@s</option> -->
                                      @foreach($lines as $line)
                                      <option value="{{$line->id}}" required>{{$line->name}}</option>
                                      @endforeach
                                    </select>
                                </div>   
                              <div class="col-12 col-sm-6">
                                  <div class="input-group">
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
                                  <div class="input-group">
                                    <div class="row  container"><label>Hasta la Fecha:</label></div>
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
                      <div class="row">
                        <div class="col-md-4 col-sm-12">
                          <h4>Reporte General Productos Por Gramos</h4>
                        </div>
                      </div>
                      <form action="reportEntradasPrgpgr">
                        <div class="panel panel-bordered">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-12 col-sm-6">
                                <label>Seleccione Sucursal</label>
                                <select id="sucursales_1" name="branch_id" alt="2"
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
                              <div class="col-12 col-sm-6">
                                  <div class="input-group">
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
                                  <div class="input-group">
                                    <div class="row container"><label>Hasta la Fecha:</label></div>
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                      </span>
                                    </div>
                                    <input name="fecter" type="text" class="form-control round" data-plugin="datepicker"
                                      required>
                                  </div>
                                  
                      </form>
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
            <div class="tab-pane" id="exampleTabsThree" role="tabpanel">
              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <h4>Reporte Entradas Productos Por Pieza</h4>
                </div>
              </div>
              <form action="reportEntradasPpz">
                <div class="panel panel-bordered">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-12 col-sm-6">
                          <label>Seleccione Sucursal</label>
                          <select id="sucursales_1" name="branch_id" alt="3" class="form-control round sucursales">
                            <!-- <option value="*">Seleccione Sucursal</option> -->
                            @php
                            $branches = $user->shop->branches;
                            @endphp
                            @foreach($branches as $branch)
                            <option value="{{$branch->id}}" required>{{$branch->name}}</option>
                            @endforeach
                          </select>
                          <label>Seleccione Categoria</label>
                          @php
                          $categories = $user->shop->categories;
                          @endphp
                          <select id="" name="category_id" alt="1" class="form-control round sucursales">
                            @foreach($categories as $categories)
                            @if($categories->type_product == 1 )
                            <option value="{{$categories->id}}" required>{{$categories->name}}</option>
                            @endif
                            @endforeach
                          </select>
                      </div>
                      <div class="col-12 col-sm-6">
                          <div class="input-group">
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
                          <div class="input-group">
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
                  </div>
                  <div class="input-group col-3 col-6 col-12">
                    <button id="submit" type="submit" name="button" class="btn btn-primary">Generar
                      reporte</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="tab-pane" id="exampleTabsFour" role="tabpanel">

              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <h4>Reporte Entradas Productos General Por Pieza</h4>
                </div>
              </div>
              <form action="reportEntradasPrgppz">
                <div class="panel panel-bordered">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col">
                        <label>Seleccione Sucursal</label>
                        <select id="sucursales_1" name="branch_id" alt="2" class="form-control round sucursales">
                          <!-- <option value="*">Seleccione Sucursal</option> -->
                          @php
                          $branches = $user->shop->branches;
                          @endphp
                          @foreach($branches as $branch)
                          <option value="{{$branch->id}}" required>{{$branch->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      
                      <div class="col-12 col-sm-6">
                          <div class="input-group">
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
                          <div class="input-group">
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
  @if(Auth::user()->type_user == 1 )
  <div class="panel">
    <div class="panel-heading bg-warning  text-center text-white" id="exampleHeadingDefaultFour" role="tab">
      <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultFour"
        data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultFour">Reporte
        de Utilidad</a>
    </div>
    <div class="panel-collapse collapse" id="exampleCollapseDefaultFour" aria-labelledby="exampleHeadingDefaultFour"
      role="tabpanel">
      <div class="panel-body">
        <!-- Example Tabs -->
        <div class="example-wrap">
          <div class="nav-tabs-horizontal" data-plugin="tabs">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab"
                  href="#exampleTabsOne" aria-controls="exampleTabsOne" role="tab">Productos Gr</a></li>
              <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleTabsTwo"
                  aria-controls="exampleTabsTwo" role="tab">Productos Pz</a></li>
            </ul>
            <div class="tab-content pt-20">
              <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                <div class="row">
                  <div class="col-md-4 col-sm-12">
                    <h4>Reporte Utilidad Productos por Gr </h4>
                  </div>
                </div>
                <form action="reportUtility">
                  <div class="panel panel-bordered">
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Seleccione Sucursal</label>
                            <select id="sucursales_1" name="branch_id" alt="1" class="form-control round sucursales">
                              <!-- <option value="*">Seleccione Sucursal</option> -->
                              @php
                              $branches = $user->shop->branches;
                              @endphp
                              @foreach($branches as $branch)
                              <option value="{{$branch->id}}" required>{{$branch->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="input-group">
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
                            <div class="input-group">
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
              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <h4>Reporte Utilidad Productos por Pz</h4>
                </div>
              </div>
              <form action="reportUtility">
                <div class="panel panel-bordered">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-12 col-sm-6">
                        <label>Seleccione Sucursal</label>
                        <select id="sucursales_1" name="branch_id" alt="2" class="form-control round sucursales">
                          <!-- <option value="*">Seleccione Sucursal</option> -->
                          @php
                          $branches = $user->shop->branches;
                          @endphp
                          @foreach($branches as $branch)
                          <option value="{{$branch->id}}" required>{{$branch->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-12 col-sm-6">
                          <div class="input-group">
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
                          <div class="input-group">
                            <div class="row container"><label>Hasta la Fecha:</label></div>
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="icon md-calendar" aria-hidden="true"></i>
                              </span>
                            </div>
                            <input name="fecter" type="text" class="form-control round" data-plugin="datepicker"
                              required>
                          </div>
              </form>
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
</form>
</div>
@endif
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
</div>
</div>
</div>
</div>
<!-- Termina formulario de Prueba -->
@endsection