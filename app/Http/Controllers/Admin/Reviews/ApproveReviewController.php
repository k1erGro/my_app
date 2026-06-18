<?php

namespace App\Http\Controllers\Admin\Reviews;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ApproveReviewController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Review $review)
    {
        if ($request->action == 'approve') {
            $review->update([
                'is_approved' => 1,
            ]);
        }
        else
        {
            $review->update([
                'is_approved' => 0,
            ]);
        }
        return redirect()->route('admin.reviews.index');
    }
}
