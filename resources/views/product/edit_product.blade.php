@extends('admin.admin_layout')

@section('content')
{{-- INI EDIT PRODUCT BELOM YA CONTROLLER DLLNYA JUGA BLM --}}
<div class="container col-md-4 backblue my-5">
    <div class="row">
        <div class="col-md-12">
            <h1></h1>
            <form action=" " method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="productName">Product Name</label>
                    <input type="text" name="product_name" id="productName" class="form-control" value="{{ $product->name }}" required>
                </div>
                <div class="form-group">
                    <label for="productPrice">Product Price</label>
                    <input type="text" name="product_price" id="productPrice" class="form-control" value="{{ $product->price }}" required>
                </div>
                <div class="form-group">
                    <label for="productDetail">Product Detail</label>
                    <input type="text" name="productDetail" id="productDetail" class="form-control" value="{{ $product->description }}" required>
                    {{-- <textarea type="text" name="product_detail" id="productDetail" class="form-control" value="{{ $product->description }}" required></textarea> --}}
                  </div>
                <div class="form-group">
                    <label for="Stock">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control" value="{{ $product->stock }}" required>
                </div>
                {{-- INI GUA MASI BINGUNG CARA STORE IMAGE YANG UDH ADA --}}
                <div class="form-group">
                    <label for="productImage">Product Image</label>
                    <input type="file" name="productImage" id="steeringWheelPhoto" class="form-control-file" value="{{ $product->image }}" required>
                </div>
                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    <button type="submit" class="btn btn-darkblue btn-block mt-4">Submit</button>
                </form>
            </form>
        </div>
    </div>
</div>
@endsection
