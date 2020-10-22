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
@page {size: 8cm 150mm;
     }
   </style>

    <body>
        <p align= "right">Fecha: {{$date}}</p>
        <p align= "right">Hora: {{$hour}}</p>
        <div border="">
        <img class="img-responsive " width="120px" height="140px" src="{{ $shop->image }}">
             
            <p><b>Tienda:</b> {{$shop->name}}</p><br>
            <table align="center" class="table-sm table-bordered">
            @foreach($expense as $expense)
            <tr>
               <th> Sucursal:</th><td>{{ ($expense->branch == null) ? $expense->shop->name : $expense->branch->name }}</td>
            </tr>
            <tr>
               <th>Nombre:</th><td>{{$expense->name}}</td>
            </tr>
            <tr>
               <th>Descripción:</th><td>{{$expense->descripcion}}</td>
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
