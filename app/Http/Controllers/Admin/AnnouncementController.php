<?php

namespace App\Http\Controllers\Admin;

use App\Models\Laporan;
use App\Models\User;
use App\Models\Pengumuman;
use App\Models\Rumah;

class AnnouncementController
{
    public function dashboard()
    {
        $totalPengumuman = Pengumuman::count();

        $Pengumuman = Pengumuman::latest()->take(5)->get();

        // dd($reports);

         return view('admin.announcement.index', compact(
        'totalPengumuman',
        'Pengumuman'
    ));
    }
}
