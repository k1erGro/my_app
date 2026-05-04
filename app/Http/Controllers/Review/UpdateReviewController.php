<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\ReviewRequest;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateReviewController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ReviewRequest $request, Review $review)
    {
        $review->update([
            'user_id' => Auth::user()->getKey(),
            'product_id' => $request->integer('product_id'),
            'review' => $request->string('review'),
            'rating' => $request->float('rating'),
        ]);
        return redirect()->back();
    }
}
