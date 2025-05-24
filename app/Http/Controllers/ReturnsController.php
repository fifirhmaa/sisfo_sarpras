<?php

namespace App\Http\Controllers;

use App\Models\Returns;
use Illuminate\Http\Request;

class ReturnsController extends Controller
{
    public function index()
    {
        $returns = Returns::with(['user', 'borrow.item'])->get();
        return view('returns.index', compact('returns'));
    }

    public function destroy(Returns $return)
    {
        $return->delete();
        return redirect()->back()->with('success', 'Data pengembalian berhasil dihapus.');
    }
}