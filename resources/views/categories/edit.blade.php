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

    .form-label {
        font-weight: 500;
        color: #fff;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #fff;
        border-radius: 10px;
    }

    .form-control::placeholder {
        color: #eee;
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.25);
        border-color: #fff;
        box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.2);
        color: #fff;
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
        background-color: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #fff;
    }

    .btn-secondary:hover {
        background-color: rgba(255, 255, 255, 0.3);
        color: #fff;
    }

    .bi {
        vertical-align: middle;
    }
</style>

<div class="container">
    <h3 class="mb-4">Edit Kategori</h3>

    <div class="card">
        <div class="card-header">
            Form Edit Kategori
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kategori</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $category->name) }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" id="description" rows="3" placeholder="Deskripsi tambahan">{{ old('description', $category->description) }}</textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save2-fill me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
