@extends('admin.admin_layout')

@section('content')
<div class="container col-md-4 backblue my-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Add New Product</h1>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"> <!-- Correct action route -->
                @csrf
                <div class="form-group">
                    <label for="productName">Product Name</label>
                    <input type="text" name="product_name" id="productName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="productPrice">Product Price</label>
                    <input type="text" name="product_price" id="productPrice" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="productDetail">Product Detail</label>
                    <textarea name="product_detail" id="productDetail" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="image">Product Image</label>
                    <input type="file" name="image" id="image" class="form-control-file" required>
                </div>
                <button type="submit" class="btn btn-darkblue btn-block mt-4">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
