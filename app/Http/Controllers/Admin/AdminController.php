<?php

namespace App\Http\Controllers\Admin;

use App\Models\Laporan;
use App\Models\User;
use App\Models\Pengumuman;
use App\Models\Rumah;

class AdminController
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalReports = Laporan::count();
        $totalReports = Rumah::count();
        $totalPengumuman = Pengumuman::count();
        

        return view('dashboard', compact('totalUsers', 'totalReports'));
    }
}
