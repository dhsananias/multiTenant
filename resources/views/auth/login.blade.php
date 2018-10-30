@extends('layouts.frontend')
@section('header-extras')

@endsection
@section('content')
@php
      $url = url('/');
      $dominio = explode('.', $url);
      $dominio = str_replace('http://', '', $dominio[0]);
    @endphp
<div class="login-box">
  {{-- <div class="login-logo">
    <img src="{{ asset("/images/logos/{$dominio}.png") }}">
  </div> --}}
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="login-logo">
        <img src="{{ asset("/images/logos/{$dominio}.png") }}" style="width:100%">
    </div>

    {{-- <p class="login-box-msg">Sign in to start your session</p> --}}

    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Usuario">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Senha">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-offset-8 col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
@endsection




























  