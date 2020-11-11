@extends('layouts.pdf')
@section('body')
<div>
    <h1 align="center">Reporte General de Ventas {{$shop->name}}</h1>
    <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
        <thead>
            <tr>
                <th>Nombre del cliente</th>
                <th>Teléfono</th>
                <th>Cantidad de Productos</th>
                <th>Total a pagar</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
            <tr id="row{{$sale->id}}">
                <td>{{ $sale->customer_name ? $sale->customer_name : $sale->client->name . $sale->client->first_lastname }}
                </td>
                <td>{{ $sale->telephone ? $sale->telephone : $sale->client->phone_number}}</td>
                <td align="center">{{ $sale->items->count() }}</td>
                <td>${{ $sale->total }}</td>
                <td>{{date_format($sale->created_at, 'd/m/y')}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

@endsection