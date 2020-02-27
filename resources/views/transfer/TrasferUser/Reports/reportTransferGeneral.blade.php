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
    <div class="container-fluid">
        <div class="row">
            <div class="col-">
                <img align="left" width="90px" height="90px" src="{{ $shop->image }}">
                <p align="right">Fecha: {{$dates}}</p>
                <p align="right">Hora: {{$hour}}</p>
                <h2 align="center">Reporte General Traspasos
                    {{$type==0 ? 'Entrantes' : 'Salientes'}}
                    {{$categoria==2 ? 'por Gr' : 'por Pz'}}
                </h2>
                <h3 align="center" style="color:red">{{$shop->name}}</h3>
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Categoria</th>
                            @foreach ($trans as $transf)
                            @if($categoria == 2)
                            <th>Peso</th>
                            @break;
                            @endif
                            @endforeach
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Sucursal Origen</th>
                            <th>Quien lo mando</th>
                            <th>Quien recibé</th>
                            <th>Sucursal Destino</th>
                            <th>Estatus</th>
                            <th>Fecha actualizacion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trans as $transfer)
                        @if($categoria == $transfer->product->category->type_product)
                        <tr>
                            <td>{{ $transfer->product->clave }}</td>
                            <td>{{ $transfer->product->category->name }}</td>
                            @if($transfer->product->category->type_product == 2 )
                            <td>{{ $transfer->product->weigth }} gr</td>
                            @endif
                            <td>{{ $transfer->product->description }}</td>
                            <td>{{$transfer->product->price}}</td>
                            <td>{{$transfer->lastBranch->name}}</td>
                            <td>{{$transfer->user->name}}</td>
                            <td>{{$transfer->destinationUser->name}}</td>
                            <td>{{$transfer->newBranch->name}}</td>
                            @if($transfer->status_product === 1)
                            <td>Por pagar</td>
                            @elseif($transfer->status_product === 0)
                            <td>Rechazado</td>
                            @else
                            <td>Pendiente</td>
                            @endif
                            <td>{{$transfer->updated_at->format('m-d-Y')}}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
