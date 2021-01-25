@extends('layout.layoutdas')
@section('title')
Graficas
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">
        @if(Auth::user()->type_user == 1)
        <div class="col-md-12 col-lg-12">
            <div class="panel-success">
                <div class="panel-heading">
                    <center>
                        <h2 class="panel-title">Grafico de productos de todas mis sucursales </h2>
                    </center>
                </div>
            </div>
        </div></br>
        @endif
        @if(Auth::user()->type_user !== 1)
        <div class="col-md-12 col-lg-12">
            <div class="panel-success">
                <div class="panel-heading">
                    <center>
                        <h2 class="panel-title">Grafico de productos de mi sucursal @foreach($branches_col as $branch) {{ $branch->name}} @endforeach </h2>
                    </center>
                </div>
            </div>
        </div></br>
        @endif
        @if(Auth::user()->type_user == 1)
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
              <div class="card">
                <h3 align="center"> Cantidad productos por Status</h3>
                <canvas id="dataStatus" width="400" height="400"></canvas>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <h3 align="center">Cantidad productos por Linea</h3>
                <canvas id="dataPLine" width="400" height="400"></canvas>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <h3 align="center">Cantidad productos por Categoría</h3>
                <canvas id="dataPCategory" width="400" height="400"></canvas>
              </div>
            </div>
        </div>
          @endif
          @if(Auth::user()->type_user !== 1)
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <h3 align="center"> Cantidad de productos por status </h3>
                <canvas id="dataStatusPS" width="400" height="400"></canvas>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <h3 align="center"> Cantidad de productos por línea</h3>
                <canvas id="dataPLS" width="400" height="400"></canvas>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <h3 align="center"> Cantidad de productos por categoría</h3>
                <canvas id="dataPCS" width="400" height="400"></canvas>
              </div>
            </div>
          </div>
          @endif
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js" integrity="sha512-hZf9Qhp3rlDJBvAKvmiG+goaaKRZA6LKUO35oK6EsM0/kjPK32Yw7URqrq3Q+Nvbbt8Usss+IekL7CRn83dYmw==" crossorigin="anonymous"></script>
<script>
/**INICIA GRAFICA DE USUARIOS POR SUCURSAL */
@if(Auth::user()->type_user == 1)  
//Status
var dataStatus = {!! $ProductStatus !!}
console.log(dataStatus);
var ctx = document.getElementById('dataStatus');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: dataStatus.map(d => (d.status)),
        datasets: [
            {
            label: 'Cantidad de productos',
            data: dataStatus.map(d => parseInt(d.cantidad_status)),
            
            backgroundColor: [
                '#6C757D', '#28A745', '#007BFF', '#FFC107', '#DC3545',
                ],
            borderColor: [
                 '#6C757D', '#28A745', '#007BFF', '#FFC107', '#DC3545',                   
                ],
            borderWidth: 1,
            showLine: false,
            pointRadius: 5,
            fill: true,
            display: false,
            animateRotate:true,
            fullWidth:true, 
        }],
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                },
                stacked: true
            }]
        },
        responsive:true,
    }
});//termina status
//LinesProducts
var dataPLine = {!! $ProductLine !!}
console.log(dataPLine);
var ctx = document.getElementById('dataPLine');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: dataPLine.map(d => (d.name)),
        datasets: [
            {
            label: 'Cantidad de productos',
            data: dataPLine.map(d => parseInt(d.cantidad_line)),
            
            backgroundColor: [
                '#64b5f6', '#4fc3f7', '#4dd0e1', '#4db6ac', '#81c784',
                '#ec407a', '#80deea', '#9c27b0', '#3f51b5', '#2196f3'
                ],
            borderColor: [
                '#64b5f6', '#4fc3f7', '#4dd0e1', '#4db6ac', '#81c784',
                '#ec407a', '#80deea', '#9c27b0', '#3f51b5', '#2196f3'
                
                ],
            borderWidth: 1,
            showLine: false,
            pointRadius: 5,
            fill: true,
            display: false,
            animateRotate:true,
            fullWidth:true, 
        }],
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                },
                stacked: true
            }]
        },
        responsive:true,
    }
});//Lines
//categoryProducts
var dataPCategory = {!! $ProductCategory !!}
console.log(dataPCategory);
var ctx = document.getElementById('dataPCategory');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: dataPCategory.map(d => (d.name)),
        datasets: [
            {
            label: 'Cantidad de productos',
            data: dataPCategory.map(d => parseInt(d.cantidad_category)),
            
            backgroundColor: [
                '#64b5f6', '#4fc3f7', '#4dd0e1', '#4db6ac', '#81c784',
                '#ec407a', '#80deea', '#9c27b0', '#3f51b5', '#2196f3',
                '#303f9f', '#1976d2', '#512da8', '#d32f2f', '#c2185b',
                '#7b1fa2', '#0288d1', '#0097a7', '#00796b', '#388e3c',
                '#689f38', '#afb42b', '#fbc02d', '#ffa000', '#f57c00'
                ],
            borderColor: [
                '#64b5f6', '#4fc3f7', '#4dd0e1', '#4db6ac', '#81c784',
                '#ec407a', '#80deea', '#9c27b0', '#3f51b5', '#2196f3',
                '#303f9f', '#1976d2', '#512da8', '#d32f2f', '#c2185b',
                '#7b1fa2', '#0288d1', '#0097a7', '#00796b', '#388e3c',
                '#689f38', '#afb42b', '#fbc02d', '#ffa000', '#f57c00'
                ],
            borderWidth: 1,
            showLine: true,
            pointRadius: 5,
            fill: true,
            display: false,
            animateRotate:true,
            fullWidth:true, 
        }],
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                },
                stacked: true
            }]
        },
        responsive:true,
    }
});//Lines
@endif 
@if(Auth::user()->type_user !== 1)
var dataStatusPS = {!! $ProductStatusSucursal !!}
console.log(dataStatusPS);
var ctx = document.getElementById('dataStatusPS');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: dataStatusPS.map(d => (d.status)),
        datasets: [
            {
            label: 'Cantidad de productos',
            data: dataStatusPS.map(d => parseInt(d.cantidad_status)),
            
            backgroundColor: [
              '#6C757D', '#28A745', '#007BFF', '#FFC107', '#DC3545',

                ],
            borderColor: [
              '#6C757D', '#28A745', '#007BFF', '#FFC107', '#DC3545',

                
                ],
            borderWidth: 1,
            showLine: false,
            pointRadius: 5,
            fill: true,
            display: false,
            animateRotate:true,
            fullWidth:true, 
        }],
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                },
                stacked: true
            }]
        },
        responsive:true,
    }
});//Lines

var dataPLS = {!! $ProductLineS !!}
console.log(dataPLS);
var ctx = document.getElementById('dataPLS');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: dataPLS.map(d => (d.name)),
        datasets: [
            {
            label: 'Cantidad de productos',
            data: dataPLS.map(d => parseInt(d.cantidad_line)),
            
            backgroundColor: [
                '#ec407a', '#80deea', '#9c27b0', '#3f51b5', '#2196f3',
                '#303f9f', '#1976d2', '#512da8', '#d32f2f', '#c2185b',
                '#7b1fa2', '#0288d1', '#0097a7', '#00796b', '#388e3c',
                ],
            borderColor: [
                '#ec407a', '#80deea', '#9c27b0', '#3f51b5', '#2196f3',
                '#303f9f', '#1976d2', '#512da8', '#d32f2f', '#c2185b',
                '#7b1fa2', '#0288d1', '#0097a7', '#00796b', '#388e3c',
                ],
            borderWidth: 1,
            showLine: false,
            pointRadius: 5,
            fill: true,
            display: false,
            animateRotate:true,
            fullWidth:true, 
        }],
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                },
                stacked: true
            }]
        },
        responsive:true,
    }
});//Lines
//Inicia garfico de productos por categoria de una sucursal//
var dataPCS = {!! $ProductCategoryS !!}
console.log(dataPCS);
var ctx = document.getElementById('dataPCS');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: dataPCS.map(d => (d.name)),
        datasets: [
            {
            label: 'Cantidad de productos',
            data: dataPCS.map(d => parseInt(d.cantidad_category)),
            
            backgroundColor:[
                '#7b1fa2', '#0288d1', '#0097a7', '#00796b', '#388e3c',
                '#303f9f', '#1976d2', '#512da8', '#d32f2f', '#c2185b',
                '#ec407a', '#80deea', '#9c27b0', '#3f51b5', '#2196f3',
                '#006064', '#795548', '#26a69a', '#e65100', '#aa00ff',
                ],
            borderColor: [
                '#7b1fa2', '#0288d1', '#0097a7', '#00796b', '#388e3c',
                '#303f9f', '#1976d2', '#512da8', '#d32f2f', '#c2185b',
                '#ec407a', '#80deea', '#9c27b0', '#3f51b5', '#2196f3',
                '#006064', '#795548', '#26a69a', '#e65100', '#aa00ff',
                ],
            borderWidth: 1,
            showLine: false,
            pointRadius: 5,
            fill: true,
            display: false,
            animateRotate:true,
            fullWidth:true, 
        }],
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                },
                stacked: true
            }]
        },
        responsive:true,
    }
});//Lines
@endif
</script>
@endsection