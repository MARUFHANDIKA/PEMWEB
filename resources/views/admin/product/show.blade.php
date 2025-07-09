@extends('admin.layouts.master')

@section('title', 'Product Detail')

@section('content')
    <main class="container py-5">
        <div class="mb-4">
            <a href="{{ route('product#list') }}" class="btn btn-dark">
                <i class="fa fa-arrow-left me-1"></i> Kembali ke list
            </a>
        </div>

        <div class="card shadow rounded-4">
            <div class="card-body">
                @if (session('updateSuccess'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('updateSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="img-fluid rounded shadow-sm mb-3">
                        <a href="{{ route('product#edit', $product->id) }}" class="btn btn-outline-dark rounded-pill">
                            <i class="fa-solid fa-pen-to-square me-1"></i> Edit Produk
                        </a>
                    </div>
                    <div class="col-md-8">
                        <h4 class="fw-semibold text-danger mb-3">
                            <i class="fa-solid fa-pizza-slice me-2"></i> {{ $product->name }}
                        </h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <i class="fa-solid fa-money-bill me-2"></i> Rp.
                                {{ number_format($product->price, 0, ',', '.') }}
                            </li>
                            <li class="list-group-item">
                                <i class="fa-solid fa-clock me-2"></i> {{ $product->waiting_time }} minutes
                            </li>
                            <li class="list-group-item">
                                <i class="fa-solid fa-eye me-2"></i> {{ $product->view_count }} views
                            </li>
                            <li class="list-group-item">
                                <i class="fa-solid fa-boxes-stacked me-2"></i> {{ $product->stock }} in stock
                            </li>
                            <li class="list-group-item">
                                <i class="fa-solid fa-database me-2"></i> {{ $product->category->name }}
                            </li>
                            <li class="list-group-item">
                                <i class="fa-solid fa-message me-2"></i> {{ $product->description }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection