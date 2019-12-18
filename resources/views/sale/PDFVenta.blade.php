<!DOCTYPE html>
<html lang="en">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Reporte de Ventas</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
     </head>
   <style>
   {
    font-size: 8px;
    font-family: 'Times New Roman';
}

td,
th,
tr,
table {
    border-collapse: collapse;
}

td.sucursal{
    width: 85px;
    max-width: 85px;
    text-align: left;
}
td.nota{
    width: 85px;
    max-width: 85px;
    text-align: left;
}
td.fecha{
    width: 85px;
    max-width: 85px;
    text-align: left;
}
td.hora{
    width: 85px;
    max-width: 85px;
    text-align: left;
}
td.cliente {
    width: 85px;
    max-width: 85px;
    text-align: left;
}
td.vendedor {
    width: 85px;
    max-width: 85px;
    text-align: left;
}


td.sucursal1 {
    width: 85px;
    max-width: 85px;
    text-align: right;
}

td.nota1 {
    width: 85px;
    max-width: 85px;
    text-align: right;
}

td.fecha1 {
    width: 85px;
    max-width: 85px;
    text-align: right;
}

td.hora1 {
    width: 85px;
    max-width: 85px;
    text-align: right;
}


td.cliente1{
    width: 85px;
    max-width: 85px;
    text-align: right;
}
td.vendedor1{
    width: 85px;
    max-width: 85px;
    text-align: right;
}

th.clave{
    width: 80px;
    max-width: 80px;
    text-align: left;
}

th.producto{
    width: 80px;
    max-width: 80px;
    text-align: left;
}

th.precio{
    width: 80px;
    max-width: 80px;
    text-align: left;
}

td.clave1{
    width: 80px;
    max-width: 80px;
    text-align: left;
}

td.producto1{
    width: 80px;
    max-width: 80px;
    text-align: left;
}

td.precio1{
    width: 80px;
    max-width: 80px;
    text-align: left;
}


.centrado {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 200px;
    max-width: 200px;
}

img {
    width: center ;
    max-width: center;
    text-align: center;
}
@page {size: 8cm 220mm;
     }
   </style>

    <body>
        <div border="">
        <img 
            align = "left"
            width="90px"
            height="90px"
            <img align="left" width="90px" height="90px" src="{{ $shop->image }}">
            alt="Logotipo"
            ></p>
            <p>
            {{$branch ? $branch->name : ''}}<br>
            {{$branch ? $branch->name_legal_re : ''}}<br>
            {{$branch ? $branch->rfc : ''}}<br> 
            {{$branch ? $branch->email : ''}}</p><br>
            <p>{{$branch ? $branch->address : ''}}
            Tel:{{$branch ? $branch->phone_number : ''}}</p>
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
