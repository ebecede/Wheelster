@extends('layouts.product_layout')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Transaction History</h3>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr class="table-light">
                    <th scope="col">Product Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td><img src="{{ url('storage/public/' . $order->product->image) }}" alt="" height="100px"></td>
                    {{-- Display Product Name --}}
                    <td>{{ $order->product->name }} <br>({{ $order->product->brand->brandName }})</td>
                    {{-- Display Product Price --}}
                    <td>Rp {{ number_format($order->product->price, 2) }}</td>
                    {{-- Display Order Date --}}
                    <td>{{ \Carbon\Carbon::parse($order->scheduleDate)->format('l, d M Y') }}</td>
                    {{-- Display Schedule Time --}}
                    <td>{{ $order->scheduleTime }}</td>
                    {{-- Display Order Status with Badge Styling --}}
                    <td>
                        @if ($order->status == 'In Progress' && !$order->trashed())
                            <span class="badge bg-warning text-dark">In Progress</span>
                        @elseif ($order->status == 'Complete')
                            <span class="badge bg-success">Complete</span>
                        @elseif ($order->status == 'Cancelled' || $order->trashed())
                            <span class="badge bg-danger">Cancelled</span>
                        @endif
                    </td>
                    {{-- Conditional Action Buttons --}}
                    <td>
                        @if ($order->status == 'In Progress' && !$order->trashed())
                        <div class="d-flex">
                            {{-- Check if the order can be rescheduled --}}
                            @php
                                $scheduleDate = \Carbon\Carbon::parse($order->scheduleDate);
                                $canReschedule = now()->lt($scheduleDate->subDays(1)); // Check if at least 2 full days left
                            @endphp

                            <form action="{{ route('show_order_detail', $order) }}" method="get" >
                                <button type="submit" class="btn btn-lightblue me-2"><i class="bi bi-card-text"></i></button>
                            </form>

                            {{-- Reschedule Button - show only if more than 1 day before schedule date --}}
                            @if ($canReschedule)
                                <a href="{{ route('reschedule', $order) }}" class="btn btn-darkblue me-2">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                            @endif

                            {{-- Cancel Order Button - show only if more than 2 full days before schedule date --}}
                            @if ($canReschedule)
                                <form action="{{ route('cancel_order', $order) }}" method="post" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                    @method('patch')
                                    @csrf
                                    <button type="submit" class="btn btn-red"><i class="fa-solid fa-ban"></i> </button>
                                </form>
                            @endif

                        </div>
                        @else
                        <form action="{{ route('show_order_detail', $order) }}" method="get" >
                            <button type="submit" class="btn btn-lightblue me-1"><i class="bi bi-card-text"></i></button>
                        </form>
                            {{-- No actions for Complete or Cancelled orders --}}
                            {{-- <span class="text-muted">N/A</span> --}}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
