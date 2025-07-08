@extends('layouts.master')

@section('title', 'Register')

@section('content')
<style>
    .register-container {
        max-width: 480px;
        margin: 60px auto;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
        padding: 40px;
    }

    .register-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 25px;
        text-align: center;
        color: #333;
    }

    .form-group label {
        font-weight: 500;
        margin-bottom: 6px;
    }

    .form-control {
        height: 45px;
        font-size: 15px;
        border-radius: 8px;
    }

    .btn-register {
        background: #28a745;
        color: white;
        font-weight: 600;
        font-size: 16px;
        border-radius: 8px;
        padding: 12px 0;
        transition: all 0.3s ease;
    }

    .btn-register:hover {
        background: #218838;
    }

    .register-link {
        margin-top: 20px;
        text-align: center;
        font-size: 14px;
    }

    .register-link a {
        color: #007bff;
        text-decoration: none;
    }

    .register-link a:hover {
        text-decoration: underline;
    }

    @media (max-width: 576px) {
        .register-container {
            margin: 30px 20px;
            padding: 30px 20px;
        }
    }
</style>

<div class="register-container">
    <div class="register-title">Buat Akun Anda</div>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label>Username</label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" placeholder="Enter your name">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label>Email Address</label>
            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label>Password</label>
            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Create a password">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label>Confirm Password</label>
            <input class="form-control" type="password" name="password_confirmation" placeholder="Repeat your password">
        </div>

        <button type="submit" class="btn btn-register w-100">Register</button>
    </form>

    <div class="register-link mt-3">
        Already have an account? <a href="{{ route('auth#loginPage') }}">Sign In</a>
    </div>
</div>
@endsection
