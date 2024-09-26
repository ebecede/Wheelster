@extends('admin.admin_layout')

@section('content')
<div class="container col-md-4 backblue my-5">
    <div class="row">
        {{-- <div class="col-md-7">
            <img src="" alt="" class="img-fluid mb-4">
        </div> --}}
        <div class="col-md-12">
            <h1></h1>
            {{-- <p class="lead">Rp </p> --}}
            <form action=" " method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="productName">Product Name</label>
                    <input type="text" name="product_name" id="vehicleName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="productPrice">Product Price</label>
                    <input type="text" name="product_price" id="vehicleName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="productDetail">Product Detail</label>
                    <textarea type="text" name="product_detail" id="vehicleName" class="form-control" required></textarea>
                  </div>
                <div class="form-group">
                    <label for="Stock">Stock</label>
                    <input type="number" name="schedule" id="schedule" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="steeringWheelPhoto">Product Image</label>
                    <input type="file" name="steering_wheel_photo" id="steeringWheelPhoto" class="form-control-file" required>
                </div>
                <form action="{{ route('store_product') }}" method="post" enctype="multipart/form-data">
                    <button type="submit" class="btn-darkblue btn-block mt-4">Submit</button>
                </form>
            </form>
        </div>
    </div>
</div>

@endsection
