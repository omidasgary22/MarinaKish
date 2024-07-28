<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return response()->json(['blogs' => $blogs]);
    }

    public function store($request)
    {
        $blog = Blog::create($request->all());
        return response()->json(['message' => 'بلاک با موفقیت ایجاد شد', 'blog' => $blog], 201);
    }

    public function show($id)
    {
        $blog = Blog::findOrFaill($id);
        return response()->json(['blog' => $blog]);
    }

    public function update($request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($request->all());
        return response()->json(['message' => 'بلاگ با موفقیت به روز رسانی شد', 'blog' => $blog]);
    }
}
