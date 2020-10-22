<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Reporte de Comision de Usuario</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
</head>
<style>
  {
    font-size: 8px;
    font-family: 'Times New Roman';
  }

  img {
    width: center;
    max-width: center;
    text-align: center;
  }

  .hora {
    font-size: 10px;
    text-align: right;
    align-content: right;
  }

  @page {
    size: 8cm 190mm;
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
            <th>Nombre</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach($sales as $s)
          <tr>
            <td>{{ $s->username }}</td>
            <td>@if($s->ventas) $ {{ $s->ventas }} @else $ 0 @endif</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>
