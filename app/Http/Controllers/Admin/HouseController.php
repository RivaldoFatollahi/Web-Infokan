<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rumah;

class HouseController
{
    public function houses()
    {
        $totalHouses = Rumah::count();

        $Houses = Rumah::latest()->take(5)->get();

        // dd($Houses);

         return view('admin.houses.index', compact(
        'totalHouses',
        'Houses'
    ));
    }
}
