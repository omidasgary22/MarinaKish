<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function admin_index($id = null)
    {
        if (!$id)
        {
            $data = Comment::all();
        }else {
            $data = Comment::findOrFail($id);
        }
        return response()->json(['data' => $data]);
    }
    public function index($id = null)
    {
        if (!$id) {
            $comments = Comment::with('user', 'product')->get();
        }else{
            $comments = Comment::with('user', 'product')->findOrFail($id)->get();
        }
        return response()->json(['comments' => $comments]);
    }

    public function store(CommentRequest $request)
    {
        $comment = Comment::create($request->toArray());
        return response()->json(['message' => 'نظر با موفقیت ایجاد شد', 'comment' => $comment], 200);
    }

    public function update(CommentRequest $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($request->toArray());
        return response()->json(['message' => 'نظر با موفقیت به روز رسانی شد', 'comment' => $comment]);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return response()->json(['message' => 'نظر با موفقیت حذف شد']);
    }

    public function restore($id)
    {
        $user = Comment::onlyTrashed()->findOrFail($id);
        $user->restore();
        return response()->json(['message' => 'نظر با موفقیت بازیابی شد.'], 200);
    }
}
