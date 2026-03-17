<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController
{
    public function index()
    {
        $totalPengumuman = Pengumuman::count();

        $Pengumuman = Pengumuman::latest()->take(5)->get();

        // dd($reports);

        return view('admin.announcement.index', compact(
            'totalPengumuman',
            'Pengumuman'
        ));
    }

    public function store(Request $request)
    {
        // 1. Ambil ID user yang login (pake helper biar simpel)
         $userId = Auth::id();

        // 2. Siapkan data yang mau disimpan
        $data = [
            'judul'   => $request->judul,
            'kontent' => $request->kontent,
            'id_user' => $userId,
        ];

        // 3. Cek apakah ada file gambar yang diupload
        if ($request->hasFile('gambar')) {
            // Simpan file ke folder: storage/app/public/pengumuman
            $path = $request->file('gambar')->store('pengumuman', 'public');

            $data['gambar'] = $path;
        }

        // 4. Eksekusi simpan ke database
        Pengumuman::create($data);

        return response()->json(['success' => true]);
    }

    public function update( Request $request, $id){
        $item = Pengumuman::findOrFail($id);
        $item->update($request->all());
        return response()->json(['success' => true]);
    }

    public function destroy( $id ) {
        Pengumuman::destroy($id);
        return response()->json(['success' => true]);
    }
}
