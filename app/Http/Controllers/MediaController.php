<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    public function save_image(Request $request,$model,$id = null)
    {
        switch ($model) {
            case 'user':
                $model = new User();
                $model = $model->find(Auth::id());
                $profile = $model->addMedia($request->profile)->toMediaCollection('profile');
                return response()->json(['profile' =>$profile]);
            case 'product':
                $model = new Product();
                $model = $model->find($id);
                $image = $model->addMedia($request->image)->toMediaCollection('product');
                return response()->json(['image'=>$image]);
            case 'blog':
                $model = new Blog();
                $model = $model->find($id);
                $image = $model->addMedia($request->image)->toMediaCollection('blog');
                return response()->json(['image'=>$image]);
        }
    }
}
