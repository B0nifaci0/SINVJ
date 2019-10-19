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
  <div class="page-content">
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

        <form class="" action="/inventarios" method="post">
        {{ csrf_field() }}
        <div class="row"> 
			<div class="form-group col-md-12">
		  		<div class="row mt-5">
					<div class="offset-md-2 col-md-4">
						<label for="">Sucursal</label>
						<select name="branch_id" id="" class="form-control mx-auto d-block mb-5">
							@foreach($branches as $branch)
								<option value="{{ $branch->id }}" {{ ($branch->enabled) ? '' : 'disabled' }}>
									{{ $branch->name }} {{($branch->enabled) ? '' : ' - Ya creado hoy' . $date}}
								</option>
							@endforeach
						</select>
					</div>
					<div class="">
						<br>
						<button type="submit" name="button" class="mx-auto d-block btn btn-lg btn-primary">Crear inventario de {{ $date }}</button>
					</div>
				</div>
        	</div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection