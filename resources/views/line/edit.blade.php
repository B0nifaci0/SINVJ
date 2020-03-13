
@extends('layout.layoutdas')
@section('title')
EDITAR LINEA
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
      <center><h3> Linea</h3></center>  
      <form action="{{ route('lineas.update', ['id' => $line->id]) }}" id="FormLines" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="row">
        <div class="form-group form-material col-md-4">
               <label class="form-control-label" for="inputBasicLastName"> Nombre Linea:</label>
               <input type="text" class="form-control"value="{{$line->name}}" required="required" name="name"> 
               </div> 
      <div class="form-group form-material col-md-4">
               <label class="form-control-label" for="inputBasicLastName">Precio Compra:</label>
               <input type="text" class="form-control"value="{{$line->purchase_price}}" required="required" id="purchase_price" name="purchase_price"> 
               <input type="hidden" value="{{$line->purchase_price}}" id="old_purchase_price"> 
      </div>
            <div class="form-group form-material col-md-4">
               <label class="form-control-label" for="inputBasicLastName">Precio venta:</label>
               <input type="text" class="form-control" name="sale_price" value="{{$line->sale_price}}" id="sale_price" required="required" placeholder="$1200" />
               <input type="hidden" value="{{$line->sale_price}}" id="old_sale_price"> 
      </div>  
      <div class="form-group form-material col-md-4">
               <label class="form-control-label" for="inputBasicLastName">Tope de descuento:</label>
               <input type="text" class="form-control" name="discount_percentage" id="discount_percentage" value="{{$line->discount_percentage}}" required="required" placeholder="$" />
               <input type="hidden" value="{{$line->discount_percentage}}" id="old_discount_percentage"> 
      </div>

      <input type="hidden" value="{{$line->id}}" id="line_id"> 

        <div class="form-group col-md-12">
          <button id="SaveLine" type="submit" name="button" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

@section('listado-productos')
<script>
    $(document).ready(function() {

        $('#SaveLine').click(function(e) {
            console.log("Diste click");
            e.preventDefault();
            let id = Number($('#line_id').val());;
            let purchase = Number($('#purchase_price').val());
            let old_purchase = Number($('#old_purchase_price').val());
            let sale = Number($('#sale_price').val());
            let old_sale = Number($('#old_sale_price').val());
            let discount = Number($('#discount_percentage').val());
            let old_discount = Number($('#old_discount_percentage').val());
            console.log(id, purchase, old_purchase, sale, old_sale, discount, old_discount);
            if (purchase != old_purchase || sale != old_sale || discount != old_discount) {
              swal.fire({
                  title: 'Confirmación',
                  text: 'Al cambiar los precios de la linea se actualizaran los precio de los productos, ¿Esta Seguro?',
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, Seguro'
              }).then((result) => {
                  if (result.value)
                  {
                    console.log(result.value);
                    $('#FormLines').submit();
                  } else {
                    return;
                  }
                })
            } else {
              $('#FormLines').submit();
            }
        });
    });
</script>
@endsection

@endsection
