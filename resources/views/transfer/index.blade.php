@extends('layout.layoutdas')
@section('title')
Traspasos
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
			@if (session('mesage-update'))	
	<div class="alert alert-warning">
				<strong>{{ session('mesage-update') }}</strong>
	</div>
		@endif
			@if (session('mesage-delete'))	
	<div class="alert alert-danger">
				<strong>{{ session('mesage-delete') }}</strong>
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
      <h2 align="center">Traspasos </h2>
      <br>  
      <form class="" action="/transpasos" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }} 
      <div class='row'>
               <div class="col-md-3  col-md-offset-1 visible-md visible-lg">
                  <label>Producto</label>
                  <select name="product_id" class="form-control" data-plugin="select2" data-placeholder="Seleccione Producto"
                      data-allow-clear="true">
                      <option></option>
                      <optgroup label="Productos">
                      @foreach($products as $product)
                     <option value="{{ $product->id }}" required>{{$product->id}}-{{ $product->name }}</option>
                     @endforeach
                      </optgroup>
                   </select>
               </div>
               <div class="col-md-3  col-md-offset-1 visible-md visible-lg">
                  <label>Sucursal</label>
                  <select name="branch_id" class="form-control ">
                    @foreach($branches as $branch)
                     <option value="{{ $branch->id }}" required>{{ $branch->name }}</option>
                    @endforeach
                  </select>
               </div>
              <div class="col-md-3  col-md-offset-1 visible-md visible-lg">
                 <label>Colaborador</label>
                 <select name="user_id" class="form-control ">
                   @foreach($users as $user)
                    <option value="{{ $user->id }}" required>{{ $user->name }}</option>
                   @endforeach
                 </select>
              </div>
              <div class="col-md-3  col-md-offset-1 visible-md visible-lg">
                 <label>Destino</label>
                   <select name="branch_id" class="form-control ">
                      @foreach($branches as $branch)
                       <option value="{{ $branch->id }}" required>{{ $branch->name }}</option>
                      @endforeach
                   </select>
               </div>

               <div class="col-md-3">
                 <label  class="control-label">Seleccione Sucursal</label>
                  <select id="branch_id"   name="branch_id"  class="form-control ">
                    @foreach($branches as $branch)            
                      <option value="{{ $branch->id }}" required>{{ $branch->name }}</option>
                    @endforeach
                  </select> 
               </div> 
               <div class="col-md-3  col-md-offset-1 visible-md visible-lg">
                 <label>Colaborador</label>
                 <select name="" id="user_id" class="form-control ">
                   @foreach($users as $user)
                   <option value="{{ $user->id }}" required>{{ $user->name }}</option>
                   @endforeach
                 </select>
               </div>
                <br>
              </div>
             <br>
            <div class="form-group col-md-12">
          <button id="submit" type="submit" name="button" class="btn btn-primary">Guardar</button>
       </div>
@endsection
        
@section('branch-user')
<script type="text/javascript">

var branches = {!! $branches !!};

$('#branch_id').change(function() {
  var id = $(this).val();
  var branch = branches.filter(l => l.id == id)[0];
  $('#user_id').val(user.id);
});

</script>
@endsection