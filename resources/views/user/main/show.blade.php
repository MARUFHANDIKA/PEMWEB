@extends('user.layout.master')

@section('content')
    <style>
        .product-carousel {
            background-color: #f8f9fa;
            border-radius: 10px;
            overflow: hidden;
        }

        .product-info h3 {
            font-weight: bold;
        }

        .product-info .price {
            font-size: 1.5rem;
            color: #e74c3c;
        }

        .product-info .stock {
            font-size: 0.95rem;
        }

        .related-carousel .product-item {
            border-radius: 10px;
            transition: transform 0.2s ease;
        }

        .related-carousel .product-item:hover {
            transform: scale(1.02);
        }
    </style>

    <div class="container py-5">
        <a href="{{ route('user#home') }}" class="text-decoration-none text-dark mb-3 d-inline-block">
            <i class="fa-solid fa-arrow-left me-2"></i> Back
        </a>
        <div class="row">
            <div class="col-lg-5 mb-4">
                <div class="product-carousel p-3">
                    <img src="{{ asset('storage/' . $pizza->image) }}" class="img-fluid w-100" alt="{{ $pizza->name }}">
                </div>
            </div>

            <div class="col-lg-7">
                <div class="bg-light p-4 rounded product-info">
                    <h3>{{ $pizza->name }}</h3>
                    <div class="d-flex align-items-center mb-2">
                        <small class="text-muted me-2"><i class="fa-solid fa-eye me-1"></i>{{ $pizza->view_count }} views</small>
                    </div>
                    <div class="price mb-2">Rp.{{ number_format($pizza->price) }}</div>
                    <div class="stock mb-3 text-muted">Stok tersedia: {{ $pizza->stock }}</div>
                    <p class="mb-4">{{ $pizza->description }}</p>

                    <div class="d-flex align-items-center mb-4">
                        <div class="input-group me-3" style="width: 120px;">
                            <button class="btn btn-outline-secondary btn-minus" type="button"><i class="fa fa-minus"></i></button>
                            <input type="text" class="form-control text-center bg-white" value="1" id="orderCount">
                            <button class="btn btn-outline-secondary btn-plus" type="button"><i class="fa fa-plus"></i></button>
                        </div>
                        <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
                        <input type="hidden" id="pizzaId" value="{{ $pizza->id }}">
                        <button class="btn btn-dark px-4" id="addCartBtn">
                            <i class="fa fa-shopping-cart me-1"></i> Add To Cart
                        </button>
                    </div>

                    <div>
                        <strong class="text-dark me-2">Share on:</strong>
                        <a class="text-dark me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="text-dark me-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="text-dark me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="text-dark" href="#"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-5">
            <h4 class="mb-4">You May Also Like</h4>
            <div class="owl-carousel related-carousel">
                @foreach ($pizzaList as $pL)
                    <div class="product-item bg-white p-3 shadow-sm">
                        <div class="product-img position-relative overflow-hidden">
                            <img src="{{ asset('storage/'.$pL->image) }}" class="img-fluid" style="height: 200px; width: 100%; object-fit: cover;" alt="{{ $pL->name }}">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href="#"><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="#"><i class="fa-solid fa-circle-info"></i></a>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a class="h6 d-block text-decoration-none text-dark text-truncate mb-2" href="#">{{ $pL->name }}</a>
                            <div class="text-primary">Rp.{{ number_format($pL->price) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section("scriptSource")
    <script>
        $(document).ready(function () {
            $('#addCartBtn').click(function () {
                const source = {
                    userId: $('#userId').val(),
                    pizzaId: $('#pizzaId').val(),
                    count: $('#orderCount').val(),
                };
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/ajax/addToCart',
                    data: source,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            window.location.href = 'http://127.0.0.1:8000/user/home';
                        }
                    }
                });
            });
        });
    </script>
@endsection
