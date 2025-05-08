@extends('layouts.user')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Riwayat Order Saya</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>{{ $order->product ? $order->product->name : '-' }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>
                        @if($order->status == 'pending')
                            <span class="badge bg-secondary">Pending</span>
                        @elseif($order->status == 'waiting_admin')
                            <span class="badge bg-warning text-dark">Menunggu Admin</span>
                        @elseif($order->status == 'paid')
                            <span class="badge bg-success">Paid</span>
                        @elseif($order->status == 'rejected')
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>{!! $order->note ? nl2br(e($order->note)) : '-' !!}</td>
                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada order.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 