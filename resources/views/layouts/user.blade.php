<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Sepatu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f4f4f4;
            color: #333;
        }
        .navbar {
            background: #4e3b31 !important;
            border-radius: 0 0 10px 10px;
        }
        .navbar .navbar-brand, .navbar .nav-link, .navbar .btn-link {
            color: #fff !important;
            font-weight: bold;
        }
        .navbar .nav-link:hover, .navbar .btn-link:hover {
            color: #c69c6d !important;
        }
        .card, .main-content, main.container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.08);
            padding: 24px;
            margin-top: 24px;
        }
        .btn-primary, .btn-success, .btn-danger {
            background: #c69c6d !important;
            border: none;
            color: #fff;
            font-weight: bold;
            border-radius: 6px;
            transition: background 0.3s;
        }
        .btn-primary:hover, .btn-success:hover, .btn-danger:hover {
            background: #a4784f !important;
        }
        .btn-logout {
            transition: color 0.3s ease;
            font-weight: bold !important;
        }
        .btn-logout:hover {
            color: #c69c6d !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Store Sepatu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="/produk">Produk</a></li>
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('user.orders') }}">Detail Order</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('user.products') }}">Semua Produk</a></li>
                    @endauth
                    @auth
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="nav-link btn-logout" style="background:none; border:none; color:#fff; font-weight:bold; font:inherit; cursor:pointer; padding:0; margin:0; text-decoration:none;">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <main class="container my-4">
        @yield('content')
    </main>
</body>
</html> 