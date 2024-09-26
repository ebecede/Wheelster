@extends('layout')

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
                    <a href="{{ route('product_detail', $product) }}" class="card h-100 shadow-sm text-decoration-none">
                        <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>Rp {{ number_format($product->price, 2) }}</strong></p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div>
            {{ $products->links('pagination::bootstrap-5') }} <!-- Pagination links -->
        </div>
    </div>
@endsection

