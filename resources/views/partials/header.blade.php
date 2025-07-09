<!-- resources/views/partials/header.blade.php -->
<header class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/Logo.png') }}" alt="Logo Pakde Joyo" height="50" class="me-2">
            <span class="fw-bold">Mie Ayam Bakar Pakde Joyo</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#menu">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('team') }}">tim pengembang</a></li>
                <li class="nav-item"><a class="btn btn-danger ms-3" href="{{ route('auth#loginPage') }}">Login</a></li>
            </ul>
        </div>
    </div>
</header>