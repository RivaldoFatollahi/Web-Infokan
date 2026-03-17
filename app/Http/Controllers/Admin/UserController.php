<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Rumah;
use App\Models\User;
use App\Models\Role;

class UserController
{
    public function index()
    {

        $Users = User::latest()->get();
        $Rumah = Rumah::latest()->get();
        $Role = Role::latest()->get();

        $totalUsers = User::count();
        // dd($reports);

        return view('admin.user.index', compact(
            'Users',
            'Rumah',
            'Role',
            'totalUsers'
        ));
    }

    public function store(Request $request)
    {
        User::create($request->all());
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $item = User::findOrFail($id);
        $data = $request->all();

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $item->update($data);

        $item->update($request->all());
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back();
    }
}
