<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Returns;

class ReturnsController extends Controller
{
    public function index($userId)
    {
        $returns = Returns::where('user_id', $userId)->get();
        
        return response()->json([
            'data' => $returns
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'borrow_id' => ['required', 'exists:borrows,id'],
            'return_date' => ['required', 'date'],
            'condition' => ['required', 'in:good,bad,lost'],
            'note' => ['required', 'string'],
            'status' => ['required', 'in:finish,finish(bad),finish(lost)']
        ]);

        $return = Returns::create([
            'user_id' => $request->user_id,
            'borrow_id' => $request->borrow_id,
            'return_date' => $request->return_date,
            'condition' => $request->condition,
            'note' => $request->note,
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Data pengembalian berhasil ditambahkan',
            'data' => $return
        ], 201);
    }
}
