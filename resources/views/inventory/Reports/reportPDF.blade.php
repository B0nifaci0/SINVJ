<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Reporte de Inventarios</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
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

      tbody tr:last-child {
        color: #000000;
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

        <img align="left" width="140px" height="120px" src="{{ $shop->image }}">

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
        <table class="table table-hover dataTable table-striped w-full">
          <thead>
            <tr>
              <th>Línea</th>
              <th>TD Gramos</th>
              <th>TD Dinero</th>
              <th>TD Gramos Existentes</th>
              <th>TD Dinero Existente</th>
              <th>TD Gramos Faltantes</th>
              <th>TD Dinero Faltante</th>
              <th>TD Gramos Dañados</th>
              <th>TD Dinero Dañado</th>
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
        <table class="table table-hover dataTable table-striped w-full">
          <thead>
            <tr>
              <th>Clave</th>
              <th>Linea</th>
              <th>Descripcion</th>
              <th>Peso</th>
              <th>Dinero Faltante</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($prod_fal as $prod)
            <tr>
              <td>{{ $prod->clave }}</td>
              <td>{{ $prod->name_line }}</td>
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
        <table class="table table-hover dataTable table-striped w-full">
          <thead>
            <tr>
              <th>Clave</th>
              <th>Linea</th>
              <th>Descripcion</th>
              <th>Peso</th>
              <th>Dinero Dañado</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($prod_da as $prod)
            <tr>
              <td>{{ $prod->clave }}</td>
              <td>{{ $prod->name_line }}</td>
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
        <h3 align="center">Productos Existentes Por Gramo al Dia @if($details->status_report == 3)
          {{$details->end_date}} @else {{$date}} @endif </h3>
        <table class="table table-hover dataTable table-striped w-full">
          <thead>
            <tr>
              <th>Clave</th>
              <th>Linea</th>
              <th>Descripcion</th>
              <th>Peso</th>
              <th>Dinero Existente</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($prod_exis as $prod)
            <tr>
              <td>{{ $prod->clave }}</td>
              <td>{{ $prod->name_line }}</td>
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
        <table class="table table-hover dataTable table-striped w-full">
          <thead>
            <tr>
              <th>Categoria</th>
              <th>TD PZ</th>
              <th>TD Dinero</th>
              <th>TD PZ Existentes</th>
              <th>TD Dinero Existente</th>
              <th>TD PZ Faltantes</th>
              <th>TD Dinero Faltante</th>
              <th>TD PZ Dañadas</th>
              <th>TD Dinero Dañado</th>
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
        <table class="table table-hover dataTable table-striped w-full">
          <thead>
            <tr>
              <th>Categoria</th>
              <th>Clave Del Producto</th>
              <th>Descripcion</th>
              <th>Dinero Faltante</th>
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
        <table class="table table-hover dataTable table-striped w-full">
          <thead>
            <tr>
              <th>Clave</th>
              <th>Categoria</th>
              <th>Descripcion</th>
              <th>Dinero Dañado</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($p_dañados as $fal)
            <tr>
              <td>{{$fal->clave}}</td>
              <td>{{$fal->cat_name}}</td>
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
        <h3 align="center">Productos Existentes Por PZ al Dia @if($details->status_report == 3) {{$details->end_date}}
          @else {{$date}} @endif </h3>
        <table class="table table-hover dataTable table-striped w-full">
          <thead>
            <tr>
              <th>Categoria</th>
              <th>Clave Del Producto</th>
              <th>Descripcion</th>
              <th>Dinero Existente</th>
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