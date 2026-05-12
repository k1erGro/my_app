<?php

namespace App\Http\Controllers\Admin\Reviews;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DeleteReviewController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Review $review)
    {
        try {
            $review->delete();
            return back()->with('success', 'Отзыв успешно удален');
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }
    }
}
