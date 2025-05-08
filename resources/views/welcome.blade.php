<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Sepatu</title>
    <link rel="stylesheet" href="/styles.css"> <!-- Link ke file CSS -->
    <script src="/script.js" defer></script> <!-- Link ke file JavaScript -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Header dengan navigasi -->
    <header>
        <nav>
            <div class="nav-toggle">☰</div> <!-- Tombol toggle menu -->
            <ul>
                <li><a href="#home">Beranda</a></li>
                <li><a href="/produk">Produk</a></li>
                <li><a href="{{ route('user.orders') }}">Detail Order</a></li>
                @auth
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-logout nav-link" style="background:none; border:none; color:inherit; font:inherit; cursor:pointer; padding:0; margin:0;">Logout</button>
                        </form>
                    </li>
                    <li class="nav-notification">
                        <a href="#" id="notifBell" style="position:relative; font-size:1.3rem; color:#fff;">
                            <i class="fas fa-bell"></i>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="notif-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                            @endif
                        </a>
                        <div class="notif-dropdown" id="notifDropdown" style="display:none;">
                            @if(auth()->user()->notifications->count() == 0)
                                <div class="notif-empty">Tidak ada notifikasi.</div>
                            @else
                                @foreach(auth()->user()->notifications->take(5) as $notification)
                                    <div class="notif-item {{ $notification->read_at ? '' : 'notif-unread' }}" data-id="{{ $notification->id }}">
                                        {{ $notification->data['message'] }}
                                        <a href="{{ url('/orders') }}" style="color:#c69c6d; font-weight:bold; margin-left:6px;">Lihat Order</a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="btn-login">Login</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    <!-- Hero section dengan deskripsi utama -->
    <section id="hero">
        <div class="carousel">
            <div class="carousel-item active">
                <h1>Selamat Datang di Store Sepatu Kami!</h1>
                <p>Dapatkan sepatu berkualitas dengan harga terbaik.</p>
                <br>
                <a href="#products" class="btn">Lihat Produk</a>
            </div>
            <div class="carousel-item">
                <h1>Diskon Spesial MURAHH!</h1>
                <p>Hanya hari ini, dapatkan diskon 20% untuk semua produk.</p>
                <br>
                <a href="#products" class="btn">Belanja Sekarang</a>
            </div>
            <div class="carousel-item">
                <h1>Big Deal!!!</h1>
                <p>Buy 1 Get 1.</p>
                <br>
                <a href="#products" class="btn">Belanja Sekarang</a>
            </div>
        </div>
        <div class="carousel-controls">
            <span class="prev">&#10094;</span>
            <span class="next">&#10095;</span>
        </div>
    </section>
    <!-- Lightbox structure -->
    <div id="lightbox" class="lightbox">
        <span class="close">&times;</span>
        <img class="lightbox-content" id="lightboxImage" src="" alt="Lightbox Image">
    </div>

    <!-- Modal Order Produk -->
    <div id="orderModal" class="modal" style="display:none; z-index:2000;">
        <div class="modal-content order-modal-content">
            <span class="close" id="closeOrderModal">&times;</span>
            <h3 id="orderProductTitle">Order Produk</h3>
            <form id="orderForm" method="POST" action="{{ route('order.store') }}" class="order-form">
                @csrf
                <input type="hidden" name="product_id" id="orderProductId">
                <div class="order-form-group">
                    <label for="orderName">Nama:</label>
                    <input type="text" name="name" id="orderName" required>
                </div>
                <div class="order-form-group">
                    <label for="orderEmail">Email:</label>
                    <input type="email" name="email" id="orderEmail" required>
                </div>
                <div class="order-form-group">
                    <label for="orderAddress">Alamat:</label>
                    <input type="text" name="address" id="orderAddress" required>
                </div>
                <div class="order-form-group">
                    <label for="orderQuantity">Jumlah:</label>
                    <input type="number" name="quantity" id="orderQuantity" min="1" value="1" required>
                </div>
                <div class="order-form-group">
                    <label for="orderNote">Catatan (opsional):</label>
                    <textarea name="note" id="orderNote" rows="2"></textarea>
                </div>
                <button type="submit" class="order-submit-btn">Kirim Pesanan</button>
            </form>
        </div>
    </div>
    <style>
        .order-modal-content {
            max-width: 420px;
            margin: 5% auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.12);
            padding: 32px 24px;
            position: relative;
        }
        .order-modal-content h3 {
            color: #4e3b31;
            margin-bottom: 18px;
            font-size: 1.2rem;
            font-weight: bold;
        }
        .order-form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .order-form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .order-form-group label {
            font-weight: 500;
            margin-bottom: 2px;
            color: #4e3b31;
        }
        .order-form-group input,
        .order-form-group textarea {
            width: 100%;
            border-radius: 6px;
            border: 1px solid #c69c6d;
            padding: 10px;
            font-size: 1rem;
            background: #faf8f6;
            transition: border 0.2s;
        }
        .order-form-group input:focus,
        .order-form-group textarea:focus {
            outline: none;
            border-color: #4e3b31;
        }
        .order-submit-btn {
            background: #c69c6d;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 12px 0;
            font-weight: bold;
            font-size: 1rem;
            margin-top: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .order-submit-btn:hover {
            background: #a4784f;
        }
        .modal-content .close {
            position: absolute;
            top: 16px;
            right: 24px;
            font-size: 28px;
            cursor: pointer;
        }
        .nav-notification {
            position: relative;
        }
        .notif-badge {
            position: absolute;
            top: -6px;
            right: -8px;
            background: #c69c6d;
            color: #fff;
            border-radius: 50%;
            font-size: 0.75rem;
            padding: 2px 6px;
            font-weight: bold;
            z-index: 2;
        }
        .notif-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 32px;
            background: #fff;
            color: #333;
            min-width: 260px;
            max-width: 340px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.12);
            border-radius: 10px;
            padding: 12px 0;
            z-index: 1000;
        }
        .notif-item {
            padding: 10px 18px;
            border-bottom: 1px solid #eee;
            font-size: 0.97rem;
        }
        .notif-item:last-child {
            border-bottom: none;
        }
        .notif-unread {
            background: #f8f6f2;
            font-weight: bold;
        }
        .notif-empty {
            padding: 16px 18px;
            color: #888;
            text-align: center;
        }
    </style>
    @if(session('success'))
        <div style="background:#d4edda; color:#155724; border-radius:8px; padding:12px 20px; margin:24px auto; max-width:400px; text-align:center; font-weight:bold; position:fixed; top:32px; left:0; right:0; z-index:9999; box-shadow:0 2px 16px rgba(0,0,0,0.12);">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function() {
                var alert = document.querySelector('div[style*="background:#d4edda"]');
                if(alert) alert.style.display = 'none';
            }, 3500);
        </script>
    @endif
    @if(session('error'))
        <div style="background:#f8d7da; color:#721c24; border-radius:8px; padding:12px 20px; margin:24px auto; max-width:400px; text-align:center; font-weight:bold;">{{ session('error') }}</div>
    @endif

    <!-- Section layanan/produk/konten utama -->
    <section id="products">
        <h2>Produk Unggulan</h2>
        <div class="product-list">
            @foreach($featuredProducts as $product)
                <article class="product-item animate-on-scroll" data-product-id="{{ $product->id }}" data-product-title="{{ $product->name }}">
                    <h3>{{ $product->name }}</h3>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width:100%; height:auto;">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" alt="No Image" style="width:100%; height:auto;">
                    @endif
                    <p>{{ $product->description }}</p>
                    <span>Harga: Rp {{ number_format($product->price, 0, ',', '.') }} Stok: {{ $product->stock }}</span>
                    @if($product->stock > 0)
                        <button class="btn order-btn" type="button" data-product-id="{{ $product->id }}" data-product-title="{{ $product->name }}">Beli Sekarang</button>
                    @else
                        <div style="margin-top:12px; color:#a3342f; font-weight:bold;">Stok Habis</div>
                        <button class="btn" type="button" disabled style="background:#ccc; color:#fff; margin-top:8px; cursor:not-allowed;">Beli Sekarang</button>
                    @endif
                </article>
            @endforeach
        </div>
    </section>
    

   <!-- Section etalase foto campaign -->
<section id="campaign-gallery">
    <h2 style="text-align:center; margin-bottom:32px;">Etalase Foto Campaign Kami</h2>
    <div class="campaign-photo-grid">
        <div class="campaign-photo-item">
            <img src="/Asset/1.png" alt="Outdoor Spirit" class="campaign-photo-img">
            <h4 class="campaign-photo-title">Campaign: Outdoor Spirit</h4>
            <p class="campaign-photo-desc">Rasakan semangat petualangan bersama produk kami di alam bebas!</p>
        </div>
        <div class="campaign-photo-item">
            <img src="/Asset/2.png" alt="Urban Adventure" class="campaign-photo-img">
            <h4 class="campaign-photo-title">Campaign: Urban Adventure</h4>
            <p class="campaign-photo-desc">Jelajahi kota dengan gaya dan kenyamanan maksimal.</p>
        </div>
        <div class="campaign-photo-item">
            <img src="/Asset/3.jpg" alt="Family Hiking" class="campaign-photo-img">
            <h4 class="campaign-photo-title">Campaign: Family Hiking</h4>
            <p class="campaign-photo-desc">Kebersamaan keluarga di alam, penuh inspirasi dan keceriaan.</p>
        </div>
    </div>
    <style>
        .campaign-photo-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 32px;
            justify-content: center;
            padding: 16px 0 32px 0;
        }
        .campaign-photo-item {
            min-width: 280px;
            max-width: 340px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.08);
            padding: 16px;
            flex: 0 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .campaign-photo-item:hover {
            transform: scale(1.04) translateY(-4px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            z-index: 2;
        }
        .campaign-photo-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 12px;
        }
        .campaign-photo-title {
            margin: 12px 0 6px 0;
            color: #4e3b31;
            font-size: 1.1rem;
            text-align: center;
        }
        .campaign-photo-desc {
            color: #333;
            font-size: 0.97rem;
            text-align: center;
        }
        @media (max-width: 900px) {
            .campaign-photo-grid { gap: 18px; }
            .campaign-photo-item { max-width: 98vw; }
        }
        @media (max-width: 600px) {
            .campaign-photo-grid { flex-direction: column; align-items: center; }
            .campaign-photo-item { width: 98vw !important; max-width: 340px; }
        }
    </style>
</section>
  

    <button id="backToTop" style="display: none;">↑</button>
    <!-- Blog/Tips Section -->
    <section class="blog-tips-section" style="background:#fff; padding:40px 0 0 0;">
        <div class="container">
            <h2 style="font-size:2rem; font-weight:bold; color:#4e3b31; text-align:center; margin-bottom:32px;">Blog & Tips</h2>
            <div class="blog-tips-flex" style="display:flex; flex-wrap:wrap; justify-content:center; gap:40px;">
                <div class="blog-card-custom" style="background:#e8d4c1; border-radius:20px; box-shadow:0 2px 16px rgba(0,0,0,0.08); padding:32px 28px 28px 28px; width:340px; min-height:420px; display:flex; flex-direction:column; justify-content:flex-start; align-items:flex-start;">
                    <img src="/Asset/blog1.png" alt="Tips 1" style="width:100%; height:120px; object-fit:cover; border-radius:12px; margin-bottom:18px;">
                    <h3 style="color:#4e3b31; font-size:1.3rem; font-weight:bold; margin-bottom:12px; text-align:left;">Tips Memilih Sepatu Outdoor</h3>
                    <p style="color:#333; margin-bottom:24px; text-align:left;">Pilih sepatu yang sesuai dengan kebutuhan aktivitas outdoor Anda agar tetap nyaman dan aman.</p>
                    <a href="#" style="background:#c69c6d; color:#fff; font-weight:bold; border:none; border-radius:8px; padding:10px 24px; text-decoration:none; font-size:1rem; margin-top:auto;">Baca Selengkapnya</a>
                </div>
                <div class="blog-card-custom" style="background:#e8d4c1; border-radius:20px; box-shadow:0 2px 16px rgba(0,0,0,0.08); padding:32px 28px 28px 28px; width:340px; min-height:420px; display:flex; flex-direction:column; justify-content:flex-start; align-items:flex-start;">
                    <img src="/Asset/blog2.jpg" alt="Tips 2" style="width:100%; height:120px; object-fit:cover; border-radius:12px; margin-bottom:18px;">
                    <h3 style="color:#4e3b31; font-size:1.3rem; font-weight:bold; margin-bottom:12px; text-align:left;">Cara Merawat Perlengkapan Hiking</h3>
                    <p style="color:#333; margin-bottom:24px; text-align:left;">Rawat perlengkapan hiking Anda dengan benar agar awet dan siap digunakan kapan saja.</p>
                    <a href="#" style="background:#c69c6d; color:#fff; font-weight:bold; border:none; border-radius:8px; padding:10px 24px; text-decoration:none; font-size:1rem; margin-top:auto;">Baca Selengkapnya</a>
                </div>
                <div class="blog-card-custom" style="background:#e8d4c1; border-radius:20px; box-shadow:0 2px 16px rgba(0,0,0,0.08); padding:32px 28px 28px 28px; width:340px; min-height:420px; display:flex; flex-direction:column; justify-content:flex-start; align-items:flex-start;">
                    <img src="/Asset/blog3.png" alt="Tips 3" style="width:100%; height:120px; object-fit:cover; border-radius:12px; margin-bottom:18px;">
                    <h3 style="color:#4e3b31; font-size:1.3rem; font-weight:bold; margin-bottom:12px; text-align:left;">Inspirasi Destinasi Alam Indonesia</h3>
                    <p style="color:#333; margin-bottom:24px; text-align:left;">Jelajahi keindahan alam Indonesia dengan rekomendasi destinasi terbaik untuk petualangan Anda.</p>
                    <a href="#" style="background:#c69c6d; color:#fff; font-weight:bold; border:none; border-radius:8px; padding:10px 24px; text-decoration:none; font-size:1rem; margin-top:auto;">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
        <style>
            @media (max-width: 1100px) {
                .blog-tips-flex { gap:24px !important; }
                .blog-card-custom { width:90vw !important; max-width:340px; }
            }
            @media (max-width: 700px) {
                .blog-tips-flex { flex-direction:column; align-items:center; }
                .blog-card-custom { width:98vw !important; max-width:340px; }
            }
        </style>
    </section>
    <!-- Footer -->
    <footer style="background:#222; color:#fff; padding:40px 0 0 0; margin-top:40px; border-top:4px solid #c69c6d;">
        <div class="container">
            <div class="footer-flex">
                <div class="footer-info">
                    <img src="/Asset/logo.png" alt="Logo" class="footer-logo">
                    <p class="footer-desc"></p>
                    <div class="footer-contact-info">
                        <strong>Alamat:</strong><br>
                        Jl. Contoh No. 123, Jakarta<br>
                        <strong>Email:</strong> info@email.com<br>
                        <strong>Telepon:</strong> +62 812-3456-789<br>
                        <strong>Jam Layanan:</strong> 09.00 - 22.00
                    </div>
                    <div class="footer-social">
                        <a href="#" class="footer-social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="footer-social-link"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="footer-social-link"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                Copyright &copy; {{ date('Y') }} - Nama Brand Anda. All rights reserved.
            </div>
        </div>
        <style>
            .footer-flex {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: flex-start;
                gap: 40px;
            }
            .footer-info {
                flex: 1 1 340px;
                min-width: 300px;
                max-width: 480px;
                text-align: left;
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                height: 100%;
                padding-left: 24px;
            }
            .footer-logo {
                width: 60px;
                margin-bottom: 16px;
            }
            .footer-desc {
                margin-bottom: 16px;
            }
            .footer-contact-info {
                margin-bottom: 16px;
                font-size: 1rem;
            }
            .footer-social {
                margin-top: 12px;
            }
            .footer-social-link {
                color: #fff;
                margin-right: 12px;
                font-size: 1.3rem;
                transition: color 0.3s;
            }
            .footer-social-link:hover {
                color: #c69c6d;
            }
            .footer-copyright {
                border-top: 1px solid #444;
                margin-top: 24px;
                padding: 16px 0 0 0;
                text-align: center;
                color: #bbb;
                font-size: 0.95rem;
            }
            @media (max-width: 900px) {
                .footer-flex { flex-direction: column; align-items: stretch; }
                .footer-info { max-width:100% !important; padding-left:0 !important; }
            }
        </style>
    </footer>
    <!-- Font Awesome untuk icon sosial media -->
    <script src="https://kit.fontawesome.com/yourfontawesomekit.js" crossorigin="anonymous"></script>
    <style>
        .blog-card.animate-on-scroll {
            opacity: 0;
            transform: translateY(40px);
        }
        .blog-card.visible {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.7s cubic-bezier(.4,0,.2,1), transform 0.7s cubic-bezier(.4,0,.2,1);
        }
        .blog-card:hover {
            transform: scale(1.04) translateY(-4px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            z-index: 2;
        }
        .btn-logout.nav-link {
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            margin: 0;
        }
        .btn-logout.nav-link:hover {
            color: #c69c6d;
        }
        .btn-login {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        .btn-login:hover {
            color: #c69c6d;
        }
        nav ul {
            display: flex;
            align-items: center;
            gap: 18px;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        nav ul li {
            display: flex;
            align-items: center;
        }
    </style>
    <script>
    // Fade-in animasi blog/tips
    function animateOnScroll() {
        const cards = document.querySelectorAll('.blog-card.animate-on-scroll');
        cards.forEach(card => {
            const rect = card.getBoundingClientRect();
            if (rect.top < window.innerHeight - 60) {
                card.classList.add('visible');
            }
        });
    }
    window.addEventListener('scroll', animateOnScroll);
    window.addEventListener('DOMContentLoaded', animateOnScroll);

    // Smooth scroll untuk navigasi
    document.querySelectorAll('nav ul li a').forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href && href.startsWith('#')) {
                e.preventDefault();
                document.querySelector(href).scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var bell = document.getElementById('notifBell');
            var dropdown = document.getElementById('notifDropdown');
            if(bell && dropdown) {
                bell.addEventListener('click', function(e) {
                    e.preventDefault();
                    var isOpen = dropdown.style.display === 'block';
                    dropdown.style.display = isOpen ? 'none' : 'block';
                });
                document.addEventListener('click', function(e) {
                    if (!bell.contains(e.target) && !dropdown.contains(e.target)) {
                        dropdown.style.display = 'none';
                    }
                });
                // Pemicu: klik notif-item, mark as read via AJAX
                dropdown.addEventListener('click', function(e) {
                    var notifItem = e.target.closest('.notif-item');
                    if(notifItem) {
                        var notifId = notifItem.getAttribute('data-id');
                        fetch('/notifications/mark-as-read-one', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ id: notifId })
                        }).then(response => {
                            if(response.ok) {
                                notifItem.remove();
                                // update badge
                                var badge = document.querySelector('.notif-badge');
                                if(badge) {
                                    let count = parseInt(badge.textContent) - 1;
                                    if(count > 0) badge.textContent = count;
                                    else badge.remove();
                                }
                                // jika sudah tidak ada notif-item, tampilkan notif-empty
                                if(dropdown.querySelectorAll('.notif-item').length === 0) {
                                    var notifEmpty = document.createElement('div');
                                    notifEmpty.className = 'notif-empty';
                                    notifEmpty.innerText = 'Tidak ada notifikasi.';
                                    dropdown.appendChild(notifEmpty);
                                }
                            }
                        });
                    }
                });
            }
        });
    </script>
</body>
</html>
