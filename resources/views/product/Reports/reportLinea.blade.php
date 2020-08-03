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
        <h1>Reporte de Productos por Gramos y Dinero</h1>
        <h1>Linea: @foreach($lines as $line){{$line->name}} @endforeach</h1>
        <h1 style="color:red">Sucursal: @foreach($branches as $branch){{$branch->name}} @endforeach</h1>
        <table>
            <thead>
                <tr>
                    <th scope="col">Clave</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Estatus</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($products as $i => $product)
                <tr ">
                    <td>{{ $product->clave }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->weigth }} gr</td>
                    <td>$ {{ $product->price }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->status->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <table>
            <thead>
                <tr>
                    <th scope=" col">Total de Gramos</th>
                    <th scope="col">Dinero por P/C</th>
                    <th scope="col">Dinero de P/V</th>
                </tr>
                </thead>
            <tbody>
                <tr>
                    <td>{{$total}} gr</td>
                    <td>$ {{$compra}}</td>
                    <td>$ {{$cash}}</td>
                </tr>
            </tbody>
        </table>
        <br>
        <table>
            <thead>
                <tr>
                    <th scope="col">Utilidad</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>$ {{$utilidad}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
</body>

</html>

@endsection
