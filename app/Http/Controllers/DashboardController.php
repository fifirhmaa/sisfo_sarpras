<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\items;
use App\Models\borrows;
use App\Models\Returns;
use App\Models\categories;

class DashboardController extends Controller
{
    public function index()
    {
        $totalitems = items::count();
        $totalborrows = borrows::count();
        $totalReturns = Returns::count();
        $totalcategories = categories::count();

        return view('dashboard', compact(
            'totalitems',
            'totalborrows',
            'totalReturns',
            'totalcategories'
        ));
    }
}