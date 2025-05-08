@extends('layouts.app')

@section('content')
<div class="card" style="max-width:700px; margin:40px auto;">
    <div class="card-header">
        <h3>Statistik Orderan</h3>
    </div>
    <div class="card-body">
        <canvas id="orderChart" width="400" height="180"></canvas>
        <table class="table table-bordered mt-4">
            <tr>
                <th>Total Order</th>
                <td>{{ $totalOrder }}</td>
            </tr>
            <tr>
                <th>Order Paid</th>
                <td>{{ $totalPaid }}</td>
            </tr>
            <tr>
                <th>Order Ditolak</th>
                <td>{{ $totalRejected }}</td>
            </tr>
            <tr>
                <th>Order Menunggu Admin</th>
                <td>{{ $totalWaiting }}</td>
            </tr>
            <tr>
                <th>Order Pending</th>
                <td>{{ $totalPending }}</td>
            </tr>
            <tr>
                <th>Total Income (Paid)</th>
                <td>Rp {{ number_format($totalIncome, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('orderChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Paid', 'Ditolak', 'Menunggu Admin', 'Pending'],
            datasets: [{
                label: 'Jumlah Order',
                data: [{{ $totalPaid }}, {{ $totalRejected }}, {{ $totalWaiting }}, {{ $totalPending }}],
                backgroundColor: [
                    '#28a745', // Paid
                    '#dc3545', // Ditolak
                    '#ffc107', // Menunggu Admin
                    '#6c757d'  // Pending
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: true, text: 'Statistik Orderan' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection 