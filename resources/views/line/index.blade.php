@extends('layout.layoutdas')
@section('title')
LISTA DE  LINEA
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
 
      <!--<table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
        <thead>
        <thead>
          <tr>
            <th data-toggle="true">Clave</th>
            <th data-hide="phone, tablet">Nombre</th>
            <th data-hide="phone, tablet">Opciones</th>
          </tr>
        </thead>
        <div class="form-inline padding-bottom-15">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <select id="filteringStatus" class="form-control" style="visibility:hidden">
                  <option value="">Todos</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6 text-right">
              
            </div>
          </div>
        </div>
        <tbody>
        @foreach ($lines as $line)
          <tr id = "row{{ $line->id }}">
            <td>{{ $line->id}}</td>
            <td>{{ $line->name }}</td>
            <td>

                    <a href="/lineas/{{$line->id}}/edit"<button type="button" class="btn btn-xs btn-icon btn-info edit"><i class="icon md-edit" aria-hidden="true"></i></button></a>

                    <a href="{{ route('lineas.destroy',$line->id)}}"<button type="button" onclick="return confirm('¿Seguro que deseas eliminar este registro?')"
                    class="btn btn-xs btn-icon btn-danger delete"><i class="icon md-delete" aria-hidden="true"></i></button></a>
                  
                        <!--<form class="" action="{{route('lineas.destroy',['id' => $line->id])}}" method="post">
                      {{csrf_field()}}
                      {{method_field('DELETE')}}
                    <button class="btn btn-xs btn-icon btn-danger delete" alt="{{$line->id}}" role="button">
                        <i class="icon md-delete" aria-hidden="true"></i>
                    </button>
                  </div>
              </div>    
            </form>
            </td>
          </tr>
            @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="7">
              <div class="text-right">
                <ul class="pagination"></ul>
              </div>
            </td>
          </tr>
        </tfoot>
      </table>-->


        <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
        <div class="container">
		     <div class="row">
			  <div class="col-md-12 col-md-offset-2">
      <button type="button" class="btn btn-floating  toggler-left  btn-info waves-effect waves-light waves-round float-right">
          <i class="icon md-plus" aria-hidden="true"></i></button>
						<a href="#">
			</div>
		</div>
	</div>
          <header class="panel-heading">
            <div class="panel-actions"></div>
            <h3 class="panel-title">Lineas</h3>
          </header>
          <div class="panel-body">
            <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
              <thead>
                <tr>
                  <th>Clave</th>
                  <th>Nombre</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tfoot>
              <tr>
                  <th>Clave</th>
                  <th>Nombre</th>
                  <th>Opciones</th>
                </tr>
              </tfoot>
              <tbody>
        @foreach ($lines as $line)
          <tr id = "row{{ $line->id }}">
            <td>{{ $line->id}}</td>
            <td>{{ $line->name }}</td>
            <td>

                  
                  
                     <a href="/lineas/{{$line->id}}/edit"<button type="button" class="btn btn-icon btn-info waves-effect waves-light waves-round"><i class="icon md-edit" aria-hidden="true"></i></button></a>

                     <a href="{{ route('lineas.destroy',$line->id)}}"<button type="button" onclick="return confirm('¿Seguro que deseas eliminar este registro?')"
                    class="btn btn-icon btn-danger waves-effect waves-light waves-round" ><i class="icon md-delete" aria-hidden="true"></i></button></a>
                        
                    </button>
                  </div>
              </div>    
            </form>
            </td>
          </tr>
            @endforeach
        </tbody>
            </table>
          </div>
        </div>
        <!-- End Panel Basic -->
</div>



@endsection

@section('delcategory')
<script type="text/javascript">
$(".delete").click(function() {
   var id = $(this).attr("alt");
   alertify.confirm("¿Seguro que desea eliminar este registro?",
     function (e) {
     if (e) {
       $.ajax({
         method: 'DELETE',
         url: '/lineas/' + id,
         success: function(){
           $("#row" + id).remove();
           alertify.success("Se ha <strong>desactivado</strong> el registro" + id);
         },
         error: function(){
           alertify.error("<strong>Ha ocurrido un error en la eliminación</strong>");
         }
       });
     }
  });
});
</script>
@endsection