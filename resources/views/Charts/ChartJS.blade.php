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
    <div class="col-md-12">
        <div class="panel-primary">
            <div class="panel-heading">
                <center>
                    <h2 class="panel-title">SINVJ</h2>
                </center>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
        <!--Table and divs that hold the pie charts-->
            <div class="col-md-6">
                <h3 align="center">Usuarios por sucursal</h3>
                <canvas id="myChart" width="400" height="400px"></canvas>
            </div>
            <div class="col-md-6">
               <h3 align="center">Mis líneas</h3>
               <canvas id="ChartLine" width="400" height="400px"></canvas>
            </div>
            <div class="col-md-6">
                <h3 align="center">Traspasos Entrantes</h3>
                <canvas id="dataTransferInt" width="400" height="400"></canvas>
            </div>
            <div class="col-md-6">
                <h3 align="center">Traspasos Salientes</h3>
                <canvas id="dataTransferOut" width="400" height="400"></canvas>
            </div>
            <div class="col-md-6">
                <h3 align="center">Ventas realizadas</h3>
                <canvas id="dataSales" width="400" height="400"></canvas>
            </div>
            <div class="col-md-6">
                <h3 align="center">Productos por Status</h3>
                <canvas id="dataStatus" width="400" height="400"></canvas>
            </div>
            <div class="col-md-6">
                <h3 align="center">Productos por Linea</h3>
                <canvas id="dataPLine" width="400" height="400"></canvas>
            </div>
            <div class="col-md-6">
                <h3 align="center">Productos por Categoría</h3>
                <canvas id="dataPCategory" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js" integrity="sha512-hZf9Qhp3rlDJBvAKvmiG+goaaKRZA6LKUO35oK6EsM0/kjPK32Yw7URqrq3Q+Nvbbt8Usss+IekL7CRn83dYmw==" crossorigin="anonymous"></script>
<script>
/**INICIA GRAFICA DE USUARIOS POR SUCURSAL */
var chartData = {!! $dataBranch !!};
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: chartData.map(c => (c.sucursal)),
        datasets: [{
            label: 'Usuarios por sucursal',
            data: chartData.map(c => parseInt(c.Cantidad_Usuarios)),
            backgroundColor: [
                '#e57373', '#f06292', '#ba68c8', '#9575cd', '#7986cb',
                '#64b5f6', '#4fc3f7', '#4dd0e1', '#4db6ac', '#81c784',
                '#aed581', '#dce775', '#fff176', '#ffd54f', '#ffb74d',
                '#ff8a65', '#a1887f', '#757575', '#ff3d00', '#607d8b'
             ],
            borderColor: [
                '#e57373', '#f06292', '#ba68c8', '#9575cd', '#7986cb',
                '#64b5f6', '#4fc3f7', '#4dd0e1', '#4db6ac', '#81c784',
                '#aed581', '#dce775', '#fff176', '#ffd54f', '#ffb74d',
                '#ff8a65', '#a1887f', '#757575', '#ff3d00', '#607d8b'
             ],
            borderWidth: 6,

        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        responsive:true,
    }
});

/**TERMINA GRAFICA DE USUARIOS POR SUCURSAL */

/**INICIA GRAFICA DE LINEAS */
var chartDataLine = {!! $dataLine !!};
console.log(chartDataLine);
var ctx = document.getElementById('ChartLine');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: chartDataLine.map(l => (l.nombre)),
        datasets: [{
            label: 'Precio compra',
            data: chartDataLine.map(l => parseInt(l.precio_compra)),
            backgroundColor: [
                '#c5cae9', 
             ],
            borderColor: [
                '#e57373', '#f06292', '#ba68c8', '#9575cd', '#7986cb',
                '#64b5f6', '#4fc3f7', '#4dd0e1', '#4db6ac', '#81c784',
                '#aed581', '#dce775', '#fff176', '#ffd54f', '#ffb74d',
                '#ff8a65', '#a1887f', '#757575', '#ff3d00', '#607d8b'
             ],
            borderWidth: 1,
            showLine: true,
            pointRadius: 5,
            fill: true,
            display: true,
            fullWidth:true,
        }, {

            label: 'Precio Venta',
            data: chartDataLine.map(l => parseInt(l.precio_venta)),
            backgroundColor: [
                '#bbdefb',
            ],
            borderColor:  [
                '#ff8a65', '#a1887f', '#757575', '#ff3d00',
                '#aed581', '#dce775', '#fff176', '#ffd54f', '#ffb74d',
                '#64b5f6', '#4fc3f7', '#4dd0e1', '#4db6ac', '#81c784',
                '#e57373', '#f06292', '#ba68c8', '#9575cd', '#7986cb'
            ],
            borderWidth: 1,
            showLine: true,
            pointRadius: 5,  
            fill: true,
        }]
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
});

/**TERMINA GRAFICA DE LINEAS */
//Grafica traspasos entrantes
var dataTransferInt = {!! $transfers !!};

var ctx = document.getElementById('dataTransferInt');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: dataTransferInt.map(d => (d.branch)),
        datasets: [
            {
            label: 'traspasos recibidos',
            data: dataTransferInt.map(d => parseInt(d.quantity)),
            
            backgroundColor: [
                '#e57373', '#f06292', '#ba68c8', '#9575cd', '#7986cb',
                '#64b5f6', '#4fc3f7', '#4dd0e1', '#4db6ac', '#81c784',
                             ],
            borderColor: [
                '#e57373', '#f06292', '#ba68c8', '#9575cd', '#7986cb',
                '#64b5f6', '#4fc3f7', '#4dd0e1', '#4db6ac', '#81c784',
                '#aed581', '#dce775', '#fff176', '#ffd54f', '#ffb74d',
                '#ff8a65', '#a1887f', '#757575', '#ff3d00', '#607d8b'
             ],
            borderWidth: 1,
            showLine: true,
            pointRadius: 5,
            fill: true,
            display: true,
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
});
//Termina
//Traspasos Salientes
var dataTransferOut = {!! $transfersout !!}
console.log(dataTransferOut);
var ctx = document.getElementById('dataTransferOut');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: dataTransferOut.map(d => (d.branch)),
        datasets: [
            {
            label: 'traspasos enviados',
            data: dataTransferOut.map(d => parseInt(d.quantity)),
            
            backgroundColor: [
                '#64b5f6', '#4fc3f7', '#4dd0e1', '#4db6ac', '#81c784',
                '#e57373', '#f06292', '#ba68c8', '#9575cd', '#7986cb',
                             ],
            borderColor: [
                '#64b5f6', '#4fc3f7', '#4dd0e1', '#4db6ac', '#81c784',
                '#e57373', '#f06292', '#ba68c8', '#9575cd', '#7986cb',
                '#aed581', '#dce775', '#fff176', '#ffd54f', '#ffb74d',
                '#ff8a65', '#a1887f', '#757575', '#ff3d00', '#607d8b'
             ],
            borderWidth: 1,
            showLine: true,
            pointRadius: 5,
            fill: true,
            display: true,
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
});//termina salientes
//ventas
var dataSales = {!! $sales !!}
console.log(dataSales);
var ctx = document.getElementById('dataSales');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: dataSales.map(d => (d.branch)),
        datasets: [
            {
            label: 'Ventas Realizadas',
            data: dataSales.map(d => parseInt(d.quantity)),
            
            backgroundColor: [
                '#aed581', '#dce775', '#fff176', '#ffd54f', '#ffb74d',
                '#e57373', '#f06292', '#ba68c8', '#9575cd', '#7986cb',
                '#64b5f6', '#4fc3f7', '#4dd0e1', '#4db6ac', '#81c784',
                             ],
            borderColor: [
                '#64b5f6', '#4fc3f7', '#4dd0e1', '#4db6ac', '#81c784',
                '#e57373', '#f06292', '#ba68c8', '#9575cd', '#7986cb',
                '#aed581', '#dce775', '#fff176', '#ffd54f', '#ffb74d',
                '#ff8a65', '#a1887f', '#757575', '#ff3d00', '#607d8b'
             ],
            borderWidth: 1,
            showLine: true,
            pointRadius: 5,
            fill: true,
            display: true,
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
});//termina ventas
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
                '#ec407a', '#80deea', '#9c27b0', '#3f51b5', '#2196f3'
                ],
            borderColor: [
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
</script>   

@endsection