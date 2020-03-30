<!DOCTYPE html>
<html lang="en">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Reporte de Comision de Usuario</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
     </head>
   <style>
   {
    font-size: 8px;
    font-family: 'Times New Roman';
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
@page {size: 8cm 190mm;
     }
   </style>
</head>
<body>
<div class="page-content">


<div border="">
    <img class="img-responsive" width="140px" height="120px" src="{{ $shop->image }}">

    <table class="table-sm table-bordered" width="100%">
      <thead>
        <tr>
          <th>De la fecha:</th>
          <th>A la fecha:</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$fecini->format('d/m/Y')}}</td>
          <td>{{$fecter->format('d/m/Y')}}</td>
        </tr>
      </tbody>
    </table>
    @foreach($branches as $branch)

    <p class="text-center">Sucursal: {{$branch->name}}</p>
    @endforeach
            <table class="table-sm table-bordered" width="100%">
              <thead>
                <tr>
                  <th>Sucursal</th>
                  <th>Total</th>
                </tr>
              </thead>
            <tbody>
            @foreach($sales as $s)
            <tr>
            @foreach($branches as $branch)
              <td>{{$branch->name}}</td>
            @endforeach
              <td>@if($s->ventas) $ {{ $s->ventas }} @else $ 0 @endif</td>
            </tr>
            @endforeach
            </tbody>
            </table>
        </div>
          </div>
    </body>
</html>
