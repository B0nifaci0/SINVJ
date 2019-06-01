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

          <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
            @csrf            
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="text" class="form-control empty{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{ old('name') }}" required autofocus>
              <label class="floating-label" for="inputName">{{ __('Nombre') }}</label>
              @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="email" class="form-control empty{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}" required>
              <label class="floating-label" for="inputEmail">{{ __('Correo Electronico') }}</label>
              @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="password" class="form-control empty{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" required>
              <label class="floating-label" for="inputPassword">{{ __('Contraseña') }}</label>
              @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input id="password-confirm" type="password" class="form-control empty" id="inputPasswordCheck" name="password_confirmation" required>
              <label class="floating-label" for="inputPasswordCheck">{{ __('Confirmar Contraseña') }}</label>
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="text" class="form-control empty{{ $errors->has('name_shop') ? ' is-invalid' : '' }}" id="name_shop" name="name_shop" value="{{ old('name_shop') }}" required autofocus>
              <label class="floating-label" for="inputName">{{ __('Tienda') }}</label>
              @if ($errors->has('name_shop'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name_shop') }}</strong>
                </span>
            @endif
            </div>
            <div>
              <input type="hidden" name='type_user' value='0'> 
            </div>
            <div class="col-md-12  visible-md visible-lg">
                <label class="floating-label" for="inputState">{{ __('Estado') }}</label>
                <select id="state" class="form-control round municipios" name="state_id" >
                <option value="*">Seleccione Estado</option>
                @foreach ($states as $state)
                    <option value="<?= $state->id ?>"><?= $state->name ?></option>
                @endforeach
                </select>
            </div>
            <div class="col-md-12  visible-md visible-lg">
              <label class="floating-label" for="inputMunicipality">{{ __('Municipio') }}</label>
              <select id="municipality" class="form-control round municipios" name="municipality_id" >
              <option value="*">Seleccione Municipio</option>
                @foreach ($municipalities as $municipality)
                  <option value="<?= $municipality->id ?>"><?= $municipality->name ?></option>
                @endforeach
              </select>
            </div> 
            <div class="form-group clearfix">
              <div class="checkbox-custom checkbox-inline checkbox-primary float-left">
                <input type="checkbox" id="inputCheckbox" name="term">
                <label for="inputCheckbox"></label>
              </div>
              <p class="ml-35">Al hacer clic en Registrarse, usted acepta nuestros <a href="#"> Términos.</a>.</p>
            </div>
            <button type="submit" class="btn btn-primary btn-block">{{ __('Registrarse') }}</button>
          </form>

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
    <!-- End Page -->
<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                    
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{__('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>-->
@endsection
