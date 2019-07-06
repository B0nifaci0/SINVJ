@extends('layout.layoutdas')
@section('title')
TRASFERENCIAS
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
  <div class="panel-body">
	@if (session('mesage'))	
	<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('mesage') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
	</div>
		@endif
    @if (session('mesage-update'))	
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('mesage-update') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
	</div>
		@endif
			@if (session('mesage-delete'))	
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('mesage-delete') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
	</div>
		@endif    
  <div class="page-content">
        <!-- Panel Basic -->
    <div class="panel">
      <header class="panel-heading">
        <div class="panel-actions">
        <div class="row">
        <div class="col-md-6 col-md-offset-2">
                  <button onclick="window.location.href='traspasospdf'" 
                  type="button" class=" btn btn-sm small btn-floating 
                   toggler-left  btn-danger waves-effect waves-light waves-round float-right"
                   data-toggle="tooltip" data-original-title="Generar reporte PDF">
                   <i class="icon fa-file-pdf-o" aria-hidden="true"></i></button>
                </div>
          <div class="col-md-6 col-md-offset-2">
            <button onclick="window.location.href='/traspasos/create'" type="button" class=" btn btn-sm small btn-floating  toggler-left 
            btn-info waves-effect waves-light waves-round float-right "
             data-toggle="tooltip" data-original-title="Agregar">
             <i class="icon md-plus" aria-hidden="true"></i></button>
          </div>
        </div>
        </div>
        <h3 class="panel-title">Traspasos</h3>
      </header>
      <div class="panel-body">
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
              <thead>
                <tr>
                 <th>Clave</th>
                 <th>Clave Del Producto</th>
                 <th>Producto</th>
                 <th>Peso</th>
                 <th>Categoría</th>
                 <th>Linea</th>
                 <th>Sucursal</th>
                 <th>Quien lo mando</th>
                 <th>Destino</th>
                 <th>Quien recibio</th>
                 <th>Fecha</th>
                 <th>Estaus Del Producto</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                 <th>Clave</th>
                 <th>Clave Del Producto</th>
                 <th>Producto</th>
                 <th>Peso</th>
                 <th>Categoría</th>
                 <th>Linea</th>
                 <th>Sucursal</th>
                 <th>Quien lo mando</th>
                 <th>Destino</th>
                 <th>Quien recibio</th>
                 <th>Fecha</th>
                 <th>Estaus Del Producto</th>
                </tr> 
              </tfoot>  
              <tbody>
              @foreach ($trans as $transfer)
                    <tr id = "row{{$transfer->id}}">
                          <td>{{ $transfer->id }}</td> 
                          <td>{{ $transfer->product->id }}</td> 
                          <td>{{ $transfer->product->name }}</td>
                          <td>{{ $transfer->product->weigth }}</td>
                          <td>{{ $transfer->product->category->name }}</td>
                          <td>{{ $transfer->product->line->name }}</td>
                          <td>{{$transfer->last_branch_id}}</td>
                          <td>{{$transfer->user_id}}</td>
                          <td>{{$transfer->new_branch_id}}</td>
                          <td>{{$transfer->destination_user_id}}</td>
                          <td>{{$transfer->created_at}}</td>
                          <td>
                 @if($transfer->status_product != 0)
                  <span class="badge badge-primary">Entregado</span>
                @else
                  <span class="badge badge-success">Recibido</span>
                @endif
                </td>
								
							
							</div>
                          
                    </tr>
                    @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  
  <!-- End Panel Basic -->
@endsection

@section('filter')
<script>
$(document).ready(function(){
  $('#filteringStatus').change(function(){
    //alert($(this).val())
    if($(this).val()==''){
        $('.active').each(function(){
            $(this).removeClass('hidden')
        });
        $('.disable').each(function(){
            $(this).removeClass('hidden')
        });
    }else if($(this).val()=='activo'){
        $('.active').each(function(){
            $(this).removeClass('hidden')
        });
        $('.disable').each(function(){
            $(this).addClass('hidden')
        });
    }else{
        $('.disable').each(function(){
            $(this).removeClass('hidden')
        });
        $('.active').each(function(){
            $(this).addClass('hidden')
        });
    }
  });
});
</script>
@endsection