@extends('layout.layoutdas')
@section('title')
VERIFICACION DE ESTATUS
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="page">
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
        <!-- Panel Basic -->
    <div class="panel">
      <header class="panel-heading">
        <div class="panel-actions">
          <div class="col-md-14 col-md-offset-2">
            <button onclick="window.location.href='/status/create'" type="button" class=" btn btn-sm small btn-floating  toggler-left  btn-info waves-effect waves-light waves-round float-right">
             <i class="icon md-plus" aria-hidden="true"></i></button>
          </div>
        </div>
        <h3 class="panel-title">Estatus</h3>
      </header>
      <div class="panel-body">
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Tienda</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                     <th>Id</th>
                        <th>Name</th>
                        <th>Tienda</th>
                        <th>Opciones</th>
                </tr> 
              </tfoot>
              <tbody>
                    @foreach ($sta as $tsd)
                    <tr id = "row{{$tsd->id}}">
                        <td>{{$tsd->id}}</td>
                          <td>{{$tsd->name}}</td>
                          <td>{{$tsd->shop->name}}</td>
                          <td>    
                        <a href="#"<button type="button" class="btn btn-icon btn-info waves-effect waves-light waves-round"><i class="icon md-edit" aria-hidden="true"></i></button></a>
                        <a href="#"<button type="button" onclick="return confirm('¿Seguro que deseas eliminar este registro?')"class="btn btn-icon btn-danger waves-effect waves-light waves-round" ><i class="icon md-delete" aria-hidden="true"></i></button></a>
                      </td>
                    </tr>
                    @endforeach 
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Panel Basic -->
@endsection