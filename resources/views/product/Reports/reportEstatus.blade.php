@extends('layouts.pdf')
@section('body')
<div>
    <h1>Reporte {{$status->name}}s por {{$type==2 ? "gr" : "pz"}} . Sucursal: {{$branch->name}}</h1>
    <h1> {{$type==2 ? "Linea:$line->name" : ""}} Categoria: {{$category->name}}</h1>
    <table>
        <thead>
            <tr>
                <th>Clave</th>
                @if($type == 2 )
                <th>Peso</th>
                @endif
                <th>Descripción</th>
                <th>Precio venta</th>
                <th>Precio compra</th>
                <th>Fecha alta</th>
                @if ($status->name == 'Traspaso')
                <th>Sucursal Destino</th>
                <th>Quien lo mando</th>
                <th>Quien recibio</th>
                <th>Fecha</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->clave }}</td>
                @if($type== 2 )
                <td>{{ $product->weigth }} gr</td>
                @endif
                <td>{{ $product->description }}</td>
                @if ($status->name != 'Vendido')
                <td>$ {{$product->price }}</td>
                @else
                @foreach ($products_by_status as $detail)
                @if($detail->product_id == $product->id)
                <td>$ {{$detail->final_price}}</td>
                @endif
                @endforeach
                @endif
                <td>$ {{$product->price_purchase }}</td>
                <td>{{date_format($product->created_at, 'd/m/y')}}</td>
                @if ($status->name == 'Traspaso')
                @foreach ($products_by_status as $transfer)
                @if ($product->id == $transfer->product_id)
                <td>{{$transfer->newBranch->name}}</td>
                <td>{{$transfer->user->name}}</td>
                <td>{{$transfer->destinationUser->name}}</td>
                <td>{{date_format($transfer->created_at, 'd/m/y')}}</td>
                @break;
                @endif
                @endforeach
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table>
        <thead>
            <tr>
                @if($type== 2 )
                <th scope="col">Total de Gramos</th>
                @endif
                <th scope="col">Total Precio Compra</th>
                @if ($status->name == 'Vendido')
                <th scope="col">Total precio Venta</th>
                @endif
            </tr>
        </thead>
        <tbody>
            <tr>
                @if($type == 2 )
                <td>{{$weigth}} gr</td>
                @endif
                <td>$ {{$price_purchase}}</td>
                @if ($status->name == 'Vendido')
                <td>$ {{$price}}</td>
                @endif
            </tr>
        </tbody>
        <br>
    </table>
    @if ($status->name == 'Vendido')
    <table>
        <thead>
            <tr>
                <th scope="col">Utilidad</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>$ {{$utility}}</td>
            </tr>
        </tbody>
    </table>
    @endif
</div>

</div>
@endsection