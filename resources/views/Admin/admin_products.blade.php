@extends('admin.admin_layout')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Products</h3>
        <form action="{{ route('products.create') }}" method="get">
            <button type="submit" class="btn-darkblue"><i class="fas fa-plus me-1" style="padding: 10px 5px"></i> Add</button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr class="table-light">
                    <th>Display</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td><img src="{{ $product->image }}" class="product-image" alt="Product Image" style="width: 150px"></td>
                    <td>
                        <h4 class="card-title">{{ $product->name }}</h4>
                        <p class="card-text">{{ $product->description }}</p>
                    </td>

                    <td><p class="card-text"><strong>Rp {{ number_format($product->price, 2) }}</strong></p></td>
                    <td>
                        <div class="d-flex">
                            <form action="{{ route('edit_product', $product) }}" method="get">
                                <button class="btn btn-darkblue me-2"><i class="fas fa-edit"></i></button>
                            </form>
                            <form action="{{ route('delete_product', $product) }}" method="post">
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
