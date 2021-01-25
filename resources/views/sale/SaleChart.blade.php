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
                        <h2 class="panel-title">Grafico de ventas</h2>
                    </center>
                </div>
            </div>
        </div></br>
    @if(Auth::user()->type_user == 1)
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h3 align="center" class="panel-title" >Ventas mis sucursales</h3>
                            <canvas id="dataSales" width="auto" height="auto"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(Auth::user()->type_user !== 1)
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h3 align="center" class="panel-title" >Ventas de mi sucursal @foreach($branches_col as $branch){{ $branch->name }} @endforeach</h3>
                            <canvas id="VentasSuc" width="auto" height="1000px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js" integrity="sha512-hZf9Qhp3rlDJBvAKvmiG+goaaKRZA6LKUO35oK6EsM0/kjPK32Yw7URqrq3Q+Nvbbt8Usss+IekL7CRn83dYmw==" crossorigin="anonymous"></script>
<script>
@if(Auth::user()->type_user == 1)
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
@endif
@if(Auth::user()->type_user !== 1)
var totalvendido = {!! $totalvendido !!}
var VentasSuc = {!! $salesBranch !!}
console.log(totalvendido);

var ctx = document.getElementById('VentasSuc');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        datasets: [{
            label: 'ventas realizadas',
            data: VentasSuc.map(d => parseInt(d.quantity)),
            
            backgroundColor: [
                '#ff8a65', '#a1887f', '#757575', '#ff3d00', '#607d8b',
                '#aed581', '#dce775', '#fff176', '#ffd54f', '#ffb74d', 
                '#e57373', '#f06292', '#ba68c8', '#9575cd', '#7986cb',
                '#64b5f6', '#4fc3f7', '#4dd0e1', '#4db6ac', '#81c784',
                ],
            borderColor: [
                '#ff8a65', '#a1887f', '#757575', '#ff3d00', '#607d8b',
                '#aed581', '#dce775', '#fff176', '#ffd54f', '#ffb74d',
                '#e57373', '#f06292', '#ba68c8', '#9575cd', '#7986cb',
                '#64b5f6', '#4fc3f7', '#4dd0e1', '#4db6ac', '#81c784',
                ],
            borderWidth: 1,
            showLine: true,
            pointRadius: 5,
            fill: true,
            display: true,
            fullWidth:true, 
        }, {
            label: 'Total vendido',
            data: totalvendido.map(d => parseInt(d.total_vendido)),
            type: 'line',
            borderColor : [
                '#64b5f6',
            ],
            borderWidth: 5,
            showLine: true,
            pointRadius: 10,
            fill: false,
            animateRotate: false,
            fullWidth: true,
        }],
        labels: VentasSuc.map(d => (d.date)),
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

@endif
</script>
@endsection