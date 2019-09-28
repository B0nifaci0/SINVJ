@extends('layout.layoutdas')
@section('title')
LISTA DE  LINEA
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
        <header class="panel-heading">
        <div class="panel-actions">
            <div class="row">
              @if(Auth::user()->type_user == 1 )
                <!-- Botón para Generar PDF de productos-->
                <div class="col-md-4 col-md-offset-2">
                  <button onclick="window.location.href='productospdf'" 
                    type="button" id='pdf01' name='pdf01'class=" btn btn-sm small btn-floating 
                    toggler-left  btn-danger waves-effect waves-light waves-round float-right"
                    data-toggle="tooltip" data-original-title="Generar reporte PDF">
                    <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                  </button>
                </div>
                <!-- END Botón-->
                <!-- Botón para generar Excel-->
                <div class="col-md-4 col-md-offset-2">
                  <button onclick="window.location.href='#'" 
                    type="button" class=" btn btn-sm small btn-floating 
                    toggler-left  btn-success waves-effect waves-light waves-round float-right"
                    data-toggle="tooltip" data-original-title="Generar reporte Excel">
                    <i class="icon fa-file-excel-o" aria-hidden="true"></i>
                  </button>
                </div>
                <!-- END Botón-->
                <!-- Botón para agregar productos-->
                <div class="col-md-4 col-md-offset-2">
                  <button onclick="window.location.href='/gastos/create'" 
                    type="button" class=" btn btn-sm small btn-floating 
                    toggler-left  btn-info waves-effect waves-light waves-round float-right"
                    data-toggle="tooltip" data-original-title="Agregar">
                    <i class="icon md-plus" aria-hidden="true"></i>
                  </button>
                </div>
                <!-- END Botón-->
              @endif
            </div>
          </div>
          <h3 class="panel-title">Gastos</h3>
        </header>
        <div class="panel-body">
        <!-- Tabla para listar inventarios-->
          <table id='example'  class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
            <thead>
              <tr>
                <th>Nombre del colaborador</th>
                <th>Concepto</th>
                <th>Monto</th>
                <th>Ticket</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Nombre del colaborador</th>
                <th>Concepto</th>
                <th>Monto</th>
                <th>Ticket</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($expenses as $expense)
                <tr id = "row{{ $expense->id }}">
                  <td>{{ $expense->user->name }}</td>
                  <td>{{ $expense->concept }}</td>
                  <td>$ {{ $expense->amount }}</td>
                  <td>
                    <a class="btn btn-primary" href="/inventarios/{{ $expense->id }}">
                    <i class="icon md-search"></i>
                    </a>
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
@endsection


@section('barcode-product')

@endsection