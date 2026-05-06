<?php

namespace App\Http\Controllers\Answer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Answer\AnswerRequest;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreAnswerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AnswerRequest $request)
    {
        Answer::create([
            'user_id' => Auth::user()->getKey(),
            'product_id' => $request->integer('product_id'),
            'question_id' => $request->integer('question_id'),
            'description' => $request->string('description'),
        ]);
        return redirect()->back();
    }
}
