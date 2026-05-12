<?php

namespace App\Http\Controllers\Admin\Answer;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DeleteAnswerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Answer $answer)
    {
        try {
            DB::transaction(function () use ($request, $answer) {
                $answer->delete();
            });
            return back()->with('success', 'Ответ успешно удален');
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }
    }
}
