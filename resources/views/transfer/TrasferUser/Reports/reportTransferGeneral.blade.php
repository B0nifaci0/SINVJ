@extends('layouts.pdf')

@section('body')
<div>
    <h1 align="center">Reporte General Traspasos
        {{$type==0 ? 'Entrantes' : 'Salientes'}}
        {{$category==2 ? 'por Gr' : 'por Pz'}}
    </h1>
    <h3 align="center" style="color:red">{{$shop->name}}</h3>
    @foreach ($branches as $branch)
    <table class="table table-condensed">
        <thead>
            @if ($category==2)
            <tr>
                <th class="text-center" colspan="10">Sucursal: {{$branch->name}} </th>
            </tr>
            @else
            <tr>
                <th class="text-center" colspan="9">Sucursal: {{$branch->name}} </th>
            </tr>
            @endif
            <tr>
                <th>Clave</th>
                <th>Categoria</th>
                @if($category == 2)
                <th>Gr</th>
                @endif
                <th>Descripción</th>
                <th>Precio</th>
                <th>Quien mando</th>
                <th>Quien recibé</th>
                @if ($type==0)
                <th>Origen</th>
                @endif
                @if ($type==1)
                <th>Destino</th>
                @endif
                <th>Estatus</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trans as $transfer)
            @if($category == $transfer->product->category->type_product)
            @if ($type==1 && $branch->id ==
            $transfer->lastBranch->id)
            <tr>
                <td>{{ $transfer->product->clave }}</td>
                <td>{{ $transfer->product->category->name }}</td>
                @if($transfer->product->category->type_product == 2 )
                <td>{{ $transfer->product->weigth }}</td>
                @endif
                <td>{{ $transfer->product->description }}</td>
                <td>{{$transfer->product->price}}</td>
                {{-- <td>{{$transfer->lastBranch->name}}</td> --}}
                <td>{{$transfer->user->name}}</td>
                <td>{{$transfer->destinationUser->name}}</td>
                <td>{{$transfer->newBranch->name}}</td>
                @if($transfer->status_product === 1)
                <td>{{$transfer->paid_at ? 'Pagado' : 'Por Pagar'}}</td>
                @elseif($transfer->status_product === 0)
                <td>Rechazado</td>
                @elseif($transfer->status_product == 3)
                <td>Devuelto</td>
                @else
                <td>Pendiente</td>z
                @endif
                <td>{{$transfer->updated_at->format('m-d-Y')}}</td>
            </tr>
            @elseif($type==0 && $branch->id ==
            $transfer->newBranch->id)
            <tr>
                <td> {{ $transfer->product->clave }}</td>
                <td>{{ $transfer->product->category->name }}</td>
                @if($transfer->product->category->type_product == 2 )
                <td>{{ $transfer->product->weigth }}</td>
                @endif
                <td>{{ $transfer->product->description }}</td>
                <td>{{$transfer->product->price}}</td>
                <td>{{$transfer->lastBranch->name}}</td>
                <td>{{$transfer->user->name}}</td>
                <td>{{$transfer->destinationUser->name}}</td>
                {{-- <td>{{$transfer->newBranch->name}}</td> --}}
                @if($transfer->status_product === 1)
                <td>{{$transfer->paid_at ? 'Pagado' : 'Por Pagar'}}</td>
                @elseif($transfer->status_product === 0)
                <td>Rechazado</td>
                @elseif($transfer->status_product == 3)
                <td>Devuelto</td>
                @else
                <td>Pendiente</td>
                @endif
                <td>{{$transfer->updated_at->format('m-d-Y')}}</td>
            </tr>
            @endif
            @endif
            @endforeach
        </tbody>
    </table>
    @endforeach
</div>
</div>
</div>
@endsection