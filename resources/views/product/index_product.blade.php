@extends('layouts.product_layout')

@section('content')
<section id="product" class="bg-dark text-white bg-image">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="fw-bold display-4">Our Products</h1>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <form action="{{ route('index_product') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <select name="brand" class="form-select" onchange="this.form.submit()">
                    <option value="">All Brands</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}"
                            {{ (isset($brand_id) && $brand_id == $brand->id) ? 'selected' : '' }}>
                            {{ $brand->brandName }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card custom-card h-100 shadow text-decoration-none">
                    <img src="{{ url('storage/public/' . $product->image) }}" alt="" height="100px"
                        style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <div class="card-body">
                        <p class="card-title">
                            <strong>{{ $product->name }} ({{ $product->brand->brandName }})</strong>
                        </p>
                        <h4 class="card-text" style="color: #091954">
                            <strong>Rp{{ number_format($product->price, 2) }}</strong>
                        </h4>
                        <p class="card-text">Stok: {{ $product->stock }}</p>
                        <div class="text-center">
                            @auth
                            <form action="{{ route('show_product', $product) }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-darkblue"
                                    style="padding-right: 30px; padding-left: 30px;">
                                    Order
                                </button>
                            </form>
                            @endauth

                            @guest
                                <button class="btn btn-darkblue guest-order-button">Order</button>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div>
        {{ $products->links('pagination::bootstrap-5') }}
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
