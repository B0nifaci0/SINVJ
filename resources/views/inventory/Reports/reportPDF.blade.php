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
   </style>
</head>
<body>
<div class="page-content">
    <div class="panel">
    
    <img align = "left" width="90px" height="90px" src="{{ $shop->image }}">
             
    <p align="right">Fecha: {{$dates}}</p> 
          
    <p align="right">Hora: {{$hour}}</p>
  
  
    <h1 align="center">Reporte de Inventarios
          @foreach($branches as $branch){{$branch->name}} @endforeach</h1>
          <h3 align="center">Productos Gramo</h3>
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
              <thead>
                <tr>
                 <th scope="col">Linea</th>
                 <th scope="col">Total De Gramos</th>
                 <th scope="col">Total De Gramos Existente</th>
                </tr>
              </thead>  
              <tbody>
                @foreach ($totals as $i => $total)
                <tr>
                 <td>{{ $total->name_line }}</td> 
                 <td>{{ $total->total_w }} gr</td>
                 @foreach ($totals1 as $i => $total1)
                 <td>{{ $total1->total_f }} gr</td>
                 @endforeach 
                </tr>
                @endforeach 
              </tbody>
            </table>
            <br>
            <h3 align="center">Gramos Faltantes</h3>
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                <thead>
                    <tr>
                      <th scope="col">Linea</th>
                      <th scope="col">Total de Gramos</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($g_faltantes as $i => $fal)
                <tr>
                 <td>{{ $fal->name_line }}</td> 
                 <td>{{ $fal->total_w }} gr</td>
                </tr>
                @endforeach 
                </tbody>    
            </table>
            <br>
            <h3 align="center">Descripcion De Productos Gramos Faltantes</h3>
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                <thead>
                    <tr>
                      <th scope="col">Clave Del Producto</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Peso</th>
                      <th scope="col">Linea</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($prod_fal as $i => $prod)
                <tr>
                 <td>{{ $prod->id }}</td> 
                 <td>{{ $prod->description }}</td>
                 <td>{{ $prod->weigth }} gr</td>
                 <td>{{ $prod->name_line }}</td> 
                </tr>
                @endforeach 
                </tbody>    
            </table>
            <br>
            <h3 align="center">Productos Pieza</h3>
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                <thead>
                    <tr>
                      <th scope="col">Categoria</th>
                      <th scope="col">Cantidad PZ</th>
                      <th scope="col">Total En Dinero</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($cat_totals as $i => $totals)
                    <tr>
                      <td>{{$totals->cat_name}}</td>
                      <td>{{$totals->num_pz}} pzs</td>
                      <td>$ {{$totals->total}}</td>
                    </tr>
                @endforeach 
                </tbody>    
            </table>
            <br>
            <h3 align="center">Productos Faltantes Por PZ</h3>
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                <thead>
                    <tr>
                    <th scope="col">Clave</th>
                      <th scope="col">Categoria</th>
                      <th scope="col">Cantidad PZ</th>
                      <th scope="col">Total En Dinero</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($p_faltantes as $i => $fal)
                    <tr>
                      <td>{{$fal->cat_id}}</td>
                      <td>{{$fal->cat_name}}</td>
                      <td>{{$fal->num_pz}} pzs</td>
                      <td>$ {{$fal->total}}</td>
                    </tr>
                @endforeach 
                </tbody>    
            </table>
            <br>
            <h3 align="center">Descripcion De Productos Faltantes Por Pieza</h3>
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                <thead>
                    <tr>
                        <th scope="col">Clave Del Producto</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Precio Venta</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($prod_faltantes as $i => $fal)
                    <tr>
                      <td>{{$fal->id}}</td>
                      <td>{{$fal->cat_name}}</td>
                      <td>$ {{$fal->price}}</td>
                    </tr>
                @endforeach 
                </tbody>    
            </table>
          </div>
          </div>
    </body>
</html>