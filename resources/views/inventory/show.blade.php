@extends('layout.layoutdas')
@section('title')
LISTA DE LINEA
@endsection

@section('admin-section')
@endsection
@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="panel-body">
    <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
            <div class="panel-body">
                <div class="example-wrap">
                <div class="row" style ="text-align:right;">
                    <div class="col-md-7">
                    @foreach($name_branch as $branch)
                    <h1 class="text-right panel-title">Inventarios {{$branch->name}}</h1>
                    @endforeach
                    </div>
                    <div class="col-md-5">
                        @foreach ($id_inventory as $i)
                            @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
                                @if($inventory->status_report == 3)
                                <button class="btn btn-primary" name="id_report" disabled>
                                    Status: Terminado
                                    @elseif($finalizar > 0)
                                    <button class="btn btn-primary" name="id_report" disabled>
                                        Status: En Proceso
                                    </button>
                                    @elseif($finalizar == 0)
                                    <button class="btn btn-primary" name="id_report" onclick=" location.href='terminar/{{$i->id}}' ">
                                        Terminar Inventario
                                    </button>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
                    <div class="panel-actions float-right">
                        <div class="container-fluid row float-right">
                            @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
                            <!-- Botón para Generar PDF de productos-->
                            @if(Auth::user()->type_user == 1)
                            <!-- <div class="col-6">
                              <button onclick="window.location.href='inventariospdf'"
                              type="button" class=" btn btn-sm small btn-floating
                              btn-danger waves-effect waves-light waves-round float-right"
                              data-toggle="tooltip" data-original-title="Generar reporte PDF">
                              <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                            </button>
                            </div> -->
                            @endif
                            <!--  <div class="col-6=">
                              <button onclick="window.location.href='/inventarios/create'"
                              type="button" class=" btn btn-sm small btn-floating
                              btn-info waves-effect waves-light waves-round float-left"
                              data-toggle="tooltip" data-original-title="Agregar">
                              <i class="icon md-plus" aria-hidden="true"></i>
                             </button>
                            </div>  !-->
                            <!-- END Botón-->
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 input-group mb-3" id="actualizar" style ="margin:0 auto;">
                <input class="form-control" type="search" id="text" placeholder="Introduce la clave del producto" aria-label="Search" />
            </div>
            <div class="panel-body">
                <!-- Tabla para listar inventarios-->
                <div id="mostrar"></div>
                <div id="prueba">
                  @include('inventory.inventory_products')
                </div>
                <!-- END Tabla-->
            </div>
        </div>
        <form method="post" action="/inventory/check" id="form" class="d-none">
    {{ csrf_field() }}
    <input type="text" name="inventory_id" id="inventory_id">
    <input type="text" name="status" id="status">
    <input type="text" name="discar_cause" id="discar_cause">
    <input type="text" name="status_product" id="status_product">
</form>
    </div>
</div>

@endsection

@section('delete-productos')
<script type="text/javascript">
$(document).ready(function () {
    var id_inventory = {!! $inventory->id !!};
    actual = '#prueba';
    document.getElementById('text').addEventListener('keyup',()=>{
        console.log(document.getElementById('text').value.length)
    if((document.getElementById('text').value.length)>0){

      console.log(text.value)
      fetch(`/productos-inventario/${id_inventory}/?text=${document.getElementById("text").value}&validacion=1`,{
        method: 'get'
      })
      .then(response => response.text())
      .then(html => {
        document.getElementById('mostrar').innerHTML = html
        document.getElementById('prueba').hidden = true;
      })

      $("#mostrar li a.page-link").each((index, element) =>{
        console.log($(this).data('href'))
        console.log("hola"+text.value)
        })


    }else{

      document.getElementById('mostrar').innerHTML = "";
      document.getElementById('prueba').hidden = false;

    }   
  })

  $(document).on('click', '.exist', function () {
        let id = $(this).attr("alt");
        Swal.fire({
            title: 'Confirmación',
            text: "¿El producto se encuentra en inventario?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4caf50',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
        }).then((result) => {
            if (result.value) {
                $('#inventory_id').val(id);
                $('#status_product').val(2);
                $('#status').val(2);
                $('#form').submit();
            }
        })
    });
    $(document).on('click', '.lost', function () {
        let id = $(this).attr("alt");
        Swal.fire({
            title: 'Confirmación',
            text: "¿El producto NO se encuentra en inventario?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4caf50',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
        }).then((result) => {
            if (result.value) {
                $('#inventory_id').val(id);
                $('#status').val(4);
                $('#discar_cause').val(1);
                $('#status_product').val(5);
                $('#form').submit();
            }
        })
    });
    $(document).on('click', '.damaged', function () {
        let id = $(this).attr("alt");
        Swal.fire({
            title: 'Confirmación',
            text: "¿El producto se encuentra dañado?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4caf50',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
        }).then((result) => {
            if (result.value) {
                $('#inventory_id').val(id);
                $('#status').val(3);
                $('#discar_cause').val(2);
                $('#status_product').val(4);
                $('#form').submit();
            }
        })
    });
    $(document).on('click', '.restart', function () {
        let id = $(this).attr("alt");
        var message = "¿Desea restablecer este producto?";
        Swal.fire({
            title: message,
            input: 'password',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            showLoaderOnConfirm: true,
            preConfirm: (password) => {
                return fetch('/check-user', {
                    method: 'POST',
                    body: JSON.stringify({ password: password }),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                            `Contraseña incorrecta`
                        )
                    })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.value) {
                $('#inventory_id').val(id);
                $('#status_product').val(2);
                $('#status').val(1);
                $('#discar_cause').val(null);
                $('#form').submit();
            }
        })
    });
});
</script>
@endsection