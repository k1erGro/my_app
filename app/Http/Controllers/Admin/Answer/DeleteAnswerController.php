<?php

namespace App\Http\Controllers\Admin\Answer;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class DeleteAnswerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Answer $answer)
    {
        $answer->delete();
        return redirect()->route('admin.answer.list');
    }
}
