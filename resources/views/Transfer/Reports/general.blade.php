@extends('layouts.pdf')
@section('body')
<div>
    <h1 class="text-center">Reporte Traspasos
        {{$type==0 ? 'Entrantes' : 'Salientes'}}
        {{$type_product==2 ? 'por Gr' : 'por Pz'}}
    </h1>
    <h1>Sucursal: {{$branch->name}}</h1>
    <table>
        <thead>
            <tr>
                <th>Clave</th>
                <th>Categoria</th>
                @if($type_product == 2)
                <th>Peso (gr)</th>
                @endif
                <th>Descripción</th>
                <th>Precio</th>
                <th>Origen</th>
                <th>Quien mando</th>
                <th>Quien recibé</th>
                <th>Destino</th>
                <th>Estatus</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trans as $transfer)
            @if($type_product == $transfer->product->category->type_product)
            <tr>
                <td>{{ $transfer->product->clave }}</td>
                <td>{{ $transfer->product->category->name }}</td>
                @if($transfer->product->category->type_product == 2 )
                <td>{{ $transfer->product->weigth }}</td>
                @endif
                <td>{{ $transfer->product->description }}</td>
                <td> {{$transfer->product->price}}</td>
                <td>{{$transfer->lastBranch->name}}</td>
                <td>{{$transfer->user->name}}</td>
                <td>{{$transfer->destinationUser->name}}</td>
                <td>{{$transfer->newBranch->name}}</td>
                @if($transfer->status_product == 1)
                <td>{{$transfer->paid_at ? 'Pagado' : 'Por Pagar'}}</td>
                @elseif($transfer->status_product == 3)
                <td>Devuelto</td>
                @elseif($transfer->status_product === 0)
                <td>Rechazado</td>
                @else
                <td>Pendiente</td>
                @endif
                <td>{{$transfer->updated_at->format('m-d-Y')}}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
@endsection