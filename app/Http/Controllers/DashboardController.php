<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\Borrows;
use App\Models\Returns;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItems = Items::count();
        $totalBorrows = Borrows::count();
        $totalReturns = Returns::count();
        $totalCategories = Categories::count();

        // 1. Ambil Barang dengan Stok < 5
        $lowStockItems = Items::where('stock', '<', 5)->get();

        // 2. Ambil data peminjaman per bulan (6 bulan terakhir)
        $borrowData = Borrows::select(
                DB::raw("MONTHNAME(borrow_date) as month"),
                DB::raw("COUNT(*) as total")
            )
            ->where('borrow_date', '>=', Carbon::now()->subMonths(6))
            ->groupBy(DB::raw("MONTH(borrow_date)"), DB::raw("MONTHNAME(borrow_date)"))
            ->orderBy(DB::raw("MONTH(borrow_date)"))
            ->get();

        $months = $borrowData->pluck('month');
        $borrowCounts = $borrowData->pluck('total');

        return view('dashboard', compact(
            'totalItems',
            'totalBorrows',
            'totalReturns',
            'totalCategories',
            'lowStockItems',
            'months',
            'borrowCounts'
        ));
    }
}
