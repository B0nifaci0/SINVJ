@extends('layout.layoutdas')
@section('title')
LISTA DE CATEGORIA
@endsection
@section('nav')
@endsection
@section('menu')
@endsection
@section('content')

<div class="page-content">
  <div class="col-12">
    <div class="panel-primary">
      <div class="panel-heading">
        <center>
          <h2 class="panel-title" style="color:white">Gráficos Sistema SINVJ
          </h2>
        </center>
      </div><br>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <!--Table and divs that hold the pie charts-->
      <div class="col-md-6">
        <div align="left" id="columnchart_values"></div>
      </div>
      <div class="col-md-6">
        <div align="left" id="chart_div"></div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

  var dataset1 = {!!$data!!};
  var dataset2 = {!!$databranch!!};

  dataset1 = dataset1.map(d => ([d.name, d.CantUsers]))
  dataset2 = dataset2.map(d => ([d.name, d.CantSucur]))

  //console.log(dataset1);
  //console.log(dataset2);
  // Load Charts and the corechart package.
  google.charts.load('current', { 'packages': ['corechart'] });

  // Funcion para grafica de usuarios 
  google.charts.setOnLoadCallback(drawUsersChart);

  // Funcion para grafica de sucursales
  google.charts.setOnLoadCallback(drawBranchesChart);

  // Llamando a la funcion para grafico de usuarios
  function drawUsersChart() {

    // Dat
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Usuarios');
    data.addRows(
      dataset1
    );

    // Formato grafico users.
    var options = {
      title: 'Usuarios por tienda',
      backgroundColor: { fill: 'transparent' },
      width: 690,
      height: 300
    };

    // Inicializando y dibujando la grafica
    var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_values'));
    chart.draw(data, options);
  }
  //funcion para hacer responsive 
  $(window).resize(function () {
    drawUsersChart();
  });
  //AREA
  // Se ocupa la funcion para generar el grafico de sucursales
  function drawBranchesChart() {

    // Los datos correspondientes a las consulta de sucursales
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Sucursales');
    data.addRows(dataset2);

    // SDiseño de la grafica.
    var options = {
      title: 'Sucursales por tienda',
      backgroundColor: { fill: 'transparent' },
      width: 690,
      height: 300
    };

    // Iniciando grafica.
    var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
  $(window).resize(function () {
    drawBranchesChart();
  });
</script>



@endsection