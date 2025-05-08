@component('mail::message')
# Struk Pembayaran

Terima kasih, pembayaran Anda telah dikonfirmasi.

**Detail Order:**
- Nama: {{ $order->name }}
- Email: {{ $order->email }}
- Alamat: {{ $order->address }}
- Produk: {{ $order->product ? $order->product->name : '-' }}
- Jumlah: {{ $order->quantity }}
- Catatan: {{ $order->note ?? '-' }}
- Status: {{ strtoupper($order->status) }}

@component('mail::panel')
Total: Rp {{ number_format($order->product ? $order->product->price * $order->quantity : 0, 0, ',', '.') }}
@endcomponent

Jika ada pertanyaan, silakan hubungi kami.

Terima kasih,
{{ config('app.name') }}
@endcomponent
