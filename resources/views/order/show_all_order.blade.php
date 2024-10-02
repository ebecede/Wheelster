@extends('layouts.product_layout')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Order List</h1>

        <form action="{{ route('order_report') }}" method="GET">
            <input type="hidden" name="month" value="{{ request()->month }}">
            <button type="submit" class="btn btn-darkblue"><i class="bi bi-file-earmark-bar-graph me-1"></i> Report</button>
        </form>
    </div>
    <div class="col-md-4">
        <form action="{{ route('order_list') }}" method="GET" class="d-flex">
            <input type="month" name="month" class="form-control me-2" value="{{ request()->month }}">
            <button type="submit" class="btn btn-darkblue">Filter</button>
            <a href="{{ route('order_list') }}" class="btn btn-secondary ms-2" style="border-radius: 12px">Clear</a>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr class="table-light">
                    <th scope="col">Customer Name</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Schedule Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    {{-- Display Customer Name --}}
                    <td>
                        {{ $order->user->name}}
                    </td>
                    {{-- Display Product Name --}}
                    <td>{{ $order->product->name }}</td>
                    {{-- Display Schedule Date --}}
                    <td>{{ \Carbon\Carbon::parse($order->scheduleDate)->format('l, d M Y') }}</td>
                    {{-- Display Order Status with Badge Styling --}}
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
                        <div class="d-flex">
                            <form action="{{ route('edit_order', $order) }}" method="get" >
                                <button type="submit" class="btn btn-darkblue me-1"><i class="bi bi-pencil-square"></i></button>
                            </form>
                            <form action="{{ route('show_order_detail', $order) }}" method="get" >
                                <button type="submit" class="btn btn-darkblue me-1"><i class="bi bi-card-text"></i></button>
                            </form>
                            <form action="{{ route('complete_order_admin', $order) }}" method="post" onsubmit="return confirm('Are you sure you want to mark this order as Complete?');">
                                @method('patch')
                                @csrf
                                <button type="submit" class="btn btn-green me-1"><i class="bi bi-check-circle"></i></button>
                            </form>
                            <form action="{{ route('cancel_order_admin', $order) }}" method="post" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                @method('patch')
                                @csrf
                                <button type="submit" class="btn btn-red me-1"><i class="bi bi-x-circle"></i></button>
                            </form>
                        </div>
                        @else
                            {{-- No actions for Complete or Cancelled orders --}}
                            <form action="{{ route('show_order_detail', $order) }}" method="get" >
                                <button type="submit" class="btn btn-darkblue me-1"><i class="bi bi-card-text"></i></button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $orders->links('pagination::bootstrap-5') }} <!-- Pagination links -->
    </div>
</div>
@endsection
