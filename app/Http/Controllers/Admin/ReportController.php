<?php

namespace App\Http\Controllers\Admin;

use App\Models\Laporan;


class ReportController
{
    public function reports()
    {
        $totalReports = Laporan::count();


        $reports = Laporan::latest()->take(5)->get();

        // dd($reports);

         return view('admin.reports.index', compact(
        'totalReports',
        'reports'
    ));
    }
}
