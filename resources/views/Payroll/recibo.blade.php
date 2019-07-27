@extends('layout.layoutdas')
@section('title')
Panel Principal
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="page">
    <div class="page-content container-fluid">
        <form action="/recibopdf">
            <div class=" col-12"> 
                <div class="panel panel-bordered">
                <div class="panel-heading">
                    <h3 class="bg-info panel-title text-center text-white">RECIBO DE NOMINA</h3>
                </div>
                <div class="panel-body row col-12">
                    <div class="row col-12">
                    <div class="col-6">
                        <label>Seleccione Sucursal</label>
                            <select id="sucursales_1"  name="branch_id" alt="1" class="form-control round sucursales">
                            <option value="*">Seleccione Sucursal</option>
                            @php  
                            $branches = $user->shop->branches;
                            @endphp
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" required>{{ $branch->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="floating-label" for="inputUser">{{ __('Empleado') }}</label>
                            <select id="usuarios_1" name="user_id" class="round form-control "></select>
                        </div>
                    </div>
                    </div>
                    <div class="input-group col-3">
                        <button id="submit" type="submit" name="button" class="btn btn-primary">Generar recibo</button>
                    </div>
        </form>
    </div>
</div>
@endsection

@section('branch-user')
<script type="text/javascript">

$(".sucursales").change(function(){
  var selector =  $(this).attr("alt");
  var id_sucursal = $(this).val();
  var url = '/sucursales/' + id_sucursal + '/usuarios';
  $.get(url, function(json){
    $('#usuarios_' + selector).empty();
    //alert('#municipios_' + selector);
        $.each(json,function(i, user){
          $('#usuarios_' + selector).append('<option value = '+ user.id +'>' + user.name +'</option>')
        });
  });
});
$(".usuarios").change(function(){
      var id_user = $(this).val();
      var selector = $(this).attr("alt");
      $("#id_user_" + selector).val(id_user);
    });
$(".usuarios").change(function(){
      var id_user = $(this).val();
      var selector = $(this).attr("alt");
      $("#id_user_" + selector).val(id_user);
    });
</script>
@endsection