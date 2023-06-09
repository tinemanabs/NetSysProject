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
        $users = User::all()->where('user_role', 2);
        return view('features.useraccounts', [
            'users' => $users
        ]);
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

    public function getProfile(Request $request)
    {
        return DB::table('users')
            ->where('id', $request->id)
            ->first();
    }

    public function editProfile(Request $request)
    {
        DB::table('users')
            ->where('id', $request->id)
            ->update([
                'password' => Hash::make($request->password)
            ]);
    }

    public function checkPassword(Request $request)
    {
        $user = DB::table('users')
            ->where("id", $request->user_id)
            ->first();

        if (Hash::check($request->password, $user->password)) {
            return 'true';
        } else {
            return 'false';
        }
    }
}
