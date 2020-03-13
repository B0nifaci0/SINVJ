@extends('layout.register')

@section('content')
    <!-- Page -->
    <div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
      <div class="page-content">
        <div class="page-brand-info">
          <div class="brand">
            <img class="brand-img" src="../../assets/images/logo@2x.png" alt="...">
            <h2 class="brand-text font-size-40">SINVJ</h2>
          </div>
          <p class="font-size-20">Sistema De Invetarios Para Joyeria Fina.
            Registrate Y Toma El Control De Tu Empresa.</p>
        </div>

        <div class="page-register-main">
          <div class="brand hidden-md-up">
            <img class="brand-img" src="../../assets/images/logo-colored@2x.png" alt="...">
            <h3 class="brand-text font-size-40">Remark</h3>
          </div>
          <h3 class="font-size-24">Registrate</h3>
          <p>Ingresa Los Siguientes Datos Para Completar Tu Registro.</p>
           <!-- Form,Method "POST" Envia los datos del formulario a la base de datos-->
           <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Input para ingresar Nombre-->
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="text" class="form-control empty{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{ old('name') }}" required autofocus>
              <label class="floating-label" for="inputName">{{ __('Nombre') }}</label>
              @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                 <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>
            <!-- END Input-->
            <!-- Input para ingresar Email-->
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="email" class="form-control empty{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}" required>
              <label class="floating-label" for="inputEmail">{{ __('Correo Electronico') }}</label>
              @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
            </div>
            <!-- END Input-->
            <!-- Input para ingresar Contraseña-->
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="password" class="form-control empty{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" required>
              <label class="floating-label" for="inputPassword">{{ __('Contraseña') }}</label>
              @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            </div>
            <!-- END Input-->
            <!-- Input para ingresar Confirmacion de contraseña-->
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input id="password-confirm" type="password" class="form-control empty" id="inputPasswordCheck" name="password_confirmation" required>
              <label class="floating-label" for="inputPasswordCheck">{{ __('Confirmar Contraseña') }}</label>
            </div>
            <!-- END Input-->
            <!-- Input para ingresar Nombre de la Tienda-->
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="text" class="form-control empty{{ $errors->has('name_shop') ? ' is-invalid' : '' }}" id="name_shop" name="name_shop" value="{{ old('name_shop') }}" required autofocus>
              <label class="floating-label" for="inputName">{{ __('Tienda') }}</label>
              @if ($errors->has('name_shop'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name_shop') }}</strong>
                </span>
            @endif
            </div>
            <!-- END Input-->
            <div>
              <input type="hidden" name='type_user' value='1'>
            </div>
            <!--<div class="form-group form-material floating" data-plugin="formMaterial">
                <input type="text" class="form-control empty{{ $errors->has('name_branch') ? ' is-invalid' : '' }}" id="name_branch" name="name_branch" value="{{ old('name_branch') }}" required autofocus>
                <label class="floating-label" for="inputName">{{ __('Sucursal') }}</label>
                @if ($errors->has('name_branch'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('name_branch') }}</strong>
                  </span>
              @endif
              </div>-->
              <div>
                <input type="hidden" name='salary' value='NULL'>
              </div>
              <!-- Select para Seleccionar Estado-->
              <div class="col-md-12  col-md-offset-1 visible-md visible-lg">
                  <label class="floating-label" for="inputState">{{ __('Estado') }}</label>
                  <select id="estados_1" class="form-control round estados" name="state_id" alt="1" >
                    <option value="*">Seleccione Estado</option>
                    @foreach ($states as $state)
                      <option value="<?= $state->id ?>"><?= $state->name ?></option>
                    @endforeach
                  </select>
              </div>
              <!-- END Select-->
              <!-- Select para Seleccionar Municipio-->
              <div class="col-md-12 col-md-offset-1 visible-md visible-lg">
                <label class="floating-label" for="inputMunicipality">{{ __('Municipio') }}</label>
                <select id="municipios_1" name="municipality_id" class="form-control round"></select>
              </div>
              <!-- END Select-->
              <br>
              <!-- checkbox para Aceptar terminos y condiciones-->
              <div class="form-group clearfix">
                <div class="checkbox-custom checkbox-inline checkbox-primary float-left">
                  <input type="checkbox" id="aceptotc" name="terms_conditions" value='1' required>
                  <label for="inputCheckbox"></label>
                </div>
                <!-- END checkbox-->
                <p class="ml-35">Al hacer clic en Registrarse, usted acepta nuestros <a href="#"> Términos.</a>.</p>
              </div>
              <!-- INICIA CAPTCHA -->
              <div class="form-group row">
                <div class="col-md-6 ">
                  <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                    @if($errors->has('g-recaptcha-response'))
                        <span class="invalid-feedback" style="display:block">
                          <strong>{{$errors->first('g-captcha-response')}}</strong>
                        </span>
                    @endif 
                  </div>  
              </div>  
              <!--TERMINA CAPTCHA-->
              <!-- Botón para  Registrarse-->
              <button id="register" type="submit" class="btn btn-primary"class="btn btn-primary btn-block registro" alt="reg">
                {{ __('Register') }}
            </button>
              <!-- END Botón-->
              <p>¿Tienes cuenta ya?  Por favor, vaya a <a href="{{url('login')}}">Iniciar sesión</a></p>
              <footer class="page-copyright">
                <p>WEBSITE BY Digital-PineApple</p>
                <p>© 2019. All RIGHT RESERVED.</p>
                <div class="social">
                  <a class="btn btn-icon btn-round social-twitter mx-5" href="javascript:void(0)">
                <i class="icon bd-twitter" aria-hidden="true"></i>
              </a>
                  <a class="btn btn-icon btn-round social-facebook mx-5" href="javascript:void(0)">
                <i class="icon bd-facebook" aria-hidden="true"></i>
              </a>
                  <a class="btn btn-icon btn-round social-google-plus mx-5" href="javascript:void(0)">
                <i class="icon bd-google-plus" aria-hidden="true"></i>
              </a>
            </div>
          </footer>
        </div>
      </div>
    </div>
@endsection

@section('disabled-submit')
<script type="text/javascript">
$(document).ready(function(){
  $("#estados_1").change(function(){
    if ($(this).val() == "" {
      $("#register").prop("disabled", true);
    }else{
      $("#register").prop("disabled", false);
    }
  });
});
  </script>
@endsection


