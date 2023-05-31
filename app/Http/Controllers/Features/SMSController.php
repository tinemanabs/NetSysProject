<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SMSController extends Controller
{
    public function index()
    {
        $usersWithSMSUpdates = User::where('is_notify', 1)->get();

        //dd($usersWithSMSUpdates);
        return view('features.smsdashboard', [
            'users' => $usersWithSMSUpdates
        ]);
    }

    public function createSMS()
    {
        return view('features.sendsms');
    }

    //single messagings

    function itexmo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/createSMS')
                ->withErrors($validator)
                ->withInput();
        } else {
            try {
                $ch = curl_init();
                $numbers = DB::table('users')
                    ->where('is_notify', 1)
                    ->pluck('contact_no')
                    ->toArray();

                $itexmo = array(
                    'Email' => '', //put email 
                    'Password' => '', // put password
                    'ApiCode' => '', //put api code
                    'Recipients' => $numbers,
                    'Message' => $request->message
                );

                //print_r($itexmo);
                //return $itexmo;

                curl_setopt($ch, CURLOPT_URL, "https://api.itexmo.com/api/broadcast");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($itexmo));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);

                return $response;
            } catch (Exception $ex) {
                //return 'error';
                return $ex->getMessage();
            }
        }
    }
}
