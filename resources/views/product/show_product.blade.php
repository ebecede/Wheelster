@extends('layouts.product_layout')

@section('content')
<div class="container col-md-7 backblue my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ url('storage/public/' . $product->image) }}" alt="" height="500px" width="500px">
        </div>
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <h5 class=""><strong>Rp {{ number_format($product->price, 2) }}</strong></h5>
            <p class="card-text">Product Description: <br>{{ $product->description }}</p>
            <hr style="border-color: black;">
            <form action="{{ route('make_order', $product) }} " method="POST" enctype="multipart/form-data">
                @csrf
                {{-- <input type="hidden" name="product_id" value="{{ $product->id }}"> --}}
                <div class="form-group">
                    <label for="vehicleName">Vehicle Name and Model</label>
                    <input type="text" name="vehicleName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="steeringWheelPhoto">Car Steering Wheel Photo</label>
                    <input type="file" name="steeringWheelPhoto" class="form-control-file" required>
                </div>
                <div class="form-group">
                    <label for="schedule">Select a Schedule</label>
                    <input type="date" name="scheduleDate" class="form-control" required>
                </div>
                <button type="submit" class="btn-darkblue btn-block mt-4" style="padding: 5px 5px">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
