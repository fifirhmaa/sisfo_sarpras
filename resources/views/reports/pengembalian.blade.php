@extends('layout.main')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #174ea6, #a0c4ff);
        font-family: 'Poppins', sans-serif;
        color: #ffffff;
    }
    .container {
        padding: 30px;
        animation: fadeIn 0.8s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    h3 {
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        color: #fff;
    }
    th, td {
        padding: 12px 15px;
        border-bottom: 1px solid rgba(255,255,255,0.15);
        text-align: left;
    }
    th {
        background: rgba(255, 255, 255, 0.2);
        font-weight: 600;
    }
    tbody tr:hover {
        background: rgba(255, 255, 255, 0.15);
    }
</style>

<div class="container mt-4">
    <h3>Laporan Pengembalian</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Peminjam</th>
                <th>Barang</th>
                <th>Jumlah Dikembalikan</th>
                <th>Tanggal Kembali</th>
                <th>Kondisi</th>
                <th>Keperluan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($returns as $pengembalian)
                <tr>
                    <td>{{ $pengembalian->borrow->user->name ?? 'User tidak ditemukan' }}</td>
                    <td>{{ $pengembalian->borrow->item->name ?? 'Barang tidak ditemukan' }}</td>
                    <td>{{ $pengembalian->quantity_returned }}</td>
                    <td>{{ \Carbon\Carbon::parse($pengembalian->return_date)->format('d-m-Y') }}</td>
                    <td>{{ ucfirst($pengembalian->condition) }}</td>
                    <td>{{ $pengembalian->borrow->purposes }}</td>
                </tr>
            @endforeach
            @if($returns->isEmpty())
                <tr><td colspan="6" style="text-align:center;">Tidak ada data pengembalian</td></tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
