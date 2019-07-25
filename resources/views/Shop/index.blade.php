@extends('layout.layoutdas')
@section('title')
LISTA TIENDAS
@endsection

@section('nav')

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
            </div>
          </div>
          <h3 class="panel-title">Tienda</h3>
        </header>
        <div class="panel-body">
              <table class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Correo</th>
                    <th>Numero telefonico</th>
                    <th>Logo</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Correo</th>
                    <th>Numero telefonico</th>
                    <th>Logo</th>
                    <th>Opciones</th>
                  </tr>
                </tfoot>
                <tbody>
                    @foreach($shops as $shop)
                    <tr id = "row{{$user->id}}">
                          <td>{{$shop->name }}</td>
                          <td>{{$shop->description }}</td>
                          <td>{{$shop->email }}</td>
                          <td>{{$shop->phone_number }}</td>
                          <td>
                              @php
                              $image = route('images',"app/public/upload/shops/$shop->image")
                              @endphp
                              <img width="100px" height="100px" src="{{ $image }}">
                            </td>
                          <td>    
                              <a href="/tiendas/{{$shop->id}}/edit"<button type="button" 
                                class="btn btn-icon btn-info waves-effect waves-light waves-round"
                                data-toggle="tooltip" data-original-title="Editar">
                                <i class="icon md-edit" aria-hidden="true"></i></button></a>
                      </td>
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


@section('delshop')
<script type="text/javascript">
$(".delete").click(function() {
   var id = $(this).attr("alt");
   alertify.confirm("¿Seguro que desea eliminar este registro?",
     function (e) {
     if (e) {
       $.ajax({
         method: 'DELETE',
         url: '/tiendas/' + id,
         success: function(){
           $("#row" + id).remove();
           alertify.success("Se ha <strong>eliminado</strong> el registro" + id);
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
@section('barcode-product')
@endsection
