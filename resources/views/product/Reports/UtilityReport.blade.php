@extends('layouts.pdf')

@section('body')
<div>
    <h1>Reporte de Utilidad por
        {{($category_type == 2 ? "gr" : "pz")}} . Sucursal: {{$branch->name}}
    </h1>
    <h1 style="color:red">{{$shop->name}}</h1>
    <table>
        <thead>
            <tr>
                <th>Clave</th>
                <th>Descripción</th>
                @if($category_type == 2 )
                <th>Peso</th>
                @endif
                <th>Precio Compra</th>
                <th>Precio Venta</th>
                <th>Utilidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->clave }}</td>
                <td>{{ $product->description }}</td>
                @if($product->category->type_product == 2 )
                <td> {{$product->weigth}}</td>
                @endif
                <td>$ {{$product->price_purchase}}</td>
                @foreach ($sale_details as $detail)
                @if ($detail->product_id == $product->id)
                <td>$ {{$detail->final_price}}</td>
                <td>$ {{$detail->profit}}</td>
                @break
                @endif
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table>
        <thead>
            <tr>
                @if($category_type == 2 )
                <th scope="col">Total de Gramos</th>
                @endif
                <th scope="col">Total Precio Compra</th>
                <th scope="col">Total pagado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @if($category_type == 2 )
                <td>{{$weight}} gr</td>
                @endif
                <td>$ {{$price_purchase}}</td>
                <td>$ {{$price}}</td>
            </tr>
        </tbody>
        <br>
    </table>
    <table>
        <thead>
            <tr>
                <th scope="col">Gastos</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>$ {{$cash_expenses}} </td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th scope="col">Utilidad</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>$ {{$utility-$cash_expenses}} </td>
            </tr>
        </tbody>
    </table>
</div>
</div>
@endsection