@extends('admin.admin_layout')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Order List</h3>
        {{-- ganti iconnya jangan lupa --}}
        <button class="btn btn-darkblue"><i class="fas fa-plus" style="padding: 5px 5px"></i> Report</button>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr class="table-light">
                    <th scope="col">Customer Name</th>
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
                    {{-- Display Customer Name --}}
                    <td>
                        {{ $order->user->name}}
                    </td>
                    {{-- Display Product Name --}}
                    <td>{{ $order->product->name }}</td>
                    {{-- Display Product Price --}}
                    <td>Rp {{ number_format($order->product->price, 2) }}</td>
                    {{-- Display Order Status with Badge Styling --}}
                    <td>
                        {{ $order->orderDate }}
                    </td>
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
                            <a href="" class="btn btn-darkblue">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="" class="btn btn-red">
                                <i class="fa fa-times"></i>
                            </a>
                            <a href="" class="btn btn-green">
                                <i class="fa fa-check"></i>
                            </a>
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
    <div>
        {{ $orders->links('pagination::bootstrap-5') }} <!-- Pagination links -->
    </div>
</div>
@endsection
