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
                    @foreach($name_branch as $branch)
                    <h1 class="text-center panel-title">Inventarios {{$branch->name}}</h1>
                    @endforeach
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
            <div class="row" style ="text-align:center;">
                <div class="col-md-6">
                    @foreach ($id_inventory as $i)
                        @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
                            @if($inventory->status_report == 3)
                            <button class="btn btn-primary" name="id_report" disabled>
                                Inventario Terminado
                                @elseif($finalizar > 0)
                                <button class="btn btn-primary" name="id_report" disabled>
                                    Aun No Has Acabado El Inventario
                                </button>
                                @elseif($finalizar == 0)
                                <button class="btn btn-primary" name="id_report" onclick=" location.href='terminar/{{$i->id}}' ">
                                    Terminar Inventario
                                </button>
                            @endif
                        @endif
                    @endforeach
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3" id="actualizar">
                        <input class="form-control col-md-6" type="search" id="text" placeholder="Introduce la clave del producto" aria-label="Search" />
                    </div>
                </div>
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
        
    </div>
</div>
@endsection

@section('delete-productos')
<script type="text/javascript">
  $(document).ready(function () {
    var id_inventory = {!! $inventory->id !!};
    actual = '#prueba'
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

});
</script>
@endsection