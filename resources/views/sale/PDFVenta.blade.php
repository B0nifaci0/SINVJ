
<!DOCTYPE html>
<html lang="en">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Reporte de Ventas</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
     </head>
   <style>
   {
    font-size: 12px;
    font-family: 'Times New Roman';
}

td,
th,
tr,
table {
    border-top: 1px solid black;
    border-collapse: collapse;
}

td.producto,
th.producto {
    width: 75px;
    max-width: 75px;
}

td.productoprecio,
th.productoprecio {
    width: 75px;
    max-width: 75px;
}

td.cantidad,
th.cantidad {
    width: 20px;
    max-width: 20px;
    word-break: normal;
}


.precio {
  text-align: right;
    align-content: right;
}
.espacio {
  text-align: right;
    align-content: right;
}

.centrado {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 155px;
    max-width: 155px;
}

img {
    max-width: inherit;
    width: inherit;
}
@page {size: 7cm 190mm;
     }
   </style>

<body>
        <div class="ticket">
            <img
                src="https://image.flaticon.com/icons/png/512/131/131050.png"
                alt="Logotipo">
                <p class="centrado">Joyeria Fina
                <br>Toluca de Lerdo #1006
                <br>19/07/2019 12:33 a.m.</p>
            <table>
                <thead>
                    <!--<tr>
                        <th class="cantidad">CLAVE</th>
                        <th class="producto">PRODUCTO</th>
                        <th class="producto">PRODUCTO</th>
                        <th class="precio">TOTAL</th>
                    </tr>-->
                </thead>
                <tbody>
                    @foreach ($sales as  $sale)
                    <tr>
                        <td class="cantidad">{{ $sale->id}}</td>
                        <td class="producto">{{ $sale->product->name }}</td>
                        <td class="productoprecio">${{ $sale->product->price }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="espacio"></p>
            <p class="precio">Total: $ {{ $sale->price }}</p>
            <p class="centrado">¡GRACIAS POR SU COMPRA!
                <br>joyeriafina.com</p>
        </div>
    </body>
</html>
