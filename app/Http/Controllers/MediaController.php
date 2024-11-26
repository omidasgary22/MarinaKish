<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
//    public function profile(Request $request)
//    {
//        $model = new User();
//        $model = $model->findOrFail(Auth::id());
//        $exist = Media::where('model_id', Auth::id())->where('collection_name', 'profile')->first();
//        if ($exist) {
//            Media::destroy('profile', $exist->id);
//        }
//        $profile = $model->addMedia($request->profile)->toMediaCollection('profile');
//        return response()->json(['message' => 'عکس پروفایل با موفقیت آپلود شد', 'profile' => $profile]);
//    }
    public function product(Request $request,$id)
    {
        $model = new Product();
        $model = $model->findOrFail($id);
        $exist = Media::where('model_id', $id)->where('collection_name', 'product')->first();
        if ($exist) {
            Media::where('model_id', $id)->where('collection_name', 'product')->delete();
        }
        $image = $model->addMedia($request->image)->toMediaCollection('product');
        return response()->json(['message' => 'عکس محصول با موفقیت آپلود شد','image' => $image]);
    }
    public function blog(Request $request, $id)
    {
                $model = new Blog();
                $model = $model->findOrFail($id);
                $exist = Media::where('model_id', $id)->where('collection_name', 'blog')->count('id');
                if ($exist === 2) {
                    Media::where('model_id', $id)->where('collection_name', 'blog')->first()->delete();
                }
                $image = $model->addMedia($request->image)->toMediaCollection('blog');
                return response()->json(["message" => "عکس بلاگ با موفقیت اظافه شد",'image' => $image]);
    }
    public function get_product($id)
    {
        $date = Product::findOrFail($id)->getMedia('product');
        return response()->json(['data' => $date]);
    }
    public function get_blog($id)
    {
        $data = Blog::findOrFail($id)->getMedia('blog');
        return response()->json(['data' => $data]);
    }
}
