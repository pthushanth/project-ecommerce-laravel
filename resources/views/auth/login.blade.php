@extends('admin.layouts.app')
@section('styles')
   <style>
        .page-container{
            padding-left: 0px;
        }
        .main-content{
            padding-top: 0px;
        }
        .au-btn{
            background-color: #18A0FB;
        }
   </style>
@endsection
@section('content')
<div class="container">
    <div class="login-wrap">
        <div class="login-content">
            <div class="login-logo">
                <a href="#">
                    <img src="{{asset('images/logo.png')}}" alt="Tech Zone">
                </a>
            </div>
            <div class="login-form">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email Address</label>
                        <input id="email" type="email" class="au-input au-input--full @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input id="password" type="password" class="au-input au-input--full @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="login-checkbox">
                        <div class="form-group row">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        
                            <div class="col">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <button class="au-btn au-btn--block m-b-20" type="submit">sign in</button>
                    
                </form>
                <div class="register-link">
                    <p>
                        Don't you have account?
                        <a href="{{ route('register') }}">Sign Up Here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection