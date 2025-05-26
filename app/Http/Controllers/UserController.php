<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Middleware auth untuk proteksi
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Tampilkan semua user
    public function index()
    {
        $users = User::all();
        return view('pendaftaran.daftar', compact('users'));
    }

    // Form tambah user
    public function create()
    {
        return view('pendaftaran.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'position' => 'nullable|in:student,teacher',
            'class' => 'nullable|string|max:50',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'class' => $request->class,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    // Form edit user
    public function edit(User $user)
    {
        return view('pendaftaran.edit', compact('user'));
    }

    // Update data user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'position' => 'nullable|in:student,teacher',
            'class' => 'nullable|string|max:50',
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'position.in' => 'Status harus "student" atau "teacher".',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->position = $request->position;
        $user->class = $request->class;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    // Hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
}
