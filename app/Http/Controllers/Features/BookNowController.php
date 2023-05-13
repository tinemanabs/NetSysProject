<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookNowController extends Controller
{
    public function index()
    {
        return view('app.booknow');
    }
}
