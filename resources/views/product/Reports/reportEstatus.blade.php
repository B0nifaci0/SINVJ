@extends('layouts.pdf')

@section('body')

<body>
    <div>
        <div>
            <img src="{{ $shop->image }}">
            <div class="date">
                <p>Fecha: {{$dates}} </p>
                <p>Hora: {{$hour}}</p>
            </div>
        </div>
        <div>
            <h1>Reporte {{$estado->name}}s por {{$type}}
            </h1>
            <h1 style="color:red"> @if($estado->name == 'Traspaso') Destino: @endif Sucursal: {{$branch}}
            </h1>
            @if($type == "Gr")
            <h1>Linea:
                @foreach ($products as $i => $product)
                {{ $product->line->name }}
                @break
                @endforeach
                @endif
            </h1>
            <table>
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Categoria</th>
                        @foreach ($products as $product)
                        @if($product->category->type_product == 2 )
                        <th>Peso</th>
                        @break;
                        @endif
                        @endforeach
                        <th>Descripción</th>
                        <th>Precio venta</th>
                        <th>Precio compra</th>
                        <th>Fecha alta</th>
                        @if ($estado->name == 'Traspaso')
                        <th>Sucursal Origen</th>
                        <th>Quien lo mando</th>
                        <th>Quien recibio</th>
                        <th>Fecha</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $i => $product)
                    <tr>
                        <td>{{ $product->clave }}</td>
                        <td>{{ $product->category->name }}</td>
                        @if($product->category->type_product == 2 )
                        <td>{{ $product->weigth }} gr</td>
                        @endif
                        <td>{{ $product->description }}</td>
                        @if ($estado->name != 'Vendido')
                        <td>$ {{$product->price }}</td>
                        @else
                        @foreach ($detalle as $det)
                        @if($det->product_id == $product->id)
                        <td>$ {{$det->final_price}}</td>
                        @endif
                        @endforeach
                        @endif
                        <td>$ {{$product->price_purchase }}</td>
                        <td>{{date_format($product->created_at, 'd/m/y')}}</td>
                        @if ($estado->name == 'Traspaso')
                        @foreach ($trans as $transfer)
                        @if ($product->id == $transfer->product_id)
                        <td>{{$transfer->lastBranch->name}}</td>
                        <td>{{$transfer->user->name}}</td>
                        <td>{{$transfer->destinationUser->name}}</td>
                        <td>{{$transfer->created_at->format('m-d-Y')}}</td>
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
                        @foreach ($products as $product)
                        @if($product->category->type_product == 2 )
                        <th scope="col">Total de Gramos</th>
                        @break
                        @endif
                        @endforeach
                        <th scope="col">Total Precio Compra</th>
                        @foreach ($products as $product)
                        @if ($estado->name == 'Vendido')
                        <th scope="col">Total precio Venta</th>
                        @break
                        @endif
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($products as $product)
                        @if($product->category->type_product == 2 )
                        <td>{{$total}} gr</td>
                        @break
                        @endif
                        @endforeach
                        <td>$ {{$compra}}</td>
                        @foreach ($products as $product)
                        @if ($estado->name == 'Vendido')
                        <td>$ {{$venta}}</td>
                        @break
                        @endif
                        @endforeach
                    </tr>
                </tbody>
                <br>
            </table>
            @if ($estado->name == 'Vendido')
            <table>
                <thead>
                    <tr>
                        <th scope="col">Utilidad</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>$ {{$utilidad}}</td>
                    </tr>
                </tbody>
            </table>
            @endif
        </div>
    </div>

</body>

</html>

@endsection
