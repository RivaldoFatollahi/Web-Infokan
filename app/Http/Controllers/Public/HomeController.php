<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Pengumuman;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $reports = Laporan::latest()->take(5)->get();
        $announcement = Pengumuman::latest()->take(3)->get();
        // dd($reports);
        
        return view('home', compact('reports', 'announcement'));
    }
}
