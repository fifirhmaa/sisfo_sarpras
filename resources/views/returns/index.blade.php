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

    .card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .card-header {
        background-color: transparent;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        font-weight: 600;
        font-size: 18px;
        color: #fff;
    }

    .table {
        color: #fff;
    }

    .table th {
        background-color: rgba(255, 255, 255, 0.15);
        color: #fff;
        font-weight: 600;
    }

    .table td {
        background-color: transparent;
    }

    .table-bordered > :not(caption) > * > * {
        border-color: rgba(255, 255, 255, 0.15);
    }

    .badge.bg-success {
        background-color: #28a745;
        font-weight: 600;
        padding: 0.4em 0.7em;
        border-radius: 12px;
    }

    .badge.bg-danger {
        background-color: #dc3545;
        font-weight: 600;
        padding: 0.4em 0.7em;
        border-radius: 12px;
    }

    .btn-outline-danger {
        font-weight: 600;
        padding: 0.35rem 1rem;
        border-radius: 50px;
        border: 1.8px solid #ef5350;
        background: transparent;
        color: #ef5350;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }

    .btn-outline-danger:hover {
        background-color: #ef5350;
        color: #fff;
        box-shadow: 0 0 8px #ef5350;
    }

    .btn-outline-danger i {
        margin-right: 6px;
        font-size: 1.1rem;
    }

    .btn-icon {
        background: none;
        border: none;
        padding: 0;
        margin: 0;
        cursor: pointer;
        transition: transform 0.2s ease;
        color: inherit;
        font-size: 1.15rem;
        display: inline-flex;
        align-items: center;
    }

    .btn-icon:hover {
        transform: scale(1.15);
    }
</style>

<div class="container">
    <h1>Data Pengembalian</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Pinjam</th>
                <th>Kode Kembali</th>
                <th>Tanggal Kembali</th>
                <th>Peminjam</th>
                <th>Barang</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($returns as $index => $return)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $return->borrow->id ?? '-' }}</td>
                <td>{{ $return->id }}</td>
                <td>{{ \Carbon\Carbon::parse($return->return_date)->format('d-m-Y') }}</td>
                <td>{{ $return->user->name ?? '-' }}</td>
                <td>{{ $return->borrow->item->name ?? '-' }}</td>
                <td><span class="badge bg-success">Dikembalikan</span></td>
                <td>
                    <form action="{{ route('returns.destroy', $return->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-outline-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Data pengembalian belum tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
