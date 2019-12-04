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
      <h4 class="example-title">Panel De Reportes de Inventarios</h4>
        <div class="example">
          <div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
                @if(Auth::user()->type_user == 1 )
                <div class="panel">
                  <div class="panel-heading bg-primary  text-center text-white" id="exampleHeadingDefaultTwo" role="tab">
                    <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultTwo" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultTwo">Inventarios por Sucursal</a>
                  </div>
                  <div class="panel-collapse collapse" id="exampleCollapseDefaultTwo" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel" style="">
                    <div class="panel-body">
                        <div class="row">
                          <div class="col-md-4 col-sm-12">
                            <h4>Reporte Por Sucursal</h4>
                          </div>
                        </div>
                    <form action="inventariospdf">
                      <div class=" col-12"> 
                          <div class="panel panel-bordered">
                            <div class="panel-body">
                              <div class="row">
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
                                </div>
                              </div>
                              <div class="input-group col-3 col-6  col-12">
                                  <button id="submit" type="submit" name="button" class="btn btn-primary">Generar reporte</button>
                              </div>
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

      
<!-- Termina formulario de Prueba -->
@endsection
