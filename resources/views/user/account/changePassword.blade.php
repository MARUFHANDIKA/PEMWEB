@extends('user.layout.master')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('user#home') }}" class="btn btn-dark"><i class="fa-solid fa-arrow-left me-2"></i>Back to Home</a>
    </div>
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-center mb-4">Change Password</h3>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('fail'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark me-2"></i> {{ session('fail') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('user#updatePassword')}}" method="post" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Old Password</label>
                            <input type="password" name="oldPassword" class="form-control @error('oldPassword') is-invalid @enderror" placeholder="Enter Old Password...">
                            @error('oldPassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="newPassword" class="form-control @error('newPassword') is-invalid @enderror" placeholder="Enter New Password...">
                            @error('newPassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="confirmPassword" class="form-control @error('confirmPassword') is-invalid @enderror" placeholder="Confirm Your Password">
                            @error('confirmPassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">
                                <i class="fa-solid fa-shield me-2"></i>Save Changes
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
