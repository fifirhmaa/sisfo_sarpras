<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\Borrows;
use App\Models\Returns;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    // Laporan Data Barang
    public function dataBarang(Request $request)
    {
        $items = Items::query();

        if ($request->kategori) {
            $items->where('category_id', $request->kategori);
        }

        if ($request->kondisi) {
            $items->where('condition', $request->kondisi);
        }

        $items = $items->get();

        return view('reports.data_barang', compact('items'));
    }

    // Laporan Peminjaman
    public function peminjaman(Request $request)
    {
        $borrows = Borrows::with('item', 'user');

        if ($request->dari && $request->sampai) {
            $borrows->whereBetween('borrow_date', [$request->dari, $request->sampai]);
        }

        if ($request->status !== null && $request->status !== '') {
            $borrows->where('is_approved', $request->status);
        }

        $borrows = $borrows->get();

        return view('reports.peminjaman', compact('borrows'));
    }

    // Laporan Pengembalian
    public function pengembalian(Request $request)
    {
        $returns = Returns::with(['borrow.item', 'user']);

        if ($request->dari && $request->sampai) {
            $returns->whereBetween('return_date', [$request->dari, $request->sampai]);
        }

        if ($request->kondisi) {
            $returns->where('condition', $request->kondisi);
        }

        $returns = $returns->get();

        return view('reports.pengembalian', compact('returns'));
    }

    // Export PDF
    public function exportPdf(Request $request, $type)
    {
        switch ($type) {
            case 'barang':
                $data = Items::all();
                $pdf = Pdf::loadView('reports.export_barang', compact('data'));
                break;

            case 'peminjaman':
                $data = Borrows::with('item', 'user')->get();
                $pdf = Pdf::loadView('reports.export_peminjaman', compact('data'));
                break;

            case 'pengembalian':
                $data = Returns::with(['borrow.item', 'user'])->get();
                $pdf = Pdf::loadView('reports.export_pengembalian', compact('data'));
                break;

            default:
                abort(404);
        }

        return $pdf->download("laporan-$type.pdf");
    }
}
