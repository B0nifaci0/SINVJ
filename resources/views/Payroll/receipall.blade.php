<!DOCTYPE html>
<html lang="en">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Recibo de Nomina</title>
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
.tienda {
    font-size: 13px;
    text-align: center;
    align-content: center;
}
.msg1 {
    font-size: 13px;
    text-align: center;
    align-content: center;
}

.date {
    font-size: 10px;
    text-align: center;
    align-content: center;
}
.msg2 {

    font-size: 12px;
    text-align: center;
    align-content: center;
}
.recibi {
    font-size: 10px;
    text-align: center;
    align-content: center;
}

.ticket {
    width: 200px;
    max-width: 200px;
}


@page {size: 8cm 120mm;
     }
   </style>

<body>
        <div class="recibo">
                @foreach($users as $user)  
                <p class="titulo" >RECIBO DE NOMINA</p>
                <p class="tienda" align="center">{{$user->shop->name}}</p> 
                <p class="msg1">Yo {{$user->name}} recibí la cantidad de $ {{$user->salary}}  <br> Por concepto del pago de mi nómina de la semana.</p>
                <p class="date"> Fecha {{$date}}</p>
                <p class="msg2"> Manifiesto expresamente que hasta la fecha de hoy. No se me adeuda nomina alguna.</p>
                <br>
                <table align="center">
                    <tr>
                        <th><p class="recibi">______________</p></th>
                        <th><p class="recibi">______________</p></th>
                    </tr>
                    <tr align="center">
                    <th><p class="recibi">Recibí</p></th>
                    <th><p class="recibi">Autorizo</p></th>
                    </tr>
                    <tr>
                        <th><p class="recibi"> Nombre y Firma </p></th>
                        <th><p class="recibi"> Nombre y Firma </p></th>
                    </tr>  
                </table>
                @endforeach
        </div>

    </body>
</html>