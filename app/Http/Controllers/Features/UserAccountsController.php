<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAccountsController extends Controller
{
    public function index()
    {
        return view('auth.features.useraccounts');
    }

    public function showAddAdmin()
    {
        return view('auth.features.addadmin');
    }

    public function addAdmin(Request $request)
    {
        User::create([
            'first_name' => 'Admin',
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_role' => 1
        ]);
    }
}
