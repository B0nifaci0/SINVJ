@extends('layouts.pdf')

@section('body')

<div>
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
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->clave }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->line->name }}</td>
                <td>{{ $product->weigth }} gr</td>
                <td>{{ $product->observations }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->status->name }}</td>
                <td>{{ $product->date_creation }}</td>
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
            @foreach ($lines as $line)
            <tr>
                <td>{{$line->name}}</td>
                <td>{{$line->weigth}} gr</td>
            </tr>
            @endforeach
        </tbody>
        <br>
    </table>
</div>
</div>

@endsection
