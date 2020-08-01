<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Reporte de Productos</title>

        <style>
            . {
                font: 12px/1.4 "Helvetica Neue", Helvetica, Arial, sans-serif;
            }

            h1 {
                text-align: center;
                margin-top: 55px;
            }

            img {

                float: left;
                width: 140px;
                height: 120px;

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
            <div>
                <img src="{{ $shop->image }}">
                <p align="right">Fecha: {{$dates}} </p>
                <p align="right">Hora: {{$hour}}</p>
            </div>
            <div>
                <h1>Productos {{$shop->name}}</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th width="15%">Descripción</th>
                            <th>Peso</th>
                            <th width="18%">Observaciónes</th>
                            <th>Categoría</th>
                            <th>Linea</th>
                            <th>Sucursal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $i => $product)
                        <tr>
                            <td>{{ $product->clave }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ ($product) ? $product->weigth: ""}}</td>
                            <td>{{ $product->observations }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ ($product->line ? $product->line->name:"")}}</td>
                            <td>{{ ($product->branch) ? $product->branch->name:""}}</td>
                            <td>{{ $product->status->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>

</html>
