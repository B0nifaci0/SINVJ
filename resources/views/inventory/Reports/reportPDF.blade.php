<!DOCTYPE html>
<html lang="en">
 <head> 
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Reporte de Inventarios</title>
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
    
    <img align = "left" width="140px" height="120px" src="{{ $shop->image }}">
             
    <p align="right">Fecha de Inicio del Inventario: {{$details->created_at}}</p> 
    @if($details->status_report == 3)
      <p align="right">Status: Terminado</p>
      <p align="right">Fecha de Termino: {{$details->end_date}}</p>
    @else
      <p align="right">Status: En proceso</p>
      <p align="right">Fecha Actual: {{$date}}</p>
    @endif 


  
  
    <h1 align="center">Reporte de Inventarios
          @foreach($report as $r) {{$r->name_branch}} @endforeach</h1>
          <h3 align="center">Inventario Por Líneas</h3>
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
              <thead>
                <tr>
                 <th scope="col">Línea</th>
                 <th scope="col">TD Gramos</th>
                 <th scope="col">TD Dinero</th>
                 <th scope="col">TD Gramos Existentes</th>
                 <th scope="col">TD Dinero Existente</th>
                 <th scope="col">TD Gramos Faltantes</th>
                 <th scope="col">TD Dinero Faltante</th>
                 <th scope="col">TD Gramos Dañados</th>
                 <th scope="col">TD Dinero Dañado</th>
                </tr>
              </thead>  
              <tbody>
                @foreach ($gramos_totales as $g)
                <tr>
                 <td>{{ $g->name_line }}</td> 
                 <td>{{ $g->total_w }} gr</td>
                 <td>$ {{ $g->dinero }}</td>
                 <td>{{ $g->gramos_ex }} gr</td>
                 <td>$ {{ $g->dinero_ex }}</td>
                 <td>{{ $g->gramos_fal }} gr</td>
                 <td>$ {{ $g->dinero_fal }}</td>
                 <td>{{ $g->gramos_da }} gr</td>
                 <td>$ {{ $g->dinero_da }}</td>
                </tr>
                @endforeach 
                @foreach ($totales_g as $totals)
                <tr>
                 <td>Total</td>  
                 <td>{{ $totals->gramos }} gr</td>
                 <td>$ {{ $totals->t_dinero }}</td>
                 <td>{{ $totals->g_existente }} gr</td>
                 <td>$ {{ $totals->d_existente }}</td>
                 <td>{{ $totals->g_faltantes }} gr</td>
                 <td>$ {{ $totals->d_faltantes }}</td>
                 <td>{{ $totals->g_dañados }} gr</td>
                 <td>$ {{ $totals->d_dañados }}</td>         
                </tr>
                @endforeach
              </tbody>
            </table>
            <br>
            <h3 align="center">Productos Faltantes Por Gramo</h3>
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                <thead>
                    <tr>
                      <th scope="col">Linea</th>
                      <th scope="col">Clave Del Producto</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Peso</th>
                      <th scope="col">Dinero Faltante</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($prod_fal as $prod)
                <tr>
                 <td>{{ $prod->name_line }}</td> 
                 <td>{{ $prod->clave }}</td> 
                 <td>{{ $prod->description }}</td>
                 <td>{{ $prod->weigth }} gr</td>
                 <td>$ {{ $prod->money }}</td>
                </tr>
                @endforeach 
                @foreach ($totales_g as $totals)
                <tr>
                 <td colspan="3">Total</td> 
                 <td>{{$totals->g_faltantes}} gr</td>   
                 <td>$ {{$totals->d_faltantes}}</td>  
                </tr>
                @endforeach 
                </tbody>    
            </table>
            <br>
            <h3 align="center">Productos Dañados Por Gramo</h3>
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                <thead>
                    <tr>
                      <th scope="col">Linea</th>
                      <th scope="col">Clave Del Producto</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Peso</th>
                      <th scope="col">Dinero Dañado</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($prod_da as $prod)
                <tr>
                 <td>{{ $prod->name_line }}</td> 
                 <td>{{ $prod->clave }}</td> 
                 <td>{{ $prod->description }}</td>
                 <td>{{ $prod->weigth }} gr</td>
                 <td>$ {{ $prod->money }}</td>
                </tr>
                @endforeach 
                @foreach ($totales_g as $totals)
                <tr>
                 <td colspan="3">Total</td> 
                 <td>{{$totals->g_dañados}} gr</td>   
                 <td>$ {{$totals->d_dañados}}</td>  
                </tr>
                @endforeach 
                </tbody>    
            </table>
            <br>
            <h3 align="center">Productos Existentes Por Gramo al Dia @if($details->status_report == 3) {{$details->end_date}} @else {{$date}} @endif </h3>
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                <thead>
                    <tr>
                      <th scope="col">Linea</th>
                      <th scope="col">Clave Del Producto</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Peso</th>
                      <th scope="col">Dinero Existente</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($prod_exis as $prod)
                <tr>
                 <td>{{ $prod->name_line }}</td> 
                 <td>{{ $prod->clave }}</td> 
                 <td>{{ $prod->description }}</td>
                 <td>{{ $prod->weigth }} gr</td>
                 <td>$ {{ $prod->money }}</td>
                </tr>
                @endforeach 
                @foreach ($totales_g as $totals)
                <tr>
                 <td colspan="3">Total</td> 
                 <td>{{$totals->g_existente}} gr</td>   
                 <td>$ {{$totals->d_existente}}</td>  
                </tr>
                @endforeach 
                </tbody>    
            </table>
            <br>
            <h3 align="center">Inventario Por Categorias</h3>
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                <thead>
                    <tr>
                      <th scope="col">Categoria</th>
                      <th scope="col">TD PZ</th>
                      <th scope="col">TD Dinero</th>
                      <th scope="col">TD PZ Existentes</th>
                      <th scope="col">TD Dinero Existente</th>
                      <th scope="col">TD PZ Faltantes</th>
                      <th scope="col">TD Dinero Faltante</th>
                      <th scope="col">TD PZ Dañadas</th>
                      <th scope="col">TD Dinero Dañado</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($cat_totals as $totals)
                    <tr>
                      <td>{{$totals->cat_name}}</td>
                      <td>{{$totals->num_pz}} pzs</td>
                      <td>$ {{$totals->total}}</td>
                      <td>{{$totals->pz_ex}} pzs</td>
                      <td>$ {{$totals->din_ex}}</td>
                      <td>{{$totals->pz_fal}} pzs</td>
                      <td>$ {{$totals->d_fal}}</td>
                      <td>{{$totals->pz_da}} pzs</td>
                      <td>$ {{$totals->d_da}}</td>
                    </tr>
                @endforeach 
                @foreach ($totales_piezas as $p)
                  <tr>
                    <td>Total</td>
                    <td>{{$p->piezas}} pzs</td>
                    <td>$ {{$p->dine}}</td>
                    <td>{{$p->exist}} pzs</td>
                    <td>$ {{$p->din_exis}}</td>
                    <td>{{$p->falt}} pzs</td>
                    <td>$ {{$p->din_falt}}</td>
                    <td>{{$p->da}} pzs</td>
                    <td>$ {{$p->din_da}}</td>
                  </tr>
                @endforeach 
                </tbody>    
            </table>
            <br>
            <h3 align="center">Productos Faltantes Por PZ</h3>
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                <thead>
                    <tr>
                      <th scope="col">Categoria</th>
                      <th scope="col">Clave Del Producto</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Dinero Faltante</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($p_faltantes as $fal)
                    <tr>
                      <td>{{$fal->cat_name}}</td>
                      <td>{{$fal->clave}}</td>
                      <td>{{$fal->description}}</td>
                      <td>$ {{$fal->discount}}</td>
                    </tr>
                @endforeach 
                @foreach ($totales_piezas as $p)
                    <tr>
                      <td colspan="3">Total</td>
                      <td>$ {{$p->din_falt}}</td>
                    </tr>
                @endforeach 
                </tbody>    
            </table>
            <br>
            <h3 align="center">Productos Dañados Por PZ</h3>
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                <thead>
                    <tr>
                      <th scope="col">Categoria</th>
                      <th scope="col">Clave Del Producto</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Dinero Dañado</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($p_dañados as $fal)
                    <tr>
                      <td>{{$fal->cat_name}}</td>
                      <td>{{$fal->clave}}</td>
                      <td>{{$fal->description}}</td>
                      <td>$ {{$fal->discount}}</td>
                    </tr>
                @endforeach 
                @foreach ($totales_piezas as $p)
                    <tr>
                      <td colspan="3">Total</td>
                      <td>$ {{$p->din_da}}</td>
                    </tr>
                @endforeach 
                </tbody>    
            </table>
            <br>
            <h3 align="center">Productos Existentes Por PZ al Dia @if($details->status_report == 3) {{$details->end_date}} @else {{$date}} @endif </h3>
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                <thead>
                    <tr>
                      <th scope="col">Categoria</th>
                      <th scope="col">Clave Del Producto</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Dinero Existente</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($p_existentes as $fal)
                    <tr>
                      <td>{{$fal->cat_name}}</td>
                      <td>{{$fal->clave}}</td>
                      <td>{{$fal->description}}</td>
                      <td>$ {{$fal->discount}}</td>
                    </tr>
                @endforeach 
                @foreach ($totales_piezas as $p)
                    <tr>
                      <td colspan="3">Total</td>
                      <td>$ {{$p->din_exis}}</td>
                    </tr>
                @endforeach 
                </tbody>    
            </table>
          </div>
          </div>
    </body>
</html>