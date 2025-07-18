@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('product#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Buat makanan</h3>
                            </div>
                            <hr>

                            {{-- create your menu start --}}
                            <form action="{{ route('product#create') }}" method="post" enctype="multipart/form-data" novalidate="novalidate">
                                @csrf
                                
                                <div class="form-group">
                                    <label class="control-label mb-1">Nama</label>
                                    <input name="name" value="{{ old('name') }}" type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="Masukan nama makanan">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Kategori</label>
                                    <select name="category" class="form-control @error('category') is-invalid @enderror">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Deskripsi</label>
                                    <textarea name="description" cols="30" rows="10"
                                              class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Gambar</label>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="price" class="control-label mb-1">Harga</label>
                                    <input type="number" name="price" value="{{ old('price') }}" placeholder="Price"
                                           class="form-control @error('price') is-invalid @enderror">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="waitingTime" class="control-label mb-1">Waktu tunggu</label>
                                    <input type="number" name="waitingTime" value="{{ old('waitingTime') }}" placeholder="Waiting Time In Minutes"
                                           class="form-control @error('waitingTime') is-invalid @enderror">
                                    @error('waitingTime')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- ✅ Tambahan: Stock --}}
                                <div class="form-group">
                                    <label for="stock" class="control-label mb-1">Stok</label>
                                    <input type="number" name="stock" value="{{ old('stock') }}" placeholder="Masukkan jumlah stok"
                                           class="form-control @error('stock') is-invalid @enderror">
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <br>
                                <div>
                                    <button type="submit" class="btn btn-lg btn-info btn-block">
                                        <span>Create</span> <i class="fa-solid fa-circle-right"></i>
                                    </button>
                                </div>
                            </form>
                            {{-- create your menu end --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
