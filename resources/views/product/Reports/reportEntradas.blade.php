@extends('layouts.pdf')

@section('body')

<div>
    <h1>Reporte de Entrada de Productos Linea: {{$line->name}}</h1>
    <h1 style="color:red">Sucursal: {{$branch->name}}</h1>
    <table>
        <thead>
            <tr>
                <th scope="col">Clave</th>
                <th scope="col">Descripción</th>
                <th scope="col">Peso</th>
                <th scope="col">Observaciones</th>
                <th scope="col">Categoria</th>
                <th scope="col">Estatus</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($products as $i => $product)
            <tr>
                <td>{{ $product->clave }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->weigth }} gr</td>
                <td>{{ $product->observations }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->status->name }}</td>
                <td class="sizedate">{{ $product->date_creation }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th scope="col">Total De Gramos</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$products->sum('weigth')}}</td>
            </tr>
        </tbody>
        <br>
    </table>
</div>
</div>

@endsection
