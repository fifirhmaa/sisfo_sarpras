<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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

    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'position' => 'nullable|in:student,teacher',
        'class' => 'nullable|string|max:50',
        'password' => 'nullable|string|min:6|confirmed',
    ], [
        'position.in' => 'Status harus "student" atau "teacher".',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ]);

    // Cari user berdasarkan ID
    $user = User::findOrFail($id);

    // Update data user
    $user->name = $request->name;
    $user->email = $request->email;
    $user->position = $request->position;
    $user->class = $request->class;

    // Jika password diisi, update password
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    // Redirect kembali dengan pesan sukses
    return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pendaftaran.edit', compact('user'));
    }



    // Hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }

    // Tampilkan daftar pendaftaran
    public function daftar()
    {
        $users = User::all();
        return view('pendaftaran.daftar', compact('users'));
    }
}
