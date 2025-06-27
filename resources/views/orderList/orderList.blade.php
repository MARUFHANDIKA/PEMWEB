@extends(Auth::user()->role !== 'admin' ? 'user.layout.master' : 'user.layout.adminMaster')

@section('content')
<main class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-uppercase">Order Details</h2>
    </div>

    <div class="table-responsive rounded shadow-sm">
        <table class="table table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>User</th>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($orderList as $order)
                    <tr>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->order->id }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $order->product->image) }}" class="img-thumbnail" style="width: 50px; height: auto;" alt="{{ $order->product->name }}">
                        </td>
                        <td>{{ $order->qty }}</td>
                        <td>Rp.{{ number_format($order->total, 0, ',', '.') }}</td>
                        <td>{{ $order->created_at->format('F j, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
@endsection
