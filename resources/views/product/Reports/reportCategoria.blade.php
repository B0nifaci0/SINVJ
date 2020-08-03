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
            <h1>Categoria @foreach ($categoria as $c) {{ $c->name }} @endforeach </h1>
            <h1 style="color:red">@foreach($branches as $branch){{$branch->name}} @endforeach</h1>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Clave</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio Compra</th>
                        <th scope="col">Precio Venta</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $i => $product)
                    <tr>
                        <td>{{ $product->clave }}</td>
                        <td>{{ $product->description }}</td>
                        <td>$ {{ $product->price_purchase }}</td>
                        <td>$ {{ $product->price }}</td>
                        <td>{{ $product->observations }}</td>
                        <td>{{ $product->status->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Total Precio Venta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cash as $i => $c)
                    <tr>
                        <td>$ {{$c->total}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

@endsection
