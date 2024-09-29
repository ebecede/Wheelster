@extends('layouts.product_layout')

@section('content')
<section id="home" class="bg-dark text-white py-5 bg-image">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="fw-bold display-4">Our Products</h1>
            </div>
        </div>
    </div>
</section>
<div class="container py-5">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card custom-card h-100 shadow-sm text-decoration-none">
                    <img src="{{ url('storage/public/' . $product->image) }}" alt="" height="100px" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text"><strong>Rp {{ number_format($product->price, 2) }}</strong></p>

                        @auth
                            <form action="{{ route('show_product', $product) }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-darkblue">Order</button>
                            </form>
                        @endauth

                        @guest
                            <button class="btn btn-darkblue guest-order-button">Order</button>
                        @endguest

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div>
        {{ $products->links('pagination::bootstrap-5') }} <!-- Pagination links -->
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const guestOrderButtons = document.querySelectorAll('.guest-order-button');

        guestOrderButtons.forEach(button => {
            button.addEventListener('click', function () {
                alert('Please login first to place an order.');
                window.location.href = "{{ route('login') }}";
            });
        });
    });
</script>
@endsection
