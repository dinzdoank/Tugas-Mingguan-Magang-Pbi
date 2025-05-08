@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Daftar Order</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->email }}</td>
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
                    <td>{{ $order->note ?? '-' }}</td>
                    <td>
                        @if($order->status == 'waiting_admin')
                        <form action="{{ route('admin.orders.approve', $order) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Setujui pembayaran order ini?')">Setujui</button>
                        </form>
                        <form action="{{ route('admin.orders.reject', $order) }}" method="POST" style="display:inline-block; margin-left:4px;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tolak pembayaran order ini?')">Tolak</button>
                        </form>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada order.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 