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

    .card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: #fff;
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #fff;
    }

    label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    select,
    input[type="date"],
    .form-control {
        background-color: rgba(255, 255, 255, 0.15);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 8px;
        padding: 0.5rem;
    }

    .form-control::placeholder {
        color: #eee;
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.25);
        color: #fff;
        box-shadow: 0 0 5px rgba(255, 255, 255, 0.3);
        border-color: #fff;
    }

    .btn-dark {
        background-color: #0f3d91;
        border: none;
        font-weight: 500;
        color: #fff;
    }

    .btn-dark:hover {
        background-color: #0c2e6e;
    }

    .btn-outline-primary {
        color: #fff;
        border-color: #fff;
        font-weight: 500;
    }

    .btn-outline-primary:hover {
        background-color: rgba(255, 255, 255, 0.15);
        color: #fff;
        border-color: #fff;
    }

    .fa-download {
        margin-right: 6px;
    }
</style>

<div class="container mt-4">
    <h3 class="mb-4">Laporan</h3>
    <div class="row">

        {{-- Laporan Data Barang --}}
        <div class="col-md-4">
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="card-title">Laporan Data Barang</h5>
                <form method="GET" action="{{ route('laporan.barang') }}">
                    <div class="form-group mb-2">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control">
                            <option value="">Semua...</option>
                            @foreach(App\Models\Categories::all() as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>Kondisi</label>
                        <select name="kondisi" class="form-control">
                            <option value="">Semua...</option>
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 mb-2">Lihat Laporan</button>
                </form>
                <a href="{{ route('laporan.export', ['type' => 'barang']) }}" class="btn btn-outline-primary w-100">
                    <i class="fa fa-download"></i> Unduh PDF
                </a>
            </div>
        </div>

        {{-- Laporan Peminjaman --}}
        <div class="col-md-4">
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="card-title">Laporan Peminjaman</h5>
                <form method="GET" action="{{ route('laporan.peminjaman') }}">
                    <div class="form-group mb-2">
                        <label>Dari Tanggal</label>
                        <input type="date" name="dari" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="sampai" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="">Semua Status</option>
                            <option value="1">Disetujui</option>
                            <option value="0">Tidak Disetujui</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 mb-2">Lihat Laporan</button>
                </form>
                <a href="{{ route('laporan.export', ['type' => 'peminjaman']) }}" class="btn btn-outline-primary w-100">
                    <i class="fa fa-download"></i> Unduh PDF
                </a>
            </div>
        </div>

        {{-- Laporan Pengembalian --}}
        <div class="col-md-4">
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="card-title">Laporan Pengembalian</h5>
                <form method="GET" action="{{ route('laporan.pengembalian') }}">
                    <div class="form-group mb-2">
                        <label>Dari Tanggal</label>
                        <input type="date" name="dari" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="sampai" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label>Kondisi</label>
                        <select name="kondisi" class="form-control">
                            <option value="">Semua Kondisi</option>
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 mb-2">Lihat Laporan</button>
                </form>
                <a href="{{ route('laporan.export', ['type' => 'pengembalian']) }}" class="btn btn-outline-primary w-100">
                    <i class="fa fa-download"></i> Unduh PDF
                </a>
            </div>
        </div>
    </div>
</div>
@endsection