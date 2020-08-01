<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Reporte general estatus gr</title>

        <style>
            . {
                font: 12px/1.4 "Helvetica Neue", Helvetica, Arial, sans-serif;
            }

            table {
                border-collapse: separate;
                border-spacing: 0;
                color: #4a4a4d;
                table-layout: fixed;
                width: 100%;
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

            th:first-child {
                border-top-left-radius: 5px;
                text-align: left;
            }

            th:last-child {
                border-top-right-radius: 5px;
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

            tfoot tr:last-child td:first-child {
                border-bottom-left-radius: 5px;
            }

            tfoot tr:last-child td:last-child {
                border-bottom-right-radius: 5px;
            }
        </style>
    </head>

    <body>
        <div>
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
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th width="11%">Categoria</th>
                        <th width="10%">Estatus</th>
                        <th width="16%">Descripción</th>
                        @if ($categoria == 2)
                        <th>Linea</th>
                        <th>Peso</th>
                        @endif
                        <th>Precio</th>
                        <th width="15%">Observaciones</th>
                        <th>Fecha de Alta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productsg as $i => $product)
                    <tr>
                        <td>{{ $product->clave }}</td>
                        <td>{{ $product->name_category }}</td>
                        <td>{{ $product->name_status }}</td>
                        <td>{{ $product->description }}</td>
                        @if ($categoria == 2)
                        <td>{{ ($product->name_line) ? $product->name_line : ''}}</td>
                        <td>{{ ($product->weigth) ? $product->weigth : ''}}</td>
                        @endif
                        <td>$ {{ $product->price }}</td>
                        <td>{{ $product->observations }}</td>
                        <td>{{date_format($product->created_at, 'd/m/y')}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <table>
                <thead>
                    <tr>
                        @foreach ($productsg as $i => $product)
                        @if($product->type_product == 2 )
                        <th>Total de Gramos</th>
                        @break
                        @endif
                        @endforeach
                        <th>Total precio Venta</th>
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
    </body>

</html>
