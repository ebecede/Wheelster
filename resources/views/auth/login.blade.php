@extends('layout')

@section('content')
<div class="container col-md-3 col-sm-8 col-10 backblue">
    <div class="text-center">
        <h1>Sign In</h1> <br>
    </div>

    {{-- Menampilkan error global, misalnya kesalahan login --}}
    @if (session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3 position-relative">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Password" style="padding-right: 40px;">
            <button type="button" onclick="togglePasswordVisibility()" class="btn btn-light position-absolute bottom-0 end-0" style="border:none; background-color: transparent;">
                <i id="toggleIcon" class="bi bi-eye-slash"></i>
            </button>

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
            <div class="col-md-8 offset-md-2 d-flex flex-column align-items-center">
                <button type="submit" class="btn btn-darkblue btn-block mb-3">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn text-darkblue p-0" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div>

    </form>
    <br>
    <hr style="border-color: black;">
    <div class="text-center mt-4">
        <p>Don't have an account? <strong><a href="{{ route('register') }}" style="color: black; text-decoration: none;">Sign Up</a></strong></p>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById('password');
        var toggleIcon = document.getElementById('toggleIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.className = 'bi bi-eye'; // Change icon to open eye
        } else {
            passwordInput.type = 'password';
            toggleIcon.className = 'bi bi-eye-slash'; // Change icon back to eye slash
        }
    }
</script>
@endsection
