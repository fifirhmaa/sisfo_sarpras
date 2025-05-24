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

    .card, .table-responsive {
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

    h3 {
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .btn-primary, .btn-success {
        background-color: #0f3d91;
        border: none;
        font-weight: 500;
        padding: 0.5rem 1.8rem;
        border-radius: 50px;
        box-shadow: 0 4px 10px rgba(15, 61, 145, 0.5);
        color: #fff;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-primary:hover, .btn-success:hover {
        background-color: #0c2e6e;
        box-shadow: 0 6px 15px rgba(12, 46, 110, 0.7);
        color: #fff;
    }

    .btn-primary i, .btn-success i {
        margin-right: 6px;
        font-size: 1.2rem;
    }

    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        color: #fff;
    }

    .table thead tr, .table th {
        background-color: rgba(255, 255, 255, 0.15);
        color: #fff;
        font-weight: 600;
        padding: 0.85rem 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.25);
        text-align: left;
    }

    .table tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.12);
        color: #fff;
    }

    .table tbody td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        vertical-align: middle;
        background-color: transparent;
    }

    .table-bordered > :not(caption) > * > * {
        border-color: rgba(255, 255, 255, 0.15);
    }

    .img-thumbnail {
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        background-color: rgba(255, 255, 255, 0.07);
        width: 50px;
        height: auto;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .img-thumbnail:hover {
        transform: scale(1.05);
        box-shadow: 0 0 12px rgba(255, 255, 255, 0.3);
    }

    .btn-outline-warning, .btn-outline-danger {
        font-weight: 600;
        padding: 0.35rem 1rem;
        border-radius: 50px;
        border: 1.8px solid;
        background: transparent;
        transition: all 0.3s ease;
        color: inherit;
        display: inline-flex;
        align-items: center;
        cursor: pointer;
    }

    .btn-outline-warning {
        border-color: #fdd835;
        color: #fdd835;
    }

    .btn-outline-warning:hover {
        background-color: #fdd835;
        color: #121827;
        box-shadow: 0 0 8px #fdd835;
    }

    .btn-outline-danger {
        border-color: #ef5350;
        color: #ef5350;
    }

    .btn-outline-danger:hover {
        background-color: #ef5350;
        color: #fff;
        box-shadow: 0 0 8px #ef5350;
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

    .alert-success {
        background-color: rgba(209, 243, 224, 0.9);
        color: #155d36;
        border: 1px solid #b2e2c5;
        font-weight: 600;
        margin-bottom: 1rem;
        padding: 0.8rem 1.2rem;
        border-radius: 10px;
    }
</style>


<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Daftar Barang</h3>
        <a href="{{ route('items.create') }}" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-plus-circle"></i> Tambah Barang
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm mb-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Kondisi</th>
                    <th>Lokasi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $item->code_item }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->name ?? '-' }}</td>
                        <td>{{ $item->stock }}</td>
                        <td>{{ $item->condition }}</td>
                        <td>{{ $item->location }}</td>
                        <td>
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="img-thumbnail" alt="Gambar {{ $item->name }}">
                            @else
                                <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('items.edit', $item->id) }}" class="btn-outline-warning rounded-pill btn-icon me-1" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-outline-danger rounded-pill btn-icon" title="Hapus">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-light">Tidak ada barang</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
