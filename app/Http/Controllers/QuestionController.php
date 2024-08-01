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
}
