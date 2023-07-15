<?php

namespace App\Http\Controllers\Features\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Reviews;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function getLatestReviews()
    {
        return Reviews::with('createdBy')->latest()->take(3)->get();
    }

    public function getUserReviews(Request $request)
    {
        return Reviews::where('user_id', $request->user_id)->get();
    }

    public function addUserReviews(Request $request)
    {
        return Reviews::create([
            'user_id' => $request->user_id,
            'rating' => $request->rating,
            'description' => $request->description
        ]);
    }
}
