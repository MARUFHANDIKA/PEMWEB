@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
<main class="container py-5">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h2 class="fw-bold text-uppercase">Account Info</h2>
        <a href="{{ route('category#list') }}" class="btn btn-dark">Back to List</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow rounded">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if (Auth::user()->image == null)
                        <img src="{{ asset('image/defaultUser.png') }}" class="img-thumbnail mb-3" alt="Default Profile">
                    @else
                        <img src="{{ asset('storage/'. Auth::user()->image ) }}" class="img-thumbnail mb-3" alt="{{ Auth::user()->name }}">
                    @endif

                    <a href="{{ route('admin#edit')}}" class="btn btn-dark w-100">
                        <i class="fa-solid fa-pen-to-square me-2"></i> Edit Profile
                    </a>
                </div>

                <div class="col-md-8">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fa-solid fa-user-pen me-2"></i>{{ Auth::user()->name }}
                        </li>
                        <li class="list-group-item">
                            <i class="fa-solid fa-envelope me-2"></i>{{ Auth::user()->email }}
                        </li>
                        <li class="list-group-item">
                            <i class="fa-solid fa-mars-and-venus me-2"></i>{{ Auth::user()->gender }}
                        </li>
                        @if (Auth::user()->phone != null)
                            <li class="list-group-item">
                                <i class="fa-solid fa-phone me-2"></i>{{ Auth::user()->phone }}
                            </li>
                        @endif
                        @if (Auth::user()->address != null)
                            <li class="list-group-item">
                                <i class="fa-solid fa-location-pin me-2"></i>{{ Auth::user()->address }}
                            </li>
                        @endif
                        <li class="list-group-item">
                            <i class="fa-solid fa-calendar-day me-2"></i>{{ Auth::user()->created_at->format('j F Y') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
