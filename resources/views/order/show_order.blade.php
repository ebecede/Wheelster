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
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td><img src="{{ url('storage/public/' . $order->product->image) }}" alt="" height="100px">
                    {{-- Display Product Name --}}
                    <td>{{ $order->product->name }}</td>
                    {{-- Display Product Price --}}
                    <td>Rp {{ number_format($order->product->price, 2) }}</td>
                    {{-- Display Order Status with Badge Styling --}}
                    <td>{{ \Carbon\Carbon::parse($order->scheduleDate)->format('l, d M Y') }}</td>
                    <td>
                        @if ($order->status == 'In Progress')
                            <span class="badge bg-warning text-dark">In Progress</span>
                        @elseif ($order->status == 'Complete')
                            <span class="badge bg-success">Complete</span>
                        @elseif ($order->status == 'Cancelled')
                            <span class="badge bg-danger">Cancelled</span>
                        @endif
                    </td>
                    {{-- Conditional Action Buttons --}}
                    <td>
                        @if ($order->status == 'In Progress')
                        <dev class="d-flex">
                            <a href="{{ route('reschedule', $order) }}" class="btn btn-darkblue me-2">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('cancel_order', $order) }}" method="post" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                @method('patch')
                                @csrf
                                <button type="submit" class="btn btn-red"><i class="bi bi-x-circle"></i></button>
                            </form>
                        </dev>

                        @else
                            {{-- No actions for Complete or Cancelled orders --}}
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
