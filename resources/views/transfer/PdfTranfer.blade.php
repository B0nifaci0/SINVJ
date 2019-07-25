<!DOCTYPE html>
<html lang="en">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Traspaso</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
     </head>
   <style>
   {
    font-family: 'Times New Roman';
}

.titulo {
    font-size: 20px;
    text-align: center;
    align-content: center;
}
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
    font-size: 30px;
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
    font-size: 8px;
    text-align: right;
    align-content: right;
}

.id {
    font-size: 8px;
    text-align: left;
    align-content: left;
}


.ticket {
    width: 200px;
    max-width: 200px;
}


@page {size: 8cm 120mm;
     }
   </style>

<body>
        @foreach ($trans as $transfer)
        <div class="ticket" id = "{{$transfer->id}}">
                <p class="titulo">TRASPASO</p>
                <p class="hora">{{$transfer->created_at->format('m/d/Y H:i:s')}}</p> 
                <p class="sucursalorigen">Sucursal  Origen................{{$transfer->lastBranch->name}}</p>
                <p class="quienlomando">Envió................{{$transfer->user->name}}</p>
                <p class="producto">{{ $transfer->product->clave }}</p>
                <p class="pesolinea">{{ $transfer->product->weigth }}.{{ $transfer->product->line->name }}</p>
                <p class="sucursaldestino">Sucursal Destino...............{{$transfer->newBranch->name}}</p>
                <p class="quienrecibe">Recibió................{{$transfer->destinationUser->name}}</p>
                <br>
                
                <p class="firma">________________
                <br>Firma</p> 
        </div>
        @endforeach
    </body>
</html>