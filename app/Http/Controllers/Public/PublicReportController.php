<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Laporan;

class PublicReportController extends Controller
{
    public function store(Request $request)
    {
        $gambarPath = null;

        $request->validate([
            'judul' => 'required',
            'kontent' => 'required',
            'gambar' => 'nullable|image|max:2048',
            'sentimen' => 'required|in:positif,netral,negatif'
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('laporan', 'public');
        }

        Laporan::create([
            'id_user' => Auth::id(), 
            'judul' => $request->judul,
            'kontent' => $request->kontent,
            'gambar' => $gambarPath,
            'sentimen' => $request->sentimen ?? null,
        ]);

        return redirect()->back()->with('success','Laporan berhasil dikirim');
    }
}
