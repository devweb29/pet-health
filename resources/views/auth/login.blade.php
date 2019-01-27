@extends('admin.layouts.authentication')

@push('styles')

@endpush

@push('scripts')
    <script>
        $(document).ready(function(){
            $('body').addClass('hold-transition login-page')
        })
    </script>
@endpush

@section('title')

@endsection

@section('content')

<div class="login-box">
        <div class="login-logo">
        <a href="{{url('')}}">
          <img src="{{url('vendor/node_modules/new_front_template/images/logo.png')}}" width="150" height="150"/>
        </a>
        </div>
        <div class="login-box-body">
          <p class="login-box-msg">Sign in to start your session</p>
          <form method="POST" action="{{ route('login') }}">

            @csrf

            <div class="form-group has-feedback">
              <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-group has-feedback">
              <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required>
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
              @endif
            </div>
            <div class="row">
              <div class="col-xs-8">
              </div>
              <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
              </div>
            </div>
          </form>
      
        </div>
</div>
@endsection