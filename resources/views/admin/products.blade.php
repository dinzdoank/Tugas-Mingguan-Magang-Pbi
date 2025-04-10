<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Produk</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header>
        <nav>
            <div class="nav-toggle">☰</div>
            <ul>
                <li><a href="{{ route('home') }}">Kembali ke Beranda</a></li>
            </ul>
        </nav>
    </header>

    <div class="admin-container">
        <h1>Kelola Produk</h1>

        <!-- Form Tambah Produk -->
        <div class="product-form">
            <h2>Tambah Produk Baru</h2>
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Produk:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi:</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Harga:</label>
                    <input type="number" id="price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="image">Gambar:</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>
                <button type="submit" class="btn">Tambah Produk</button>
            </form>
        </div>

        <!-- Daftar Produk -->
        <div class="product-list">
            <h2>Daftar Produk</h2>
            @if($products->isEmpty())
                <p class="no-products">Belum ada produk yang ditambahkan.</p>
            @else
                @foreach($products as $product)
                <div class="product-item">
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ Str::limit($product->description, 100) }}</p>
                    <span>Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    
                    <div class="product-actions">
                        <button class="edit-btn" onclick="editProduct({{ $product->id }})">Edit</button>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Modal Edit Produk -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2>Edit Produk</h2>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="edit_name">Nama Produk:</label>
                    <input type="text" id="edit_name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="edit_description">Deskripsi:</label>
                    <textarea id="edit_description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="edit_price">Harga:</label>
                    <input type="number" id="edit_price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="edit_image">Gambar (opsional):</label>
                    <input type="file" id="edit_image" name="image" accept="image/*">
                </div>
                <button type="submit" class="btn">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <script>
        function editProduct(id) {
            fetch(`/admin/products/${id}`)
                .then(response => response.json())
                .then(product => {
                    document.getElementById('edit_name').value = product.name;
                    document.getElementById('edit_description').value = product.description;
                    document.getElementById('edit_price').value = product.price;
                    document.getElementById('editForm').action = `/admin/products/${id}`;
                    document.getElementById('editModal').style.display = 'block';
                });
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</body>
</html> 