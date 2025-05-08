@extends('layouts.app')

@section('content')
<div class="container" style="max-width:500px; margin:40px auto; background:#fff; border-radius:16px; box-shadow:0 2px 16px rgba(0,0,0,0.08); padding:32px 24px;">
    <h2 style="color:#4e3b31; font-weight:bold; margin-bottom:24px;">Konfirmasi Pembayaran</h2>
    <div style="margin-bottom:18px;">
        <strong>Nama:</strong> {{ $order->name }}<br>
        <strong>Email:</strong> {{ $order->email }}<br>
        <strong>Alamat:</strong> {{ $order->address }}<br>
        <strong>Produk:</strong> {{ $order->product->name }}<br>
        <strong>Jumlah:</strong> {{ $order->quantity }}<br>
        <strong>Catatan:</strong> {{ $order->note ?? '-' }}<br>
        <strong>Status:</strong> <span style="color:{{ $order->status == 'paid' ? '#28a745' : '#c69c6d' }}; font-weight:bold;">{{ strtoupper($order->status) }}</span>
    </div>
    @if($order->status == 'pending')
    <form method="POST" action="{{ route('order.confirmPayment', $order) }}">
        @csrf
        <button type="submit" style="background:#c69c6d; color:#fff; border:none; border-radius:8px; padding:12px 32px; font-weight:bold;">Saya sudah bayar</button>
    </form>
    @else
    <div style="background:#d4edda; color:#155724; border-radius:8px; padding:12px 20px; margin-top:16px; text-align:center; font-weight:bold;">Pembayaran sudah dikonfirmasi. Terima kasih!</div>
    @endif
</div>
@endsection 