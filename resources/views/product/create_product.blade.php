@extends('layouts.product_layout')

@section('content')
<div class="container col-md-4 col-sm-8 col-10 backblue my-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="{{ url()->previous() }}" style="color: black"><i class="bi bi-arrow-left"></i></a>
        <h1 class="text-center flex-grow-1">Add New Product</h1>
    </div>
    <hr style="border-color: black;">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('store_product') }}" method="post" enctype="multipart/form-data">
                @csrf

                <!-- Product Name -->
                <div class="form-group mb-3">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}">

                    <!-- Error Message -->
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Brand -->
                <div class="form-group mb-3">
                    <label for="brand">Brand</label>
                    <select name="brand_id" id="brand"
                        class="form-select select2 @error('brand_id') is-invalid @enderror">
                        <option value="" disabled selected>Select Brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}"
                                {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->brandName }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Error Message -->
                    @error('brand_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Product Description -->
                <div class="form-group mb-3">
                    <label for="description">Product Description</label>
                    <input type="text" name="description" id="description"
                        class="form-control @error('description') is-invalid @enderror"
                        value="{{ old('description') }}">

                    <!-- Error Message -->
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Product Price -->
                <div class="form-group mb-3">
                    <label for="price">Product Price</label>
                    <input type="" name="price" id="price"
                        class="form-control @error('price') is-invalid @enderror"
                        value="{{ old('price') }}">

                    <!-- Error Message -->
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Stock -->
                <div class="form-group mb-3">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock"
                        class="form-control @error('stock') is-invalid @enderror"
                        value="{{ old('stock') }}">

                    <!-- Error Message -->
                    @error('stock')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Product Image -->
                <div class="form-group mb-3">
                    <label for="image">Product Image</label>
                    <input type="file" name="image" id="image"
                        class="form-control @error('image') is-invalid @enderror">

                    <!-- Error Message -->
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-darkblue btn-block mt-4">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
