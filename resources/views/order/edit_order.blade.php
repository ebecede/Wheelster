@extends('layouts.product_layout')

@section('content')
<div class="container col-md-7 backblue my-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="{{ url()->previous() }}" style="color: black"><i class="bi bi-arrow-left"></i></a>
        <h1 class="text-center flex-grow-1">Edit Order</h1>
    </div>
    <hr style="border-color: black;"> <br>
    <div class="row">
        <div class="col-md-6 text-center">
            <img id="productImage" src="{{ url('storage/public/' . $product->image) }}" alt="Product Image" max-height="100%" object-fit="contain" height = "400px">
            <h4 class="card-text mt-3"><strong id="productDetails">{{ $product->name }} - Rp {{ number_format($product->price, 2) }}</strong></h4>
        </div>
        <div class="col-md-6">
            <form action="{{ route('update_order', $order) }}" method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="form-group">
                    <label for="customerName">Customer Name</label>
                    <input type="text" name="customerName" class="form-control" value="{{ $order->user->name }}" readonly>
                </div>

                <div class="form-group">
                    <label for="product">Product</label>
                    <select name="product_id" id="product" class="form-control select2">
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

                <div class="form-group">
                    <label for="vehicleName">Vehicle Name and Model</label>
                    <input type="text" name="vehicleName" class="form-control" value="{{ $order->vehicleName }}" required>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="scheduleDate">Date</label>
                        <input type="date" name="scheduleDate" class="form-control" value="{{ $order->scheduleDate }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="scheduleTime">Time</label>
                        <input name="scheduleTime" class="form-control" value="{{ $order->scheduleTime }}" readonly>
                    </div>
                </div>


                <div class="form-group">
                    <label for="steeringWheelPhoto">Car Steering Wheel Photo</label>
                    @if($order->steeringWheelPhoto)
                        <img src="{{ url('storage/public/' . $order->steeringWheelPhoto) }}" alt="Car Steering Wheel Photo" width="100">
                    @endif
                    {{-- <input type="file" name="steeringWheelPhoto" class="form-control-file" accept="image/*" readonly> --}}
                </div>

                <button type="submit" class="btn btn-darkblue btn-block mt-4">Update Order</button>
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
            $('.select2').select2();

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

