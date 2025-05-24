<?php

namespace App\Http\Controllers;

use App\Models\Borrows;
use App\Models\Items;
use App\Models\User;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index()
    {
        $borrows = Borrows::with(['user', 'item', 'return'])->get();
        return view('borrows.index', compact('borrows'));
    }
    public function create()
    {
        $users = User::all();
        $items = Items::all();
        return view('borrows.create', compact('users', 'items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'     => 'required|exists:users,id',
            'item_id'     => 'required|exists:items,id',
            'quantity'    => 'required|integer|min:1',
            'purposes'    => 'required|string',
            'borrow_date' => 'required|date',
            'status'      => 'required|string',
            'is_approved' => 'required|boolean',
        ]);

        Borrows::create($validated);

        return redirect()->route('borrows.index')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function show($id)
    {
        $borrow = Borrows::with(['user', 'item', 'return'])->findOrFail($id);
        return view('borrows.show', compact('borrow'));
    }

    public function edit($id)
    {
        $borrow = Borrows::findOrFail($id);
        $users = User::all();
        $items = Items::all();
        return view('borrows.edit', compact('borrow', 'users', 'items'));
    }

    public function update(Request $request, $id)
    {
        $borrow = Borrows::findOrFail($id);

        $validated = $request->validate([
            'user_id'     => 'required|exists:users,id',
            'item_id'     => 'required|exists:items,id',
            'quantity'    => 'required|integer|min:1',
            'purposes'    => 'required|string',
            'borrow_date' => 'required|date',
            'status'      => 'required|string',
            'is_approved' => 'required|boolean',
        ]);

        $borrow->update($validated);

        return redirect()->route('borrows.index')->with('success', 'Peminjaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $borrow = Borrows::findOrFail($id);
        $borrow->delete();

        return redirect()->route('borrows.index')->with('success', 'Peminjaman berhasil dihapus.');
    }
}
