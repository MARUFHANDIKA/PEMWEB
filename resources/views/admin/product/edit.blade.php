@extends('admin.layouts.master')

@section('title', 'Edit Product')

@section('content')
    <main class="container py-5">
        <div class="mb-4">
            <a href="{{ route('product#list') }}" class="btn btn-dark">
                <i class="fa fa-arrow-left me-1"></i> Kembali ke list
            </a>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <h4 class="mb-4 text-center fw-semibold">Edit Produk</h4>

                <form action="{{ route('product#update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center mb-3">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image"
                                    class="img-thumbnail w-100">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar Produk</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <button type="submit" class="btn btn-info w-100">
                                <span>Update</span>
                                <i class="fa fa-check ms-2"></i>
                            </button>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="category" class="form-select @error('category') is-invalid @enderror">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" rows="3"
                                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input type="number" name="price" value="{{ old('price', $product->price) }}"
                                    class="form-control @error('price') is-invalid @enderror">
                                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Waktu tunggu (Menit)</label>
                                <input type="number" name="waitingTime"
                                    value="{{ old('waitingTime', $product->waiting_time) }}"
                                    class="form-control @error('waitingTime') is-invalid @enderror">
                                @error('waitingTime')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                                    class="form-control @error('stock') is-invalid @enderror">
                                @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">View Count</label>
                                <input type="text" value="{{ $product->view_count }}" class="form-control" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Dibuat pada</label>
                                <input type="text" value="{{ $product->created_at->format('j F Y') }}" class="form-control"
                                    disabled>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection