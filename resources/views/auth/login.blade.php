<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Biblioteca&nbsp;Online | Login</title>  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="/adminlte/css/AdminLTE.min.css">
  <link rel="stylesheet" href="/adminlte/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <!-- <a href="/">{{ env('APP_NAME') }}</a> -->
    <a href="/"><b>Biblioteca&nbsp;</b>Online</a>
  </div>

  <div class="login-box-body">
    <p class="login-box-msg">Ingresa tus datos para iniciar sesión</p>

    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
        @csrf
      <div class="form-group {{ $errors->has('email') ? ' is-invalid' : '' }} has-feedback">
        <input type="email"
               class="form-control"
               placeholder="Email"
               name="email"
               value="{{ old('email') }}" 
               required autofocus>
        @if ($errors->has('email'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('email') }}</strong>
          </span>
        @endif
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group {{ $errors->has('password') ? ' is-invalid' : '' }} has-feedback">
        <input type="password" 
              class="form-control" 
              placeholder="Contraseña" 
              name="password" 
              required>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="form-group">
          <a href="{{ route('password.request') }}">Olvidaste tu contraseña?</a><br>   
            <!-- <label>
              <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Recuérdame                       
            </label> -->
          </div>
        </div>     
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
        </div>
      </div>
    </form>
    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->   
    <!-- <a href="register.html" class="text-center">Register a new membership</a> -->
  </div> 
</div>

<script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/adminlte/plugins/icheck.min.js"></script>
<script>
  $(function ($) {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>


