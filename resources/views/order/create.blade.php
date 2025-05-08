@extends('layouts.user')

@section('content')
<div class="container" style="max-width:500px; margin:40px auto; background:#fff; border-radius:16px; box-shadow:0 2px 16px rgba(0,0,0,0.08); padding:32px 24px;">
    <h2 style="color:#4e3b31; font-weight:bold; margin-bottom:24px;">Order Produk</h2>
    <div style="margin-bottom:18px;">
        <strong>Produk:</strong> {{ $product->name }}<br>
        <strong>Harga:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}<br>
        <strong>Stok:</strong> {{ $product->stock }}<br>
        <strong>Deskripsi:</strong> {{ $product->description }}
    </div>
    <form method="POST" action="{{ route('order.store') }}">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="name" value="{{ auth()->user()->name }}">
        <input type="hidden" name="email" value="{{ auth()->user()->email }}">
        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="quantity" name="quantity" min="1" max="{{ $product->stock }}" value="1" required>
        </div>
        <div class="mb-3">
            <label for="note" class="form-label">Catatan (opsional)</label>
            <textarea class="form-control" id="note" name="note" rows="2"></textarea>
        </div>
        <button type="submit" class="btn btn-success w-100" style="background:#c69c6d; border:none; font-weight:bold;">Buat Order</button>
    </form>
</div>
@endsection 