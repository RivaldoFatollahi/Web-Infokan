<?php

namespace App\Http\Controllers\Admin;

use App\Models\Laporan;


class ReportController
{
    public function index()
    {
        $totalReports = Laporan::count();


        $reports = Laporan::get();

        return view('admin.reports.index', compact(
            'totalReports',
            'reports'
        ));
    }
}
