<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Pesan Kontak</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header>
        <nav>
            <div class="nav-toggle">☰</div>
            <ul>
                <li><a href="{{ route('admin.products') }}">Kelola Produk</a></li>
                <li><a href="{{ route('admin.contacts') }}">Daftar Pesan</a></li>
                <li><a href="{{ route('home') }}">Kembali ke Beranda</a></li>
            </ul>
        </nav>
    </header>

    <div class="admin-container">
        <h1>Daftar Pesan Kontak</h1>

        @if($contacts->isEmpty())
            <p class="no-messages">Belum ada pesan yang masuk.</p>
        @else
            <div class="contact-list">
                @foreach($contacts as $contact)
                    <div class="contact-item">
                        <div class="contact-header">
                            <h3>{{ $contact->name }}</h3>
                            <span class="contact-date">{{ $contact->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div class="contact-email">{{ $contact->email }}</div>
                        <div class="contact-message">{{ $contact->message }}</div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html> 