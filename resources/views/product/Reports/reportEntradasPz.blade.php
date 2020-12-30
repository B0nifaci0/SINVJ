@extends('layouts.pdf')

@section('body')
<div>
    <h1>Reporte de Entrada de Productos</h1>
    <h1>Categoria: {{ $category->name}} <br/>Sucursal: {{$branch->name}}</h1>
    <table>
        <thead>
            <tr>
                <th scope="col">Clave</th>
                <th scope="col">Descripción</th>
                <th scope="col">Observaciones</th>
                <th scope="col">Categoria</th>
                <th scope="col">Estatus</th>
                <th>Precio Venta</th>
                <th>Precio compra</th>
                <th scope="col">Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->clave }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->observations }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->status->name }}</td>
                <td>$ {{$product->price}}</td>
                <td>$ {{$product->price_purchase}}</td>
                <td>{{ Carbon\Carbon::parse($product->date_creation)->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th scope="col">Total Precio venta</th>
                <th>Total precio venta</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>$ {{$price}}</td>
                <td>$ {{$price_purchase}}</td>
            </tr>
        </tbody>
        <br>
    </table>
</div>
</div>

@endsection
