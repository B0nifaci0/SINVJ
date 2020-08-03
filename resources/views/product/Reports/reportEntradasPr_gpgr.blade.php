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
            <h1>Reporte General De Entrada de Productos Por Gramos</h1>
            <h1>Reporte de Entradas Por Lineas</h1>
            <h1 style="color:red"> Sucursl: {{$branch->name}}
            </h1>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Clave</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Linea</th>
                        <th scope="col">Peso</th>
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
                        <td>{{ $product->name_line }}</td>
                        <td>{{ $product->weigth }} gr</td>
                        <td>{{ $product->observations }}</td>
                        <td>{{ $product->name_category }}</td>
                        <td>{{ $product->name_status }}</td>
                        <td class="sizedate">{{ $product->date_creation }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Linea</th>
                        <th scope="col">Total De Gramos</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($lines as $i => $line)
                    <tr>
                        <td>{{$line->nombre_linea}}</td>
                        <td>{{$line->gramo_linea}} gr</td>
                    </tr>
                    @endforeach
                </tbody>
                <br>
            </table>
        </div>
    </div>
</body>

</html>

@endsection
