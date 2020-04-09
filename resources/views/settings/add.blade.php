@extends('layout.layoutdas')
@section('title')
LISTA DE  LINEA
@endsection

@section('admin-section')
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
      <center><h3>Registrar nuevo ajuste</h3></center>

      <form class="" action="/lineas" method="post">
      {{ csrf_field() }} 
      <div class="row">
      <div class="form-group form-material col-md-4">
               <label class="form-control-label" for="inputBasicLastName"> </label>
               <input type="text" class="form-control" name="name" value="{{old('name')}}" required="required" placeholder="" />
      </div> 

      <div class="form-group form-material col-md-4">
               <label class="form-control-label" for="inputBasicLastName"></label>
               <input type="text" class="form-control" name="purchase_price" value="{{old('purchase_price')}}" required="required" placeholder="" />
      </div>
      <div class="form-group form-material col-md-4">
               <label class="form-control-label" for="inputBasicLastName"></label>
               <input type="text" class="form-control" name="sale_price" value="{{old('sale_price')}}" required="required" placeholder="" />
      </div>
      <div class="form-group form-material col-md-4">
               <label class="form-control-label" for="inputBasicLastName"></label>
               <input type="text" class="form-control" name="discount_percentage" value="{{old('discount_percentage')}}" required="required" placeholder="" />
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