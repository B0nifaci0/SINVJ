@extends('layouts.pdf')

@section('body')
<div>
    <h1>Reporte de Productos por Piezas y Dinero por Categorias.</h1>
    <h1 style="color:red">{{$shop->name}}</h1>
    <table>
        <thead>
            <tr>
                <th scope="col">Clave</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio Compra</th>
                <th scope="col">Precio Venta</th>
                <th scope="col">Observaciones</th>
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
                <td>$ {{ $product->price_purchase }}</td>
                <td>$ {{ $product->price }}</td>
                <td>{{ $product->observations }}</td>
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
                <th scope="col">Categoria</th>
                <th scope="col">Total Precio Venta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{$category->name}}</td>
                <td>$ {{$category->price}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
