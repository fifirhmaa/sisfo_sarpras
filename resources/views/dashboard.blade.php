@extends('layout.main')

@section('content')
    <style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .card-blue {
        background: linear-gradient(135deg, #174ea6, #468bfd);
        border-radius: 15px;
        color: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease;
    }

    .card-blue:hover {
        transform: translateY(-5px);
    }

    .icon-wrapper {
        font-size: 28px;
    }

    .section-title {
        font-weight: 600;
        color: white; /* Ubah warna jadi putih */
    }
    .section {
        font-weight: 600;
        color: #174ea6;
    }

    .table thead {
        background-color: #e3f0ff;
        color: #174ea6;
        font-weight: 600;
    }

    .table tbody tr:hover {
        background-color: #f2f9ff;
    }
</style>


    <h3 class="fw-bold section-title mb-4">Dashboard</h3>

    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card card-blue p-3">
                <div class="icon-wrapper mb-2"><i class="bi bi-box-seam"></i></div>
                <strong>Total Barang</strong>
                <h3>{{ $totalItems }}</h3>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-blue p-3">
                <div class="icon-wrapper mb-2"><i class="bi bi-arrow-left-right"></i></div>
                <strong>Total Peminjaman</strong>
                <h3>{{ $totalBorrows }}</h3>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-blue p-3">
                <div class="icon-wrapper mb-2"><i class="bi bi-arrow-counterclockwise"></i></div>
                <strong>Total Pengembalian</strong>
                <h3>{{ $totalReturns }}</h3>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-blue p-3">
                <div class="icon-wrapper mb-2"><i class="bi bi-tags"></i></div>
                <strong>Total Kategori</strong>
                <h3>{{ $totalCategories }}</h3>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-8 mb-4">
            <div class="card shadow-sm p-4">
                <h5 class="mb-3 section">Grafik Peminjaman per Bulan</h5>
                <canvas id="borrowChart" height="150"></canvas>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm p-4">
                <h5 class="mb-3 section">Stok Barang Menipis</h5>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lowStockItems as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td><span class="badge bg-danger">{{ $item->stock }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-muted text-center">Aman semua</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('borrowChart').getContext('2d');
    const borrowChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [{
                label: 'Jumlah Peminjaman',
                data: {!! json_encode($borrowCounts) !!},
                backgroundColor: '#174ea6',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
</script>
@endsection
