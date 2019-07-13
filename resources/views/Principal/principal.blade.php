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
  <div class="page-content container-fluid">
    <div class="row" data-plugin="matchHeight" data-by-row="true">
      <div class="col-xl-3 col-md-6">
        <!-- Widget Linearea One-->
        <div class="card card-shadow" id="widgetLineareaOne">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-map grey-600 font-size-24 vertical-align-bottom mr-5"></i>  14 kl Nacional                  
              </div>
              <span class="float-right grey-700 font-size-30">60 gr</span>
            </div>
            <div class="mb-20 grey-500">
              <i class="icon md-long-arrow-up green-500 font-size-16"></i>                  15% Ventas
            </div>
            <div class="ct-chart h-50"></div>
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      <div class="col-xl-3 col-md-6">
        <!-- Widget Linearea Two -->
        <div class="card card-shadow" id="widgetLineareaTwo">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-pizza grey-600 font-size-24 vertical-align-bottom mr-5"></i>              10 kl Italiano
              </div>
              <span class="float-right grey-700 font-size-30">30 gr</span>
            </div>
            <div class="mb-20 grey-500">
              <i class="icon md-long-arrow-up green-500 font-size-16"></i>                  10% Ventas
            </div>
            <div class="ct-chart h-50"></div>
          </div>
        </div>
        <!-- End Widget Linearea Two -->
      </div>
      <div class="col-xl-3 col-md-6">
        <!-- Widget Linearea Three -->
        <div class="card card-shadow" id="widgetLineareaThree">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-notifications-active grey-600 font-size-24 vertical-align-bottom mr-5"></i>                    18 kl Frances
              </div>
              <span class="float-right grey-700 font-size-30">100 gr</span>
            </div>
            <div class="mb-20 grey-500">
              <i class="icon md-long-arrow-down red-500 font-size-16"></i>                  5% Ventas
            </div>
            <div class="ct-chart h-50"></div>
          </div>
        </div>
        <!-- End Widget Linearea Three -->
      </div>
      <div class="col-xl-3 col-md-6">
        <!-- Widget Linearea Four -->
        <div class="card card-shadow" id="widgetLineareaFour">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-label grey-600 font-size-24 vertical-align-bottom mr-5"></i>                    Productos
              </div>
              <span class="float-right grey-700 font-size-30">500</span>
            </div>
            <div class="mb-20 grey-500">
              <i class="icon md-long-arrow-up green-500 font-size-16"></i>                  $30,000 en Productos
            </div>
            <div class="ct-chart h-50"></div>
          </div>
        </div>
        <!-- End Widget Linearea Four -->
        </div>
      </div>
    </div>
<!-- Inicia Reporte De Momina -->
        <div class=" col-12"> 
          <div class="panel panel-bordered">
            <div class="panel-heading">
              <h3 class="bg-info panel-title text-center text-white">Repoerte De Nomina Por Sucursal</h3>
            </div>
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
                        <option value="{{ $branch->id }}" required>{{ $branch->name }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="col-3">
                        <label class="floating-label" for="inputUser">{{ __('Colaborador') }}</label>
                        <select id="usuarios_1" name="user_id" class="round form-control "></select>
                  </div>
                  <div class="input-group col-3">
                    <div class="row container"><label>De la Fecha:</label></div>
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="icon md-calendar" aria-hidden="true"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control round" data-plugin="datepicker">
                    </div>
                  <div class="input-group col-3">
                      <div class="row container"><label>Hasta la Fecha:</label></div>
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="icon md-calendar" aria-hidden="true"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control round" data-plugin="datepicker" data-multidate="true">
                    </div>
                </div>
              </div>
                  <div class="form-group col-3">
                      <button id="ok" type="submit"  data-toggle="button" class="btn btn-primary">Generar Reporte</button>
                  </div>
            </div>
        </div>
<!-- Termina Reporte De Nomina -->
  </div>

@endsection

        
@section('branch-user')
<script type="text/javascript">

$(".sucursales").change(function(){
  var selector =  $(this).attr("alt");
  var id_sucursal = $(this).val();
  var url = '/sucursales/' + id_sucursal + '/usuarios';
  $.get(url, function(json){
    $('#usuarios_' + selector).empty();
    //alert('#municipios_' + selector);
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
$(".usuarios").change(function(){
      var id_user = $(this).val();
      var selector = $(this).attr("alt");
      $("#id_user_" + selector).val(id_user);
    });
</script>
@endsection