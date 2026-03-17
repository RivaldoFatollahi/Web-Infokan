<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rumah;
use Illuminate\Http\Request;

class HouseController
{
    public function index()
    {
        $totalHouses = Rumah::count();

        $Houses = Rumah::get();

        // dd($Houses);

        return view('admin.houses.index', compact(
            'totalHouses',
            'Houses'
        ));
    }

    public function store(Request $request)
    {
        rumah::create($request->all());
        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $item = Rumah::findOrFail($id);
        $item->update($request->all());
        return response()->json(['success' => true]);
    }

    public function destroy($id) {
    Rumah::destroy($id);
    return response()->json(['success' => true]);
    }
}
