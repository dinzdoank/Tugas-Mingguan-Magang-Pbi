<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Sepatu</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>
<body>
    <header>
        <nav>
            <div class="nav-toggle">☰</div>
            <ul>
                <li><a href="#home">Beranda</a></li>
                <li><a href="#products">Produk</a></li>
                <li><a href="#testimonials">Testimoni</a></li>
                <li><a href="#contact">Kontak</a></li>
                <li><a href="{{ route('admin.products') }}">Admin</a></li>
            </ul>
        </nav>
    </header>

    <section id="hero">
        <div class="carousel">
            <div class="carousel-item active">
                <h1>Selamat Datang di Store Sepatu Kami!</h1>
                <p>Dapatkan sepatu berkualitas dengan harga terbaik.</p>
                <br>
                <a href="#products" class="btn">Lihat Produk</a>
            </div>
            <div class="carousel-item">
                <h1>Diskon Spesial!</h1>
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

    <section id="products">
        <h2>Produk Unggulan</h2>
        <div class="product-list">
            @foreach($products as $product)
            <article class="product-item">
                <h3>{{ $product->name }}</h3>
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width:100%; height:auto;">
                <p>{{ $product->description }}</p>
                <span>Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                <a href="#contact" class="btn">Beli Sekarang</a>
            </article>
            @endforeach
        </div>
    </section>

    <section id="testimonials">
        <h2>Apa Kata Pelanggan Kami?</h2>
        <div class="video-list">
            <div class="video-item">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Testimoni Pelanggan 1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </section>

    <section id="contact">
        <h2>Hubungi Kami</h2>
        <div id="contact-message" class="alert" style="display: none;"></div>
        <form id="contact-form">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="message">Pesan:</label>
            <textarea id="message" name="message" required></textarea>
            
            <button type="submit">Kirim</button>
        </form>
    </section>

    <button id="backToTop" style="display: none;">↑</button>

    <footer>
        <p>&copy; 2023 Store Sepatu. Semua hak dilindungi.</p>
        <p>Alamat: Jl. Contoh No. 123, Jakarta</p>
        <p>Email: info@storesepatu.com</p>
    </footer>

    <!-- Modal -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modalTitle"></h2>
            <img id="modalImage" src="" alt="Product Image">
            <p id="modalDescription"></p>
            <p id="modalPrice"></p>
        </div>
    </div>

    <!-- Lightbox -->
    <div id="lightbox" class="lightbox">
        <span class="close">&times;</span>
        <img id="lightboxImage" src="" alt="Lightbox Image">
    </div>
</body>
</html>