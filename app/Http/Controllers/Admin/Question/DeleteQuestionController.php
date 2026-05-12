<?php

namespace App\Http\Controllers\Admin\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DeleteQuestionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Question $question)
    {
        try {
            $question->delete();
            return back()->with('success', 'Вопрос успешно удален');
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }
    }
}
