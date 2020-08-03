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
            <h1>Reporte General Gramos y Dinero por Lineas</h1>
            <h1 style="color:red">{{$shop->name}}</h1>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Clave</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Linea</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Sucursal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $i => $product)
                    <tr>
                        <td>{{ $product->clave }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->name_line }}</td>
                        <td>{{ $product->weigth }} gr</td>
                        <td>$ {{ $product->price }}</td>
                        <td>{{ $product->name_category }}</td>
                        <td>{{ $product->name_status }}</td>
                        <td>{{ $product->name_branch }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Linea</th>
                        <th scope="col">Total de Gramos</th>
                        <th scope="col">Total Precio Venta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($totals as $i => $total)
                    <tr>
                        <td>{{$total->name}}</td>
                        <td>{{$total->total_w}} gr</td>
                        <td>$ {{$total->total_p}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

@endsection
