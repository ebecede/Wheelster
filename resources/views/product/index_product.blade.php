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
                            <form action="{{ route('show_product', $product) }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-darkblue">Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div>
            {{ $products->links('pagination::bootstrap-5') }} <!-- Pagination links -->
        </div>
    </div>
@endsection

