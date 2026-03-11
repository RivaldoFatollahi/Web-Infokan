<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

class UserController
{
    public function users()
    {

        $Users = User::latest()->take(5)->get();

        $totalUsers = User::count();
        // dd($reports);

         return view('admin.user.index', compact(
        'Users',
        'totalUsers'
    ));
    }
}
