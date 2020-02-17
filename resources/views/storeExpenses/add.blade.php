
@extends('layout.layoutdas')
@section('title')
ALTA GASTOS
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
          <center><h3>Registrar Gasto Realizado</h3></center>
          <form class="" action="/gastos" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}   
            <div class="row">
            <!-- Select para Seleccionar sucursal-->
            @if (Auth::user()->type_user =='1')  
            <div class="form-group col-md-6">
            <label class="form-control-label" for="inputBasicLastName"> Seleccione Sucursal:</label>
              <select name="branch_id" class="form-control round" required>
                @php  
                    $branches = $user->shop->branches;
                @endphp
                  <!--<option value="" required>Gasto de tienda (ninguna sucursal)</option>-->
                  @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" value="{{old('$branch->id')}}"  required>{{ $branch->name }}</option>
                  @endforeach
              </select>
            </div>           
            @endif
            <!-- END Select-->  
              <!-- Input para ingresar el nombre del gasto -->
              <div class="form-group form-material col-md-6">
                <label class="form-control-label" for="inputBasicLastName"> Nombre del Gasto:</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" required="required" placeholder="Franela" />                
              </div>
              <!-- END Input-->
              <!-- Input para ingresar descripcion-->
              <div class="form-group form-material col-md-6">
                <label class="form-control-label" for="inputBasicLastName"> Descripcion:</label>
                <input type="text" class="form-control" name="descripcion" value="{{old('descripcion')}}" />
              </div>
              <!-- END Input-->
              <!-- Select para Seleccionar imagen de comprobante-->
              <div class="form-group form-material col-md-6">
                <label>Selecciona imagen de comprobante</label>
                <br>
                <label for="image" class="btn btn-primary">Explorar</label>
                <input type="file" name="image" id="image" class="hidden" required>
              </div>
              <!-- END Select--> 
              <!-- Input para Ingresar el precio-->
              <div class="form-group form-material col-md-6">
                <label class="form-control-label" for="inputBasicLastName"> Precio:</label>
                <input type="text" class="form-control" name="price" value="{{old('price')}}" required="required" placeholder="$ 100" />
              </div>
              <!-- END Input--> 
              <div>
                @foreach ($shops as $shop)
                <input type="hidden" name="shop_id" value="{{$shop->id}}">
                @endforeach 
              </div>
              <!-- Botón para guardar gasto -->   
              <div class="form-group col-md-12">
                <button id="submit"type="submit" name="button" class="btn btn-primary">Guardar</button>
              </div>
              <!-- END Botón-->
            </div> 
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('footer')

@endsection