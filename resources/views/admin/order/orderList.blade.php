@extends('admin.layouts.master')

@section('title', 'Order List')

@section('content')
<main class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Orders</h2>
        <a href="{{ route('order#csvDownload') }}" class="btn btn-success">
            <i class="fa fa-download me-1"></i> CSV Download
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-check"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('productDelete'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('productDelete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('order#list') }}" method="GET" class="row g-3 mb-4 justify-content-end">
        <div class="col-auto">
            <input type="text" name="key" class="form-control" placeholder="Search By Username" value="{{ request('key') }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-dark">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
    </form>

    @if (request('key'))
        <h5 class="mb-3">Search key: <span class="text-success">{{ request('key') }}</span></h5>
    @endif

    <div class="row align-items-center mb-3">
        <div class="col-md-6">
            <h5><i class="fa-solid fa-database"></i> Total Orders: {{ $orders->total() }}</h5>
        </div>
        <div class="col-md-3">
            <select name="filterStatus" id="filterStatus" class="form-select">
                <option value="all">All</option>
                <option value="0">Pending</option>
                <option value="1">Approve</option>
                <option value="2">Reject</option>
            </select>
        </div>
    </div>

    <div class="table-responsive rounded shadow-sm">
        @if (count($orders) > 0)
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Order Date</th>
                        <th>Total</th>
                        <th>Lists</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach ($orders as $order)
                        <tr>
                            <td>
                                <input type="hidden" value="{{ $order->id }}" class="orderId">
                                {{ $order->user->id }}
                            </td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->created_at->format('m/d/Y') }}</td>
                            <td>Rp.{{ $order->total_price }}</td>
                            <td>
                                <a href="{{ route('orderList', $order->id) }}" class="btn btn-dark position-relative">
                                    Lists
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ count($order->orderLists) }}
                                    </span>
                                </a>
                            </td>
                            <td>
                                <select class="form-select orderStatus">
                                    <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Pending</option>
                                    <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Approve</option>
                                    <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Reject</option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">{{ $orders->links() }}</div>
        @else
            <div class="text-center py-5">
                <h4 class="text-muted">There is no data</h4>
            </div>
        @endif
    </div>
</main>
@endsection

@section('scriptSection')
<script>
    $('.orderStatus').each(function() {
        $(this).change(function() {
            const orderId = $(this).closest('tr').find('.orderId').val();
            const status = parseInt($(this).val(), 10);

            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/order/status',
                data: { orderStatus: status, orderId },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        location.reload();
                    }
                }
            });
        });
    });

    $('#filterStatus').change(function() {
        const status = $(this).val();

        $.ajax({
            type: 'get',
            url: 'http://127.0.0.1:8000/order/filter',
            data: { status },
            dataType: 'json',
            success: function(response) {
                let list = '';

                if (response.length > 0) {
                    response.forEach(order => {
                        const formattedDate = new Date(order.created_at).toLocaleDateString();

                        list += `
                            <tr>
                                <td><input type="hidden" value="${order.id}" class="orderId">${order.user_id}</td>
                                <td>${order.name}</td>
                                <td>${formattedDate}</td>
                                <td>Rp.${order.total_price}</td>
                                <td>
                                    <a href="/orderList/${order.id}" class="btn btn-dark position-relative">
                                        Lists
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            ${order.order_lists_count}
                                        </span>
                                    </a>
                                </td>
                                <td>
                                    <select class="form-select orderStatus">
                                        <option value="0" ${order.status == 0 ? 'selected' : ''}>Pending</option>
                                        <option value="1" ${order.status == 1 ? 'selected' : ''}>Approve</option>
                                        <option value="2" ${order.status == 2 ? 'selected' : ''}>Reject</option>
                                    </select>
                                </td>
                            </tr>
                        `;
                    });
                    $('#tableBody').html(list);
                } else {
                    $('#tableBody').html('<tr><td colspan="6" class="text-center text-muted">No orders found</td></tr>');
                }
            }
        });
    });
</script>
@endsection