<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\customer;
use App\Models\sales_det;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'transaksi' => sales_det::count(),
            'barang' => barang::count(),
            'customer' => customer::count(),
        ]);
    }
}
