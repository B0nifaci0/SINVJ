@extends('layouts.pdf')
@section('body')
<div>
    <h1>Productos {{$shop->name}}</h1>
    <table>
        <thead>
            <tr>
                <th>Clave</th>
                <th>Descripción</th>
                <th>Peso</th>
                <th>Observaciónes</th>
                <th>Categoría</th>
                <th>Linea</th>
                <th>Sucursal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->clave }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ ($product) ? $product->weigth: ""}}</td>
                <td>{{ $product->observations }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ ($product->line ? $product->line->name:"")}}</td>
                <td>{{ ($product->branch) ? $product->branch->name:""}}</td>
                <td>{{ $product->status->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
