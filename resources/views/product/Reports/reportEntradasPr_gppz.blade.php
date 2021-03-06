@extends('layouts.pdf')

@section('body')

<div>
    <h1>Reporte General De Productos Por Pieza</h1>

    <h1 style="color:red">Sucursal {{$branch->name}} </h1>
    <table>
        <thead>
            <tr>
                <th scope="col">Clave</th>
                <th scope="col">Descripción</th>
                <th scope="col">Observaciones</th>
                <th scope="col">Categoria</th>
                <th scope="col">Precio Venta</th>
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
                <td>{{ $product->category->name }}</td>
                <td>$ {{ $product->price }}</td>
                <td>{{ $product->status->name }}</td>
                <td>{{date_format($product->date_creation, 'd/m/y')}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table>
        <thead>
            <tr>
                <th scope="col">Categoria</th>
                <th scope="col">Total</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{$category->name}}</td>
                <td>$ {{$category->price }}</td>
            </tr>
            @endforeach
        </tbody>
        <br>
    </table>
</div>
</div>

@endsection
