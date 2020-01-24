<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Reporte de Productos</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
  <style>
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

    .table>thead:first-child>tr:first-child>th {
      border-top: 1px solid #000;
    }

    table thead tr th {
      text-align: center;
      border: 1px solid #ededed;
    }

    table tbody tr td {
      vertical-align: middle;
    }

    .sale-head,
    table.table thead tr th,
    table tbody tr td,
    table tfoot tr td {
      border: 1px solid #212121;
    }

  </style>
</head>

<body>
  <div class="page-content">
    <div class="panel">
      <img align="left" width="140px" height="120px" src="{{ $shop->image }}">
      <p align="right">Fecha: {{$dates}}</p>
      <p align="right">Hora: {{$hour}}</p>
    <h2 align="center">Reporte General Estatus por
      @if($categoria == 1)
      Pz
      @else
      Gr
      @endif
    </h2>
      <h3 align="center" style="color:red">{{$shop->name}}</h3>
      <table class="table table-condensed table-hover table-striped ">
        <thead>
          <tr>
            <th scope="col">Clave</th>
            <th scope="col">Categoria</th>
            <th scope="col">Estatus</th>
            <th scope="col">Descripción</th>
            @if ($categoria == 2)
            <th scope="col">Linea</th>
            <th scope="col">Peso</th>
            @endif
            <th scope="col">Precio</th>
            <th scope="col">Observaciones</th>
            <th>Fecha de Alta</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($productsg as $i => $product)
          <tr id="row{{$product->id}}">
            <td>{{ $product->clave }}</td>
            <td>{{ $product->name_category }}</td>
            <td>{{ $product->name_status }}</td>
            <td>{{ $product->description }}</td>
            @if ($categoria == 2)
            <td>{{ ($product->name_line) ? $product->name_line : ''}}</td>
            <td>{{ ($product->weigth) ? $product->weigth : ''}} gr</td>
            @endif
            <td>$ {{ $product->price }}</td>
            <td>{{ $product->observations }}</td>
            <td>{{date_format($product->created_at, 'd/m/y')}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <br>
      <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
        <thead>
          <tr>
            @foreach ($productsg as $i => $product)
            @if($product->type_product == 2 )
            <th scope="col">Total de Gramos</th>
            @break
            @endif
            @endforeach
            <th scope="col">Total precio Venta</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            @foreach ($productsg as $i => $product)
            @if($product->type_product == 2 )
            <td align="center">{{$total}} gr</td>
            @break
            @endif
            @endforeach
            <td align="center">$ {{$cash}}</td>
          </tr>
        </tbody>
        <br>
      </table>
    </div>
  </div>
</body>

</html>
