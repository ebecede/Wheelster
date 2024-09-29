@extends('layouts.product_layout')

@section('content')
<div class="container col-md-7 backblue my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ url('storage/public/' . $order->product->image) }}" alt="Product Image" height="500px" width="500px">
        </div>
        <div class="col-md-6">
            <h1>{{ $order->product->name }}</h1>
            <h5><strong>Rp {{ number_format($order->product->price, 2) }}</strong></h5>
            <hr style="border-color: black;">
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
            <img src="{{ url('storage/public/' . $order->steeringWheelPhoto) }}" alt="Car Steering Wheel Photo" width="227px">
        </div>
    </div>
</div>
@endsection
