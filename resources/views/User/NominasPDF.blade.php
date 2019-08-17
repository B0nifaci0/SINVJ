<!DOCTYPE html>
<html lang="en">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Reporte de Nominas</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
   <style>
   {
    font-family: 'Times New Roman';
}

.texto {
    font-size: 13px;
    text-align: justify;
}

.fecha {
    font-size: 9px;
    text-align: right;
    align-content: right;
}
.fecha1 {
    font-size: 9px;
    text-align: right;
    align-content: right;
}

.recibo {
    font-size: 15px;
    text-align: center;
    align-content: center;
}
.nomina {
    font-size: 14px;
    text-align: center;
    align-content: center;
}

.ticket {
    width: 110px;
    max-width: 110px;
}


@page {size: 5.5cm 140mm;
     }
   </style>
</head>
<body>
    <div class="ticket">
        <p class="fecha">{{$dates}}</p>
        <p class="fecha1">{{$hour}}</p>
      <p class="recibo">RECIBO</p>
      <p  class="nomina" >Nomina</p>
      <br>
      <p class="texto">Empleado {{$users -> name}} el salario es $ {{$salary}} por semana, trabajo {{$hoy}} semanas
        El pago total fue de : $ {{$nomina}}</p> 
     </div>
  </body>
</html>
