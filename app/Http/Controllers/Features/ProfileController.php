<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        return view('auth.features.editprofile', [
            'user' => $user
        ]);
    }

    public function updatePersonalInfo(Request $request)
    {
        DB::table('users')
            ->where('id', $request->user_id)
            ->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'birthday' => $request->birthday,
                'contact_no' => $request->contact_no
            ]);
    }

    public function updatePassword(Request $request)
    {
        DB::table('users')
            ->where('id', $request->user_id)
            ->update([
                'password' => Hash::make($request->password)
            ]);
    }
}
