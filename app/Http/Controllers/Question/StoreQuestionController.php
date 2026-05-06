<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Http\Requests\Question\QuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreQuestionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(QuestionRequest $request)
    {
        Question::create([
            'user_id' => Auth::user()->getKey(),
            'product_id' => $request->integer('product_id'),
            'title' => $request->string('title'),
            'description' => $request->string('description'),
        ]);
        return redirect()->back();
    }
}
