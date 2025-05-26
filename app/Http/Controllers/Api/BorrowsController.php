<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Borrows;

class BorrowsController extends Controller
{
    public function index($userId)
    {
        $borrows = Borrows::where('user_id', $userId)->get();
        return response()->json([
            'data' => $borrows
        ], 200);
    }

    public function show($userId, $borrowId)
    {
        $borrow = Borrows::where('user_id', $userId)
        ->where('id', $borrowId)
        ->first();

        if (!$borrow) {
            return response()->json(['message' => 'Borrow not found'], 404);
        }

        return response()->json($borrow);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'borrow_date' => 'required|date',
            'purposes' => 'required|string',
            'status' => 'nullable|in:borrowed,returned',
            'is_approved' => 'nullable|boolean',
        ]);

        $borrow = Borrows::create($request->all());
        return response()->json([
            'data' => $borrow
        ], 201);
    }
}
