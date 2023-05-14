<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function showRoomsPage()
    {
        return view('features.rooms');
    }
}
