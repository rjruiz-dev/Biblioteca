<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ $ml_password->pri_nombre_rp }}&nbsp;{{ $ml_password->seg_nombre_rp }} | {{ $ml_password->reset_rp }}</title>

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
    <a href="/"><b>{{ $ml_password->pri_nombre_rp }}&nbsp;</b>{{ $ml_password->seg_nombre_rp }}</a>
  </div> 
  <div class="login-box-body">
    <p class="login-box-msg">{{ $ml_password->reset_msg_rp }}</p>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group {{ $errors->has('email') ? ' is-invalid' : '' }} has-feedback">
            <input type="email"
                class="form-control"
                placeholder="{{ $ml_password->email_rp }}"
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

        <div class="row">        
            <div class="col-xs-12"> 
                <button type="submit" class="btn btn-primary btn-block btn-flat">{{ $ml_password->btn_reestablecer_rp }}</button>
            </div>
      </div>       
    </form>
  </div>
</div>
<script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>




