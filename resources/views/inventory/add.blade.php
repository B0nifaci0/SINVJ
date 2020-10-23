@extends('layout.layoutdas')
@section('title')
ALTA LíNEAS
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
  <div class="">
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
        <center><h3>Creación de inventario</h3></center>

        <form id="form" class="" action="/inventarios" method="post">
        {{ csrf_field() }}
        <div class="row"> 
			<div class="form-group col-md-12">
		  		<div class="row mt-5">
					<div class="offset-md-2 col-md-4">
						<label for="">Sucursal</label>
						<select name="branch_id" id="inventories" class="form-control mx-auto d-block mb-5">
							@foreach($branches as $branch)
								<option id="{{ $branch->id }}" alt="{{$branch->inventory_validation}}" value="{{ $branch->id }}" {{ ($branch->enabled) ? '' : 'disabled' }}>
									{{ $branch->name }} {{($branch->enabled) ? '' : ' - Ya creado hoy' . $date}}
								</option>
							@endforeach
						</select>
					</div>
					<div class="">
						<br>
						<a id="submit" class="mx-auto d-block btn btn-lg btn-primary text-white">Crear inventario de {{ $date }}</a>
					</div>
				</div>
        	</div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('delete-sucursales')
<script type="text/javascript">
  //console.log("a")
$(document).ready(function() {
  
  setTimeout(()=>{

      $('#submit').click(function(e) {
        var id = $('#inventories').val();
        var validation = $("option:selected", '#inventories').attr("alt");
        console.log(id,validation)
        if(validation > 0){
          Swal.fire({
            title: 'Confirmación',
            text: "Esta Sucursal Tiene Traspasos Activos, ¿Desea Continuar?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6' ,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Crear Inventario!'
          }).then((result) => {
            if (result.value)
            {
              $('#form').submit();
            } else {
              e.preventDefault();
            }
          })
        } else {
          $('#form').submit();
        }
      });

    },500)

  });
</script>
@endsection