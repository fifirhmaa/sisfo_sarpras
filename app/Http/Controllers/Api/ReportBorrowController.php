<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Borrows;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportBorrowController extends Controller
{
    public function generateBorrowReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status');

        $borrows = Borrows::with(['user', 'item', 'return'])
            ->whereBetween('borrow_date', [$startDate, $endDate])
            ->get()
            ->map(function ($item) {
                $item->borrow_date = \Carbon\Carbon::parse($item->borrow_date);
                if ($item->return) {
                    $item->return->return_date = \Carbon\Carbon::parse($item->return->return_date);
                }
                return $item;
            });

        $data = [
            'title' => 'Laporan Peminjaman Barang',
            'period' => $startDate . ' s/d ' . $endDate,
            'borrows' => $borrows,
            'generated_at' => now()->format('d-m-Y H:i:s'),
        ];

        $pdf = Pdf::loadView('pdf.borrowApi', $data)
            ->setPaper('a4', 'landscape');

        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="borrow_report.pdf"');
    }
}

