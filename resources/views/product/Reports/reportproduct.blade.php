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
                      <div class="panel-heading bg-info  text-center text-white" id="exampleHeadingDefaultOne" role="tab">
                        <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultOne" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultOne">
                          Reporte De Productos Por Estatus
                    </a>
                      </div>
                      <div class="panel-collapse collapse" id="exampleCollapseDefaultOne" aria-labelledby="exampleHeadingDefaultOne" role="tabpanel" style="">
                        <div class="panel-body">
                            <div align="right">
                                <a href="/reportEstatusG"<button type="button" 
                                  class="btn btn-icon btn-danger waves-effect waves-light waves-round"
                                  data-toggle="tooltip" data-original-title="Reporte General">
                                  <i class="icon fa-file-pdf-o" aria-hidden="true"></i></button>
                                </a>
                            </div>
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
                              @endif
                        <form action="estatusproducto">
                          <div class=" col-12"> 
                              <div class="panel panel-bordered">
                                <div class="panel-body row col-12">
                                  <div class="row col-12">
                                      <div class="col-3">
                                        <label>Seleccione Sucursal</label>
                                          <select id="sucursales_1"  name="branch_id" alt="1" class="form-control round sucursales">
                                            <!-- <option value="*">Seleccione Sucursal</option> -->
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
                                          <select id=""  name="estatus_id" alt="1" class="form-control round sucursales">
                                            <!-- <option value="">Selecciona Estatus</option>
                                            <option value="*" name="todos">Tod@s</option> -->
                                            @foreach($status as $onestatus)
                                          <option value="{{$onestatus->id}}" required>{{$onestatus->name}}</option>
                                          @endforeach
                                          </select>
                                      </div>
                                      <div class="col-3">
                                        <label>Seleccione Categoria</label>
                                          <select id=""  name="category_id" alt="1" class="form-control round sucursales">
                                            <!-- <option value="">Selecciona Categoria</option>
                                            <option value="*">Tod@s</option> -->
                                            @foreach($categories as $categories)
                                          <option value="{{$categories->id}}" required>{{$categories->name}}</option>
                                          @endforeach
                                          </select>
                                      </div>
                                      <div class="col-3">
                                        <label>Seleccione Linea</label>
                                          <select id=""  name="id" alt="1" class="form-control round sucursales">
                                            <!-- <option value="">Selecciona Linea</option>
                                            <option value="*">Tod@s</option> -->
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
                    @endif
                    @if(Auth::user()->type_user == 1 )
                    <div class="panel">
                      <div class="panel-heading bg-primary  text-center text-white" id="exampleHeadingDefaultTwo" role="tab">
                        <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultTwo" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultTwo">
                      Reporte de Gramos y $ por Linea
                    </a>
                      </div>
                      <div class="panel-collapse collapse" id="exampleCollapseDefaultTwo" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel" style="">
                        <div class="panel-body">
                            <div align="right">
                                <a href="/gramoslineageneral"><button type="button" 
                                  class="btn btn-icon btn-danger waves-effect waves-light waves-round"
                                  data-toggle="tooltip" data-original-title="Reporte General">
                                  <i class="icon fa-file-pdf-o" aria-hidden="true"></i></button>
                                </a>
                            </div>
                        <form action="gramoslinea">
                          <div class=" col-12"> 
                              <div class="panel panel-bordered">
                                <div class="panel-body row col-12">
                                  <div class="row col-12">
                                      <div class="col-6">
                                        <label>Seleccione Sucursal</label>
                                          <select id="sucursales_1"  name="branch_id" alt="1" class="form-control round sucursales">
                                          <!--  <option value="*">Seleccione Sucursal</option> -->
                                          @php  
                                            $branches = $user->shop->branches;
                                          @endphp
                                            @foreach($branches as $branch)
                                          <option value="{{$branch->id}}" required>{{$branch->name}}</option>
                                          @endforeach
                                          </select>
                                      </div>
                                      <div class="col-6">
                                        <label>Seleccione Linea</label>
                                          <select id=""  name="id" alt="1" class="form-control round sucursales">
                                            <!-- <option value="">Selecciona Linea</option>
                                            <option value="*">Tod@s</option> -->
                                          @foreach($line as $line)
                                          <option value="{{$line->id}}" required>{{$line->name}}</option>
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
                    @endif
                    <div class="panel">
                      <div class="panel-heading bg-success  text-center text-white" id="exampleHeadingDefaultThree" role="tab"> 
                        <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultThree" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultThree">
                      Reporte de Entradas De Productos
                        </a>
                      </div>
                            <div class="panel-collapse collapse" id="exampleCollapseDefaultThree" aria-labelledby="exampleHeadingDefaultThree" role="tabpanel">
                              <div class="panel-body">
                                   @if(Auth::user()->type_user == 1 )
                                  <div align="right">
                                      <a href="/reportEntradasGpgr"><button type="button" 
                                        class="btn btn-icon btn-danger waves-effect waves-light waves-round"
                                        data-toggle="tooltip" data-original-title="Reporte General Productos Por Linea">
                                        <i class="icon fa-file-pdf-o" aria-hidden="true"></i></button>
                                      </a>
                                      <a href="/reportEntradasPpz"><button type="button" 
                                        class="btn btn-icon btn-danger waves-effect waves-light waves-round"
                                        data-toggle="tooltip" data-original-title="Reporte General Productos Por Categoria">
                                        <i class="icon fa-file-pdf-o" aria-hidden="true"></i></button>
                                      </a>
                                  </div>
                                  @endif
                                <div class=" col-12"> 
                                <!-- Example Tabs -->
                                <div class="example-wrap">
                                  <div class="nav-tabs-horizontal" data-plugin="tabs">
                                    <ul class="nav nav-tabs" role="tablist">
                                      <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#exampleTabsOne"
                                          aria-controls="exampleTabsOne" role="tab">Productos Gr</a></li>
                                      <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleTabsTwo"
                                          aria-controls="exampleTabsTwo" role="tab">Productos Pz</a></li>
                                    </ul>
                                    <div class="tab-content pt-20">
                                      <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                                            <form action="entradasproducto">
                                              <div class="panel panel-bordered">
                                                  <div class="panel-body row col-12">
                                                    <div class="row col-12">
                                                      <div class="col-3">
                                                      <label>Seleccione Sucursal</label>
                                                        <select id="sucursales_1"  name="branch_id" alt="1" class="form-control round sucursales">
                                                          <!-- <option value="*">Seleccione Sucursal</option> -->
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
                                                <div class="input-group col-3">
                                                    <div class="row container"><label>De la Fecha:</label></div>
                                                      <div class="input-group">
                                                        <div class="input-group-prepend">
                                                          <span class="input-group-text">
                                                            <i class="icon md-calendar" aria-hidden="true"></i>
                                                          </span>
                                                        </div>
                                                        <input name="fecini" type="text" class="form-control fecini round" data-plugin="datepicker" required>
                                                      </div>
                                                    </div>
                                                <div class="input-group col-3">
                                                    <div class="row container"><label>Hasta la Fecha:</label></div>
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                                      </span>
                                                    </div>
                                                    <input name="fecter" type="text"   class="form-control round" data-plugin="datepicker" required>
                                                  </div>
                                              </div>
                                            </div>
                                            <div class="input-group col-3">
                                                <button id="submit" type="submit" name="button" class="btn btn-primary">Generar reporte</button>
                                            </div>
                                         </div>
                                        </form>
                                    </div>
                                  <div class="tab-pane" id="exampleTabsTwo" role="tabpanel">
                                    <form action="entradasproducto">
                                              <div class="panel panel-bordered">
                                                  <div class="panel-body row col-12">
                                                    <div class="row col-12">
                                                      <div class="col-3">
                                                      <label>Seleccione Sucursal</label>
                                                        <select id="sucursales_1"  name="branch_id" alt="1" class="form-control round sucursales">
                                                          <!-- <option value="*">Seleccione Sucursal</option> -->
                                                        @php  
                                                          $branches = $user->shop->branches;
                                                        @endphp
                                                          @foreach($branches as $branch)
                                                        <option value="{{$branch->id}}" required>{{$branch->name}}</option>
                                                        @endforeach
                                                        </select>
                                                         </div>
                                                      <div class="col-3">
                                                          <label>Seleccione Categoria</label>
                                                          @php  
                                                            $categories = $user->shop->categories;
                                                          @endphp
                                                          <select id=""  name="category_id" alt="1" class="form-control round sucursales">
                                                            <!-- <option value="">Selecciona Categoria</option>
                                                            <option value="*">Tod@s</option> -->
                                                            @foreach($categories as $categories)
                                                            @if($categories->type_product == 1 )
                                                          <option value="{{$categories->id}}" required>{{$categories->name}}</option>
                                                          @endif
                                                          @endforeach
                                                          </select>
                                                      </div>
                                                <div class="input-group col-3">
                                                    <div class="row container"><label>De la Fecha:</label></div>
                                                      <div class="input-group">
                                                        <div class="input-group-prepend">
                                                          <span class="input-group-text">
                                                            <i class="icon md-calendar" aria-hidden="true"></i>
                                                          </span>
                                                        </div>
                                                        <input name="fecini" type="text" class="form-control fecini round" data-plugin="datepicker" required>
                                                      </div>
                                                    </div>
                                                <div class="input-group col-3">
                                                    <div class="row container"><label>Hasta la Fecha:</label></div>
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                                      </span>
                                                    </div>
                                                    <input name="fecter" type="text"   class="form-control round" data-plugin="datepicker" required>
                                                  </div>
                                              </div>
                                            </div>
                                            <div class="input-group col-3">
                                                <button id="submit" type="submit" name="button" class="btn btn-primary">Generar reporte</button>
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
            </div>   
        </div>
        @if(Auth::user()->type_user == 1 )
              <div class="panel">
                      <div class="panel-heading bg-warning  text-center text-white" id="exampleHeadingDefaultFour" role="tab">
                        <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultFour" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultFour">
                      Reporte de Productos PZ Con Descuento
                    </a>
                      </div>
                      <div class="panel-collapse collapse" id="exampleCollapseDefaultFour" aria-labelledby="exampleHeadingDefaultFour" role="tabpanel" style="">
                        <div class="panel-body">
                            <div align="right">
                                <a href="/"<button type="button" 
                                  class="btn btn-icon btn-danger waves-effect waves-light waves-round"
                                  data-toggle="tooltip" data-original-title="Reporte General">
                                  <i class="icon fa-file-pdf-o" aria-hidden="true"></i></button>
                                </a>
                            </div>
                          <div class=" col-12"> 
                            <form action="/reportProductspzs">
                              <div class="panel panel-bordered">
                                <div class="panel-body row col-12">
                                  <div class="row col-12">
                                      <div class="col-3">
                                        <label>Seleccione Sucursal</label>
                                          <select id="sucursales_1"  name="branch_id" alt="1" class="form-control round sucursales">
                                          @php  
                                            $branches = $user->shop->branches;
                                          @endphp
                                            @foreach($branches as $branch)
                                          <option value="{{$branch->id}}" required>{{$branch->name}}</option>
                                          @endforeach
                                          </select>
                                      </div>
                                      <div class="col-3">
                                        <label>Seleccione Categoria</label>
                                          @php  
                                            $categories = $user->shop->categories;
                                          @endphp
                                          <select id=""  name="category_id" alt="1" class="form-control round sucursales">
                                            <!-- <option value="">Selecciona Categoria</option>
                                            <option value="*">Tod@s</option> -->
                                            @foreach($categories as $categories)
                                            @if($categories->type_product == 1 )
                                          <option value="{{$categories->id}}" required>{{$categories->name}}</option>
                                          @endif
                                          @endforeach
                                          </select>
                                      </div>
                                    <div class="input-group col-3">
                                          <div class="row container"><label>De la Fecha:</label></div>
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                  <i class="icon md-calendar" aria-hidden="true"></i>
                                                </span>
                                              </div>
                                              <input name="fecini" type="text" class="form-control fecini round" data-plugin="datepicker" required>
                                            </div>
                                          </div>
                                      <div class="input-group col-3">
                                          <div class="row container"><label>Hasta la Fecha:</label></div>
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="icon md-calendar" aria-hidden="true"></i>
                                            </span>
                                          </div>
                                          <input name="fecter" type="text"   class="form-control round" data-plugin="datepicker" required>
                                        </div>
                                    <div class="form-material col-3">
                                      <label class="form-control-label" for="inputBasicFirstName">Descuento: </label>
                                        <input value ="" type="text" name="descuento" id="" class="form-control" required>
                                      </div>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="input-group col-3">
                                      <button id="submit" type="submit" name="button" class="btn btn-primary">Generar reporte</button>
                                  </div>
                              </div>
                            </form>
                            </div>
                        </div>
                      </div>
                      @endif
                    </div>
                </div>
              </div>
          </div>
       </div>
    </div>
</div>
      
<!-- Termina formulario de Prueba -->
@endsection
