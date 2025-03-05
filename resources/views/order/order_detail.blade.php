@extends('layouts.product_layout')

@section('content')
<div class="container col-sm-8 col-10 backblue my-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="{{ url()->previous() }}" class="text-decoration-none" style="color: black"><i class="bi bi-arrow-left"></i></a>
        <h1 class="text-center flex-grow-1">Order Detail</h1>
    </div>
    <hr style="border-color: black;">
    <div class="row gy-4">
        <!-- Product Image and Details -->
        <div class="col-md-6 text-center">
            <img src="{{ url('storage/public/' . $order->product->image) }}" alt="Product Image" class="img-fluid rounded" style="max-height: 500px; object-fit: contain;">
            <h4 class="card-text mt-3">
                <strong>{{ $order->product->name }} - Rp {{ number_format($order->product->price, 2) }}</strong>
            </h4>
        </div>

        <!-- Order and Customer Details -->
        <div class="col-md-6">
            <p class="card-text mb-1">Customer Name: <strong>{{ $order->user->name }}</strong></p>
            <p class="card-text mb-1">Vehicle Name and Model: <strong>{{ $order->vehicleName }}</strong></p>
            <p class="card-text mb-1">Schedule Date: <strong>{{ $order->scheduleDate }}</strong></p>
            <p class="card-text mb-1">Schedule Time: <strong>{{ $order->scheduleTime }}</strong></p>
            <p class="card-text mb-1">Status:
                @if ($order->trashed())
                    <span class="badge bg-danger">Cancelled</span>
                @elseif ($order->status == 'In Progress')
                    <span class="badge bg-warning text-dark">In Progress</span>
                @elseif ($order->status == 'Complete')
                    <span class="badge bg-success">Complete</span>
                @else
                    <span class="badge bg-secondary">Unknown</span>
                @endif
            </p>
            <p class="card-text mb-1">Car Steering Wheel Photo:</p>
            <img
                src="{{ url('storage/public/' . $order->steeringWheelPhoto) }}" alt="Car Steering Wheel Photo" class="img-fluid rounded" style="max-width: 100%; max-height: 290px; object-fit: contain;">
        </div>
    </div>
</div>
@endsection
