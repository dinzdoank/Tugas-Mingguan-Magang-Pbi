<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel</title>
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
            .table {
                background: #e8d4c1;
                border-radius: 8px;
                overflow: hidden;
            }
            .table th {
                background: #4e3b31;
                color: #fff;
            }
            .table td {
                background: #f0e4d7;
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
                <a class="navbar-brand" href="/admin/products">Admin Panel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/products">Produk</a>
                        </li>
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.orders.index') }}">Order</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.orders.stats') }}">Statistik</a></li>
                            @endif
                            <li class="nav-item">
                                <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="nav-link btn-logout" style="background:none; border:none; color:#fff; font-weight:bold; font:inherit; cursor:pointer; padding:0; margin:0;">Logout</button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.login') }}">Login</a></li>
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
