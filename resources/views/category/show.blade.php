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
        <a href="/categorias/{{$category->id}}/edit">
          <button class="btn-raised btn btn-primary btn-floating btn-sm" data-toggle="tooltip" data-original-title="Editar">
            <i class="icon md-edit" aria-hidden="true"></i>
          </button>
        </a>
      </div>
      <div class="panel-title text-center"><h3>Categoria <br> {{$category->name}}</h3></div>
    </header>
    <div class="container-fluid">
			<div class="panel-body">
		    <table class="table table-hover">
					<tbody>
							<tr>
								<td> <strong>Nombre</strong></td>
								<td>{{$category->name}}</td>
							</tr>
							<tr>
								<td> <strong>Tipo de Producto</strong></td>
								@if($category->type_product == 1 )
                <td>Pieza</td>
                @else
                <td>Gramos</td>
                @endif
							</tr>
					</tbody>
				</table>
        @if($category->type_product == 1)
          @if($category->business_rule_id)
          <div class="col-sm-12 col-lg-12">
            <div class="panel-success">
              <div class="panel-heading">
                <h2 class="panel-title text-center" style="color:black">Regla a la que pertenece</h2>
              </div>
              <div class="row">
                <div class="col-sm-12 col-lg-12">
                  <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Operador</th>
                            <th>Multiplicador</th>
                            <th>Porcentaje de Descuento</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Operador</th>
                            <th>Multiplicador</th>
                            <th>Porcentaje de Descuento</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td><strong> {{ $rule->operator }} </strong></td>
                            <td> {{ $rule->price }} </td>
                            <td> {{ $rule->discount_percentage }} %</td>
                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          @else
            <h2 class="panel-title text-center" style="color:black">Actualmente esta categoria no tiene una regla asignada</h2>
          @endif
        @endif
			</div>
    </div>
  </div>
</div>
@endsection

