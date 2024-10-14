@extends('layouts.product_layout')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Products List</h1>
        <form action="{{ route('create_product') }}" method="get">
            <button type="submit" class="btn btn-darkblue pe-3"><i class="bi bi-plus-circle me-2"></i> Add</button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr class="table-light">
                    <th>Display</th>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td><img src="{{ url('storage/public/' . $product->image) }}" alt="" height="100px">
                    <td>
                        <h4 class="card-title">{{ $product->name }}</h4>
                        <p class="card-text">{{ $product->description }}</p>
                    </td>
                    <td><p class="card-text">{{ $product->brand->brandName }}</p></td>
                    <td><p class="card-text"><strong>Rp {{ number_format($product->price, 2) }}</strong></p></td>
                    <td><p class="card-text"><strong>{{ $product->stock}}</strong></p></td>
                    <td>
                        <div class="d-flex">
                            <form action="{{ route('edit_product', $product) }}" method="get">
                                <button class="btn btn-darkblue me-2"><i class="fas fa-edit"></i></button>
                            </form>
                            <form action="{{ route('delete_product', $product) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @method('delete')
                                @csrf
                                <button class="btn btn-red"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $products->links('pagination::bootstrap-5') }} <!-- Pagination links -->
    </div>
</div>

@endsection
