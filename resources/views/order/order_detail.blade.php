@extends('layouts.product_layout')

@section('content')
<div class="container col-md-7 backblue my-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="{{ url()->previous() }}" style="color: black"><i class="bi bi-arrow-left"></i></a>
        <h1 class="text-center flex-grow-1">Order Detail</h1>
    </div>
    <hr style="border-color: black;"> <br>
    <div class="row">
        <div class="col-md-6">
            <img src="{{ url('storage/public/' . $order->product->image) }}" alt="Product Image" height="500px" width="500px">
        </div>
        <div class="col-md-6">
            <p class="card-text">Product Name: <strong>{{ $order->product->name }}</strong></p>
            <p class="card-text">Product Price: <strong>{{ number_format($order->product->price, 2) }}</strong></p>
            <p class="card-text">Customer Name: <strong>{{ $order->user->name }}</strong></p>
            <p class="card-text">Schedule Date: <strong>{{ $order->scheduleDate }}</strong></p>
            <p class="card-text">Status:
                @if ($order->status == 'In Progress')
                    <span class="badge bg-warning text-dark">In Progress</span>
                @elseif ($order->status == 'Complete')
                    <span class="badge bg-success">Complete</span>
                @elseif ($order->status == 'Cancelled')
                    <span class="badge bg-danger">Cancelled</span>
                @endif
            </p>
            <p class="card-text">Car Steering Wheel Photo:</p>
            <img src="{{ url('storage/public/' . $order->steeringWheelPhoto) }}" alt="Car Steering Wheel Photo" width="250px">
        </div>
    </div>
</div>
@endsection
