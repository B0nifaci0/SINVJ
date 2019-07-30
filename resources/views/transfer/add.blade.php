@extends('layout.layoutdas')
@section('title')
ALTA PRODUCTO
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
            <!-- END Select-->
            <div class="col-md-3">
              <input type="hidden" name="status_product" value="0">
            </div> 
          </div>   
          <!-- Botón para guardar traspaso-->
          <div class="form-group col-md-12">
            <button id="submit" type="submit" name="button" class="btn btn-primary">Guardar</button>
          </div>
          <!-- END Botón-->
        </form>
      </div>
    </div>
  </div>
@endsection
<!-- Función para seleccionar solo los usuarios de esa sucursal(Combo dinamico)-->
@section('branch-user')
<script type="text/javascript">

$(".sucursales").change(function(){
  var selector =  $(this).attr("alt");
  var id_sucursal = $(this).val();
  var url = '/sucursales/' + id_sucursal + '/usuarios';
  $.get(url, function(json){
    $('#usuarios_' + selector).empty();
        $.each(json,function(i, user){
          $('#usuarios_' + selector).append(
              '<option value="" selected disabled>Seleccione un colaborador</option>'
            + '<option value = '+ user.id +'>' + user.name +'</option>'
          );
        });
  });
});
$(".usuarios").change(function(){
      var id_user = $(this).val();
      var selector = $(this).attr("alt");
      $("#id_user_" + selector).val(id_user);
    });

$(".sucursales1").change(function(){
  var selector =  $(this).attr("alt");
  var id_sucursal = $(this).val();
  var url = '/sucursales/' + id_sucursal + '/usuarios';
  $.get(url, function(json){
    $('#usuario_' + selector).empty();
        $.each(json,function(i, user){
          $('#usuario_' + selector).append('<option value = '+ user.id +'>' + user.name +'</option>')
        });
  });
});
      var id_user = $(this).val();
      var selector = $(this).attr("alt");
      $("#id_user_" + selector).val(id_user);
    });

</script>
@endsection
<!-- END Función-->
@section('traspaso')
<script type="text/javascript">
$('.accept').click(function({
  var id = $(this).attr('alt');
  $('#t_product_id').val(id);
  $('#status').val(1)

  $('#form').submit();
});  
});
</script> 
@endsection
