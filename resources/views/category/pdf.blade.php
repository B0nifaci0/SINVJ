@extends('layouts.pdf')
@section('body')
<div>
  <h1 align="center">Reporte de Categorias {{$shop->name}}</h1>
  <table>
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Tipo de producto</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($category as $category)
      <tr id="row{{ $category->id }}">
        <td>{{ $category->name }}</td>
        @if($category->type_product == 1 )
        <td>Pieza</td>
        @endif
        @if($category->type_product == 2 )
        <td>Gramos</td>
        @endif
        </td>
      </tr>
      @endforeach
      @foreach ($category2 as $category2)
      <tr id="row{{ $category->id }}">
        <td>{{ $category2->name }}</td>
        @if($category2->type_product == 1 )
        <td>Pieza</td>
        @endif
        @if($category2->type_product == 2 )
        <td>Gramos</td>
        @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
@endsection