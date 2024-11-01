<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Wheelster</title>
    @yield('pageStyle')
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid text-white">
            <div class="footer-logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Wheelster Logo" style="width: 50px; margin-left: 100px;">
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mx-auto text-center">
                    <!-- Links visible to all users -->
                <a class="nav-link me-3" href="{{ route('home') }}">Home</a>
                @auth
                    @if(Auth::user()->is_admin)
                        <!-- Admin-specific links -->
                        <a class="nav-link me-3" href="{{ route('index_product_admin') }}">Product</a>
                        <a class="nav-link me-3" href="{{ route('show_all_order') }}">Order</a>
                        <a class="nav-link me-3" href="{{ route('view_report') }}">Report</a>
                    @else
                        <!-- User-specific links -->
                        <a class="nav-link me-3" href="{{ route('index_product') }}">Product</a>
                        <a class="nav-link me-3" href="{{ route('show_order') }}">Transaction</a>
                    @endif
                @else
                    <!-- Guest-specific links -->
                    <a class="nav-link me-3" href="{{ route('index_product') }}">Product</a>
                @endauth
                </div>
                <div class="d-flex justify-content-center mt-2 mt-lg-0 me-3">
                    @guest
                        @if (Route::has('login'))
                            <a class="btn btn-white me-2" href="{{ route('login') }}">{{ __('Sign In') }}</a>
                        @endif

                        {{-- @if (Route::has('register'))
                            <a class="btn btn-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif --}}
                    @else
                        <div class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="flex-grow-1">
        @yield('content')
    </div>

    <footer class="footer mt-auto">
        <div class="container">
            <div class="row">
                <!-- Footer Logo -->
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="footer-logo">
                        <img src="{{ asset('images/logo-2.png') }}" alt="Wheelster Logo" style="width: 300px; margin-right: 100px;">
                    </div>
                </div>
                <!-- Footer Navigation -->
                <div class="col-lg-6 col-md-6 mb-4 mb-lg-0">
                    <div class="row footer-nav">
                        <div class="col-6">
                            <a href="#">Home</a>
                            <a href="#about">About Us</a>
                            <a href="#services">Services</a>
                        </div>
                        <div class="col-6">
                            <a href="#team">Team</a>
                            <a href="#contact">Contact Us</a>
                            <a href="#product">Product</a>
                        </div>
                    </div>
                </div>
                <!-- Social Icons -->
                <div class="col-lg-2 col-md-12">
                    <h5>Follow Us</h5>
                    <div class="social-icons">
                        <a href="https://wa.me/+6285217920501" target="_blank" aria-label="WhatsApp">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                        <a href="https://www.instagram.com/wheelster.id" target="_blank" aria-label="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Footer Bottom -->
            <div class="row footer-bottom mt-3">
                <div class="col-md-6 text-center text-md-left">
                    <p>&copy; 2024 Wheelster. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <a href="#">Terms & Conditions</a> |
                    <a href="#">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>
    @yield('scripts')
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
