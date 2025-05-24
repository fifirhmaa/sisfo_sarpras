@extends('layout.main')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #174ea6, #a0c4ff);
        font-family: 'Poppins', sans-serif;
        color: #fff;
        animation: fadeIn 0.8s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    h3 {
        margin-bottom: 1.5rem;
        font-weight: 600;
    }

    table {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        color: #fff;
    }

    thead th {
        background-color: rgba(0, 0, 0, 0.25);
        padding: 12px 15px;
        text-align: left;
    }

    tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.15);
    }

    tbody td {
        padding: 10px 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    }

    .badge {
        background-color: rgba(255, 255, 255, 0.2);
        padding: 5px 10px;
        border-radius: 10px;
        font-weight: 500;
    }
</style>

<div class="container mt-4">
    <h3>Laporan Data Barang</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Kondisi</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category->name ?? '-' }}</td>
                    <td>
                        @if(strtolower($item->kondisi) === 'baik')
                            <span class="badge" style="background-color: #4caf50;">Baik</span>
                        @elseif(strtolower($item->kondisi) === 'rusak')
                            <span class="badge" style="background-color: #f44336;">Rusak</span>
                        @else
                            <span class="badge">{{ ucfirst($item->kondisi) }}</span>
                        @endif
                    </td>
                    <td>{{ $item->jumlah }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak ada data barang.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection