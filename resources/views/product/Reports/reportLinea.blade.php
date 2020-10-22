@extends('layouts.pdf')

@section('body')
<div>
    <h1>Reporte de Productos por Gramos y Dinero</h1>
    <h1>Linea:{{$line->name}} Sucursal: {{$branch->name}}</h1>
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
            @foreach ($products as $product)
            <tr>
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
                <td>{{$weigth}} gr</td>
                <td>$ {{$price_purchase}}</td>
                <td>$ {{$price}}</td>
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
                <td>$ {{$utility}}</td>
            </tr>
        </tbody>
    </table>
</div>
</div>
@endsection
