@extends('layouts.pdf')

@section('body')
<div>
    <h1>Categoria {{ $category->name }}</h1>
    <h1 style="color:red">{{$branch->name}}</h1>
    <table>
        <thead>
            <tr>
                <th scope="col">Clave</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio Compra</th>
                <th scope="col">Precio Venta</th>
                <th scope="col">Observaciones</th>
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
            <tr>
                <td>$ {{$total}}</td>
            </tr>
        </tbody>
    </table>
</div>
</div>


@endsection
