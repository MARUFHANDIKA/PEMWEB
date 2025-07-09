@extends('layouts.master')

@section('title', 'Login')

@section('content')
    <style>
        <style>.login-container {
            max-width: 450px;
            margin: 60px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .login-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 25px;
            text-align: center;
            color: #333;
        }

        .form-group label {
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control {
            height: 45px;
            font-size: 15px;
            border-radius: 8px;
        }

        .btn-login {
            background: #dc3545;
            color: white;
            font-weight: 600;
            font-size: 16px;
            border-radius: 8px;
            padding: 12px 0;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-login:hover {
            background: #c82333;
        }


        .register-link {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }

        .register-link a {
            color: #e3342f;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .login-container {
                max-width: 450px;
                margin: 60px auto;
                background: #ffffff;
                border-radius: 12px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                padding: 40px;
            }

            .login-title {
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 25px;
                text-align: center;
                color: #333;
            }

            .form-group label {
                font-weight: 500;
                margin-bottom: 8px;
            }

            .form-control {
                height: 45px;
                font-size: 15px;
                border-radius: 8px;
            }

            .btn-login {
                background: #28a745;
                color: white;
                font-weight: 600;
                font-size: 16px;
                border-radius: 8px;
                padding: 12px 0;
                transition: all 0.3s ease;
            }

            .btn-login:hover {
                background: #218838;
            }

            .register-link {
                margin-top: 20px;
                text-align: center;
                font-size: 14px;
            }

            .register-link a {
                color: #e3342f;
                text-decoration: none;
            }

            .register-link a:hover {
                text-decoration: underline;
            }

            @media (max-width: 576px) {
                .login-container {
                    margin: 30px 20px;
                    padding: 30px 20px;
                }
            }
    </style>

    <div class="login-container">
        <div class="login-title">Selamat Datang!</div>

        <form action="{{ route('login') }}" method="post">
            @csrf

            <div class="form-group mb-3">
                <label for="email">Masukan email</label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                    placeholder="Email" value="{{ old('email') }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="password">Password</label>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                    placeholder="Password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-login w-100">Login</button>
        </form>

        <div class="register-link">
            Don’t have an account? <a href="{{ route('auth#registerPage') }}">Sign Up Here</a>
        </div>
    </div>
@endsection