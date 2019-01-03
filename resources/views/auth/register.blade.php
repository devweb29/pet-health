@extends('admin.layouts.authentication')

@push('styles')

@endpush

@push('scripts')
    <script>
        $(document).ready(function(){
            $('body').addClass('hold-transition register-page')
        })
    </script>
@endpush

@section('title')

@endsection

@section('content')

<div class="register-box">
        <div class="register-logo">
        <a href="{{url('admin/dashboard')}}"><b>Admin</b>LTE</a>
        </div>
        <div class="register-box-body">
          <p class="login-box-msg">Register a new membership</p>
      
          <form method="POST" action="{{ route('register') }}">
                @csrf
            <div class="form-group has-feedback">
              <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Full name" value="{{ old('name') }}" required autofocus>
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
              @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-group has-feedback">
              <input type="email" name="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" value="{{ old('email') }}" required>
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group has-feedback">
              <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required>
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group has-feedback">
              <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password" required>
              <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="row">
              <div class="col-xs-8">
                <div class="checkbox icheck">
    
                </div>
              </div>
              <!-- /.col -->
              <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    {{ __('Register') }}
                </button>
              </div>
              <!-- /.col -->
            </div>
          </form>
      
          <a href="{{url('login')}}" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
      </div>

@endsection