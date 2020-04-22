@extends('layout.layoutdas')
@section('title')
AJUSTES
@endsection

@section('admin-section')
@endsection
@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="">
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
        <h3 align="center">Registrar nuevo ajuste</h3>
        <form class="" action="/ajustes" method="post">
          {{ csrf_field() }}
          <div class="row">
            <!-- Select -->
            <div class="col-md-6">
              <label>Seleccione El minimo de dias</label>
              <select name="min_day_re" class="form-control round">
                <option value="">Selecciona un numero</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
              </select>
            </div>
            <!-- END Select-->
            <!-- Select-->
            <div class="col-md-6">
              <label>Seleccione El maximo de dias</label>
              <select name="max_day_re" class="form-control round">
                <option value="">selecciona un numero</option>
                <option value="55">55</option>
                <option value="60">60</option>
                <option value="61">61</option>
                <option value="62">62</option>
                <option value="63">63</option>
                <option value="64">64</option>
                <option value="65">65</option>
              </select>
            </div>
            <!-- END Select-->
            <!--boton guardar-->
            <div class=" col-md-6">
              <button type="submit" name="button" class="btn btn-primary">Guardar</button>
            </div>
            <!--fin boton-->
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection