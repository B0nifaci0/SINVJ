
@extends('layout.layoutdas')
@section('title')
EDITAR CATEGORIA
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
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
      <center><h2> Categoria</h2></center>
      <form id="form" action="{{ route('categorias.update', ['id' => $category->id]) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="row">
          <!-- Input Para editar Nombre de categoria-->
          <div class="form-group form-material col-md-6">
            <label class="form-control-label" for="inputBasicLastName"> Nombre Categoria:</label>
            <input type="text" class="form-control" value="{{$category->name}}" name="name">
          </div>
          <!-- END Input-->
          <!-- Input Para ingresar Type Product-->
          <div class="form-group form-material col-md-3">
            <label class="form-control-label" for="inputBasicLastName"> Tipo De Producto:</label>
              <ul class="list-unstyled list-inline m-0">
                @if($category->type_product == 1)
                <li class="list-inline-item mb-20">
                    <input type="radio" value="{{$category->type_product}}" class="iradio_flat-blue checked hover" id="inputRadiosChecked" name="type_product" data-plugin="iCheck" data-checkbox-class="iradio_flat-blue" checked />
                    <label for="inputColorPrimary">PZS</label>
                </li>
                <li class="list-inline-item mb-20">
                    <input type="radio" value="2" class="iradio_flat-blue checked hover" id="inputColorGreen" name="type_product" data-plugin="iCheck" data-checkbox-class="iradio_flat-blue">
                    <label for="inputColorGreen">GRS</label>
                </li>
                @endif
                @if($category->type_product == 2)
                <li class="list-inline-item mb-20">
                    <input type="radio" value="1" class="iradio_flat-blue checked hover" id="inputRadiosChecked" name="type_product" data-plugin="iCheck" data-checkbox-class="iradio_flat-blue" />
                    <label for="inputColorPrimary">PZS</label>
                </li>
                <li class="list-inline-item mb-20">
                    <input type="radio" value="{{$category->type_product}}" class="iradio_flat-blue checked hover" id="inputColorGreen" name="type_product" data-plugin="iCheck" data-checkbox-class="iradio_flat-blue" checked />
                    <label for="inputColorGreen">GRS</label>
                </li>
                @endif
              </ul>
          </div>
          <!-- END Input-->
          @if($rules->count() != 0)
            @if($category->type_product == 1)
              <!-- Input Para asignar regla-->
              <div id="pz" class="form-group form-material col-md-3">
                <label class="form-control-label" for="inputBasicLastName"> Asignar Regla:</label><br>
                <button class="btn btn-primary" data-target="#exampleTabs" data-toggle="modal" type="button">
                <i class="icon fa-cog" aria-hidden="true"></i></button>
              </div>
              <!-- END Input-->
            @else
              <!-- Input Para asignar regla-->
              <div id="pz" class="form-group form-material d-none">
                <label class="form-control-label" for="inputBasicLastName"> Asignar Regla:</label><br>
                <button class="btn btn-primary" data-target="#exampleTabs" data-toggle="modal" type="button">
                <i class="icon fa-cog" aria-hidden="true"></i></button>
              </div>
              <!-- END Input-->
            @endif
          @endif
          <!-- Modal para asignar regla de negocio -->
          <div class="col-xl-4 col-lg-6">
            <!-- Example Tab In Modal -->
            <div class="example-wrap">
                <div class="example">
                    <!-- Modal -->
                    <div class="modal fade modal-success" id="exampleTabs"
                        aria-hidden="true" aria-labelledby="exampleModalTabs" role="dialog"
                        tabindex="-1">
                        <div class="modal-dialog modal-simple">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="exampleModalTabs">Asignar Regla</h4>
                                </div>
                                <div class="modal-body">
                                    <h1 class="text-center panel-title">Reglas Existentes</h1>
                                    <div class="row">
                                      <table id="rules" class="table table-hover dataTable table-striped w-full text-center"
                                        data-plugin="dataTable">
                                        <thead>
                                            <tr>
                                                <th>Operador</th>
                                                <th>Multiplicador</th>
                                                <th>Porcentaje de Descuento</th>
                                                <th>Seleccionar</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Operador</th>
                                                <th>Multiplicador</th>
                                                <th>Porcentaje de Descuento</th>
                                                <th>Seleccionar</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($rules as $rule)
                                            <tr class="rules">
                                                <td><strong> {{ $rule->operator }} </strong></td>
                                                <td> {{ $rule->price }} </td>
                                                <td> {{ $rule->discount_percentage }} %</td>
                                                <td>
                                                  <div class="col-md-12">
                                                  @if($rule->id == $actual_rule)
                                                    <input type="radio" name="business_rule_id" value="{{$rule->id}}" checked>
                                                  @else
                                                    <input type="radio" name="business_rule_id" value="{{$rule->id}}">
                                                  @endif
                                                  </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                      </table>
                                      <button type="button" name="continuar" data-dismiss="modal"
                                              class="btn btn-success btn-lg btn-block"
                                              aria-label="Close">Continuar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                </div>
            </div>
            <!-- End Example Tab In Modal -->
          </div>
          <!-- End Modal -->
          <!-- Botón Para guardar cambios--> 
          <div class="form-group col-md-12">
            <a id="save" type="button" class="btn btn-primary text-white">Guardar</a>
          </div>
          <!-- END Botón-->
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('barcode-product')
<script type="text/javascript">
    //inicializa la tabla para resposnive
    $(document).ready(function () {
        $("#rules").DataTable({
            retrieve: true,
        });

        $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
            $($.fn.dataTable.tables(true))
                .DataTable()
                .columns.adjust()
                .responsive.recalc();
        });
    });
</script>
@endsection

@section('listado-productos')
<script type="text/javascript">
    $(document).ready(function () {

      var num_rules = {!! $rules->count() !!}

      $('input[name=type_product]').change(function() {
        let type = $(this).val();
        if (type == 1) {
            $('#pz').addClass('col-md-3');
            $('#pz').removeClass('d-none');
        } else {
            $('#pz').removeClass('col-md-3');
            $('#pz').addClass('d-none');
        }
      });

      $('#save').click(function(e) {
        let type = $('input:radio[name=type_product]:checked').val();
        let rule = $('input:radio[name=business_rule_id]:checked').val();
        console.log(type,rule);
        if(type == 1 && rule == undefined && num_rules > 0)
        {
          Swal.fire({
            title: 'Confirmación',
            text: "Si no asignas una regla a esta categoria no podrás usarla hasta asignarle una, ¿Quieres Continuar?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6' ,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si!'
          }).then((result) => {
            if (result.value)
            {
              $('#form').submit();
            } else {
              e.preventDefault();
              return
            }
          })
        } else {
          $('#form').submit();
        }
      });

    });
</script>
@endsection
