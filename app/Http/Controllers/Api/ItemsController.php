<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    // Tampilkan semua items
    public function index()
    {
        $items = Item::all();
        return response()->json($items);
    }

    // Tampilkan detail item per id
    public function show($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        return response()->json($item);
    }

    // Simpan item baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            // tambahkan validasi sesuai kolom lain
        ]);

        $item = Item::create($request->all());

        return response()->json($item, 201);
    }

    // Update item berdasarkan id
    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string',
            'category_id' => 'sometimes|required|exists:categories,id',
            // validasi lainnya sesuai kebutuhan
        ]);

        $item->update($request->all());

        return response()->json($item);
    }

    // Hapus item berdasarkan id
    public function destroy($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $item->delete();

        return response()->json(['message' => 'Item deleted successfully']);
    }

    // Contoh export PDF (jika ada implementasi)
    public function exportPDF()
    {
        // logika export PDF disini
        return response()->json(['message' => 'Export PDF not implemented yet']);
    }
}