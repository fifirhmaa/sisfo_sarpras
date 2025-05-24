<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #174ea6, #a0c4ff);
            min-height: 100vh;
            color: #fff;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            padding: 20px;
            color: #fff;
        }

        /* Logo hover container with overlay cover effect */
        .logo-container {
            position: relative;
            display: block;
            margin: 0 auto 20px;
            width: fit-content;
        }

        .logo-img {
            max-width: 180px;
            border: 4px solid rgba(255, 255, 255, 0.6);
            border-radius: 15px;
            padding: 5px;
            background-color: rgba(255, 255, 255, 0.2);
            display: block;
            transition: 0.3s ease;
        }

        .logo-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 15px;
            background: rgba(0, 102, 204, 0.7);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 18px;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .logo-container:hover .logo-overlay {
            opacity: 1;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
            border-radius: 10px;
            transition: background 0.3s ease;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .sidebar hr {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin: 15px 0;
        }

        .main-content {
            flex-grow: 1;
            padding: 40px;
        }

        .card-blue {
            background-color: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            color: #fff;
        }

        .card-blue .card-body {
            padding: 20px;
        }

        .card-blue h5, .card-blue p {
            color: #fff;
        }

        .d-flex {
            display: flex;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar">
        <!-- Logo dengan efek overlay biru saat hover -->
        <div class="logo-container">
            <img src="{{ asset('img/images.png') }}" alt="Logo" class="logo-img">
            <div class="logo-overlay">SMK Taruna Bhakti</div>
        </div>

        <a href="{{ route('dashboard') }}"><i class="bi bi-grid"></i> Dashboard</a>
        <a href="/categories"><i class="bi bi-journal-text"></i> Kategori Barang</a>
        <a href="/items"><i class="bi bi-clipboard-data"></i> Barang</a>
        <a href="/borrows"><i class="bi bi-clipboard-check"></i> Peminjaman</a>
        <a href="/returns"><i class="bi bi-clipboard-check-fill"></i> Pengembalian</a>
        <hr>
        <a href="/laporan"><i class="bi bi-chat-left-text"></i> Laporan</a>
        <a href="/registrasi"><i class="bi bi-person-plus"></i> Registrasi</a>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mb-0" onsubmit="return confirmLogout(event)">
            @csrf
            <button type="submit" class="btn btn-link text-white text-decoration-none d-flex align-items-center gap-2" 
                style="padding: 12px 15px; width: 100%; text-align: left; border-radius: 10px;">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>

    <div class="main-content">
        @yield('content')
    </div>
</div>

<script>
    function confirmLogout(event) {
        const confirmed = confirm("Yakin ingin logout?");
        if (!confirmed) {
            event.preventDefault();
        }
        return confirmed;
    }
</script>

</body>
</html>
    