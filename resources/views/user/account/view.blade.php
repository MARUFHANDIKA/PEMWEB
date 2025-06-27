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
                    <h3 class="text-center mb-4">Account Information</h3>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row align-items-center">
                        <div class="col-md-4 text-center">
                            @if (Auth::user()->image == null)
                                <img src="{{ asset('image/defaultUser.png') }}" class="img-thumbnail" alt="">
                            @else
                                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Image" class="img-thumbnail shadow-sm" />
                            @endif
                            <a href="{{ route('user#edit', Auth::user()->id)}}" class="btn btn-dark mt-3">
                                <i class="fa-solid fa-pen-to-square me-2"></i> Edit Profile
                            </a>
                        </div>

                        <div class="col-md-8">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><i class="fa-solid fa-user me-2"></i><strong>Name:</strong> {{ Auth::user()->name }}</li>
                                <li class="list-group-item"><i class="fa-solid fa-envelope me-2"></i><strong>Email:</strong> {{ Auth::user()->email }}</li>
                                @if (Auth::user()->gender)
                                    <li class="list-group-item"><i class="fa-solid fa-venus-mars me-2"></i><strong>Gender:</strong> {{ Auth::user()->gender }}</li>
                                @endif
                                @if (Auth::user()->phone)
                                    <li class="list-group-item"><i class="fa-solid fa-phone me-2"></i><strong>Phone:</strong> {{ Auth::user()->phone }}</li>
                                @endif
                                @if (Auth::user()->address)
                                    <li class="list-group-item"><i class="fa-solid fa-location-dot me-2"></i><strong>Address:</strong> {{ Auth::user()->address }}</li>
                                @endif
                                <li class="list-group-item"><i class="fa-solid fa-calendar-day me-2"></i><strong>Member Since:</strong> {{ Auth::user()->created_at->format('j F Y') }}</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
