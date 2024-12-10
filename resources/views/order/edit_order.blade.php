@extends('layouts.product_layout')

@section('content')
<div class="container col-md-8 col-sm-8 col-10 backblue my-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="{{ url()->previous() }}" style="color: black"><i class="bi bi-arrow-left"></i></a>
        <h1 class="text-center flex-grow-1">Edit Order</h1>
    </div>
    <hr style="border-color: black;">
    <div class="row">
        <!-- Left Section: Product Image -->
        <div class="col-md-6 text-center mb-4">
            <img id="productImage" src="{{ url('storage/public/' . $product->image) }}" alt="Product Image"
                 class="img-fluid rounded" style="max-height: 400px; object-fit: contain;">
            <h4 class="card-text mt-3">
                <strong id="productDetails">{{ $product->name }} - Rp {{ number_format($product->price, 2) }}</strong>
            </h4>
        </div>

        <!-- Right Section: Order Form -->
        <div class="col-md-6">
            <form action="{{ route('update_order', $order) }}" method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf

                <!-- Customer Name -->
                <div class="form-group mb-3">
                    <label for="customerName">Customer Name</label>
                    <input type="text" name="customerName" class="form-control" value="{{ $order->user->name }}" readonly>
                </div>

                <!-- Product Selection -->
                <div class="form-group mb-3">
                    <label for="product">Product</label>
                    <select name="product_id" id="product" class="form-select select2">
                        @foreach ($products as $prod)
                            <option value="{{ $prod->id }}"
                                    data-image="{{ url('storage/public/' . $prod->image) }}"
                                    data-name="{{ $prod->name }}"
                                    data-price="{{ $prod->price }}"
                                    {{ $prod->id == $product->id ? 'selected' : '' }}>
                                {{ $prod->name }} - Rp {{ number_format($prod->price, 2) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Vehicle Information -->
                <div class="form-group mb-3">
                    <label for="vehicleName">Vehicle Name and Model</label>
                    <input type="text" name="vehicleName" class="form-control" value="{{ $order->vehicleName }}" required>
                </div>

                <!-- Schedule Date and Time -->
                <div class="form-group row mb-3">
                    <div class="col-md-6">
                        <label for="scheduleDate">Date</label>
                        <input type="date" name="scheduleDate" class="form-control" value="{{ $order->scheduleDate }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="scheduleTime">Time</label>
                        <input type="text" name="scheduleTime" class="form-control" value="{{ $order->scheduleTime }}" readonly>
                    </div>
                </div>

                <!-- Steering Wheel Photo -->
                <div class="form-group mb-3">
                    <label for="steeringWheelPhoto">Car Steering Wheel Photo</label>
                    @if($order->steeringWheelPhoto)
                        <div class="mb-3">
                            <img src="{{ url('storage/public/' . $order->steeringWheelPhoto) }}" alt="Car Steering Wheel Photo"
                                 class="img-fluid rounded" style="max-width: 100px;">
                        </div>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-darkblue w-100">Update Order</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                width: '100%' // Ensures the Select2 dropdown matches the parent container width
            });

            // Update product details on selection change
            $(document).on('change', '#product', function() {
                var selectedOption = $(this).find('option:selected');
                var imageUrl = selectedOption.data('image');
                var productName = selectedOption.data('name');
                var productPrice = selectedOption.data('price');

                $('#productImage').attr('src', imageUrl);
                $('#productDetails').html(productName + ' - Rp ' + Number(productPrice).toLocaleString('id-ID', {minimumFractionDigits: 2}));
            });
        });
    </script>
@endsection
