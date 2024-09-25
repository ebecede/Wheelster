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
            @foreach ($items as $item)
                <div class="col-md-3 mb-4">
                    <a href="{{ route('product.detail', $item->id) }}" class="card h-100 shadow-sm text-decoration-none">
                        <img src="{{ $item->picture }}" class="card-img-top" alt="{{ $item->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">{{ $item->description }}</p>
                            <p class="card-text"><strong>Rp {{ number_format($item->price, 2) }}</strong></p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $items->links('pagination::bootstrap-5') }} <!-- Pagination links -->
        </div>
    </div>
@endsection

