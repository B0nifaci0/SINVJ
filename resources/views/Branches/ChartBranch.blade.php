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
        <div class="col-md-12 col-lg-12">
            <div class="panel-success">
                <div class="panel-heading">
                    <center>
                        <h2 class="panel-title">Grafico de usuarios por sucursal</h2>
                    </center>
                </div>
            </div>
        </div></br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h3 align="center" class="panel-title" >Cantidad de usuarios asignados en cada sucursal</h3>
                            <canvas id="myChart" width="auto" height="auto"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js" integrity="sha512-hZf9Qhp3rlDJBvAKvmiG+goaaKRZA6LKUO35oK6EsM0/kjPK32Yw7URqrq3Q+Nvbbt8Usss+IekL7CRn83dYmw==" crossorigin="anonymous"></script>
<script>
var chartData = {!! $dataBranch !!};
console.log(chartData);
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

</script>

@endsection