<!-- resources/views/auth/login.blade.php -->
@extends('layout')

@section('content')
<div class="container col-md-4 login">
    <div class="logo">
      <img src="{{ asset('images/logo-2.png') }}" alt="Wheelsteer Logo">
    </div>
    <form>
      <div class="form-group">
        <label for="username">Username / E-mail</label>
        <input type="text" class="form-control custom-input" id="username" placeholder="Enter username or email">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control custom-input" id="password" placeholder="Enter password">
      </div>
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-darkblue">Login</button>
      </div>
    </form>
    <div class="create-account">
      Don't have an account? <a href="#">Create an Account!</a>
    </div>
</div>
@endsection
