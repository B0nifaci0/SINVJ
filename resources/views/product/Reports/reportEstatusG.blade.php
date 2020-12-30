@extends('layouts.pdf')
@section('body')
<div>
<br/>
    <h1>Reporte General Estatus por {{ ($category_type == 1) ? 'Pz' : 'Gr'}} </h1>
    <h1 style="color:red">{{$shop->name}}</h1>
    <table>
        <thead>
            <tr>
                <th>Clave</th>
                <th>Categoria</th>
                <th>Estatus</th>
                <th>Sucursal</th>
                <th>Descripción</th>
                @if ($category_type == 2)
                <th>Linea</th>
                <th>Peso</th>
                @endif
                <th>Observaciones</th>
                <th>Fecha</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->clave }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->status->name }}</td>
                <td>{{$product->branch->name}}</td>
                <td>{{ $product->description }}</td>
                @if ($category_type == 2)
                <td>{{ ($product->line->name) ? $product->line->name : ''}}</td>
                <td>{{ ($product->weigth) ? $product->weigth : ''}}</td>
                @endif
                <td>{{ $product->observations }}</td>
                <td>{{date_format($product->updated_at, 'd/m/y')}}</td>
                <td>$ {{ $product->price }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            @if ($category_type == 2)
            <tr class="text-offset">
                <td colspan="9">Total de gramos</td>
                <td>{{$weight}}</td>
            </tr>
            <tr>
                <td colspan="9">Total precio</td>
                <td> $ {{$price}}</td>
            </tr>
            @else
            <tr class="text-offset">
                <td colspan="7">Total precio</td>
                <td> $ {{$price}}</td>
            </tr>
            @endif
        </tfoot>
    </table>
</div>
</div>
@endsection