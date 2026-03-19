<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {   
        $reports = Laporan::where('id_user', Auth::id())->latest()->get();
        // dd($reports);

        return view('public-laporan', compact('reports'));
    }
}


