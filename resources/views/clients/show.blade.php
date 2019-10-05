@extends('layout.layoutdas')
@section('title')
ALTA BITACORAS
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="page-content container-fluid">
    <form autocomplete="off" method="POST" action="/mayoristas">
        {{ csrf_field() }}
        <div class="panel">
            <div class="panel-body">
                @if (session('mesage'))
                    <div class="alert alert-success">
                        <strong>{{ session('mesage') }}</strong>
                    </div>
                @endif
                @if($errors->count() > 0)
                    <div class="alert alert-danger" role="alert">
                        <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                    <h2 class="panel-title">Perfil de {{ $client->name }} {{ $client->first_lastname }} {{ $client->second_lastname }}</h2>
                    <h4 class="panel-title">Número telefónico: {{ $client->phone_number }}</h4>
                    <div class="row">
                        <div class="form-group form-material col-md-6">
                        </div>
                    </div>
            </div>

        </div>
        <div class="panel">
            <div class="panel-body">
                <h3>Historial de compras</h3>    
            </div>
            @foreach($client->sales as $sale)
            <div class="panel-body">
                <h2 class="panel-title">Fecha de compra: {{ date('d/m/Y', strtotime($sale->created_at)) }}</h2>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Clave</th>
                                    <th>Descripción</th>
                                    <th>Peso</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sale->itemsSold as $item)
                                <tr>
                                    <td>{{ $item->clave }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->weigth }} g</td>
                                    <td>$ {{ $item->price }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3"></td>
                                    <td><strong>$ {{ $sale->total }}</strong></td>
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </form>
</div>
@endsection