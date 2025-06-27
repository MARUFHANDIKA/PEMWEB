@extends('user.layout.master')

@section('content')
    <style>
        .order-table th,
        .order-table td {
            vertical-align: middle;
        }

        .order-status span {
            font-weight: 600;
        }
    </style>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h4 class="mb-0">Order History</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table order-table table-hover text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>Date</th>
                                    <th>Order ID</th>
                                    <th>Total Price</th>
                                    <th>Lists</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->created_at->format('F-j-Y') }}</td>
                                        <td>{{ $order->id }}</td>
                                        <td>Rp.{{ number_format($order->total_price) }}</td>
                                        <td>
                                            <a href="{{ route('orderList', $order->id) }}">
                                                <button class="btn btn-outline-dark position-relative">
                                                    Lists
                                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                        {{ count($order->orderLists) }}
                                                    </span>
                                                </button>
                                            </a>
                                        </td>
                                        <td class="order-status">
                                            @if ($order->status == 0)
                                                <span class="text-warning"><i class="fa-solid fa-hourglass-start me-2"></i> Pending</span>
                                            @elseif ($order->status == 1)
                                                <span class="text-success"><i class="fa-solid fa-check me-2"></i> Success</span>
                                            @elseif ($order->status == 2)
                                                <span class="text-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i> Rejected</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4 d-flex justify-content-center">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
