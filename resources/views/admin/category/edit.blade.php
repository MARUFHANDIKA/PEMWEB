@extends('admin.layouts.master')

@section('title', 'Edit Category')

@section('content')
<main class="container py-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center mb-4 fw-semibold">Edit Category</h3>

                    <form action="{{ route('category#update') }}" method="POST" novalidate>
                        @csrf
                        <input type="hidden" name="id" value="{{ $category->id }}">

                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Name</label>
                            <input type="text" id="categoryName" name="categoryName"
                                class="form-control @error('categoryName') is-invalid @enderror"
                                value="{{ old('categoryName', $category->name) }}" placeholder="e.g. Seafood">
                            @error('categoryName')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa-solid fa-circle-check me-2"></i>Update
                        </button>
                    </form>

                    <div class="text-end mt-3">
                        <a href="{{ route('category#list') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fa fa-arrow-left me-1"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
