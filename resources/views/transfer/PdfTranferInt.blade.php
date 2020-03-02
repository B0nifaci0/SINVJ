<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Traspaso</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
</head>
<style>
    {
        font-size: 8px;
        font-family: 'Times New Roman';
    }

    /* .titulo {
        font-size: 20px;
        text-align: center;
        align-content: center;
    } */

    .sucursalorigen {
        font-size: 13px;
        text-align: center;
        align-content: center;
    }

    .quienlomando {
        font-size: 13px;
        text-align: center;
        align-content: center;
    }

    .producto {
        font-weight: bold;
        font-size: 15px;
        text-align: center;
        align-content: center;
    }

    .pesolinea {
        font-weight: bold;
        font-size: 13px;
        text-align: center;
        align-content: center;
    }

    .sucursaldestino {
        font-size: 13px;
        text-align: center;
        align-content: center;
    }

    .quienrecibe {
        font-size: 13px;
        text-align: center;
        align-content: center;
    }

    .firma {
        font-size: 13px;
        text-align: center;
        align-content: center;
    }

    .hora {
        font-size: 10px;
        text-align: right;
        align-content: right;
    }

    .id {
        font-size: 8px;
        text-align: left;
        align-content: left;
    }

    .ticket {
        width: 120px;
        max-width: 120px;
    }

    @page {
        size: 5.5cm 170mm;
    }
</style>

<body>
    <img class="img-responsive " width="140px" height="120px" src="{{ $shop->image }}">
    @foreach ($trans as $transfer)
    <div class="ticket" id="{{$transfer->id}}">
        {{-- <p class="titulo">TRASPASO</p> --}}
        <p class="hora">{{$transfer->created_at->format('m/d/Y H:i:s')}}</p>
        <br>
        <p align="center">Origen........{{$transfer->lastBranch->name}}</p>
        <p align="center">Envió............{{$transfer->user->name}}</p>
        @if ($transfer->status_product == 1)
        <p class="font-weight-bold" align="center"> <strong>Recibido</strong></p>
        @elseif($transfer->status_product === 0)
        <p class="font-weight-bold" align="center"> <strong>Rechazado</strong></p>
        @elseif($transfer->status_product === 3)
        <p class="font-weight-bold" align="center"> <strong>Devuelto</strong></p>
        @endif
        <p class="producto">{{ $transfer->product->clave }}</p>
        {{-- <p align="center">{{ $transfer->product->weigth }}
            gr,{{ $transfer->product->line ? $transfer->product->line->name : '' }}</p> --}}
        <p align="center">Destino........{{$transfer->newBranch->name}}</p>
        <p align="center">Recibió.............{{$transfer->destinationUser->name}}</p>
        <br>
        <p class="firma">________________
            <br>Firma</p>
    </div>
    @endforeach
</body>

</html>