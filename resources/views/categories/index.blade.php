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
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #e0e7ff;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
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
        color: #e0e7ff;
    }

    .btn-success {
        background-color: #0f3d91;
        border: none;
        font-weight: 500;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        box-shadow: 0 4px 10px rgba(15, 61, 145, 0.5);
        color: #fff;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        display: inline-flex;
        align-items: center;
    }

    .btn-success:hover {
        background-color: #0c2e6e;
        box-shadow: 0 6px 15px rgba(12, 46, 110, 0.7);
        color: #fff;
    }

    .table {
        width: 100%;
        color: #e0e7ff;
        font-weight: 500;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table th {
        background-color: rgba(15, 61, 145, 0.75);
        color: #e0e7ff;
        font-weight: 600;
        padding: 0.85rem 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        user-select: none;
        text-align: left;
    }

    .table td {
        background-color: transparent;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        vertical-align: middle;
    }

    .table-bordered > :not(caption) > * > * {
        border-color: rgba(255, 255, 255, 0.15);
    }

    .btn-icon {
        background: none;
        border: none;
        padding: 0;
        margin: 0;
        cursor: pointer;
        transition: transform 0.2s ease;
        color: inherit;
        font-size: 1.25rem;
        display: inline-flex;
        align-items: center;
    }

    .btn-icon:hover {
        transform: scale(1.15);
    }

    .text-warning i {
        color: #fdd835;
    }

    .text-danger i {
        color: #ef5350;
    }

    .text-center {
        color: #e0e7ff;
    }
</style>

<div class="container">
    <h3>Kategori Barang</h3>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Daftar Kategori Barang</span>
            <a href="{{ route('categories.create') }}" class="btn btn-success">+ Tambah Kategori</a>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 30%">Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th style="width: 15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn-icon text-warning me-3" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon text-danger" title="Hapus">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
