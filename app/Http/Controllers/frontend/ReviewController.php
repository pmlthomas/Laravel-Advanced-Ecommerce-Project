<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function StoreReview(Request $request)
    {
        Review::insert([
            'ranking' => $request->rating,
            'comment' => $request->comment,
            'author' => $request->author,
            'review_title' => $request->review_title,
            'product_id' => $request->id,
            'created_at' => Carbon::now('Europe/Paris'),
        ]);

        return redirect()->back();
    }
}
