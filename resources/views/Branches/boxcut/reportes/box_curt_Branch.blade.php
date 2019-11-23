<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Corte sucursal </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
  <style>
    @media print {

      html,
      body {
        font-size: 9.5pt;
        margin: 0;
        padding: 0;
      }

      .page-break {
        page-break-before: always;
        width: auto;
        margin: auto;
      }
    }

    .page-break {
      width: 980px;
      margin: 0 auto;
    }

    .sale-head {
      margin: 40px 0;
      text-align: center;
    }

    .sale-head h1,
    .sale-head strong {
      padding: 10px 20px;
      display: block;
    }

    .sale-head h1 {
      margin: 0;
      border-bottom: 1px solid #212121;
    }

    table,
    th,
    td {
      border: 1px solid black;
      border-collapse: collapse;
    }

    .table>thead:first-child>tr:first-child>th {
      border-top: 1px solid #000;
    }

    th,
    td {
      padding: 5px;
      text-align: center;
    }

    table tbody tr td {
      vertical-align: middle;
    }

    .sale-head h1,
    table thead tr th,
    table tfoot tr td {
      background-color: #f8f8f8;
    }

    tfoot {
      color: #000;
      text-transform: uppercase;
      font-weight: 500;
    }
  </style>
</head>

<body>
  <div class="page-content">
    <div class="panel">
      <div class="panel">
          <img 
          align = "left"
          width="100px"
          height="100px"
          src="https://images.vexels.com/media/users/3/151690/isolated/preview/be2ec10fa7ff133565ba9a4bc65aae6c-icono-de-trazo-de-piedra-preciosa-de-diamante-by-vexels.png"
          alt="Logotipo"
          >
        <p align="right">Fecha: {{$branch-> date}}</p>
        <p align="right">Hora: {{$branch-> hour}}</p>
        <h2 align="center">Reporte Corte Por Sucursal {{$branch ->name}}
      </div>
      <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
        <tr>
          <th>TOTAL TARJETA</th>
          <td> $ {{$branch->tarjeta }} </td>
        </tr>
        <tr>
          <th>TOTAL EFECTIVO</th>
          <td>$ {{$branch->efectivo }} </td>
        </tr>
        <tr>
          <th>TOTAL TARJETA-EFECTIVO</th>
          <td>$ {{$branch->total }} </td>
        </tr>
        <tr>
          <th>GASTOS SUCURSAL</th>
          <td>$ {{$branch->total }} </td>
        </tr>
        <tr>
          <th>TOTAL EFECTIVO-GASTOS</th>
          <td>$ {{$branch->total }} </td>
        </tr>
      </table>
    </div>
  </div>
</body>

</html>