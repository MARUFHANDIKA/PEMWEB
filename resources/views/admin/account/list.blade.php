@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
<main class="container py-5">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h2 class="fw-bold text-uppercase">Admin List</h2>
        {{-- Optional action buttons can go here --}}
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('listDelete') && count($admins) >= 1)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-xmark me-2"></i> {{ session('listDelete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-md-4">
            @if (request('key'))
                <h5 class="text-muted">Search key: <span class="text-success">{{ request('key') }}</span></h5>
            @endif
        </div>
        <div class="col-md-4 offset-md-4">
            <form action="{{ route('admin#list') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="key" class="form-control" placeholder="Search" value="{{ request('key') }}">
                    <button class="btn btn-dark" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mb-3">
        <h5><i class="fa-solid fa-database me-2"></i>Total Admins: <strong>{{ $admins->total() }}</strong></h5>
    </div>

    @if (count($admins) > 0)
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($admins as $admin)
                        <tr>
                            <td>
                                @if ($admin->image == null)
                                    <img src="{{ asset('image/defaultUser.png') }}" class="img-thumbnail" style="width: 50px; height: auto;">
                                @else
                                    <img src="{{ asset('storage/' . $admin->image) }}" class="img-thumbnail" style="width: 50px; height: auto;">
                                @endif
                            </td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->gender }}</td>
                            <td>{{ $admin->phone }}</td>
                            <td>{{ $admin->address }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    @if (Auth::user()->id == $admin->id)
                                        <a href="{{ route('admin#edit') }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('admin#changeRole', $admin->id) }}" class="btn btn-sm btn-outline-warning" title="Change Role">
                                            <i class="fa-solid fa-user-shield"></i>
                                        </a>
                                        <a href="{{ route('admin#delete', $admin->id) }}" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $admins->links() }}
        </div>
    @else
        <h4 class="text-secondary text-center">There is no data</h4>
    @endif
</main>
@endsection
