<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Sepatu</title>
    <link rel="stylesheet" href="/styles.css"> <!-- Link ke file CSS -->
    <script src="/script.js" defer></script> <!-- Link ke file JavaScript -->
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
        <div class="modal-content" style="max-width:420px; margin:5% auto; background:#fff; border-radius:16px; box-shadow:0 2px 16px rgba(0,0,0,0.12); padding:32px 24px; position:relative;">
            <span class="close" id="closeOrderModal" style="position:absolute; top:16px; right:24px; font-size:28px; cursor:pointer;">&times;</span>
            <h3 id="orderProductTitle" style="color:#4e3b31; margin-bottom:18px;">Order Produk</h3>
            <form id="orderForm" method="POST" action="{{ route('order.store') }}" style="display:flex; flex-direction:column; gap:12px;">
                @csrf
                <input type="hidden" name="product_id" id="orderProductId">
                <div>
                    <label for="orderName" style="font-weight:500;">Nama:</label>
                    <input type="text" name="name" id="orderName" required style="width:100%; border-radius:6px; border:1px solid #c69c6d; padding:8px;">
                </div>
                <div>
                    <label for="orderEmail" style="font-weight:500;">Email:</label>
                    <input type="email" name="email" id="orderEmail" required style="width:100%; border-radius:6px; border:1px solid #c69c6d; padding:8px;">
                </div>
                <div>
                    <label for="orderAddress" style="font-weight:500;">Alamat:</label>
                    <input type="text" name="address" id="orderAddress" required style="width:100%; border-radius:6px; border:1px solid #c69c6d; padding:8px;">
                </div>
                <div>
                    <label for="orderQuantity" style="font-weight:500;">Jumlah:</label>
                    <input type="number" name="quantity" id="orderQuantity" min="1" value="1" required style="width:100%; border-radius:6px; border:1px solid #c69c6d; padding:8px;">
                </div>
                <div>
                    <label for="orderNote" style="font-weight:500;">Catatan (opsional):</label>
                    <textarea name="note" id="orderNote" rows="2" style="width:100%; border-radius:6px; border:1px solid #c69c6d; padding:8px;"></textarea>
                </div>
                <button type="submit" style="background:#c69c6d; color:#fff; border:none; border-radius:6px; padding:10px 24px; font-weight:bold; margin-top:8px;">Kirim Pesanan</button>
            </form>
        </div>
    </div>
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
    

   <!-- Section etalase video campaign -->
<section id="testimonials">
    <h2 style="text-align:center; margin-bottom:32px;">Etalase Video Campaign Kami</h2>
    <div class="campaign-video-scroll" style="display: flex; overflow-x: auto; gap: 32px; padding: 16px 0 32px 0; scrollbar-width: thin;">
        <div class="campaign-video-item" style="min-width:320px; max-width:340px; background:#fff; border-radius:12px; box-shadow:0 2px 16px rgba(0,0,0,0.08); padding:16px; flex:0 0 auto;">
            <video controls poster="/Asset/campaign1.jpg" style="width:100%; border-radius:8px;">
                <source src="/Asset/campaign1.mp4" type="video/mp4">
                Browser Anda tidak mendukung video.
            </video>
            <h4 style="margin:12px 0 6px 0; color:#4e3b31;">Campaign: Outdoor Spirit</h4>
            <p style="color:#333; font-size:0.97rem;">Rasakan semangat petualangan bersama produk kami di alam bebas!</p>
        </div>
        <div class="campaign-video-item" style="min-width:320px; max-width:340px; background:#fff; border-radius:12px; box-shadow:0 2px 16px rgba(0,0,0,0.08); padding:16px; flex:0 0 auto;">
            <video controls poster="/Asset/campaign2.jpg" style="width:100%; border-radius:8px;">
                <source src="/Asset/campaign2.mp4" type="video/mp4">
                Browser Anda tidak mendukung video.
            </video>
            <h4 style="margin:12px 0 6px 0; color:#4e3b31;">Campaign: Urban Adventure</h4>
            <p style="color:#333; font-size:0.97rem;">Jelajahi kota dengan gaya dan kenyamanan maksimal.</p>
        </div>
        <div class="campaign-video-item" style="min-width:320px; max-width:340px; background:#fff; border-radius:12px; box-shadow:0 2px 16px rgba(0,0,0,0.08); padding:16px; flex:0 0 auto;">
            <video controls poster="/Asset/campaign3.jpg" style="width:100%; border-radius:8px;">
                <source src="/Asset/campaign3.mp4" type="video/mp4">
                Browser Anda tidak mendukung video.
            </video>
            <h4 style="margin:12px 0 6px 0; color:#4e3b31;">Campaign: Family Hiking</h4>
            <p style="color:#333; font-size:0.97rem;">Kebersamaan keluarga di alam, penuh inspirasi dan keceriaan.</p>
        </div>
    </div>
    <style>
        .campaign-video-scroll::-webkit-scrollbar {
            height: 8px;
        }
        .campaign-video-scroll::-webkit-scrollbar-thumb {
            background: #c69c6d;
            border-radius: 4px;
        }
        .campaign-video-item {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .campaign-video-item:hover {
            transform: scale(1.04) translateY(-4px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            z-index: 2;
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
            <div class="footer-flex" style="display:flex; flex-wrap:wrap; justify-content:center; align-items:flex-start; gap:40px;">
                <div class="footer-info" style="flex:1 1 340px; min-width:300px; max-width:480px; text-align:left; display:flex; flex-direction:column; justify-content:flex-start; height:100%; padding-left:24px;">
                    <img src="/Asset/logo.png" alt="Logo" style="width:60px; margin-bottom:16px;">
                    <p style="margin-bottom:16px;">Dapatkan promo terbaru dan info lainnya hanya dengan mendaftarkan emailmu!</p>
                    <div style="margin-bottom:16px;">
                        <strong>Alamat:</strong><br>
                        Jl. Contoh No. 123, Jakarta<br>
                        <strong>Email:</strong> info@email.com<br>
                        <strong>Telepon:</strong> +62 812-3456-789<br>
                        <strong>Jam Layanan:</strong> 09.00 - 22.00
                    </div>
                    <div style="margin-top:12px;">
                        <a href="#" style="color:#fff; margin-right:8px;"><i class="fab fa-instagram"></i></a>
                        <a href="#" style="color:#fff; margin-right:8px;"><i class="fab fa-facebook"></i></a>
                        <a href="#" style="color:#fff;"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="footer-contact" style="flex:1 1 340px; min-width:300px; max-width:480px; display:flex; flex-direction:column; justify-content:flex-start; align-items:flex-start; padding-right:24px;">
                    <h4 style="color:#fff; margin-bottom:16px; text-align:left; font-weight:bold;">Hubungi Kami</h4>
                    <form action="{{ route('contact.store') }}" method="post" style="background:#333; border-radius:16px; box-shadow:0 2px 16px rgba(0,0,0,0.08); padding:24px 20px; width:100%; min-width:240px; max-width:400px;">
                        @csrf
                        <label for="footer-name" style="font-weight:500;">Nama:</label>
                        <input type="text" id="footer-name" name="name" required style="width:100%; margin-bottom:14px; border-radius:6px; border:1px solid #c69c6d; padding:8px;">
                        <label for="footer-email" style="font-weight:500;">Email:</label>
                        <input type="email" id="footer-email" name="email" required style="width:100%; margin-bottom:14px; border-radius:6px; border:1px solid #c69c6d; padding:8px;">
                        <label for="footer-message" style="font-weight:500;">Pesan:</label>
                        <textarea id="footer-message" name="message" required style="width:100%; margin-bottom:14px; border-radius:6px; border:1px solid #c69c6d; padding:8px;"></textarea>
                        <button type="submit" style="background:#c69c6d; color:#fff; border:none; border-radius:6px; padding:10px 24px; font-weight:bold; width:100%;">Kirim</button>
                    </form>
                </div>
            </div>
            <div style="border-top:1px solid #444; margin-top:24px; padding:16px 0 0 0; text-align:center; color:#bbb; font-size:0.95rem;">
                Copyright &copy; {{ date('Y') }} - Nama Brand Anda. All rights reserved.
            </div>
        </div>
        <style>
            @media (max-width: 900px) {
                .footer-flex { flex-direction: column; align-items: stretch; }
                .footer-info, .footer-contact { max-width:100% !important; padding-left:0 !important; padding-right:0 !important; }
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
        .btn-logout {
            background: none;
            border: none;
            color: #fff;
            font-weight: bold;
            font: inherit;
            cursor: pointer;
            padding: 0;
            margin: 0;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .btn-logout:hover {
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
</body>
</html>
