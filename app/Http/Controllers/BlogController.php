<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function Main_Index()
    {
        $data = Blog::with('media')->latest()->take(10)->get();
        return response()->json(['data' => $data]);
    }
    public function index($id = null)
    {
        if (!$id) {
            $blogs = Blog::all();
        }else{
            $blogs = Blog::findOrFail($id);
        }
        return response()->json(['blogs' => $blogs]);
    }

    public function store( StoreBlogRequest $request)
    {
        $blog = Blog::create($request->all());
        return response()->json(['message' => 'بلاک با موفقیت ایجاد شد', 'blog' => $blog], 201);
    }
    public function update( UpdateBlogRequest $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($request->all());
        return response()->json(['message' => 'بلاگ با موفقیت به روز رسانی شد', 'blog' => $blog]);
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return response()->json(['message' => 'بلاگ با موفقیت حذف شد']);
    }

    public function restore($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->restore();
        return response()->json(['message' => 'بلاگ با موفقیت بازیابی شد',]);
    }
}
