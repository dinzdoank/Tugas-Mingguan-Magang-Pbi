<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - Store Sepatu</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
    <!-- Header dengan navigasi -->
    <header>
        <nav>
            <div class="nav-toggle">☰</div>
            <ul>
                <li><a href="/">Beranda</a></li>
                <li><a href="/produk">Produk</a></li>
                <li><a href="{{ route('user.orders') }}">Detail Order</a></li>
                @auth
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-logout">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="btn-login">Login</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    <div class="contact-container" style="max-width:800px; margin:40px auto; padding:0 20px;">
        <h1 style="color:#4e3b31; text-align:center; margin-bottom:32px;">Hubungi Kami</h1>
        
        @if(session('success'))
            <div style="background:#d4edda; color:#155724; border-radius:8px; padding:12px 20px; margin-bottom:24px; text-align:center; font-weight:bold;">
                {{ session('success') }}
            </div>
        @endif

        <div style="display:flex; gap:40px; flex-wrap:wrap;">
            <div style="flex:1; min-width:300px;">
                <h2 style="color:#4e3b31; margin-bottom:24px;">Kirim Pesan</h2>
                <form action="{{ route('contact.store') }}" method="post" style="background:#fff; border-radius:16px; box-shadow:0 2px 16px rgba(0,0,0,0.08); padding:32px; width:100%;">
                    @csrf
                    <div style="margin-bottom:20px;">
                        <label for="name" style="display:block; font-weight:500; margin-bottom:8px;">Nama:</label>
                        <input type="text" id="name" name="name" required style="width:100%; border-radius:6px; border:1px solid #c69c6d; padding:10px;">
                    </div>
                    <div style="margin-bottom:20px;">
                        <label for="email" style="display:block; font-weight:500; margin-bottom:8px;">Email:</label>
                        <input type="email" id="email" name="email" required style="width:100%; border-radius:6px; border:1px solid #c69c6d; padding:10px;">
                    </div>
                    <div style="margin-bottom:20px;">
                        <label for="subject" style="display:block; font-weight:500; margin-bottom:8px;">Subjek:</label>
                        <input type="text" id="subject" name="subject" required style="width:100%; border-radius:6px; border:1px solid #c69c6d; padding:10px;">
                    </div>
                    <div style="margin-bottom:24px;">
                        <label for="message" style="display:block; font-weight:500; margin-bottom:8px;">Pesan:</label>
                        <textarea id="message" name="message" required rows="6" style="width:100%; border-radius:6px; border:1px solid #c69c6d; padding:10px;"></textarea>
                    </div>
                    <button type="submit" style="background:#c69c6d; color:#fff; border:none; border-radius:6px; padding:12px 32px; font-weight:bold; width:100%; cursor:pointer; transition:background 0.3s ease;">Kirim Pesan</button>
                </form>
            </div>

            <div style="flex:1; min-width:300px;">
                <h2 style="color:#4e3b31; margin-bottom:24px;">Informasi Kontak</h2>
                <div style="background:#fff; border-radius:16px; box-shadow:0 2px 16px rgba(0,0,0,0.08); padding:32px;">
                    <div style="margin-bottom:24px;">
                        <h3 style="color:#4e3b31; margin-bottom:12px;">Alamat</h3>
                        <p>Jl. Contoh No. 123, Jakarta</p>
                    </div>
                    <div style="margin-bottom:24px;">
                        <h3 style="color:#4e3b31; margin-bottom:12px;">Email</h3>
                        <p>info@email.com</p>
                    </div>
                    <div style="margin-bottom:24px;">
                        <h3 style="color:#4e3b31; margin-bottom:12px;">Telepon</h3>
                        <p>+62 812-3456-789</p>
                    </div>
                    <div>
                        <h3 style="color:#4e3b31; margin-bottom:12px;">Jam Layanan</h3>
                        <p>09.00 - 22.00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background:#f5f5f5;
            font-family:Arial, sans-serif;
        }
        .contact-container {
            margin-top:80px;
        }
        input:focus, textarea:focus {
            outline:none;
            border-color:#4e3b31 !important;
        }
        button:hover {
            background:#4e3b31 !important;
        }
    </style>
</body>
</html> 