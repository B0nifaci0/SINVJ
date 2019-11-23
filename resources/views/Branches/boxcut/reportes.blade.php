@extends('layout.layoutdas')
@section('title')
Panel Principal
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<!-- Formulario de Reporte de Productos por estatus-->
<div class="page">
  <div class="page-content container-fluid">
      <div class="table-responsive">
          <table class="table table-sm text-center">
            <thead>
              <tr>
                <th>Sucursal</th>
                <th>De la fecha:</th>
                <th>Hasta la fecha:</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($branches as $branch)
              <tr>
                <td>{{$branch-> name}}</td>
                <td>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="icon md-calendar" aria-hidden="true"></i>
                      </span>
                    </div>
                    <input name="fecini" type="text" class="form-control fecini round" data-plugin="datepicker" required>
                  </div>
                </td>
                <td>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="icon md-calendar" aria-hidden="true"></i>
                      </span>
                    </div>
                    <input name="fecter" type="text" class="form-control round" data-plugin="datepicker" required>
                  </div>
                </td>
                <td>
                  <a href="{{route('sucursalcorte', $branch->id)}}"><button type="button"
                      class="btn btn-icon btn-danger waves-effect waves-light" data-toggle="tooltip"
                      data-original-title="Generar reporte PDF">
                      <i class="icon fa-file-pdf-o" aria-hidden="true"></i>Generar reporte</button>
                    <i class="fas fa-sync-alt"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
  </div>
</div>
</div>
<!-- Termina formulario de Prueba -->
@endsection