<?php

namespace App\Http\Controllers\Admin\Answer;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;

class ShowAnswerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Answer $answer)
    {
        return view('admin.answer.show', compact('answer'));
    }
}
