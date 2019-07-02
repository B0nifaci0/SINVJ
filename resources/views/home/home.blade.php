@extends('layout.layoutdas')
@section('title')
ALTA TIENDAS
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
      <h2 align="center">Reporte De Transpaso </h2>
      <br>  
      <form class="" action="/home" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }} 
      <div class='row'>
      <div class="col-md-3  col-md-offset-1 visible-md visible-lg">
               <label>Sucursal</label>
               <select name="branch_id" class="form-control round">
               
                 @foreach($branches as $branch)
                  <option value="{{ $branch->id }}" required>{{ $branch->name }}</option>
                 @endforeach
               </select>
            </div>

            <div class="col-md-3  col-md-offset-1 visible-md visible-lg">
               <label>Colaborador</label>
               <select name="user_id" class="form-control round">
               
                 @foreach($users as $user)
                  <option value="{{ $user->id }}" required>{{ $user->name }}</option>
                 @endforeach
               </select>
            </div>

        <div class="col-md-3 col-md-offset-1 visible-md visible-lg">
          <form class="clearfix"  >
            <div class="form-group">
              <label class="form-label">Fecha </label>
           <div id="datepicker" class="input-group date round" data-date-format="mm-dd-yyyy">
           <input type="text" class="datepicker form-control " placeholder="Desde">
           <span class="input-group-addon"><i class="clearfix fa-angle-right"></i></span>
           
           <div class="form-group">
           <div id="datepicker1" class="input-group date round" data-date-format="mm-dd-yyyy">
           <input type="text" class="datepicker form-control " placeholder="A">
           <span class="input-group-addon "></span>
       </div>
           </div>
           </div>
        </div>
           </div>

           <div class="col-md-12">
           <a href="homepdf">
          <button  name="button" class="btn btn-danger">Generar Reporte</button>
          </a>
          </div>




@endsection


@section('date-time')
<script type="text/javascript">
    $(function () {
  $("#datepicker").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());
});

$(function () {
  $("#datepicker1").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());
});
</script>
@endsection