@extends('layouts.pdf')
@section('body')
<div>
  <h1>Sucursal {{$branch->name}}</h1>
  <table>
    <thead>
      <tr>
        <th>Clave</th>
        <th>Linea</th>
        <th>Peso</th>
        <th>Descripcion</th>
        <th>Categoria</th>
        <th>Estatus</th>
        <th>Observaciones</th>
        <th>Precio</th>
        <th>Fecha</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product)
      <tr>
        <td>{{ $product->clave}}</td>
        <td>{{ ($product->line) ? $product->line->name : '' }}</td>
        <td>{{ $product->weigth }}</td>
        <td>{{ $product->description }}</td>
        <td>{{ $product->category->name  }}</td>
        <td>{{ $product->status->name }}</td>
        <td>{{ $product->observations }}</td>
        <td>$ {{ $product->price }}</td>
        <td>{{ $product->updated_at->format('m-d-Y')}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
@endsection