@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <main class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Kategori List</h2>
            <div>
                <a href="{{ route('category#createPage') }}" class="btn btn-primary me-2">
                    <i class="fa fa-plus me-1"></i> Tambah Kategori
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('deleteMessage'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-check me-2"></i>{{ session('deleteMessage') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-md-4">
                @if (request('key'))
                    <h5 class="text-muted">Search Key: <span class="text-dark fw-semibold">{{ request('key') }}</span></h5>
                @endif
            </div>
            <div class="col-md-4 offset-md-4">
                <form action="{{ route('category#list') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="key" class="form-control" placeholder="Search"
                            value="{{ request('key') }}">
                        <button class="btn btn-dark" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mb-3">
            <h5><i class="fa-solid fa-database me-2"></i> Total: {{ $categories->total() }}</h5>
        </div>

        @if ($categories->count())
            <div class="table-responsive bg-white rounded shadow-sm">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama Kategori</th>
                            <th>Tanggal Pembuatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->created_at->format('j F, Y') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('category#edit', $category->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('category#delete', $category->id) }}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $categories->links() }}
            </div>
        @else
            <div class="alert alert-info text-center">There is no data available.</div>
        @endif
    </main>
@endsection