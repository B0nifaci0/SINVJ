<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Reporte de Productos</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
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
      <img align="left" width="140px" height="120px" src="{{ $shop->image }}">
      <p align="right">Fecha: {{$dates}}</p>
      <p align="right">Hora: {{$hour}}</p>
      <h2 align="center">Reporte {{$estado->name}}s por
          @foreach ($products as $i => $product)
          @if($product->category->type_product == 2 )
          Gr
          @else
          Pz
          @endif
          @break;
          @endforeach
      </h2>
      <h3 align="center" style="color:red"> @if($estado->name == 'Traspaso') Destino: @endif @foreach($branches as $branch){{$branch->name}} @endforeach</h3>
      <h4 align="center" >Linea:
        @foreach ($products as $i => $product)
        @if($product->category->type_product == 2 )
        {{ $product->line->name }}
        @endif
        @break
        @endforeach </h4>
      <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
        <thead>
          <tr>
            <th>Clave</th>
            <th>Categoria</th>
            @foreach ($products as $i => $product)
            @if($product->category->type_product == 2 )
            <th>Peso</th>
                @break;
            @endif
            @endforeach
            <th>Descripción</th>
            <th>Precio</th>
            <th>Fecha alta</th>
            @if ($estado->name == 'Traspaso')
            <th>Sucursal Origen</th>
            <th>Quien lo mando</th>
            <th>Quien recibio</th>
            <th>Fecha</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $i => $product)
          <tr id="row{{$product->id}}">
              <td>{{ $product->clave }}</td>
            <td>{{ $product->category->name }}</td>
            @if($product->category->type_product == 2 )
            <td>{{ $product->weigth }} gr</td>
            @endif
            <td>{{ $product->description }}</td>
            @if ($estado->name != 'Vendido')
            <td>$ {{$product->price }}</td>
            @else
            @foreach ($detalle as $det)
            @if($det->product_id == $product->id)
            <td>$ {{$det->final_price}}</td>
            @endif
            @endforeach
            @endif
          <td>{{date_format($product->created_at, 'd/m/y')}}</td>
            @if ($estado->name == 'Traspaso')
            @foreach ($trans as $transfer)
            @if ($product->id == $transfer->product_id)
            <td>{{$transfer->lastBranch->name}}</td>
            <td>{{$transfer->user->name}}</td>
            <td>{{$transfer->destinationUser->name}}</td>
            <td>{{$transfer->created_at->format('m-d-Y')}}</td>
            @break;
            @endif
            @endforeach
            @endif
          </tr>
          @endforeach
        </tbody>
      </table>
      <br>
      <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
        <thead>
          <tr>
              @foreach ($products as $product)
              @if($product->category->type_product == 2 )
              <th scope="col">Total de Gramos</th>
              @break
              @endif
              @endforeach
            <th scope="col">Total Precio Compra</th>
            @foreach ($products as $product)
            @if ($estado->name == 'Vendido')
            <th scope="col">Total precio Venta</th>
            @break
            @endif
            @endforeach
          </tr>
        </thead>
        <tbody>
          <tr>
            @foreach ($products as $product)
            @if($product->category->type_product == 2 )
            <td align="center">{{$total}} gr</td>
            @break
            @endif
            @endforeach
            <td align="center">$ {{$compra}}</td>
            @foreach ($products as $product)
            @if ($estado->name == 'Vendido')
            <td align="center">$ {{$venta}}</td>
            @break
            @endif
            @endforeach
          </tr>
        </tbody>
        <br>
      </table>
      @if ($estado->name == 'Vendido')
      <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
        <thead>
          <tr>
            <th scope="col">Utilidad</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td align="center">$ {{$utilidad}}</td>
          </tr>
        </tbody>
      </table>
      @endif
    </div>
  </div>
</body>
</html>
