@extends('layouts.pdf')

@section('body')

<body>
    <div>
        <div>
            <img src="{{ $shop->image }}">
            <div class="date">
                <p>Fecha: {{$dates}} </p>
                <p>Hora: {{$hour}}</p>
            </div>
        </div>
        <div>
            <h1>Reporte de Productos Pzs</h1>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Clave</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio Compra</th>
                        <th scope="col">Precio Venta</th>
                        <th scope="col">Observaciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($productos as $i => $productos)
                    <tr>
                        <td>{{ $productos->clave }}</td>
                        <td>{{ $productos->status->name }}</td>
                        <td>{{ $productos->description }}</td>
                        <td>{{ $productos->price_purchase }}</td>
                        <td>{{$productos->pricepzt}}</td>
                        <td>{{ $productos->observations }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Total Precio Compra</th>
                        <th scope="col">Total Precio Venta</th>
                        <th scope="col">Desc= {{$adescuento}}% - TPV = ${{$sumprice}}</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>${{$sumprice_purchase}}</td>
                        <td>${{$sumprice}}</td>
                        <td>${{$total}}</td>
                    </tr>
                </tbody>
                <br>
            </table>
        </div>
    </div>
</body>

</html>

@endsection
