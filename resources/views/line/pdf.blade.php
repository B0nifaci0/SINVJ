@extends('layouts.pdf')
@section('body')
<div>
    <h1 align="center">Reporte de Lineas {{$shop->name}}</h1>
    <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lines as $line)
            <tr id="row{{ $line->id }}">
                <td>{{ $line->name }}</td>
                <td>$ {{ $line->purchase_price }}</td>
                <td>$ {{ $line->sale_price }}</td>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
