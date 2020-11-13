<!DOCTYPE html>
<html lang="en">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Reporte de Gastos</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
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
<img align="left" width="140px" height="120px" src="{{ $shop->image }}"><br>
    <div class="panel">
    <p align= "right">Fecha:{{$date}}</p>
    <p align= "right">Hora:{{$hour}}</p>
    <h2 align="center" style="color:black">Reporte General De Gastos {{ $shop->name}} </h2>
            <table>
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Usuario</th>
                  <th>Sucursal</th>
                  <th>Fecha</th>
                  <th>Precio</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($expenses as  $expense)
                  <tr id ="row{{$expense->id}}">
                    <td>{{ $expense->name }}</td>
                    <td>{{ $expense->descripcion }}</td>
                    <td>{{ $expense->user ? $expense->user->name : ''}}</td>
                    <td>{{ ($expense->branch == null) ? $expense->shop->name : $expense->branch->name }}</td>
                    <td>{{$expense->created_at}}</td>
                    <td>$ {{ $expense->price }}</td>
                  </tr>
                  @endforeach
              </tbody>
            </table><br>
            <table>
                <thead>
                    <tr>
                            <th scope="col">Sucursal</th>
                            <th scope="col">Total Gastado</th></tr>
                        </thead>
                      <tbody>
                      @foreach($total as $t)
                      <tr>
                      <td align="center">{{$t->sucursal}}</td>
                      <td align="center">${{$t->money}}</td>
                      </tr>
                      @endforeach
                      </tbody>
                    </table><br>

            <table>
                <thead>
                    <tr>
                            <th scope="col">Total De Gastos</th>
          </tr>
                      </thead>
                    <tbody>
                      <tr>
                      <td scope="col">${{$totales}}</td>
                      </tr>
                    </tbody>
                    </table>
              </div>
          </div>
    </body>
</html>


