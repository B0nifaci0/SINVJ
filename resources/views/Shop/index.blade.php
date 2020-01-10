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
                  </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Correo</th>
                    <th>Numero telefonico</th>
                    <th>Logo</th>
                  </tr>
                </tfoot>
                <tbody>
                    @foreach($shops as $shop)
                    <tr id = "row{{$user->id}}">
                          <td>{{$shop->name }}</td>
                          @if($shop->description == "NULL")
                          <td></td>
                          @elseif($shop->description != "NULL")
                          <td>{{$shop->description}}</td>
                          @endif
                          @if($shop->email == "NULL")
                          <td></td>
                          @elseif($shop->email != "NULL")
                          <td>{{$shop->email}}</td>
                          @endif
                          @if($shop->phone_number == "NULL")
                          <td></td>
                          @elseif($shop->phone_number != "NULL")
                          <td>{{$shop->phone_number}}</td>
                          @endif
                          <td>
                            <img width="150px" height="150px" src="{{ $shop_img->image }}">
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
