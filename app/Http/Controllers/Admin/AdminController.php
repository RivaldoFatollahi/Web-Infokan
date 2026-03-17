<?php

namespace App\Http\Controllers\Admin;

use App\Models\Laporan;
use App\Models\User;
use App\Models\Pengumuman;
use App\Models\Rumah;

class AdminController
{
    public function index()
    {
        $totalUsers = User::count();
        $totalReports = Laporan::count();
        $totalHouses = Rumah::count();
        $totalPengumuman = Pengumuman::count();

        $reports = Laporan::latest()->take(5)->get();

        // dd($reports);

         return view('admin.dashboard', compact(
        'totalUsers',
        'totalHouses',
        'totalReports',
        'reports'
    ));
    }
}
