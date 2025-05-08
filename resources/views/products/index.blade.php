@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100" style="background:#f8f5f2; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.06);">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height:200px; object-fit:cover; border-radius:12px 12px 0 0;">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" class="card-img-top" alt="No Image" style="height:200px; object-fit:cover; border-radius:12px 12px 0 0;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title" style="color:#4e3b31; font-weight:bold;">{{ $product->name }}</h5>
                        <p class="card-text" style="min-height:48px;">{{ Str::limit($product->description, 60) }}</p>
                        <div style="font-weight:bold; color:#c69c6d;">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <div>Stok: {{ $product->stock }}</div>
                        @if($product->stock > 0)
                            @auth
                                <a href="{{ route('order.create', $product) }}" class="btn btn-success mt-3 w-100" style="background:#c69c6d; border:none; font-weight:bold;">Beli</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary mt-3 w-100" style="font-weight:bold;">Login untuk Beli</a>
                            @endauth
                        @else
                            <button class="btn btn-secondary mt-3 w-100" style="font-weight:bold;" disabled>Stok Habis</button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">Belum ada produk.</div>
        @endforelse
    </div>
</div>
@endsection 