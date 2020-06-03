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
            <p class="font-size-20">Sistema De Inventarios Para Joyería Fina.</p>
        </div>
        <div class="page-login-main">
            <div class="brand hidden-md-up">
                <img class="brand-img" src="../../assets/images/logo-colored@2x.png" alt="...">
                <h3 class="brand-text font-size-40">SINVJ</h3>
            </div>
            <h3 class="font-size-24">INICIAR SESIÓN</h3>
            <p>Ingresa Usuario y Contraseña Para Iniciar Sesión.</p>
            <!-- Form, Method "POST" para verificar correo y contraseña del usuario en la base de datos-->
            <form method="POST" onsubmit="return submitUserForm();" action="{{ route('login') }}">
                @csrf
                <!-- Input para ingresar Correo electronico-->
                <div class="form-group form-material floating" data-plugin="formMaterial">
                    <input type="email" class="form-control empty{{ $errors->has('email') ? ' is-invalid' : '' }}"
                        name="email" value="{{ old('email') }}" id="email" name="email" value="{{ old('email') }}"
                        required autofocus>
                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                    <label class="floating-label" for="inputEmail">{{ __('Correo Electronico') }}</label>
                </div>
                <!-- END Input-->
                <!-- Input para ingresar Contraseña-->
                <div class="form-group form-material floating" data-plugin="formMaterial">
                    <input type="password" class="form-control empty{{ $errors->has('password') ? ' is-invalid' : '' }}"
                        id="password" name="password" required>
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                    <label class="floating-label" for="inputPassword">{{ __('Contraseña') }}</label>
                </div>
                <!-- END Input-->
                <!-- CheckBox para Recordar Usuario-->
                <div class="form-group clearfix">
                    <div class="checkbox-custom checkbox-inline checkbox-primary float-left">
                        <input type="checkbox" id="remember" name="checkbox" {{ old('remember') ? 'checked' : '' }}>
                        <label for="inputCheckbox">{{ __('Recuerdame') }}</label>
                    </div>
                    <!--<a class="float-right" href="href=¡"{{route('password.request') }}">{{ __('Olvidaste tu contraseña?')}}</a>-->
                </div>
                <!-- END CheckBox-->
                <!-- INICIA CAPTCHA -->
                <div class="g-recaptcha" data-sitekey="6LceneAUAAAAAC1It9wnjrO7H8wHYRujfzM2zQme"
                    data-callback="verifyCaptcha"></div>
                <div id="g-recaptcha-error"></div>
                <!--TERMINA CAPTCHA-->

                <!-- Botón para ingresar Iniciar Sesion-->
                <button type="submit" class="btn btn-primary btn-block">Iniciar</button>
                <!-- END Botón-->
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
            <script>
                function submitUserForm() {
                    var response = grecaptcha.getResponse();
                    if (response.length == 0) {
                        document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">Por favor marque la casilla.</span>';
                        return false;
                    }
                    return true;
                }

                function verifyCaptcha() {
                    document.getElementById('g-recaptcha-error').innerHTML = '';
                }
            </script>
            <p>No tienes Cuenta? <a href={{{url('usuario')}}}>Registrarse</a></p>

            <footer class="page-copyright">
                <p>WEBSITE BY Digital-PineApple</p>
                <p>© 2019. Digital-PineApple.</p>
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
