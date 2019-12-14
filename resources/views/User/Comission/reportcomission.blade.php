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
      <h4 class="example-title">Panel De Comisiones de Usuarios</h4>
      <div class="example">
        <div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
          @if(Auth::user()->type_user == 1 )
          <div class="panel">  <!-- Producto por Estatus -->
            <div class="panel-heading bg-info  text-center text-white" id="exampleHeadingDefaulttwo" role="tab">
              <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultOne"
                data-parent="#exampleAccordionDefault" aria-expanded="false"
                aria-controls="exampleCollapseDefaultOne">Comisiones Por Sucursal</a>
            </div>
            <div class="panel-collapse collapse" id="exampleCollapseDefaultOne"
              aria-labelledby="exampleHeadingDefaultOne" role="tabpanel" style="">
              <div class="panel-body">
                <!-- Example Tabs -->
                <div class="example-wrap">
                  <div class="nav-tabs-horizontal" data-plugin="tabs">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab"
                          href="#comissionUser" aria-controls="comissionUser" role="tab">Por Colaborador</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab"
                          href="#comissionBranch" aria-controls="comissionBranch" role="tab">Por Sucursal</a></li>
                    </ul>
                    <div class="tab-content pt-20">
                      <div class="tab-pane active" id="comissionUser" role="tabpanel">
                        <div class="row">
                          <div class="col-md-4 col-sm-12">
                            <h4>Reporte Comisiones De Usuarios Por Sucursal </h4>
                          </div>
                        </div>
                        <form action="comisionusuario">
                          <div class="panel panel-bordered">
                            <div class="panel-body">
                              <div class="row">
                              <div class="col-6">
                                <label class="floating-label" for="inputBranch">{{ __('Sucursal') }}</label>
                                <select id="branches" class="form-control  sucursales1" name="sucursal" alt="1" >
                                  <option value="*">Seleccione Sucursal</option>
                                  @foreach($branches as $b)
                                 <option value="{{ $b->id }}">{{$b->name}}</option>
                                 @endforeach
                                </select>
                              </div>

                              <div class="col-6">
                                <label class="floating-label" for="inputUser">{{ __('Usuario') }}</label>
                                <select id="usuario_1" name="user" class="form-control ">

                               </select>
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
                    <div class="tab-pane" id="comissionBranch" role="tabpanel">
                        <div class="row">
                          <div class="col-md-4 col-sm-12">
                            <h4>Reporte Comisiones General De Usuarios Por Sucursal </h4>
                          </div>
                        </div>
                        <form action="comisionsucursal">
                          <div class="panel panel-bordered">
                            <div class="panel-body">
                              <div class="row">
                              <div class="col-6">
                                <label class="floating-label" for="inputBranch">{{ __('Sucursal') }}</label>
                                <select id="branches" class="form-control  sucursales1" name="sucursal" alt="1" >
                                  <option value="*">Seleccione Sucursal</option>
                                  @foreach($branches as $b)
                                 <option value="{{ $b->id }}">{{$b->name}}</option>
                                 @endforeach
                                </select>
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

@section('branch-user')
<script type="text/javascript">

var products = {!! $branches !!};
console.log("PPPP", products)


$(".sucursales").change(function(){
  var selector =  $(this).attr("alt");
  var id_sucursal = $(this).val();
  var url = '/sucursales/' + id_sucursal + '/usuarios';
  $.get(url, function(json){
    $('#usuarios_' + selector).empty();
        $.each(json,function(i, user){
          $('#usuarios_' + selector).append('<option value = '+ user.id +'>' + user.name +'</option>')
        });
  });
});
$(".usuarios").change(function(){
      var id_user = $(this).val();
      var selector = $(this).attr("alt");
      $("#id_user_" + selector).val(id_user);
    });

$(".sucursales1").change(function(){
  var selector =  $(this).attr("alt");
  var id_sucursal = $(this).val();
  var url = '/sucursales/' + id_sucursal + '/usuarios';
  $.get(url, function(json){
    $('#usuario_' + selector).empty();
        $.each(json,function(i, user){
          $('#usuario_' + selector).append('<option value = '+ user.id +'>' + user.name +'</option>')
        });
  });
}); 

</script>
@endsection
<!-- Termina formulario de Prueba -->
@endsection