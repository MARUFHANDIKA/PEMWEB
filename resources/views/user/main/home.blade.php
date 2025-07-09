@extends('user.layout.master')

@section('content')
<style>
    .product-card {
        border-radius: 12px;
        overflow: hidden;
        background-color: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease-in-out;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .product-img {
        border-radius: 12px 12px 0 0;
        transition: transform 0.3s ease;
        object-fit: cover;
        height: 230px;
    }

    .product-card:hover .product-img {
        transform: scale(1.05);
    }
</style>

<div class="container py-5">
    <div class="row">
        <!-- Sidebar Kategori -->
        <div class="col-lg-3 mb-4">
            <h5 class="mb-3">Kategori Menu</h5>
            <ul class="list-group mb-4">
                <a href="{{ route('user#home') }}" class="list-group-item list-group-item-action">Semua</a>
                @foreach ($categories as $category)
                    <a href="{{ route('user#filter', $category->id) }}" class="list-group-item list-group-item-action">
                        {{ $category->name }}
                    </a>
                @endforeach
            </ul>
        </div>

        <!-- Konten Produk -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <a href="{{ route('user#carts') }}" class="btn btn-dark position-relative">
                        <i class="fa fa-shopping-cart text-white"></i>
                        <span id="cartCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $carts->count() }}
                        </span>
                    </a>
                    <a href="{{ route('user#history') }}" class="btn btn-dark position-relative ms-2">
                        <i class="fa fa-history text-white"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $orders->count() }}
                        </span>
                    </a>
                </div>
                <div>
                    <select id="sortingOption" class="form-control">
                        <option value="">Pilih Opsi</option>
                        <option value="asc">Terdahulu</option>
                        <option value="desc">Terbaru</option>
                        <option value="popular">Populer</option>
                    </select>
                </div>
            </div>

            <div class="row" id="dataList">
                @if (count($menu) != 0)
                    @foreach ($menu as $menu)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="product-card">
                                <img src="{{ asset('storage/' . $menu->image) }}" class="img-fluid w-100 product-img" alt="{{ $menu->name }}">
                                <div class="p-3 text-center">
                                    <h5 class="text-truncate">{{ $menu->name }}</h5>
                                    <p class="text-muted">Rp.{{ number_format($menu->price) }}</p>
                                    <p class="small text-warning">Stok: {{ $menu->stock }}</p>
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-outline-primary btn-sm cartBtn">
                                            <i class="fa fa-shopping-cart"></i>
                                        </button>
                                        <a href="{{ route('user#show', $menu->id) }}" class="btn btn-outline-info btn-sm">
                                            <i class="fa fa-info-circle"></i>
                                        </a>
                                    </div>
                                    <input type="hidden" class="menuId" value="{{ $menu->id }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h4 class="text-center bg-warning text-white p-4 col-12">There is no menu in this category</h4>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptSource')
<script>
    $(document).ready(function () {
        $('#sortingOption').change(function () {
            const eventOption = $(this).val();
            if (eventOption) {
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/ajax/menu',
                    data: { status: eventOption },
                    dataType: 'json',
                    success: function (response) {
                        let list = '';
                        for (let i = 0; i < response.length; i++) {
                            list += `
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="product-card">
                                        <img src="/storage/${response[i].image}" class="img-fluid w-100 product-img" alt="${response[i].name}">
                                        <div class="p-3 text-center">
                                            <h5 class="text-truncate">${response[i].name}</h5>
                                            <p class="text-muted">Rp.${response[i].price}</p>
                                            <p class="small text-secondary">Stok: ${response[i].stock}</p>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button class="btn btn-outline-warning btn-sm cartBtn">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button>
                                                <a href="/user/show/${response[i].id}" class="btn btn-outline-info btn-sm">
                                                    <i class="fa fa-info-circle"></i>
                                                </a>
                                            </div>
                                            <input type="hidden" class="menuId" value="${response[i].id}">
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                        $('#dataList').html(list);
                    }
                });
            }
        });

        // Tambah ke cart
        $(document).on('click', '.cartBtn', function (event) {
            event.preventDefault();
            const menuId = $(this).closest('.product-card').find('.menuId').val();
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/user/ajax/autoAddToCart',
                data: { menuId: menuId },
                dataType: 'json',
                success: function (response) {
                    if (response.status == 'success') {
                        let current = parseInt($('#cartCount').text());
                        $('#cartCount').text(current + 1);
                    }
                }
            });
        });
    });
</script>
@endsection
