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
body{
    font-size: 12px;
}

td,
th,
tr,
table {
    border-collapse: collapse;
}

td.sucursal{
    width: 50px;
    max-width: 50px;
    text-align: left;
}
td.nota{
    width: 50px;
    max-width: 50px;
    text-align: left;
}
td.fecha{
    width: 50px;
    max-width: 50px;
    text-align: left;
}
td.hora{
    width: 50px;
    max-width: 50px;
    text-align: left;
}
td.cliente {
    width: 50px;
    max-width: 50px;
    text-align: left;
}
td.vendedor {
    width: 50px;
    max-width: 50px;
    text-align: left;
}


td.sucursal1 {
    width: 50px;
    max-width: 50px;
    text-align: right;
}

td.nota1 {
    width: 50px;
    max-width: 50px;
    text-align: right;
}

td.fecha1 {
    width: 50px;
    max-width: 50px;
    text-align: right;
}

td.hora1 {
    width: 50px;
    max-width: 50px;
    text-align: right;
}


td.cliente1{
    width: 50px;
    max-width: 50px;
    text-align: right;
}
td.vendedor1{
    width: 50px;
    max-width: 50px;
    text-align: right;
}

th.clave{
    width: center ;
    max-width: center;
    text-align: left;
}

th.producto{
    width: center ;
    max-width: center;
    text-align: left;
    
}

th.precio{
    width: center ;
    max-width: center;
    text-align: left;
    
}

td.clave1{
    width: center ;
    max-width: center;
    text-align: center;
    
}

td.producto1{
    width: center ;
    max-width: center;
    text-align: center;
    
}

td.precio1{
    width: center ;
    max-width: center;
    text-align: center;
    
}


.centrado {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 120px;
    max-width: 190px;
}

img {
    width: center ;
    max-width: center;
    text-align: center;
}
@page {size: 5.5cm 25cm;
     }
   </style>

<body>
        <div class="ticket">
            <img
                src="https://images.vexels.com/media/users/3/151701/isolated/preview/b46f3c41fa0350842e75ac9450c64789-icono-de-golpe-de-diamante-by-vexels.png"
                alt="Logotipo">
                <p class="centrado">@foreach ($shops as  $shop) 
                {{ $shop->name}}
                <br>Toluca de Lerdo #1006</p>
                <br>
            <table>
                <tbody>
                    <tr>
                    <td class="sucursal">Sucursal:</td>
                    <td class="sucursal1">{{ $branch->name}}</td>
                    </tr>
                    @foreach ($sales as  $sale)
                    <tr>
                        <td class="nota">Nota no.:</td>
                        <td class="nota1">{{ $sale->id}}</td>
                    </tr>
                    <tr>
                        <td class="fecha">Fecha:</td>
                        <td class="fecha1">{{ $sale->created_at->format('m/d/Y')}}</td>
                    </tr>
                    <tr>
                        <td class="hora">Hora:</td>
                        <td class="hora1">{{ $sale->created_at->format('H:i:s')}}</td>
                    </tr>
                    <tr>
                        <td class="cliente">Cliente:</td>
                        <td class="cliente1">{{ $sale->customer_name }}</td>
                    </tr>
                    <tr>
                        <td class="vendedor">Vendedor:</td>
                        <td class="vendedor1">{{Auth::user()->name}}</td>
                    </tr>
                    </tbody>
                   </table>
                   <br>
                   <table>
                    <tbody>
                      <tr>
                        <th class="clave">Clave</th>
                        <th class="producto">Producto</th>
                        <th class="precio">Precio</th>
                      </tr>
                      <tr>
                        <td class="clave1">1</td>
                        <td class="producto1">{{ $sale->product->name }}</td>
                        <td class="precio1">${{ $sale->product->price }}</td>
                     </tr>
                     <tr>
                        <td ></td>
                        <th >Total</th>
                        <td class="precio1">${{ $sale->price }}</td>>
                     </tr>
                    </tbody>
                  </table>
                    @endforeach
                    <br>
            <p class="centrado">¡GRACIAS POR SU COMPRA!
                <br>{{$shop->email }}<br>
                {{$shop->phone_number }}</p>
                @endforeach
        </div>
    </body>
</html>
