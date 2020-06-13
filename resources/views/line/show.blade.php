@extends('layout.layoutdas')
@section('title')
SUCURSAl
@endsection

@section('nav')
@endsection
@section('menu')

@endsection
@section('content')

<div class="page-content">
  <div class="panel panel-info panel-bordered" data-plugin="appear" data-animate="fade">
    <header class="panel-heading">
      <div class="panel-actions">
        <a href="/lineas/{{$line->id}}/edit">
          <button class="btn-raised btn btn-primary btn-floating btn-sm" data-toggle="tooltip" data-original-title="Editar">
            <i class="icon md-edit" aria-hidden="true"></i>
          </button>
        </a>
      </div>
      <h2 class="panel-title">Promoción</h2>
    </header>
      <div class="table-responsive container-fluid">
				<div class="panel-body">
			    <table class="table table-hover">
						<tbody>
								<tr>
									<td> <strong>Nombre</strong></td>
									<td>{{$line->name}}</td>
								</tr>
						
						</tbody>
					</table>
				</div>
      </div>
  </div>
</div>
@endsection

