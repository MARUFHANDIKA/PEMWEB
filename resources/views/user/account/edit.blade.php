@extends('user.layout.master')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('user#home') }}" class="btn btn-dark"><i class="fa-solid fa-arrow-left me-2"></i>Back to Home</a>
    </div>
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-center mb-4">Edit Account Profile</h3>

                    <form action="{{ route('user#update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row align-items-start">
                            <div class="col-md-4 text-center">
                                @if (Auth::user()->image == null)
                                    <img src="{{ asset('image/defaultUser.png') }}" class="img-thumbnail mb-3" alt="">
                                @else
                                    <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="" class="img-thumbnail shadow-sm mb-3">
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
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ Auth::user()->name }}" placeholder="User Name">
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email }}" placeholder="email@address.com">
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Gender</label>
                                    <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                        <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                        <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                    </select>
                                    @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ Auth::user()->phone }}" placeholder="08**********">
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ Auth::user()->address }}</textarea>
                                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <input type="text" class="form-control" disabled value="{{ Auth::user()->role }}">
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
