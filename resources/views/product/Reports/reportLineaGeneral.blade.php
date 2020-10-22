@extends('layouts.pdf')

@section('body')

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
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->clave }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->line->name  }}</td>
                <td>{{ $product->weigth }} gr</td>
                <td>$ {{ $product->price }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->status->name }}</td>
                <td>{{ $product->branch->name }}</td>
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
            @foreach ($lines as $line)
            <tr>
                <td>{{$line->name}}</td>
                <td>{{$line->weigth}} gr</td>
                <td>$ {{$line->price}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

@endsection
