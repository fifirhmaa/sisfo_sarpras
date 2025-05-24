@extends('layout.main')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #174ea6, #a0c4ff);
        font-family: 'Poppins', sans-serif;
        color: #ffffff;
    }

    h4 {
        color: #ffffff;
        font-weight: 600;
    }

    label {
        color: #ffffff;
        font-weight: 500;
    }

    .card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .form-control,
    .form-select {
        background-color: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #ffffff;
        border-radius: 10px;
    }

    .form-control::placeholder {
        color: #e0e0e0;
    }

    .form-control:focus,
    .form-select:focus {
        background-color: rgba(255, 255, 255, 0.25);
        border-color: #ffffff;
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.2);
        color: #ffffff;
    }

    .btn-primary {
        background-color: #0f3d91;
        border: none;
        font-weight: 500;
    }

    .btn-primary:hover {
        background-color: #0c2e6e;
    }

    .btn-secondary {
        background-color: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .btn-secondary:hover {
        background-color: rgba(255, 255, 255, 0.3);
        color: #ffffff;
    }

    .btn i {
        vertical-align: middle;
    }
</style>

<div class="container mt-4">
    <h4 class="mb-4">Edit Barang</h4>

    <div class="card p-4">
        <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="code_item" class="form-label">Kode Barang</label>
                <input type="text" name="code_item" id="code_item" class="form-control" value="{{ $item->code_item }}" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nama Barang</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $item->name }}" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stok</label>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ $item->stock }}" required>
            </div>

            <div class="mb-3">
                <label for="condition" class="form-label">Kondisi</label>
                <select name="condition" id="condition" class="form-select" required>
                    <option value="">-- Pilih Kondisi --</option>
                    <option value="baik" {{ $item->condition == 'baik' ? 'selected' : '' }}>Baik</option>
                    <option value="rusak" {{ $item->condition == 'rusak' ? 'selected' : '' }}>Rusak</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Lokasi</label>
                <input type="text" name="location" id="location" class="form-control" value="{{ $item->location }}" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('items.index') }}" class="btn btn-secondary px-4 rounded-pill">
                    <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary px-4 rounded-pill">
                    <i class="bi bi-save2-fill me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
