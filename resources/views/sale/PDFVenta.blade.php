
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
                src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/d442db70-59ff-489c-a4b0-e9d66fdfdab6/d71s15s-53f5ab9d-bd41-4036-9913-37e06b069505.png/v1/fit/w_150,h_150,strp/diamante_png_by_openyourearseditions_d71s15s-150.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9NTc5IiwicGF0aCI6IlwvZlwvZDQ0MmRiNzAtNTlmZi00ODljLWE0YjAtZTlkNjZmZGZkYWI2XC9kNzFzMTVzLTUzZjVhYjlkLWJkNDEtNDAzNi05OTEzLTM3ZTA2YjA2OTUwNS5wbmciLCJ3aWR0aCI6Ijw9NjA2In1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmltYWdlLm9wZXJhdGlvbnMiXX0.SfIpPWUfzdOHhz4XcgswitZh5z9bzeYavEq_qyEJttY"
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
