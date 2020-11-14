<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Reporte de Comision de Usuario</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
</head>
<style>
            @import 'https://fonts.googleapis.com/css2?family=Archivo&display=swap';

            body {
                font-size: 14px;
                font-family: 'Archivo', sans-serif;
            }

            h1 {
                text-align: center;
                margin-top: 55px;
            }

            .date {
                float: right;
            }

            img {
                float: left;
                width: 150px;
                height: 129px;
            }

            table {
                border-collapse: separate;
                border-spacing: 0;
                color: #4a4a4d;
                table-layout: fixed;
                width: 100%;
                text-align: center;
            }

            th,
            td {
                padding: 10px 15px;
                vertical-align: middle;
                text-align:center;
            }

            thead {
                background: #395870;
                background: linear-gradient(#49708f, #293f50);
                color: #fff;
            }

            tbody tr:nth-child(even) {
                background: #f0f0f2;
            }

            td {
                border-bottom: 1px solid #cecfd5;
                border-right: 1px solid #cecfd5;
            }

            td:first-child {
                border-left: 1px solid #cecfd5;
            }

            .book-title {
                color: #395870;
                display: block;
            }

            .text-offset {
                color: #7c7c80;
                font-size: 12px;
            }

            .item-stock,
            .item-qty {
                text-align: center;
            }

            .item-price {
                text-align: right;
            }

            .item-multiple {
                display: block;
            }

            tfoot {
                text-align: right;
            }

            tfoot tr:last-child {
                background: #f0f0f2;
                color: #395870;
                font-weight: bold;
            }

            tfoot tr:last-child td:first-child {
                border-bottom-left-radius: 5px;
            }

            tfoot tr:last-child td:last-child {
                border-bottom-right-radius: 5px;
            }

        </style>
</head>

<body>
  <div class="page-content">

  <div class="panel">
     
     <img align="left" width="200x" height="150px" src="{{ $shop->image }}"><br>       
     <p align="right" class="hora">Fecha: {{$dates}} </p>
            
      <p align="right" class="hora">Hora: {{$hour}} </p>
    </div>
  
      <table class="table-sm table-bordered text" width="100%">
        <thead class="text">
          <tr>
            <th align="center">De la fecha:</th>
            <th align="center">A la fecha:</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$fecini->format('d/m/Y')}}</td>
            <td>{{$fecter->format('d/m/Y')}}</td>
          </tr>
        </tbody>
      </table>
      @foreach($branches as $branch)

      <p class="text" align="center">Sucursal: {{$branch->name}}</p>
      @endforeach
      <table class="table-sm table-bordered" width="100%">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach($sales as $s)
          <tr>
            <td>{{ $s->username }}</td>
            <td>@if($s->ventas) $ {{ $s->ventas }} @else $ 0 @endif</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>
