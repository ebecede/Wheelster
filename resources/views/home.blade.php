@extends('layout')

@section('content')
<body>
    <section id="home" class="bg-dark text-white py-5 bg-image">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class=" fw-bold display-4">Welcome to <img src="{{ asset('images/logo-2.png') }}" alt="Wheelster Logo" height="100"></h1>
                    <p class="lead">Providing the best car steering modification services in the PIK area.</p>
                    <a href="#" class="btn btn-darkblue">Get Started</a>
                </div>
            </div>
        </div>
    </section>

    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class=" fw-bold mb-4">Why Wheelster?</h2>
                    <p>Wheelster is a web-based application specifically designed for car enthusiasts and car modification business owners. Our goal is to connect car enthusiasts with car modification business owners. Here are a few reasons why you should choose Wheelster:</p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="card custom-card mb-4">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-tools fs-3 me-4"></i>
                            {{-- <i class="fas fa-wrench fa-2x me-4"></i> --}}
                            <div>
                                <h5 class="card-title">Expertise and Experience</h5>
                                <p class="card-text">Skilled technicians adept at safely and efficiently modifying car steering systems.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card custom-card mb-4">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-bar-chart-line-fill fs-3 me-4"></i>
                            {{-- <i class="fas fa-chart-bar fa-2x me-4"></i> --}}
                            <div>
                                <h5 class="card-title">Quality of Work</h5>
                                <p class="card-text">Use high-quality components and ensure that all work is done to industry standards. This reduces the risk of problems later on.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card custom-card mb-4">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-people-fill fs-3 me-4"></i>
                            {{-- <i class="fas fa-users fa-2x me-4"></i> --}}
                            <div>
                                <h5 class="card-title">Extensive Network</h5>
                                <p class="card-text">Connect with a vast community of car enthusiasts and modification businesses.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card custom-card mb-4">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-currency-dollar fs-3 me-4"></i>
                            {{-- <i class="fas fa-dollar-sign fa-2x me-4"></i> --}}
                            <div>
                                <h5 class="card-title">Exclusive Deals</h5>
                                <p class="card-text">You'll gain access to exclusive deals and discounts from top car modification businesses.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="fw-bold mb-4">Services</h2>
                    <p>Some of the services we provide</p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-3">
                    <div class="card square-card mb-4">
                        <div class="card-body text-center ">
                            <i class="bi bi-telephone fs-1"></i>
                            <h5 class="card-title mt-3">Customer Service</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card square-card mb-4">
                        <div class="card-body text-center">
                            <i class="bi bi-gear fs-1"></i>
                            <h5 class="card-title mt-3">Quick Administration</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card square-card mb-4">
                        <div class="card-body text-center">
                            <i class="bi bi-gear-wide-connected fs-1"></i>
                            <h5 class="card-title mt-3">Steering Wheel Modification</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card square-card mb-4">
                        <div class="card-body text-center">
                            <i class="bi bi-shop fs-1"></i>
                            <h5 class="card-title mt-3">Manage Your Business</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="team">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="fw-bold mb-4">Team</h2>
                    <p>Our team consists of three students from Bina Nusantara University</p>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-md-12">
                    <div class="card text-center custom-card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('images/Profile.png') }}" alt="David Bonardo Purba" class="rounded-circle img-fluid mb-3">
                                    <h5 class="card-title">David Bonardo Purba</h5>
                                    <p class="card-text">2502010250<br>Computer Science</p>
                                </div>
                                <div class="col-md-4">
                                    <img src="{{ asset('images/Profile.png') }}" alt="Edward Wijaya" class="rounded-circle img-fluid mb-3">
                                    <h5 class="card-title">Edward Wijaya</h5>
                                    <p class="card-text">2502001385<br>Computer Science</p>
                                </div>
                                <div class="col-md-4">
                                    <img src="{{ asset('images/Profile.png') }}" alt="Matthew" class="rounded-circle img-fluid mb-3">
                                    <h5 class="card-title">Matthew</h5>
                                    <p class="card-text">2540125434<br>Computer Science</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="fw-bold">Contact Us</h2>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.700450779522!2d106.79833221474267!3d-6.166428864860968!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e832365946ff%3A0x8a839311c267365!2sRuko%20La%20Riviera%20Blok%20B%20No.11%2C%20Lemo%2C%20Kec.%20Teluknaga%2C%20Kabupaten%20Tangerang%2C%20Banten%2015510!5e0!3m2!1sen!2sid!4v1701814962605!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-md-6">
                    <h4 class="mb-4">Contact Information</h4>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-geo-alt fs-5"></i> Ruko La Riviera Blok B No.11, Lemo, Kec. Teluknaga, Tanggerang, Kabupaten Tangerang, Banten 15510</li>
                        <li><i class="bi bi-clock fs-5"></i> 10.00 am - 5.00 pm (Sunday Closed)</li>
                        <li><i class="bi bi-envelope fs-5"></i> wheelsteer.id@gmail.com</li>
                        <li><i class="bi bi-phone fs-5"></i> 085217920501</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script> --}}
</body>
</html>
@endsection


    {{-- <section id="home" class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="display-4">Welcome to <img src="logo.svg" alt="Wheelster Logo" height="40"> WHEELSTER</h1>
                    <p class="lead">Providing the best car steering modification services in the PIK area.</p>
                    <a href="#services" class="btn btn-outline-light mt-3">Get Started</a>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <img src="car-steering-wheel.jpg" alt="Car Steering Wheel" class="img-fluid">
                </div>
            </div>
        </div>
    </section> --}}

    {{-- <section id="team">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="mb-4">Team</h2>
                    <p>Our team consists of three students from Bina Nusantara University</p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="{{ asset('images/Profile.png') }}" alt="David Bonardo Purba" class="rounded-circle img-fluid mb-3">
                            <h5 class="card-title">David Bonardo Purba</h5>
                            <p class="card-text">2502010250<br>Computer Science</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="{{ asset('images/Profile.png') }}" alt="Edward Wijaya" class="rounded-circle img-fluid mb-3">
                            <h5 class="card-title">Edward Wijaya</h5>
                            <p class="card-text">2502001385<br>Computer Science</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="{{ asset('images/Profile.png') }}" alt="Matthew" class="rounded-circle img-fluid mb-3">
                            <h5 class="card-title">Matthew</h5>
                            <p class="card-text">2540125434<br>Computer Science</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
