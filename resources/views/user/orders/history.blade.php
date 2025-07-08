@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Riwayat Pemesanan Saya</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>
                            <ul>
                                @foreach ($order->orderList as $item)
                                    <li>{{ $item->product->name ?? 'Produk tidak ditemukan' }} x{{ $item->quantity }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>Rp {{ number_format($order->total_price) }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada riwayat pemesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection