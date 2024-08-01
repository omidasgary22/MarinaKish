<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('user', 'product')->get();
        return response()->json(['comments' => $comments]);
    }

    public function store(CommentRequest $request)
    {
        $comment = Comment::create($request->toArray());
        return response()->json(['message' => 'نظر با موفقیت ایجاد شد', 'comment' => $comment], 201);
    }
}
