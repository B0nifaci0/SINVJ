<!DOCTYPE html>
<html lang="en">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Reporte de Ventas</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
     </head>
   <style>
 .cuerpo{
    font-size: 12px;
    font-family: 'Times New Roman';
}
@page {size: 8.3cm 250mm;
     }
   </style>

    <body>
        <div border="">
        <img align="right" width="200px" height="100px" src="{{$shop->image}}"><br>
         <p align="center">{{$sale->created_at}}</p>
            <p align="center">Suc:{{$branch->name}},
            {{ $branch->name_legal_re }}<br>
            RFC:{{ $branch->rfc }} <br>
            Email:{{ $branch->email }}<br>
            <p align="center"> Direccion:{{$branch ? $branch->address : ''}}<br>
            Tel:{{$branch ? $branch->phone_number : ''}}</p>
            <p align="left"><b>Folio:</b>{{$sale->folio}}</p>
            <p><b>Tipo de venta: </b>{{ ($sale->client) ? 'Mayorista' : 'General' }}</p>
            @if($sale->client)
                <p><b>Cliente: </b>{{ $sale->client->name }} {{ $sale->client->first_lastname }} {{ $sale->client->second_lastname }} </p>
            @else
                <p>{{ $sale->customer_name }}</p>
            @endif

            <table class="table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Descripción</th>
                            <th>Peso</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->itemsSold as $item)
                        <tr>
                            <td class='cuerpo'>{{ $item->clave }}</td>
                            <td class='cuerpo'>{{ $item->description }}</td>
                            <td class='cuerpo'>{{ $item->weigth }} g</td>
                            <td class='cuerpo'>$ {{ $item->final_price }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">Total a pagar</td>
                            <td><strong> ${{ $sale->total }}</strong></td>
                        </tr> 
                    </tbody>
            </table>
            <br>
            @if($sale->partials->sum('amount') < $sale->total || $sale->partials->count() > 1)
                <p class="centrado">Abonos a la cuenta</p>
                @endif

                <table class="table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Tipo de pago</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sale->partials as $partial)
                            <tr>
                                <td>{{ $partial->created_at }}</td>
                                <td>{{ ($partial->type === "1") ? 'Efectivo' : 'Tarjeta' }} </td>
                                <td>$ {{ $partial->amount }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="2"></td>
                                <td><strong>$ {{ $sale->partials->sum('amount') }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2">Restan</td>
                                <td><strong>$ {{ $sale->total - $sale->partials->sum('amount') }}</strong></td>
                            </tr>
                        </tbody>
                </table>
        </div> 
        <br>
        <p align="center">¡GRACIAS POR SU COMPRA!</p>
        <p align="center">¡ESTE NO ES UN COMPROBANTE FISCAL!</p>
        <p align="justify">Si requiere factura favor de enviar sus datos fiscales al correo: <b>{{$branch->email}}</p>
    </body>
</html>
