<!DOCTYPE html>
<html lang="en">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Reporte de Ventas</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
     </head>
   <style>
   {
    font-size: 1px;
    font-family: 'Times New Roman';
}
@page {size: 8.3cm 230mm;
     }
   </style>

    <body>
        <div border="">
        <p align="right">{{$sale->created_at}}</p>
        <!--<h3 align="center">{{$shop->name}}</h3>-->
        <img align="left" width="100px" height="100px" src="{{$shop->image}}">
            <p>{{ $branch->name }}<br><p>
            {{ $branch->name_legal_re }}<br>
            {{ $branch->rfc }} </p>
            <p>{{ $branch->email }}</p>
            <p align="left">{{$branch ? $branch->address : ''}}<br>
            Tel:{{$branch ? $branch->phone_number : ''}}</p>
            <p align="left"><b>Folio:</b>{{$sale->folio}}</p>
            <p><b>Tipo de venta:</b>{{ ($sale->client) ? 'Mayorista' : 'General' }}</p>
            @if($sale->client)
                <p><b>Cliente:</b>{{ $sale->client->name }} {{ $sale->client->first_lastname }} {{ $sale->client->second_lastname }} </p>
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
                            <td>{{ $item->clave }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->weigth }} g</td>
                            <td>$ {{ $item->final_price }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="3"></td>
                            <td><strong>$ {{ $sale->total }}</strong></td>
                        </tr> 
                    </tbody>
            </table>
            <br>
            @if(count($sale->partials) > 0)
                <p class="centrado">Abonos a la cuenta</p>

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
            @endif 
        </div> 
        <br>
        <p class="centrado">¡GRACIAS POR SU COMPRA!</p>
        <br>
        <p class="centrado">¡ESTE NO ES UN COMPROBANTE FISCAL!</p>
    </body>
</html>
