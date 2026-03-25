<?php

namespace App\Http\Controllers\Admin;

use App\Models\Laporan;
use App\Models\ReportReply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class ReportController
{
    public function index()
    {
        $totalReports = Laporan::count();


        // Tarik laporan beserta user pelapor dan replies-nya
        // Pastikan hanya ambil reply yang paling atas (parent_id null) di tingkat pertama
        $reports = Laporan::with(['user', 'replies' => function ($q) {
            $q->whereNull('parent_id')->with('user', 'children');
        }])->get();

        return view('admin.reports.index', compact(
            'totalReports',
            'reports'
        ));
    }

    public function storeReply(Request $request)
    {
        ReportReply::create([
            'id_laporan' => $request->report_id,
            'id_user' => Auth::id(),
            'parent_id' => $request->parent_id, // bisa null
            'message' => $request->message,
        ]);

        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $report = Laporan::with(['user', 'replies' => function ($q) {
            $q->whereNull('parent_id')->with('user', 'children.user');
        }])->findOrFail($id);

        return view('admin.reports.show', compact('report'));
    }
}
