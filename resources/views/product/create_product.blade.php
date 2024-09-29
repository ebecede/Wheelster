@extends('layouts.product_layout')

@section('content')
<div class="container col-md-4 backblue my-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="{{ url()->previous() }}" style="color: black"><i class="bi bi-arrow-left"></i></a>
        <h1 class="text-center flex-grow-1">Add New Product</h1>
    </div>
    <hr style="border-color: black;">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('store_product') }}" method="post" enctype="multipart/form-data"> <!-- Correct action route -->
                @csrf
                <div class="form-group">
                    <label for="">Product Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Product Description</label>
                    <input type="text" name="description" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Product Price</label>
                    <input type="number" name="price"class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Stock</label>
                    <input type="number" name="stock" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Product Image</label>
                    <input type="file" name="image" class="form-control-file" required>
                </div>
                <button type="submit" class="btn btn-darkblue btn-block mt-4">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
