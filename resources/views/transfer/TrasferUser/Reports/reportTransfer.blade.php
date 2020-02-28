<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Reporte de Productos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
    <style>
        table tbody tr td {
            vertical-align: middle;
        }

        table.table thead tr th,
        table tbody tr td,
        table tfoot tr td {
            border: 1px solid #212121;
        }

        table thead tr th,
        table tfoot tr td {
            background-color: #f8f8f8;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-">
                <img align="left" width="140px" height="120px" src="{{ $shop->image }}">
                <p align="right">Fecha: {{$dates}}</p>
                <p align="right">Hora: {{$hour}}</p>
                <h2 align="center">Reporte Traspasos
                    {{$type==0 ? 'Entrantes' : 'Salientes'}}
                    @if($estado == 1)
                    Por pagar
                    @elseif($estado == 3)
                    Devuelto
                    @elseif($estado == 4)
                    Pagado
                    @elseif($estado === '0')
                    Rechazado
                    @else
                    Pendiente
                    @endif
                    {{$categoria==2 ? 'por Gr' : 'por Pz'}}
                </h2>
                <h3 align="center" style="color:red">Sucursal: {{$branch}}</h3>
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Categoria</th>
                            @if($categoria == 2)
                            <th>Peso (gr)</th>
                            @endif
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Origen</th>
                            <th>Quien mando</th>
                            <th>Quien recibé</th>
                            <th>Destino</th>
                            <th>Estatus</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trans as $transfer)
                        @if($categoria == $transfer->product->category->type_product)
                        <tr>
                            <td>{{ $transfer->product->clave }}</td>
                            <td>{{ $transfer->product->category->name }}</td>
                            @if($transfer->product->category->type_product == 2 )
                            <td>{{ $transfer->product->weigth }}</td>
                            @endif
                            <td>{{ $transfer->product->description }}</td>
                            <td> {{$transfer->product->price}}</td>
                            <td>{{$transfer->lastBranch->name}}</td>
                            <td>{{$transfer->user->name}}</td>
                            <td>{{$transfer->destinationUser->name}}</td>
                            <td>{{$transfer->newBranch->name}} {{ $transfer->status_product }}</td>
                            @if($transfer->status_product == 1)
                            <td>{{$transfer->paid_at ? 'Pagado' : 'Por Pagar'}}</td>
                            @elseif($transfer->status_product == 3)
                            <td>Devuelto</td>
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
