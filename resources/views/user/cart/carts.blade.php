@extends('user.layout.master')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container py-3">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumb bg-white shadow-sm rounded px-3 py-2">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Toko</a>
                    <span class="breadcrumb-item active">Keranjang belanja</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Cart Start -->
    <div class="container">
        @if (count($cartList) != 0)
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="table-responsive shadow rounded bg-white p-3">
                        <table class="table table-bordered align-middle mb-0" id="dataTable">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>gambar</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>kuantitas</th>
                                    <th>Total</th>
                                    <th>hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <input type="hidden" value="{{ Auth::User()->id}}" id="userId">
                                @foreach ($cartList as $c)
                                    <tr data-order-id="{{ $c->id }}">
                                        <td><img src="{{ asset('storage/' . ($c->product->image ?? 'default.jpg')) }}"
                                                class="img-thumbnail" style="width: 80px;"></td>
                                        <td>{{ $c->product->name ?? 'Unknown Product' }}</td>
                                        <input type="hidden" class="orderId" value="{{ $c->id }}">
                                        <input type="hidden" class="productId" value="{{ $c->product_id }}">
                                        <input type="hidden" class="cartUserId" value="{{ $c->user_id }}">
                                        <td class="menuPrice">Rp.{{ $c->product->price ?? '0' }}</td>
                                        <td>
                                            <div class="input-group input-group-sm justify-content-center">
                                                <button class="btn btn-outline-secondary btn-minus"><i
                                                        class="fa fa-minus"></i></button>
                                                <input type="text" class="form-control text-center mx-1 qty"
                                                    value="{{ $c->quantity }}">
                                                <button class="btn btn-outline-secondary btn-plus"><i
                                                        class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td class="total">Rp.{{ ($c->product->price ?? 0) * $c->quantity }}</td>
                                        <td class="text-center"><button class="btn btn-sm btn-danger btnRemove"><i
                                                    class="fa fa-times"></i></button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="bg-white shadow rounded p-4">
                        <h5 class="text-uppercase mb-3 border-bottom pb-2">Cart Summary</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span id="subTotalPrice">Rp.{{ $totalPrice }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>ongkos kirim</span>
                            <span>Rp.3000</span>
                        </div>
                        <div class="d-flex justify-content-between border-top pt-2">
                            <strong>Total</strong>
                            <strong id="finalTotal">Rp.{{ $totalPrice + 3000 }}</strong>
                        </div>
                        <button class="btn btn-primary w-100 mt-3" id="orderBtn">Checkout</button>
                        <button class="btn btn-danger w-100 mt-2" id="clearBtn">Bersihkan Keranjang</button>
                    </div>
                </div>
            </div>
        @else
            <div class="d-flex justify-content-center align-items-center" style="height: 50vh">
                <h2 class="text-center text-muted">Belum ada pesanan di keranjang</h2>
            </div>
        @endif
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
    <script>
        $('#orderBtn').click(function () {
            let orderList = [];
            let random = Math.floor(Math.random() * 100000) + 1;
            let totalAmount = Number($('#finalTotal').text().replace('Rp.', '').replace(/,/g, ''));

            let order = {
                'user_id': $('#userId').val(),
                'total_price': totalAmount,
            };

            $('#dataTable tbody tr').each(function () {
                orderList.push({
                    'user_id': $(this).find('.cartUserId').val(),
                    'product_id': $(this).find('.productId').val(),
                    'qty': $(this).find('.qty').val(),
                    'total': $(this).find('.total').text().replace('Rp.', '').replace(/,/g, '') * 1,
                    'order_code': "POS" + random,
                });
            });

            let payLoad = {
                'order': order,
                'orderList': orderList
            };

            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/user/ajax/order',
                data: payLoad,
                dataType: 'json',
                success: function (response) {
                    if (response.status == 'success') {
                        $('#dataTable tbody').html('');
                        $('#subTotalPrice').text('Rp.0');
                        $('#finalTotal').text('Rp.0');
                    }
                }
            });
        });

        $('#clearBtn').click(function () {
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/user/ajax/clear/cart',
                dataType: 'json',
                success: function () {
                    $('#dataTable tbody').html('');
                    $('#subTotalPrice').text('Rp.0');
                    $('#finalTotal').text('Rp.0');
                }
            });
        });

        // Remove individual cart item
        $(document).on('click', '.btnRemove', function () {
            let row = $(this).closest('tr');
            let orderId = row.find('.orderId').val();
            let productId = row.find('.productId').val();

            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/user/ajax/remove',
                data: { orderId: orderId, productId: productId },
                dataType: 'json',
                success: function (res) {
                    if (res.status === 'success') {
                        row.fadeOut(300, function () {
                            $(this).remove();

                            let total = 0;
                            $('#dataTable tbody tr').each(function () {
                                total += Number($(this).find('.total').text().replace("Rp.", "").replace(/,/g, ''));
                            });

                            $('#subTotalPrice').text(`Rp.${total}`);
                            $('#finalTotal').text(`Rp.${total + 3000}`);
                        });
                    }
                }
            });
        });
        document.getElementById('orderBtn').addEventListener('click', function () {
            window.location.href = "{{ route('user#checkout') }}";
        });
    </script>
@endsection