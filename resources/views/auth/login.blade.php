@extends('layout')

@section('content')
<div class="container col-md-3 backblue">
    <div class="text-center">
        <h1>Sign In</h1> <br>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="row mb-3">
            <div class="col-md-6 ms-1">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div>
        <br>
        <div class="row mb-0">
            <div class="col-md-8 offset-md-2">
                <button type="submit" class="btn btn-darkblue btn-block">
                    {{ __('Login') }}
                </button>
            </div>
        </div>
    </form>
    <br>
    <hr style="border-color: black;">
    <div class="text-center mt-4">
        <p>Don't have an account? <strong><a href="{{ route('register') }} " style="color: black; text-decoration: none;">Sign Up</a></strong></p>
    </div>
</div>
@endsection
