<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

class UserController
{
    public function users()
    {

        $Users = User::get();

        $totalUsers = User::count();
        // dd($reports);

         return view('admin.user.index', compact(
        'Users',
        'totalUsers'
    ));
    }
}
