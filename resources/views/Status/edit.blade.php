@extends('layout.layoutdas')
@section('title')
EDITAR ESTATUS
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
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
      <center><h3>Estatus</h3></center>
      <form action="{{ route('status.update', ['id' => $status->id]) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <!-- Input para editar Nombre de Estatus-->
        <div class="form-group form-material col-md-6">
          <label>Nombre:</label>
          <input type="text" class="form-control" value="{{$status->name}}" name="name" required> 
        </div>
        <!-- END Input-->
        <!-- Botón para guardar cambios-->
        <div class="form-group col-md-12">
          <button type="submit" name="button" class="btn btn-primary">Guardar</button>
        </div>
        <!-- END Botón-->
      </form>
    </div>
  </div>
</div>
@endsection 