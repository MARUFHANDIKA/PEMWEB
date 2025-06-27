@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
<main class="container py-5">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h2 class="fw-bold text-uppercase">Change Password</h2>
        <a href="{{ route('category#list') }}" class="btn btn-dark">Back to List</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-check me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('fail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-xmark me-2"></i>{{ session('fail') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow rounded col-md-8 offset-md-2">
        <div class="card-body">
            <form action="{{ route('admin#updatePassword') }}" method="post" novalidate>
                @csrf

                <div class="mb-3">
                    <label class="form-label">Old Password</label>
                    <input name="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" placeholder="Enter Old Password...">
                    @error('oldPassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" placeholder="Enter New Password...">
                    @error('newPassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Confirm Password</label>
                    <input name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" placeholder="Confirm Your Password">
                    @error('confirmPassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark w-100">
                    <i class="fa-solid fa-shield me-2"></i>Save Changes
                </button>
            </form>
        </div>
    </div>
</main>
@endsection
