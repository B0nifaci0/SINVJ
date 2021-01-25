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
                        <h2 class="panel-title">Grafico de gastos</h2>
                    </center>
                </div>
            </div>
        </div></br>
    @if(Auth::user()->type_user == 1)
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h3 align="center" class="panel-title" >Gastos Generales</h3>
                            <canvas id="dataExpenses" width="auto" height="auto"></canvas>
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
                        <h3 align="center" class="panel-title" >Gastos de mi sucursal</h3>
                            <canvas id="GastosSuc" width="auto" height="auto"></canvas>
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
var  dataExpenses = {!! $expenses !!}
console.log(dataExpenses); 

var ctx = document.getElementById('dataExpenses');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        datasets: [{
            label: 'total gastado',
            data: dataExpenses.map(d => parseInt(d.total_gastado)),
            backgroundColor: [
                'rgba(255,99,132,0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(255, 205, 86, 0.2)', 'rgba(75, 192, 192,0.2)',
                'rgba(54, 162, 235, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(201, 203, 207, 0.2)',
                ],
            borderColor: [
                'rgba(255,99,132,0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(255, 205, 86, 0.2)', 'rgba(75, 192, 192,0.2)',
                'rgba(54, 162, 235, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(201, 203, 207, 0.2)',
                ],
            borderWidth: 1,
            showLine: true,
            pointRadius: 5,
            fill: false,
            display: false,
            animateRotate:true,
            fullWidth:true, 
        }, {
            label: 'Gastos realizados',
            data: dataExpenses.map(d => parseInt(d.quantity)),
            type: 'line',
            borderColor: [
                '#64b5f6',
                ],
            borderWidth: 5,
            showLine: true,
            pointRadius: 10,
            fill: false,
            display: false,
            animateRotate:true,
            fullWidth:true, 
        }],
        labels: dataExpenses.map(d => (d.sucursal)),
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
@if(Auth::user()->type_user !== 1 )

//inicia graficos gastos por sucursal
var GastosSuc = {!! $expensesBranch !!}
console.log(GastosSuc);

var ctx = document.getElementById('GastosSuc');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        datasets: [{
            label: 'total gastado',
            data: GastosSuc.map(d => parseInt(d.total_gastado)),
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(201, 203, 207, 0.2)',
                'rgba(255,99,132,0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(255, 205, 86, 0.2)', 'rgba(75, 192, 192,0.2)',
                ],
            borderColor: [
                'rgba(54, 162, 235, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(201, 203, 207, 0.2)',
                'rgba(255,99,132,0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(255, 205, 86, 0.2)', 'rgba(75, 192, 192,0.2)',
                ],
            borderWidth: 1,
            showLine: true,
            pointRadius: 5,
            fill: false,
            display: false,
            animateRotate:true,
            fullWidth:true, 
        }, {
            label: 'Gastos realizados',
            data: GastosSuc.map(d => parseInt(d.quantity)),
            type: 'line',
            borderColor: [
                '#64b5f6',
                ],
            borderWidth: 5,
            showLine: true,
            pointRadius: 10,
            fill: false,
            display: false,
            animateRotate:true,
            fullWidth:true, 
        }],
        labels: GastosSuc.map(d => (d.fecha)),
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