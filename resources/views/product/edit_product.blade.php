@extends('layouts.product_layout')

@section('content')
<div class="container col-md-8 col-lg-7 backblue my-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="{{ url()->previous() }}" class="text-decoration-none" style="color: black"><i class="bi bi-arrow-left"></i></a>
        <h1 class="text-center flex-grow-1">Edit Product</h1>
    </div>
    <hr style="border-color: black;">

        <!-- Product Image and Current Details -->


        <!-- Edit Product Form -->
        <div class="col-md-12">
            <form action="{{ route('update_product', $product) }}" method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="row gy-4">
                    <div class="col-md-6 text-center">
                        <div class="form-group mb-3">
                            @if($product->image)
                                <img src="{{ asset('storage/public/' . $product->image) }}" alt="Product Image" class="img-fluid rounded mb-3" style="max-height: 500px; object-fit: contain;">
                            @endif
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="productName">Product Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="brand">Brand</label>
                            <select name="brand_id" id="brand" class="form-select" required>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                        {{ $brand->brandName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="productDetail">Product Description</label>
                            <input type="text" name="description" class="form-control" value="{{ $product->description }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="productPrice">Product Price</label>
                            <input type="text" name="price" class="form-control" value="{{ $product->price }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="Stock">Stock</label>
                            <input type="number" name="stock" id="stock" class="form-control" value="{{ $product->stock }}" required>
                        </div>



                        <button type="submit" class="btn btn-darkblue btn-block mt-4">Update Product</button>
                    </div>
                </div>
            </form>
        </div>

</div>
@endsection
