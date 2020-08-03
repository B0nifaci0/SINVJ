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
            <h1>Reporte de Utilidad por
                @foreach ($products as $i => $product)
                @if($product->category->type_product == 2 )
                Gr
                @else
                Pz
                @endif
                @break;
                @endforeach
            </h1>
            <h1 style="color:red">@foreach($branches as $branch){{$branch->name}} @endforeach</h1>
            <table>
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Descripción</th>
                        @foreach ($products as $i => $product)
                        @if($product->category->type_product == 2 )
                        <th>Peso</th>
                        @endif
                        @break;
                        @endforeach
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Utilidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $i => $product)
                    <tr>
                        <td>{{ $product->clave }}</td>
                        <td>{{ $product->description }}</td>
                        @if($product->category->type_product == 2 )
                        <td> {{$product->weigth}}</td>
                        @endif
                        <td>$ {{$product->price_purchase}}</td>
                        <td>$ {{$product->final_price}}</td>
                        <td>$ {{$product->profit}}</td>

                        @foreach ($lines as $line)
                        <td>{{$precio = $line->purchase_price}}</td>
                        @endforeach
                        < <!--profit-->
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <table>
                <thead>
                    <tr>
                        @foreach ($products as $i => $product)
                        @if($product->category->type_product == 2 )
                        <th scope="col">Total de Gramos</th>
                        @endif
                        @break;
                        @endforeach

                        <th scope="col">Total Precio Compra</th>
                        <th scope="col">Total precio Venta</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($products as $i => $product)
                        @if($product->category->type_product == 2 )
                        <td>{{$total}} gr</td>
                        @endif
                        @break;
                        @endforeach
                        <td>$ {{$compra}}</td>
                        <td>$ {{$venta}}</td>
                    </tr>
                </tbody>
                <br>
            </table>
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
        </div>
    </div>
</body>

</html>
