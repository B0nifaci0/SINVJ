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
  <div class="">
        <!-- Panel Basic -->
    <div class="panel">
        <div class="panel-body">
            <div class="example-wrap">
              <h1 class="text-center panel-title">Sucursales</h1>
              <div class="panel-actions float-right">
                <div class="container-fluid row float-right">
                  @if(Auth::user()->type_user == 1 )
                  <!-- Botón para Generar PDF de productos-->
                  <div class="col-6">
                    <button onclick="window.location.href='sucursales/corte'"
                type="button" class="btn btn-sm small btn-floating
                toggler-left  btn-secondary waves-effect waves-light waves-round float-right"
                data-toggle="tooltip" data-original-title="Corte de caja">
                <i class="iicon md-money" aria-hidden="true"></i>
              </button>
                  </div>
                  <div class="col-6">
                    <button onclick="window.location.href='/sucursales/create'" type="button" class="btn btn-sm small btn-floating  toggler-left  btn-info waves-effect waves-light waves-round float-left " data-toggle="tooltip" data-original-title="Agregar Sucursal">
                        <i class="icon md-plus" aria-hidden="true"></i></button>
                  </div>
                  <!-- END Botón-->
                  @endif
                </div>
              </div>
            </div>
          </div>
      <div class="panel-body">
            <!-- Tabla para listar sucursales-->
            <table id='branchs'  class="display table table-hover dataTable table-striped w-full" data-plugin="dataTable">
              <thead>
                <tr>
                 <!-- <th>Id</th> -->
                  <th>Nombre</th>
                  <th>Representate Legal</th>
                  <th>RFC</th>
                  <th>Correo</th>
                  <th>Teléfono </th>
                  <th>Dirección</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tfoot>
              <tr>
                  <!-- <th>Id</th> -->
                  <th>Nombre</th>
                  <th>Representate Legal</th>
                  <th>RFC</th>
                  <th>Correo</th>
                  <th>Teléfono </th>
                  <th >Dirección</th>
                  <th>Opciones</th>
                </tr>
              </tfoot>
              <tbody>
                  @foreach ($branches as $branch)
                  <tr id = "row{{$branch->id}}" class="row{{$branch->id}}">
                    <!-- <td>{{$branch->id}}</td>  -->
                    <td>{{$branch->name }}</td>
                    <td>{{$branch->name_legal_re}}</td>
                    <td>{{$branch->rfc}}</td>
                    <td>{{$branch->email}}</td>
                    <td>{{$branch->phone_number}}</td>
                    <td>{{$branch->address}}</td>
                      <!-- <td>{{$branch->shop->name }}</td> -->
                    <td>
                    @if(Auth::user()->type_user == 1 )
                      <!-- Botón para editar sucursal-->
                      <a href="/sucursales/{{$branch->id}}/edit"><button type="button"
                      class="btn btn-icon btn-primary waves-effect waves-light waves-round"
                      data-toggle="tooltip" data-original-title="Editar">
                      <i class=" icon md-edit" aria-hidden="true"></i></button></a>
                      <!--END Botón -->
                      @endif
                      <!-- Botón para ver productos por sucursal-->
                      @if($branch->num_products == 0)
                     <!-- <a href="/sucursales/{{$branch->id}}/producto"> --> <button type="button"
                      class="btn btn-icon btn-warning waves-effect waves-light waves-round products"
                      data-toggle="tooltip" data-original-title="Productos">
                      <i class="icon md-label-heart" aria-hidden="true"></i></button></a>
                      @else
                      <a href="/sucursales/{{$branch->id}}/producto"><button type="button"
                      class="btn btn-icon btn-warning waves-effect waves-light waves-round"
                      data-toggle="tooltip" data-original-title="Productos">
                      <i class="icon md-label-heart" aria-hidden="true"></i></button></a>
                      @endif
                      <!--END Botón -->
                      <!-- Botón para borrar sucursal-->
                      @if(Auth::user()->type_user == 1 )
                      <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                        alt="{{$branch->id}}" role="button"
                        data-toggle="tooltip" data-original-title="Borrar">
                        <i class="icon md-delete" aria-hidden="true"></i>
                      </button>
                      @endif
                      <!--END Botón -->

                      <!-- Botón para ver corte de venta
                      <a href="/sucursales/{{$branch->id}}/inventario"><button  type="button"
                      class="btn btn-icon btn-success  waves-effect waves-light waves-ligth"
                      data-toggle="tooltip" data-original-title="Inventario">
                      <i class="icon md-check" aria-hidden="true"></i></button></a>
                      END Botón -->
                    </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
            <!-- END Tabla-->
          </div>
        </div>
      </div>
    </div>
  <!-- End Panel Basic -->
@endsection
 @section('barcode-product')
  <script type="text/javascript">
    $(document).ready(function(){
        $('#branchs').DataTable({
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
//console.log("a")
$(document).ready(function() {
  //console.log("b")
setTimeout(()=>{
      console.log("cdededee")
  $("#branchs").on('click','.delete',function () {
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
            success: function (response) {
              if(response.success){
              $("#branchs").DataTable()
              .rows('.row' + id)
              .remove()
              .draw();
              Swal.fire(
                'Eliminado',
                'El registro ha sido eliminado.',
                'success'
                );
              }else{
                Swal.fire(
                    'error',
                    response.message
                  )
                 }
                }
              })
           }
       })
     });
     $("#branchs").on('click','.products',function () {
    var id = $(this).attr("alt");
    console.log(id);
    Swal.fire({
      title: 'Confirmación',
      text: "Esta Sucursal No Tiene Productos Activos, ¿Quieres Crear Uno?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6' ,
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Crear!'
    }).then((result) => {
      if (result.value)
      {
        location.href ="/productos/create";
        $.ajaxSetup({
         headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
           }
         });
        $.ajax({
          url:  '/sucursales/' + id,
          method: 'verificacion',
            success: function (response) {
              if(response.success){
                location.href ="/productos/create";
              }else{
                location.href ="/sucursales";
                 }
                }
              })
           }
       })
     });
    },500)
  });
</script>
@endsection
<!--END Función-->


