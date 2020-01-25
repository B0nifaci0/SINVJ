<!DOCTYPE html>
<html lang="en">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Reporte de Traspasos</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
   <style>
   @media print {
     html,body{
        font-size: 9.5pt;
        margin: 0;
        padding: 0;
     }.page-break {
       page-break-before:always;
       width: auto;
       margin: auto;
      }
    }
    .page-break{
      width: 980px;
      margin: 0 auto;
    }
     .sale-head{
       margin: 40px 0;
       text-align: center;
     }.sale-head h1,.sale-head strong{
       padding: 10px 20px;
       display: block;
     }.sale-head h1{
       margin: 0;
       border-bottom: 1px solid #212121;
     }.table>thead:first-child>tr:first-child>th{
       border-top: 1px solid #000;
      }
      table thead tr th {
       text-align: center;
       border: 1px solid #ededed;
     }table tbody tr td{
       vertical-align: middle;
     }.sale-head,table.table thead tr th,table tbody tr td,table tfoot tr td{
       border: 1px solid #212121;
     }.sale-head h1,table thead tr th,table tfoot tr td{
       background-color: #f8f8f8;
     }tfoot{
       color:#000;
       text-transform: uppercase;
       font-weight: 500;
     }
   </style>
</head>
<body>
<div class="page-content">
<img align="left" width="140px" height="120px" src="{{ $shop->image }}"><br>
    <div class="panel">
    <p align="right">Fecha: {{$date}}</p>
    <p align="right">Hora: {{$hour}}</p>
    <h2 align="center">Traspasos {{$shop->name}}</h2>
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
              <thead>
                <tr>
                 <th>Clave</th>
                 <th>Clave Del Producto</th>
                 <th>Producto</th>
                 <th>Peso</th>
                 <th>Categoría</th>
                 <th>Linea</th>
                 <th>Sucursal</th>
                 <th>Quien lo mando</th>
                 <th>Destino</th>
                 <th>Quien recibio</th>
                 <th>Fecha</th>
                </tr>
              </thead>  
              <tbody>
                    @foreach ($trans as $transfer)
                    <tr id = "row{{$transfer->id}}">
                    <td>{{ $transfer->id }}</td> 
                          <td>{{ $transfer->product->clave }}</td> 
                          <td>{{ $transfer->product->name }}</td>
                          <td>{{ $transfer->product->weigth }}</td>
                          <td>{{ $transfer->product->category->name }}</td>
                          <td>{{ $transfer->product->line ? $transfer->product->line->name : '' }}</td>
                          <td>{{$transfer->lastBranch->name}}</td>
                          <td>{{$transfer->user->name}}</td>
                          <td>{{$transfer->newBranch->name}}</td>
                          <td>{{$transfer->destinationUser->name}}</td>
                          <td>{{$transfer->created_at->format('m-d-Y')}}</td>
                    </tr>
                    @endforeach
              </tbody>
            </table>
          </div>
          </div>
    </body>
</html>


