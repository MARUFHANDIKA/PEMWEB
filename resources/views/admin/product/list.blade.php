@extends('admin.layouts.master')

@section('title', 'Products List')

@section('content')
<main class="container py-5">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h2 class="fw-semibold">Product List</h2>
        <div>
            <a href="{{ route('product#new') }}" class="btn btn-primary">
                <i class="fa fa-plus me-1"></i> Add Product
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-check me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('productDelete'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-trash me-2"></i>{{ session('productDelete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('updateSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-check me-2"></i>{{ session('updateSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-md-6">
            @if (request('key'))
                <h6 class="text-muted">Search Key: <span class="text-primary fw-semibold">{{ request('key') }}</span></h6>
            @endif
        </div>
        <div class="col-md-6">
            <form action="{{ route('product#list') }}" method="GET" class="d-flex justify-content-end">
                <input type="text" name="key" class="form-control w-50" placeholder="Search..." value="{{ request('key') }}">
                <button class="btn btn-dark ms-2" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    <h5 class="mb-3">
        <i class="fa-solid fa-database me-1"></i>Total - {{ $menu->total() }}
    </h5>

    <div class="table-responsive">
        @if ($menu->count())
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>View</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menu as $menus)
                        <tr>
                            <td style="width: 100px">
                                <img src="{{ asset('storage/' . $menus->image) }}" alt="{{ $menus->name }}" class="img-thumbnail">
                            </td>
                            <td>{{ $menus->name }}</td>
                            <td>{{ Str::limit($menus->description, 50) }}</td>
                            <td>Rp{{ number_format($menus->price, 0, ',', '.') }}</td>
                            <td>{{ $menus->category->name ?? 'No Category' }}</td>
                            <td><i class="fa fa-eye me-1"></i>{{ $menus->view_count }}</td>
                            <td>
                                @if($menus->stock <= 5)
                                    <span class="badge bg-danger">{{ $menus->stock }}</span>
                                @else
                                    <span class="badge bg-success">{{ $menus->stock }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('product#show', $menus->id) }}" class="btn btn-sm btn-outline-primary" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('product#edit', $menus->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('product#delete', $menus->id) }}" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $menu->links() }}
            </div>
        @else
            <div class="text-center my-5">
                <h5 class="text-muted">There is no data.</h5>
            </div>
        @endif
    </div>
</main>
@endsection
