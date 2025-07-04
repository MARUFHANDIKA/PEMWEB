<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Foods')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">

    <!-- Animation & Carousel Libraries -->
    <link href="{{ asset('user/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-3">
        <div class="container px-0">
            <nav class="navbar navbar-expand-lg navbar-dark py-3">
                <a class="navbar-brand fw-bold" href="{{ route('user#home') }}">
                    <i class="mie-ayam"></i> mie ayam bakar pakde joyo
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('user#home') ? 'active' : '' }}"
                                href="{{ route('user#home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('user#carts') ? 'active' : '' }}"
                                href="{{ route('user#carts') }}">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('user#history') ? 'active' : '' }}"
                                href="{{ route('user#history') }}">History</a>
                        </li>
                    </ul>
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-user me-1"></i> {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('user#view') }}"><i
                                        class="fa-solid fa-user"></i> Account</a></li>
                            <li><a class="dropdown-item" href="{{ route('user#changePassword') }}"><i
                                        class="fa-solid fa-lock"></i> Change Password</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="post" class="px-3">
                                    @csrf
                                    <button class="btn btn-sm btn-danger w-100 mt-2" type="submit">
                                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer (Optional - Uncomment to use) -->
    {{--
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <small>&copy; {{ date('Y') }} Store. All rights reserved.</small>
    </footer>
    --}}

    <!-- Back to Top Button -->
    <a href="#" class="btn btn-primary position-fixed bottom-0 end-0 m-4"><i class="fa fa-angle-double-up"></i></a>

    <!-- JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('user/js/main.js') }}"></script>

    @yield('scriptSource')
</body>

</html>