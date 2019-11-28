<!DOCTYPE html>
<html lang="en">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Reporte de Productos</title>
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
      .sizedate{
       font-size: 12px!important;
     }
   </style>
</head>
<body>
<div class="page-content">
    <div class="panel">

    <img align = "left" width="90px" height="90px" src="{{ $shop->image }}">
             
    <p align="right">Fecha: {{$dates}}</p>
          
    <p align="right">Hora: {{$hour}}</p>
  
  
    <h1 align="center">Reporte de Entrada de Productos</h1>
        <h2 align="center">Todas las lineas</h2>
            <h3 align="center" style="color:red">@foreach($branches as $branch){{$branch->name}} @endforeach</h3>
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
              <thead>
                <tr>
				 <th scope="col">Clave</th>
                 <th scope="col">Descripción</th>
                 <th scope="col">Linea</th>
                 <th scope="col">Peso</th>
                 <th scope="col">Precio Venta</th>
                 <th scope="col">Observaciones</th>
                 <th scope="col">Categoria</th>
                 <th scope="col">Estatus</th>
                 <th scope="col" >Fecha</th>

                </tr>
              </thead>  
              <tbody>
              
      @foreach ($products as $i => $product)
                <tr id="row{{$product->id}}">
                 <td>{{ $product->clave }}</td> 
                 <td>{{ $product->description }}</td>
                 <td>{{ $product->name_line }}</td> 
                 <td>{{ $product->weigth }} gr</td>
                 <td>{{ $product->price }} $</td> 
                 <td>{{ $product->observations }}</td>
                 <td>{{ $product->name_category }}</td>
                 <td>{{ $product->name_status }}</td>
                <td class="sizedate">{{ $product->date_creation }}</td>

                </tr>
                  @endforeach
              </tbody>
            </table>
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                <thead>
                    <tr>
                            <th scope="col">Linea</th>
                            <th scope="col">Total De Gramos</th>

                    </tr>
                </thead>
                <tbody>
                   @foreach ($lines as $i => $line)
                    <tr>
                        <td>{{$line->name}}</td> 
                        <td align="center">{{$line->total_g}}</td>
                    </tr>
                     @endforeach
                </tbody> 
                <br>   
            </table>
          </div>
          </div>
    </body>
</html>