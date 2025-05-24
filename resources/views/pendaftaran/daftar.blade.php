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

    h2 {
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #e0e7ff;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
    }

    .card, .table-responsive {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.15);
        padding: 1rem;
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
        color: #e0e7ff;
        font-weight: 500;
    }

    .table thead tr, .table th {
        background-color: rgba(15, 61, 145, 0.75);
        color: #e0e7ff;
        font-weight: 600;
        padding: 0.85rem 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        text-align: left;
        user-select: none;
    }

    .table tbody tr:hover {
        background-color: rgba(15, 61, 145, 0.55);
        color: #fff;
        cursor: pointer;
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
    <h2>Daftar User</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pendaftaran.create') }}" class="btn btn-primary mb-4 rounded-pill">
        <i class="bi bi-person-plus-fill me-1"></i> Tambah User
    </a>

    <div class="table-responsive card">
        <table class="table table-bordered table-hover shadow-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Kelas</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->position) }}</td>
                        <td>{{ $user->class }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn-outline-warning btn-sm rounded-pill me-1">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin hapus user ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-outline-danger btn-sm rounded-pill">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-light">Belum ada data user</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
