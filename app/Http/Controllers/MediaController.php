<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Media;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    public function save_image(Request $request, $model, $id = null)
    {
        switch ($model) {
            case 'user':
                $model = new User();
                $model = $model->find(Auth::id());
                $exist = Media::where('model_id', Auth::id())->where('collection_name', 'profile')->first();
                if ($exist) {
                    $media = new Media();
                    $media->destroy('profile', $exist->id);
                }
                $profile = $model->addMedia($request->profile)->toMediaCollection('profile');
                return response()->json(['profile' => $profile]);
            case 'product':
                $model = new Product();
                $model = $model->find($id);
                $exist = Media::where('model_id', $id)->where('collection_name', 'product')->first();
                if ($exist) {
                    $media = new Media();
                    $media->destroy('product', $exist->id);
                }
                $image = $model->addMedia($request->image)->toMediaCollection('product');
                return response()->json(['image' => $image]);
            case 'blog':
                $model = new Blog();
                $model = $model->find($id);
                $exist = Media::where('model_id', $id)->where('collection_name', 'blog')->count('id');
                if ($exist = 2) {
                    $media = new Media();
                    $media->destroy('blog');
                }
                $image = $model->addMedia($request->image)->toMediaCollection('blog');
                return response()->json(['image' => $image]);
        }
    }
}
