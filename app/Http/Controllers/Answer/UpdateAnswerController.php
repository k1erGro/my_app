<?php

namespace App\Http\Controllers\Answer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Answer\AnswerRequest;
use App\Http\Requests\Question\QuestionRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateAnswerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AnswerRequest $request, Answer $answer)
    {
        $answer->update([
            'user_id' => Auth::user()->getKey(),
            'product_id' => $request->integer('product_id'),
            'question_id' => $request->integer('question_id'),
            'description' => $request->string('description'),
        ]);
        return redirect()->back();
    }
}
