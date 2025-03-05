@extends('layout')

@section('content')
<div class="container col-md-6 col-sm-8 col-10 backblue">
    <div class="text-center">
        <h1>Sign Up</h1> <br>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="row">
                    <!-- Name Field -->
                    <div class="col-md-6 mb-3 position-relative">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Name">

                        <!-- Error Message -->
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="col-md-6 mb-3 position-relative">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Email">

                        <!-- Error Message -->
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Password Field -->
                    <div class="col-md-6 mb-3 position-relative">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Password" style="padding-right: 40px;">

                        <!-- Error Message -->
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="col-md-6 mb-3 position-relative">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control"
                            name="password_confirmation" autocomplete="new-password" placeholder="Confirm Password">
                    </div>
                </div>

                <br>
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn btn-darkblue btn-block">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <hr style="border-color: black;">
            <div class="text-center mt-4">
                <p>Already have an account? <strong><a href="{{ route('login') }}" style="color: black; text-decoration: none;">Sign In</a></strong></p>
            </div>
        </div>
    </div>
</div>
@endsection
