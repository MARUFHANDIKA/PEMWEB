<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Smart Campus Admin Panel">
    <meta name="author" content="Tracer Team">
    <title>@yield('title')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
        }

        aside {
            background-color: #2c3e50;
        }

        aside .nav-link {
            color: #ecf0f1;
        }

        aside .nav-link.active,
        aside .nav-link:hover {
            background-color: #34495e;
            border-radius: 8px;
        }

        aside .btn {
            background-color: #e74c3c;
            border: none;
        }

        aside .btn:hover {
            background-color: #c0392b;
        }

        main {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>
    <div class="d-flex min-vh-100">
        <!-- Sidebar -->
        <aside class="text-white p-3" style="width: 250px;">
            <div class="text-center mb-4">
                <a href="#" class="text-white text-decoration-none">
                    {{-- <img src="{{ asset('admin/images/icon/logo.png') }}" alt="Logo" class="img-fluid mb-2"
                        style="max-height: 50px;"> --}}
                    <h5 class="fw-bold">Admin Panel</h5>
                </a>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="{{ route('category#list') }}" class="nav-link"><i
                            class="fas fa-chart-bar me-2"></i>Kategori</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('product#list') }}" class="nav-link"><i
                            class="fas fa-pizza-slice me-2"></i>Produk</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('order#list') }}" class="nav-link"><i class="fas fa-list me-2"></i>Pesanan</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('user#list') }}" class="nav-link"><i class="fas fa-users me-2"></i>Customer</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('admin#list') }}" class="nav-link"><i class="fas fa-user-cog me-2"></i>List
                        Admin</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('admin#detail') }}" class="nav-link"><i class="fas fa-user me-2"></i>Akun</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('admin#changePasswordPage') }}" class="nav-link"><i
                            class="fas fa-lock me-2"></i>Ganti Password</a>
                </li>
                <li class="nav-item mt-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn text-white w-100"><i
                                class="fas fa-sign-out-alt me-2"></i>Logout</button>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow-1 p-4">
            @yield('content')
        </main>
    </div>

    <!-- JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <!-- Custom Script -->
    <script src="{{ asset('js/admin.js') }}"></script>
    @yield('scriptSection')
</body>

</html>