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
            <h1>Reporte de Entrada de Productos</h1>
            <h1>Categoria <span style="color:red"> @foreach($categories as $c){{ $c->nombre_categoria}}
                    @endforeach </span> </h1>
            <h1 style="color:red"> Sucursal: {{$branch->name}}</h1>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Clave</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $i => $product)
                    <tr>
                        <td>{{ $product->clave }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->observations }}</td>
                        <td>{{ $product->name_category }}</td>
                        <td>{{ $product->name_status }}</td>
                        <td class="sizedate">{{ $product->date_creation }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

@endsection
