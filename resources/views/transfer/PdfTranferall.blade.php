@extends('layouts.pdf')
@section('body')
<div>
    <h1 align="center">Traspasos {{$shop->name}}</h1>
    <table>
        <thead>
            <tr>
                <th>Clave</th>
                <th>Peso</th>
                <th>Categoría</th>
                <th>Linea</th>
                <th>Sucursal</th>
                <th>Quien lo mando</th>
                <th>Destino</th>
                <th>Quien recibio</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trans as $transfer)
            <tr>
                <td>{{ $transfer->product->clave }}</td>
                <td>{{ $transfer->product->weigth }}</td>
                <td>{{ $transfer->product->category->name }}</td>
                <td>{{ $transfer->product->line ? $transfer->product->line->name : '' }}</td>
                <td>{{$transfer->lastBranch->name}}</td>
                <td>{{$transfer->user->name}}</td>
                <td>{{$transfer->newBranch->name}}</td>
                <td>{{$transfer->destinationUser->name}}</td>
                <td>{{$transfer->created_at->format('m-d-Y')}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
