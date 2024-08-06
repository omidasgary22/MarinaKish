<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $faqs = Question::all();
        return response()->json(['faqs' => $faqs]);
    }
    public function update(UpdateQuestionRequest $request, $id)
    {
        $faq = Question::findorFail($id);
        $faq->update($request->toArray());
        return response()->json(['message' => 'سوال با موفقیت به روز رسانی شد.']);
    }

}
