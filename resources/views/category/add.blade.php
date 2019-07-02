
@extends('layout.layoutdas')
@section('title')
ALTA CATEGORIA
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="panel-body">
@if (session('mesage'))
<div class="alert alert-success">
      <strong>{{ session('mesage') }}</strong>
    </div>
  @endif
<div class="page-content">
  <div class="panel">
    <div class="panel-body">
    @if($errors->count() > 0)
        <div class="alert alert-danger" role="alert">
          <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
    @endif
      <center><h3>Registrar Categoria</h3></center>

      <form class="" action="/categorias" method="post">
      {{ csrf_field() }}   
      <div class="row">
      <div class="form-group form-material col-md-6">
                            <label class="form-control-label" for="inputBasicLastName"> Nombre Categoria:</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}" required="required" placeholder="Anillo" />
                        </div> 
        <div class="form-group col-md-12">
          <button type="submit" name="button" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
@endsection
