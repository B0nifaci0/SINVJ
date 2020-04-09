@extends('layout.layoutdas')
@section('title')
LISTA DE  SUCURSALES
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
        <div class="panel-body">
            <div class="example-wrap">
              <h1 class="text-center panel-title">Clientes</h1>
              <div class="panel-actions float-right">
                <div class="container-fluid row float-right">
                  @if(Auth::user()->type_user == 1 )
                  <!-- Botón para Generar PDF de productos-->
                  <div class="col-6">
                    <button onclick="window.location.href='/mayoristas/create'" type="button" class="btn btn-sm small btn-floating  toggler-left  btn-info waves-effect waves-light waves-round float-left " data-toggle="tooltip" data-original-title="Agregar">
                        <i class="icon md-plus" aria-hidden="true"></i></button>
                  </div>
                  <!-- END Botón-->
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-12 col-md-12 col-sl">
        <div class="example-wrap">
          <div class="nav-tabs-horizontal" data-plugin="tabs">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab"
                  href="#exampleTabsOne" aria-controls="exampleTabsOne" role="tab">Menudeo</a></li>
              <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleTabsTwo"
                  aria-controls="exampleTabsTwo" role="tab">Mayoristas</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                <div class="page-content panel-body container-fluid">
                  <table id="public" class=" display table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                    <thead>
                      {{ csrf_field() }}
                      <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Opciones</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($public as $client)
                  <tr id = "row{{ $client->id }}">
                    <td>{{$client->name}}</td>
                    <td>
                    @if($client->phone_number == null || $client->phone_number == 0000000000)
                      Sin Telefono
                    @else
                    {{$client->phone_number }}
                    @endif
                    </td>
                    <td>
                        <!-- Botón para ver cliente-->
                        <a href="/mayoristas/{{ $client->id }}" type="button"
                        class="btn btn-icon btn-primary waves-effect waves-light waves-round"
                        data-toggle="tooltip" data-original-title="Ver Perfil">
                        <i class="icon fa-search" aria-hidden="true"></i></button></a>
                        <!--END Botón -->
                        <!-- Botón para editar cliente-->
                        <a href="/mayoristas/{{$client->id}}/edit"> <button type="button"
                        class="btn btn-icon btn-info waves-effect waves-light waves-round"
                      data-toggle="tooltip" data-original-title="Editar">
                      <i class=" icon md-edit" aria-hidden="true"></i></button></a>
                      <!--END Botón -->
                        <!-- Botón para eliminar cliente -->
                        <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                        alt="{{$client->id}}" role="button"
                        data-toggle="tooltip" data-original-title="Eliminar">
                        <i class="icon md-delete" aria-hidden="true"></i></button></a>
                        <!--END Botón -->
                    </td>
                  </tr>
                  @endforeach
                    </tbody>
                  </table>
                  <!-- END Table-->
                </div>
              </div>

            </div>
            <div class="tab-pane" id="exampleTabsTwo" role="tabpanel">
              <div class="page-content panel-body container-fluid">
                <!-- Tabla para listar productos-->
                <table id="wholesaler" class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
                  <thead>
                    {{ csrf_field() }}
                    <tr>
                        <th>Nombre</th>
                        <th>Primer apellido</th>
                        <th>Segundo apellido</th>
                        <th>Teléfono</th>
                        <th>Límite de Crédito</th>
                        <th>Sucursal</th>
                        <th>Opciones</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Primer apellido</th>
                        <th>Segundo apellido</th>
                        <th>Teléfono</th>
                        <th>Límite de Crédito</th>
                        <th>Sucursal</th>
                        <th>Opciones</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  @foreach ($wholesaler as $client)
                  <tr id = "row{{ $client->id }}">
                    <td>{{$client->name}}</td>
                    <td>{{$client->first_lastname }}</td>
                    <td>{{$client->second_lastname }}</td>
                    <td>{{$client->phone_number }}</td>
                    <td>{{$client->credit}}</td>
                    <td>{{$client->branch ? $client->branch->name : 'Sin sucursal' }}</td>
                    <td>
                        <!-- Botón para ver cliente-->
                        <a href="/mayoristas/{{ $client->id }}" type="button"
                        class="btn btn-icon btn-primary waves-effect waves-light waves-round"
                        data-toggle="tooltip" data-original-title="Ver Perfil">
                        <i class="icon fa-search" aria-hidden="true"></i></button></a>
                        <!--END Botón -->
                        <!-- Botón para editar cliente-->
                        <a href="/mayoristas/{{$client->id}}/edit"> <button type="button"
                        class="btn btn-icon btn-info waves-effect waves-light waves-round"
                      data-toggle="tooltip" data-original-title="Editar">
                      <i class=" icon md-edit" aria-hidden="true"></i></button></a>
                      <!--END Botón -->
                        <!-- Botón para eliminar cliente -->
                        <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                        alt="{{$client->id}}" role="button"
                        data-toggle="tooltip" data-original-title="Eliminar">
                        <i class="icon md-delete" aria-hidden="true"></i></button></a>
                        <!--END Botón -->
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
                <!-- END Table-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <!-- End Panel Basic -->
@endsection
@section('barcode-product')
  <script type="text/javascript">
    $(document).ready(function(){
        $('#table').DataTable({
            retrieve: true,
            //responsive: true,
            //paging: false,
            //searching: false
        });
 
    });
    </script>
  @endsection
<!-- Función Sweet Alert para eliminar sucursal-->
@section('delete-sucursales')
<script type="text/javascript">
console.log("a")
$(document).ready(function() {
  console.log("b")
  $(".delete").click(function() {
    var id = $(this).attr("alt");
    console.log(id);
    Swal.fire({
      title: 'Confirmación',
      text: "¿Seguro que desea eliminar este registro?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33' ,
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Si, Borralo!'
    }).then((result) => {
      if (result.value)
      {
        $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
        });
        $.ajax({
          url:  '/sucursales/' + id,
          method: 'DELETE',
          success: function () {
            $("#row" + id).remove();
            Swal.fire(
              'Eliminado',
              'El registro ha sido eliminado.',
              'success'
            )
          },
          error: function () {
            Swal.fire(
              'Eliminado',
              'El registro no ha sido eliminado.'+ id,
              'error'
            )
          }
        })
      }
    })

  });

  $('#table').DataTable();
});


</script>
@endsection
<!--END Función-->


