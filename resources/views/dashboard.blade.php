@extends('layout.main')

@section('content')
    <h3 class="fw-bold">Dashboard</h3>
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="card card-blue p-3">
                <strong>Total Barang</strong>
                <h3>{{ $totalitems }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-blue p-3">
                <strong>Total Peminjaman</strong>
                <h3>{{ $totalborrows }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-blue p-3">
                <strong>Total Pengembalian</strong>
                <h3>{{ $totalReturns }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-blue p-3">
                <strong>Total Kategori</strong>
                <h3>{{ $totalcategories }}</h3>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5>Grafik Peminjaman</h5>
            <p class="text-muted">Data grafik peminjaman akan ditampilkan di sini</p>
        </div>
    </div>
@endsection
