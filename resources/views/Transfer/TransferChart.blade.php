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
                        <h2 class="panel-title">Grafico de traspasos de todas mis sucursales </h2>
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
                        <h2 class="panel-title">Grafico de traspasos de mi sucursal @foreach($branches_col as $branch) {{ $branch->name}} @endforeach </h2>
                    </center>
                </div>
            </div>
        </div></br>
        @endif
        @if(Auth::user()->type_user == 1)
        <div class="container-fluid">
        <div class="row">
          <!--Table and divs that hold the pie charts-->
            <div class="col-md-6">
              <div class="card">
                <h3 align="center">Traspasos Entrantes</h3>
                <canvas id="dataTransferInt" width="400" height="400"></canvas>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <h3 align="center">Traspasos Salientes</h3>
                <canvas id="dataTransferOut" width="400" height="400"></canvas>
              </div>
            </div>
        </div>
          @endif
          @if(Auth::user()->type_user !== 1)
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <h3 align="center"> Traspasos Entrantes</h3>
                <canvas id="TransferIntSuc" width="400" height="400"></canvas>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <h3 align="center"> Traspasos Salientes</h3>
                <canvas id="TransferOutSuc" width="400" height="400"></canvas>
              </div>
            </div>
          </div>
          @endif
          </div>
  </div>
    </div>
</div>    

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js" integrity="sha512-hZf9Qhp3rlDJBvAKvmiG+goaaKRZA6LKUO35oK6EsM0/kjPK32Yw7URqrq3Q+Nvbbt8Usss+IekL7CRn83dYmw==" crossorigin="anonymous"></script>
<script>
@if(Auth::user()->type_user == 1)
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
            label: 'traspasos realizados',
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
@endif
@if(Auth::user()->type_user !== 1 )
var TransferIntSuc = {!! $transfersIntSuc !!};
console.log(TransferIntSuc);

var ctx = document.getElementById('TransferIntSuc');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: TransferIntSuc.map(d => (d.date)),
        datasets: [
            {
            label: 'traspasos recibidos',
            data: TransferIntSuc.map(d => parseInt(d.quantity)),
            
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
//inicia traspasos salientes sucursal
var TransferOutSuc = {!! $transfersoutSuc !!}
console.log(TransferOutSuc);

var ctx = document.getElementById('TransferOutSuc');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: TransferOutSuc.map(d => (d.date)),
        datasets: [
            {
            label: 'traspasos realizados',
            data: TransferOutSuc.map(d => parseInt(d.quantity)),
            
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
@endif
</script>

@endsection