@extends('layout.login')

@section('content')
    <!-- Page -->
    <div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
      <div class="page-content">
        <div class="page-brand-info">
          <div class="brand">
            <img class="brand-img" src="../../assets/images/logo@2x.png" alt="...">
            <h2 class="brand-text font-size-40">SINVJ</h2>
          </div>
          <p class="font-size-20">Sistema De Inventarios Para Joyeria Fina.</p>
        </div>

        <div class="page-login-main">
          <div class="brand hidden-md-up">
            <img class="brand-img" src="../../assets/images/logo-colored@2x.png" alt="...">
            <h3 class="brand-text font-size-40">SINVJ</h3>
          </div>
          <h3 class="font-size-24">INICIAR SESIÓN</h3>
          <p>Ingresa Usuario y Contraseña Para Iniciar Sesión.</p>

          <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
          @csrf

            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="email" class="form-control empty{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" id="email" name="email" value="{{ old('email') }}" required autofocus>
              @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
              <label class="floating-label" for="inputEmail">{{ __('Correo Electronico') }}</label>
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="password" class="form-control empty{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" required>
              @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              <label class="floating-label" for="inputPassword">{{ __('Contraseña') }}</label>
            </div>
            <div class="form-group clearfix">
              <div class="checkbox-custom checkbox-inline checkbox-primary float-left">
                <input type="checkbox" id="remember" name="checkbox" {{ old('remember') ? 'checked' : '' }} >
                <label for="inputCheckbox">{{ __('Recuerdame') }}</label>
              </div>
              <a class="float-right" href="href="{{route('password.request') }}">{{ __('Olvidaste tu contraseña?')}}</a>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Iniciar</button>
          </form>

          <p>No tienes Cuenta? <a href={{{url('register')}}}>Registrarse</a></p>

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
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

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
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>-->
@endsection
