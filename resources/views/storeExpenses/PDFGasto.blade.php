<!DOCTYPE html>
<html lang="en">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Ticket de Gasto</title>
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
@page {size: 7cm 150mm;
     }
   </style>

    <body>
        <div border="">
        <img 
            align = "left"
            width="100px"
            height="100px"
            src="https://images.vexels.com/media/users/3/151690/isolated/preview/be2ec10fa7ff133565ba9a4bc65aae6c-icono-de-trazo-de-piedra-preciosa-de-diamante-by-vexels.png"
            alt="Logotipo"
            

            <p class="centrado">¡COMPROBANTE DE GASTO!
                <br align= "right">joyeriafina.com
            </p><br>  
            <br> 
            <p><b>Tienda:</b> {{$shop->name}}</p><br>
            <table class="table-sm table-bordered">
            @foreach($expense as $expense)
            <tr>
               <th> Sucursal:</th><td>{{$expense->branch->name}}</td>
            </tr>
            <tr>
               <th>Clave:</th><td>{{$expense->id}}</td>
            </tr>
            <tr>
               <th>Nombre:</th><td>{{$expense->name}}</td>
            </tr>
            <tr>
               <th>Descripcion:</th><td>{{$expense->descripcion}}</td>
            </tr>
            <tr>
               <th>Total Del Gasto:</th><td> ${{$expense->price}}</td>
            </tr>
           @endforeach
           </table>
            <br>
        </div>  
    </body>
</html>
