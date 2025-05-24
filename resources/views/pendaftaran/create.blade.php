@extends('layout.main')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #174ea6, #a0c4ff);
        font-family: 'Poppins', sans-serif;
        color: #fff;
    }

    .container {
        padding: 30px 40px;
        animation: fadeIn 0.8s ease;
        max-width: 1400px; /* lebar lebih besar */
        background: rgba(15, 61, 145, 0.3);
        border-radius: 15px;
        backdrop-filter: blur(12px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.15);
        margin: 3rem auto;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    h2 {
        font-weight: 700;
        margin-bottom: 2rem;
        color: #e0e7ff;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
        user-select: none;
    }

    label.form-label {
        font-weight: 600;
        color: #cbd5e1; /* biru muda */
        user-select: none;
    }

    input.form-control, select.form-select {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.25);
        color: #e0e7ff;
        border-radius: 10px;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    input.form-control::placeholder {
        color: rgba(224, 231, 255, 0.7);
    }

    input.form-control:focus, select.form-select:focus {
        background: rgba(255, 255, 255, 0.3);
        border-color: #0f3d91;
        color: #fff;
        outline: none;
        box-shadow: 0 0 8px rgba(15, 61, 145, 0.7);
    }

    .btn-primary {
        background-color: #0f3d91;
        border: none;
        font-weight: 600;
        padding: 0.5rem 1.8rem;
        border-radius: 50px;
        box-shadow: 0 4px 10px rgba(15, 61, 145, 0.6);
        color: #fff;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0c2e6e;
        box-shadow: 0 6px 15px rgba(12, 46, 110, 0.8);
        color: #fff;
    }

    .alert-danger {
        background-color: rgba(239, 68, 68, 0.15);
        border: 1px solid rgba(239, 68, 68, 0.5);
        color: #f87171;
        font-weight: 600;
        padding: 1rem 1.25rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
    }

    .alert-danger ul {
        margin: 0;
        padding-left: 1.25rem;
    }
</style>

<div class="container">
    <h2>Registrasi User Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="position" class="form-label">Status</label>
            <select name="position" id="position" class="form-select">
                <option value="">Status</option>
                <option value="student" {{ old('position') == 'student' ? 'selected' : '' }}>Siswa</option>
                <option value="teacher" {{ old('position') == 'teacher' ? 'selected' : '' }}>Guru</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="class" class="form-label">Kelas</label>
            <input type="text" name="class" id="class" class="form-control" value="{{ old('class') }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>
</div>
@endsection
