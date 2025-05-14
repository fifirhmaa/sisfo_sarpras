<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9ff;
        }
        .sidebar {
            height: 100vh;
            background-color: #cce6ff;
            width: 250px;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #001f4d;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
        }

        .sidebar a:hover {
            background-color: #b3d9ff;
            border-radius: 5px;
        }

        .card-blue {
            background-color: #b3e0ff;
            border: none;
        }

        .sidebar img {
            margin-bottom: -19px;
        }

        .sidebar a:first-child {
            padding-top: px;
        }

    </style>
</head>
<body>
<div class="d-flex">
<div class="sidebar p-3">
    <a href="/dashboard" class="d-block text-center mb-4">
    <img src="{{ asset('img/tebe.png') }}" alt="Logo" class="img-fluid" style="max-width: 300px ;"></a>
    <a href="/dashboard"><i class="bi bi-grid me-2"></i> Dashboard</a>
    <a href="/kategori"><i class="bi bi-journal-text me-2"></i> Kategori Barang</a>
    <a href="/barang"><i class="bi bi-clipboard-data me-2"></i> Data Barang</a>
    <a href="/peminjaman"><i class="bi bi-clipboard-check me-2"></i> Peminjaman</a>
    <a href="/peminjaman"><i class="bi bi-clipboard-check me-2"></i> Permintaan Peminjaman</a>
    <a href="/pengembalian"><i class="bi bi-clipboard-check-fill me-2"></i> Pengembalian</a>
    <hr>
    <a href="/laporan"><i class="bi bi-chat-left-text me-2"></i> Laporan</a>
    <a href="/registrasi"><i class="bi bi-person-plus me-2"></i> Registrasi</a>
    <a href="/logout"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
</div>
    <div class="flex-grow-1 p-4">
        @yield('content')
    </div>
</div>
</body>
</html>