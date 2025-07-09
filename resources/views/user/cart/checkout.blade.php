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
                    <option value="COD">Bayar di Tempat (COD)</option>
                </select>
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
            <button type="button" class="btn btn-danger mt-4 w-100" data-bs-toggle="modal"
                data-bs-target="#paymentGuideModal">
                Lihat tata cara pembayaran
            </button>

        </form>
        <div class="modal fade" id="paymentGuideModal" tabindex="-1" aria-labelledby="paymentGuideModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentGuideModalLabel">🛒 Tata Cara Pemesanan & Pembayaran COD</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Mie Ayam Bakar Pakde Joyo</strong></p>
                        <p>Nikmati kemudahan memesan mie ayam favorit Anda dari rumah! Ikuti langkah-langkah berikut untuk
                            pemesanan dan pembayaran secara COD (Cash on Delivery):</p>

                        <h6 class="mt-3">✅ Langkah-Langkah Pemesanan</h6>
                        <ol>
                            <li><strong>Buka Website Resmi:</strong> Kunjungi website Mie Ayam Bakar Pakde Joyo melalui
                                browser di HP atau laptop Anda.</li>
                            <li><strong>Pilih Menu yang Diinginkan:</strong> Telusuri daftar menu, klik tombol "Pesan
                                Sekarang" pada produk yang ingin dipesan.</li>
                            <li><strong>Isi Formulir Pemesanan:</strong> Masukkan data Anda: Nama lengkap, Nomor WhatsApp
                                aktif, Alamat lengkap pengiriman, Catatan tambahan (opsional).</li>
                            <li><strong>Pilih Metode Pembayaran:</strong> Pilih opsi “COD (Bayar di Tempat)”.</li>
                            <li><strong>Klik “Kirim Pesanan”:</strong> Pesanan Anda akan langsung kami terima dan
                                dikonfirmasi melalui WhatsApp.</li>
                        </ol>

                        <h6 class="mt-3">💵 Cara Pembayaran COD</h6>
                        <ul>
                            <li>Pembayaran dilakukan secara tunai saat pesanan tiba di lokasi Anda.</li>
                            <li>Mohon siapkan uang pas untuk mempercepat proses transaksi.</li>
                            <li>Kurir kami akan mengantar langsung ke alamat yang Anda berikan.</li>
                        </ul>

                        <h6 class="mt-3">⚠️ Syarat dan Ketentuan</h6>
                        <ul>
                            <li>Layanan COD berlaku untuk wilayah Purbalingga kota dan sekitarnya.</li>
                            <li>Waktu pengantaran tergantung antrian dan stok, estimasi ±30–60 menit.</li>
                            <li>Harap pastikan nomor WhatsApp dan alamat sudah benar saat mengisi formulir.</li>
                            <li>Pembatalan hanya dapat dilakukan maksimal 10 menit setelah pemesanan.</li>
                        </ul>

                        <p class="mt-3">Terima kasih telah mendukung UMKM lokal!<br>
                            Kami siap mengantarkan cita rasa lezat Mie Ayam Bakar Pakde Joyo langsung ke rumah Anda.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection