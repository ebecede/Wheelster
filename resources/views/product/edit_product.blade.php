@extends('layouts.product_layout')

@section('content')
<div class="container col-md-4 backblue my-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="{{ url()->previous() }}" style="color: black" ><i class="bi bi-arrow-left"></i></a>
        <h1 class="text-center flex-grow-1">Edit Product</h1>
    </div>
    <hr style="border-color: black;">
    <div class="row">
        <div class="col-md-12">
            <h1></h1>
            <form action="{{ route('update_product', $product) }}" method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="form-group">
                    <label for="productName">Product Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                </div>
                <div class="form-group">
                    <label for="productDetail">Product Description</label>
                    <input type="text" name="description" class="form-control" value="{{ $product->description }}" required>
                </div>
                <div class="form-group">
                    <label for="productPrice">Product Price</label>
                    <input type="text" name="price" class="form-control" value="{{ $product->price }}" required>
                </div>
                <div class="form-group">
                    <label for="Stock">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control" value="{{ $product->stock }}" required>
                </div>
                {{-- INI GUA MASI BINGUNG CARA STORE IMAGE YANG UDH ADA --}}
                <div class="form-group">
                    <label for="productImage">Product Image</label>
                    @if($product->image)
                        <img src="{{ asset('storage/public/' . $product->image) }}" alt="Product Image" width="100">
                    @endif
                    <input type="file" name="image" class="form-control-file">
                </div>

                <button type="submit" class="btn btn-darkblue btn-block mt-4">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
