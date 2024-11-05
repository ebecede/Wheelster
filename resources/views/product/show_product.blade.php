@extends('layouts.product_layout')

@section('content')
<div class="container col-md-7 backblue my-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="{{ url()->previous() }}" style="color: black"><i class="bi bi-arrow-left"></i></a>
        <h1 class="text-center flex-grow-1">Order Form</h1>
    </div>
    <hr style="border-color: black;"> <br>
    <div class="row">
        <div class="col-md-6">
            <img src="{{ url('storage/public/' . $product->image) }}" alt="" height="500px" width="500px">
        </div>
        <div class="col-md-6">
            <h4 class=""><strong>{{ $product->name }}</strong></h4>
            <h3 class=""><strong>Rp{{ number_format($product->price, 2) }}</strong></h3>
            <p class="">Product Description: <br> {{ $product->description }}</p>
            <br>
            <form action="{{ route('make_order', $product) }} " method="POST" enctype="multipart/form-data">
                @csrf
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
                    <input type="date" name="scheduleDate" class="form-control" id="scheduleDate" required>
                </div>
                <button type="submit" class="btn-darkblue btn-block mt-4" style="padding: 5px 5px">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Set the minimum date to tomorrow's date
        const scheduleDateInput = document.getElementById("scheduleDate");
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(today.getDate() + 2);
        const year = tomorrow.getFullYear();
        const month = String(tomorrow.getMonth() + 1).padStart(2, '0');
        const day = String(tomorrow.getDate()).padStart(2, '0');
        scheduleDateInput.min = `${year}-${month}-${day}`;
    });
</script>
@endsection
