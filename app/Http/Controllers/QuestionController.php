<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $faqs = Question::all();
        return response()->json(['faqs' => $faqs]);
    }

    public  function store(StoreFAQRequest $request)
    {
        $faq = Question::create($request->toArray());
        return response()->json(['message' => 'سوال با موفقیت ایجاد شد', 'faq' => $faq], 201);
    }

    public function update(UpdateFAQRequest $request, $id)
    {
        $faq = Question::findorFail($id);
        $faq->update($request->toArray());
        return response()->json(['message' => 'سوال با موفقیت به روز رسانی شد.'], 200);
    }

    public function destroy($id)
    {
        $faq = Question::findOrFail($id);
        $faq->delete();
        return response()->json(['message' => 'سوال با موفقیت حذف شد.'], 200);
    }

}
