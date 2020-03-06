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

    .producto {
        font-weight: bold;
        font-size: 15px;
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
        /* padding-top: 0px;
        padding-bottom: 0px; */
    }

    /* .ticket {
        width: 120px;
        max-width: 120px;
    } */

    @page {
        size: 5.5cm 150mm;
    }
</style>

<body>
    <img class="img-responsive " width="140px" height="120px" src="{{ $shop->image }}">
    @foreach ($trans as $transfer)
    <div class="ticket" id="{{$transfer->id}}">
        <p class="hora">{{$transfer->created_at->format('m/d/Y H:i:s')}}</p>
        <p class="text-center">Origen</p>
        <p class="text-center">{{$transfer->lastBranch->name}}</p>
        <p class="text-center">{{$transfer->user->name}}</p>
        <p class="producto">{{ $transfer->product->clave }}</p>
        {{-- <p class="text-center">{{ $transfer->product->weigth }}
        gr,{{ $transfer->product->line ? $transfer->product->line->name : '' }}</p> --}}
        <p class="text-center">Destino</p>
        <p class="text-center">{{$transfer->newBranch->name}}</p>
        <p class="text-center">{{$transfer->destinationUser->name}}</p>
        <br>
        <p class="firma">________________
            <br>Firma</p>
        @if ($transfer->status_product == 1)
        <p class="font-weight-bold text-center"> <strong>Entregado</strong></p>
        @elseif($transfer->status_product === 0)
        <p class="font-weight-bold text-center"> <strong>Rechazado</strong></p>
        @elseif($transfer->status_product === 3)
        <p class="font-weight-bold text-center"> <strong>Devuelto</strong></p>
        @endif
    </div>
    @endforeach
</body>

</html>
