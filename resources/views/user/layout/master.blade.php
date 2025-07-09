<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Foods')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <header class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('user#home') }}">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo Pakde Joyo" height="50" class="me-2">
                <span class="fw-bold">Mie Ayam Bakar Pakde Joyo</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('user#home') ? 'active fw-bold text-primary' : '' }}"
                                href="{{ route('user#home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('user#carts') ? 'active fw-bold text-primary' : '' }}"
                                href="{{ route('user#carts') }}">Keranjang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('user#history') ? 'active fw-bold text-primary' : '' }}"
                                href="{{ route('user#history') }}">Riwayat</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-user me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('user#view') }}">
                                        <i class="fa-solid fa-user"></i> Akun</a></li>
                                <li><a class="dropdown-item" href="{{ route('user#changePassword') }}">
                                        <i class="fa-solid fa-lock"></i> Ubah Password</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="px-3">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger w-100 mt-2">
                                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="#menu">Menu</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">Tentang Kami</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
                        <li class="nav-item">
                            <a class="btn btn-danger ms-3" href="{{ route('auth#loginPage') }}">Login</a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </header>

    <!-- Navbar End -->

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- resources/views/partials/footer.blade.php -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container row mx-auto">
            <div class="col-md-3">
                <h5>Mie Ayam Bakar Pakde Joyo</h5>
                <p>Melayani dengan cita rasa autentik sejak 2010</p>
            </div>
            <div class="col-md-3">
                <h5>Menu</h5>
                <a href="{{ route('user#home') }}" class="d-block text-white">Home</a>
                <a href="{{ route('user#home') }}#menu" class="d-block text-white">Menu</a>
                <a href="{{ route('user#home') }}#about" class="d-block text-white">Tentang Kami</a>
                <a href="{{ route('user#home') }}#contact" class="d-block text-white">Kontak</a>
            </div>
            <div class="col-md-3">
                <h5>Kontak</h5>
                <p><i class="fa fa-phone me-1"></i> +62 882-0089-01178</p>
                <p><i class="fa fa-envelope me-1"></i> info@mieayampakdejoyo.com</p>
                <p><i class="fa fa-map-marker-alt me-1"></i> Jl. Raya Rupakpicis, babakan slatri, klapasawit, Kec.
                    Kalimanah, Kabupaten Purbalingga, Jawa Tengah</p>
            </div>
            <div class="col-md-3">
                <h5>Ikuti Kami</h5>
                <a href="https://www.instagram.com/mie_ayam_pakde_joyo?igsh=eTUwMm54eG4wOXMz " target="_blank"
                    class="d-block text-white">Instagram</a>
                <a href="https://maps.app.goo.gl/PnJzTMjiqgRjfLR9A?g_st=aw" target="_blank"
                    class="d-block text-white">Gmaps</a>
            </div>
        </div>
        <div class="text-center mt-4">&copy; 2025 Mie Ayam Bakar Pakde Joyo. All rights reserved.</div>
    </footer>
    <!-- Footer End -->
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