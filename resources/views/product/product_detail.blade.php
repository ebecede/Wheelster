@extends('layout')

@section('content')
<div class="container col-md-8 backblue my-5">
    <div class="row">
        <div class="col-md-7">
            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid mb-4">
        </div>
        <div class="col-md-5">
            <h1>{{ $product->name }}</h1>
            <p class="lead">Rp {{ number_format($product->price, 2) }}</p>
            <form action=" " method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="vehicleName">Vehicle Name and Model</label>
                    <input type="text" name="vehicle_name" id="vehicleName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="steeringWheelPhoto">Car Steering Wheel Photo</label>
                    <input type="file" name="steering_wheel_photo" id="steeringWheelPhoto" class="form-control-file" required>
                </div>
                <div class="form-group">
                    <label for="schedule">Select a Schedule</label>
                    <input type="date" name="schedule" id="schedule" class="form-control" required>
                </div>
                <button type="submit" class="btn-darkblue btn-block mt-4" style="padding: 5px 5px">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
