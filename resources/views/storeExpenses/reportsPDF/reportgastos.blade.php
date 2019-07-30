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
                    <div class="panel">
                      <div class="panel-heading bg-info  text-center text-white" id="exampleHeadingDefaultOne" role="tab">
                        <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultOne" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultOne">
                          Reporte De Productos Por Estatus
                    </a>
                      </div>
                      <div class="panel-collapse collapse" id="exampleCollapseDefaultOne" aria-labelledby="exampleHeadingDefaultOne" role="tabpanel" style="">
                        <div class="panel-body">
                        <form action="/">
                          <div class=" col-12"> 
                              <div class="panel panel-bordered">
                                <div class="panel-body row col-12">
                                  <div class="row col-12">
                                      <div class="col-3">
                                        <label>Seleccione Sucursal</label>
                                          <select id="sucursales_1"  name="branch_id" alt="1" class="form-control round sucursales">
                                            <option value="*">Seleccione Sucursal</option>
                                          @php  
                                            $branches = $user->shop->branches;
                                          @endphp
                                            @foreach($branches as $branch)
                                          <option value="{{$branch->id}}" required>{{$branch->name}}</option>
                                          @endforeach
                                          </select>
                                      </div>

                                      <div class="col-3">
                                        <label>Seleccione Estatus</label>
                                          <select id=""  name="branch_id" alt="1" class="form-control round sucursales">
                                            <option value="">Selecciona Estatus</option>
                                            <option value="*">Tod@s</option>
                                            @foreach($status as $onestatus)
                                          <option value="{{$onestatus->id}}" required>{{$onestatus->name}}</option>
                                          @endforeach
                                          </select>
                                      </div>
                                      <div class="col-3">
                                        <label>Seleccione Categoria</label>
                                          <select id=""  name="id" alt="1" class="form-control round sucursales">
                                            <option value="">Selecciona Estatus</option>
                                            <option value="*">Tod@s</option>
                                            @foreach($categories as $categories)
                                          <option value="{{$categories->id}}" required>{{$categories->name}}</option>
                                          @endforeach
                                          </select>
                                      </div>
                                      <div class="col-3">
                                        <label>Seleccione Linea</label>
                                          <select id=""  name="id" alt="1" class="form-control round sucursales">
                                            <option value="">Selecciona Linea</option>
                                            <option value="*">Tod@s</option>
                                            @foreach($line as $linea)
                                          <option value="{{$linea->id}}" required>{{$linea->name}}</option>
                                          @endforeach
                                          </select>
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
                    <div class="panel">
                      <div class="panel-heading bg-success  text-center text-white" id="exampleHeadingDefaultThree" role="tab">
                        <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultThree" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultThree">
                      Reporte de Entradas De Productos
                    </a>
                      </div>
                      <div class="panel-collapse" id="exampleCollapseDefaultThree" aria-labelledby="exampleHeadingDefaultThree" role="tabpanel">
                        <div class="panel-body">
                        <form action="/">
                          <div class=" col-12"> 
                              <div class="panel panel-bordered">
                                <div class="panel-body row col-12">
                                  <div class="row col-12">
                                      <div class="col-3">
                                        <label>Seleccione Sucursal</label>
                                          <select id="sucursales_1"  name="branch_id" alt="1" class="form-control round sucursales">
                                            <option value="*">Seleccione Sucursal</option>
                                          @php  
                                            $branches = $user->shop->branches;
                                          @endphp
                                            @foreach($branches as $branch)
                                          <option value="{{$branch->id}}" required>{{$branch->name}}</option>
                                          @endforeach
                                          </select>
                                      </div>
                                      <div class="col-3">
                                        <label>Seleccione Linea</label>
                                          <select id=""  name="id" alt="1" class="form-control round sucursales">
                                            <option value="">Selecciona Linea</option>
                                           @php  
                                            $lines= $user->shop->lines;
                                          @endphp
                                            <option value="*">Tod@s</option>
                                          @foreach($lines as $line)
                                          <option value="{{$line->id}}" required>{{$line->name}}</option>
                                        @endforeach
                                          </select>
                                      </div>
                                      <div class="input-group col-3">
                                       <div class="row container"><label>De la Fecha:</label></div>
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">
                                            <i class="icon md-calendar" aria-hidden="true"></i>
                                          </span>
                                        </div>
                                        <input name="fecini" type="text" class="form-control round fecini" data-plugin="datepicker">
                                      </div>
                                    <div class="input-group col-3">
                                        <div class="row container"><label>Hasta la Fecha:</label></div>
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">
                                            <i class="icon md-calendar" aria-hidden="true"></i>
                                          </span>
                                        </div>
                                        <input name="fecter" type="text"   class="form-control round" data-plugin="datepicker" data-multidate="true">
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
      </div>
    </div>        
<!-- Termina formulario de Prueba -->
@endsection