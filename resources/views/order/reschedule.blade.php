@extends('layouts.product_layout')

@section('content')

<div class="container col-md-4 backblue my-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Reschedule</h1>
            {{-- <img src="{{ url('storage/public/' . $order->product->image) }}" alt="" height="100px">
            <h1>{{ $order->product->name }}</h1>
            <h5 class=""><strong>Rp {{ number_format($order->product->price, 2) }}</strong></h5>
            <p class="card-text">Product Description: <br>{{ $order->product->description }}</p> --}}
            <form action="{{ route('reschedule_order', $order) }} " method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
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
