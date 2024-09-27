@extends('layout')

@section('content')
<div class="container col-md-7 backblue my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ url('storage/public/' . $product->image) }}" alt="" height="500px" width="500px">
        </div>
        <div class="col-md-6">
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
