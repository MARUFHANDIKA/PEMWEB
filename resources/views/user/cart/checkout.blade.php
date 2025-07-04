@extends('user.layout.master')

@section('content')
    <div class="container my-5">
        <h3>Form Pemesanan</h3>
        <form action="{{ route('user#checkoutSubmit') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Alamat Lengkap</label>
                <textarea name="address" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label>Metode Pembayaran</label>
                <select name="payment_method" class="form-control" required>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="COD">Bayar di Tempat (COD)</option>
                    <option value="E-Wallet">E-Wallet</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Bukti Pembayaran</label>
                <input type="file" name="receipt" class="form-control" required>
            </div>

            <hr>
            <h5>Ringkasan Pesanan</h5>
            <ul class="list-group">
                @php $total = 0; @endphp
                @foreach ($carts as $item)
                    @php
                        $product = $item->product;
                        $price = $product->price ?? 0;
                        $quantity = $item->quantity ?? 0;
                        $subtotal = $price * $quantity;
                        $total += $subtotal;
                    @endphp

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            {{ $product->name ?? 'Produk tidak ditemukan' }} x {{ $quantity }} <br>
                            <small class="text-muted">Rp {{ number_format($price) }} / item</small>
                        </div>
                        <strong>Rp {{ number_format($subtotal) }}</strong>
                    </li>
                @endforeach

                <li class="list-group-item d-flex justify-content-between">
                    <strong>Total</strong>
                    <strong>Rp {{ number_format($total) }}</strong>
                </li>
            </ul>



            <button type="submit" class="btn btn-success mt-4 w-100">Kirim Pesanan</button>
        </form>
    </div>
@endsection