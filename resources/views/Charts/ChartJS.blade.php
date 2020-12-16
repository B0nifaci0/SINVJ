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
</script>

@endsection