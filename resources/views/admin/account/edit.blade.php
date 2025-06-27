@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
<main class="container py-5">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h2 class="fw-bold text-uppercase">Account Profile</h2>
        <a href="{{ route('category#list') }}" class="btn btn-dark">Back to List</a>
    </div>

    <div class="card shadow rounded">
        <div class="card-body">
            <form action="{{ route('admin#update', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 text-center">
                        @if (Auth::user()->image == null)
                            <img src="{{ asset('image/defaultUser.png') }}" class="img-thumbnail mb-3" alt="Default Profile">
                        @else
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" class="img-thumbnail mb-3" alt="Profile Image">
                        @endif

                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <button class="btn btn-dark mt-3 w-100" type="submit">
                            <i class="fa-solid fa-chevron-right me-2"></i>Update
                        </button>
                    </div>

                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ Auth::user()->name }}" placeholder="UserName">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email }}" placeholder="email@address.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ Auth::user()->phone }}" placeholder="09*********">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="4">{{ Auth::user()->address }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <input type="text" name="role" class="form-control" value="{{ Auth::user()->role }}" disabled>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
