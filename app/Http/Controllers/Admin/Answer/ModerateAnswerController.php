<?php

namespace App\Http\Controllers\Admin\Answer;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;

class ModerateAnswerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Answer $answer)
    {
        $action = $request->input('action');

        if (!in_array($action, ['approve', 'reject'])) {
            return back()->withErrors(['Неверное действие.']);
        }

        try {
            $answer->is_approved = ($action === 'approve');
            $answer->save();

            $message = $action === 'approve' ? 'Ответ одобрен.' : 'Ответ отклонён.';
            return back()->with('success', $message);
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }    }
}
