<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="style.css">
    <title>Wheelster</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid text-white">
            <div class="footer-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Wheelster Logo" style="width: 50px; margin-left: 50px;">
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mx-auto" >
                    <a class="nav-link me-3" href="#">Home</a>
                    <a class="nav-link me-3" href="#">About Us</a>
                    <a class="nav-link me-3" href="#">Services</a>
                    <a class="nav-link me-3" href="#">Team</a>
                    <a class="nav-link me-3" href="#">Contact Us</a>
                    <a class="nav-link" href="#">Product</a>
                </div>
            </div>
            <div class="d-flex me-3">
                <a href="#" class="btn btn-signin">Sign In</a>
            </div>
        </div>
    </nav>

    <div class="flex-grow-1">
        <!-- Main content goes here -->
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
                            <a href="#">About Us</a>
                            <a href="#">Services</a>
                        </div>
                        <div class="col-6">
                            <a href="#">Team</a>
                            <a href="#">Contact Us</a>
                            <a href="#">Product</a>
                        </div>
                    </div>
                </div>
                <!-- Social Icons -->
                <div class="col-lg-2 col-md-12">
                    <h5>Follow Us</h5>
                    <div class="social-icons">
                        <a href="#"><i class="bi bi-whatsapp"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
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
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
