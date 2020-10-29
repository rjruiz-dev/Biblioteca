<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Biblioteca&nbsp;Online | Reset Password</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="/adminlte/css/AdminLTE.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <!-- <a href="/">{{ env('APP_NAME') }}</a> -->
            <a href="/"><b>Biblioteca&nbsp;</b>Online</a>
        </div> 
        <div class="login-box-body">
            <p class="login-box-msg">Reestablece tu contraseña</p>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
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
                    <input id="password" 
                        type="password" 
                        class="form-control" 
                        placeholder="Nueva contraseña" 
                        name="password" 
                        required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group {{ $errors->has('password') ? ' is-invalid' : '' }} has-feedback">
                    <input id="password-confirm" 
                        type="password" 
                        class="form-control" 
                        placeholder="Nueva contraseña" 
                        name="password_confirmation" 
                        required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">        
                    <div class="col-xs-12"> 
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Restablecer contraseña</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>




