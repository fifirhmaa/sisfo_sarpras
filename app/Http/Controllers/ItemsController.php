<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Categories;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ItemsController extends Controller
{
    // Tampilkan list barang (index)
    public function index()
    {
        // Ambil semua items beserta relasi category-nya
        $items = Items::with('category')->get();
        return view('items.barang', compact('items'));
    }

    // Tampilkan form tambah barang
    public function create()
    {
        $categories = Categories::all();
        return view('items.create', compact('categories'));
    }

    // Simpan data barang baru
    public function store(Request $request)
    {
        $request->validate([
            'code_item' => 'required',
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'condition' => 'required',
            'stock' => 'required|integer',
            'location' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('items', 'public');
        }

        Items::create($data);

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan');
    }

    // Tampilkan form edit barang
    public function edit(Items $item)
    {
        $categories = Categories::all();
        return view('items.edit', compact('item', 'categories'));
    }

    // Update data barang
    public function update(Request $request, Items $item)
    {
        $request->validate([
            'code_item' => 'required',
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer',
            'condition' => 'required',
            'location' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('items', 'public');
        }

        $item->update($data);

        return redirect()->route('items.index')->with('success', 'Barang berhasil diperbarui');
    }

    // Hapus barang
    public function destroy(Items $item)
    {
        // Optional: Hapus file gambarnya dari storage sebelum hapus data
        if ($item->image && Storage::disk('public')->exists($item->image)) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus');
    }

    // Export barang
    public function exportPDF()
    {
        $items = Items::all();

        $pdf = Pdf::loadView('items.export', compact('items'));
        return $pdf->download('data_barang.pdf');
    }
}
