<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Corte sucursal Diario</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
</head>

<body>
  <div border="">
      <div >
        <img align="left" width="220px" height="100px" src="{{ $shop->image }}"></br>
        <p align="right">Fecha: {{$branch-> date}}</p>
        <p align="right">Hora: {{$branch-> hour}}</p>
        <h3 align="center">Corte de caja diario</h3>
        <h3 align="left"><b>Vendedor:</b>{{$user->name}}</h3>
        <h3>Sucursal: {{$branch ->name}}</h3>
      </div>
        </br>
        <div class="panel">
              <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
        <tr>
          <th align="center">VENTA TOTAL (T + E)</th>
          <tr>
          <td align="center">$ {{$branch->total }} </td></tr>
        </tr>
        <tr>
          <th align="center">VENTA TARJETA</th>
          <tr>
          <td align="center"> $ {{$branch->tarjeta }} </td></tr>
        </tr>
        <tr>
          <th align="center">VENTA EFECTIVO</th>
          <tr>
          <td align="center">$ {{$branch->efectivo }} </td></tr>
        </tr>
        <tr>
          <th align="center">GASTOS SUCURSAL</th>
          <tr>
          <td align="center">$ {{$branch->gastos }} </td></tr>
        </tr>
        <tr>
          <th align="center"> TOTAL EFECTIVO</th>
          <tr>
          <td align="center">$ {{$branch->totalFin }} </td></tr>
        </tr>
      </table>


        </div>
  </div>
</body>

</html>
