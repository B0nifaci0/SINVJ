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
        <h3>Sucursal: {{$branch ->name}}</h3>
      </div>
        </br>
        <div class="panel">
              <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
        <tr>
          <th>VENTA TOTAL (TARJETA + EFECTIVO)</th>
          <tr>
          <td>$ {{$branch->total }} </td></tr>
        </tr>
        <tr>
          <th>VENTA TARJETA</th>
          <tr>
          <td> $ {{$branch->tarjeta }} </td></tr>
        </tr>
        <tr>
          <th>VENTA EFECTIVO</th>
          <tr>
          <td>$ {{$branch->efectivo }} </td></tr>
        </tr>
        <tr>
          <th>GASTOS SUCURSAL</th>
          <tr>
          <td>$ {{$branch->gastos }} </td></tr>
        </tr>
        <tr>
          <th> TOTAL EFECTIVO</th>
          <tr>
          <td>$ {{$branch->totalFin }} </td></tr>
        </tr>
      </table>


        </div>
  </div>
</body>

</html>
