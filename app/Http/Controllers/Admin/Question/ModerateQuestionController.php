<?php

namespace App\Http\Controllers\Admin\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class ModerateQuestionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Question $question)
    {
        $action = $request->input('action');

        if (!in_array($action, ['approve', 'reject'])) {
            return back()->withErrors(['Неверное действие.']);
        }

        try {
            if ($action === 'approve') {
                $question->is_approved = true;
                $message = 'Вопрос успешно одобрен.';
            } else {
                $question->is_approved = false;
                $message = 'Вопрос отклонён.';
            }
            $question->save();

            return back()->with('success', $message);
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }
    }
}
