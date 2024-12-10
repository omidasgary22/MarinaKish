<?php

namespace App\Http\Controllers;

use App\Events\SansProcessed;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequesr;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Sans;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ProductController extends Controller
{
    public function index($id = null)
    {
        $products = new Product();
        if ($id) {
            $products = $products->with('sans')->find($id);
            $comments = Comment::where('product_id', $id)->where('status',"approved")->get();
        } else {
            $products = $products->all();
            $comments = null;
        }
        return response()->json($products,$comments);
    }
    public function admin_index($id =null)
    {
        if ($id) {
            $product = Product::findOrFail($id)->with('sans', 'orders', 'comments', 'labels');
        } else {
            $product = Product::all();
        }
        return response()->json(['product' => $product]);
    }
    public function store(StoreProductRequest $request)
    {
        $user = new User();
        $user = $user->find(Auth::id());
        $time = $request->time;
        $pending = $request->pending;
        $total = $request->total;
        $start_time = Carbon::parse($request->started_at);
        $ended_at = Carbon::parse($request->ended_at);
        $product = new Product();
        $product = $product->create($request->toArray());
        $id = $product->id;
        SansController::store($time, $pending, $total, $start_time, $ended_at, $id);
        $product = Product::with('sans')->find($id);
        return response()->json(['message' => 'محصول با موفقیت ایجاد شد', 'product' => $product]);
    }
    public function update(UpdateProductRequesr $request, $id)
    {
        $time = $request->time;
        $pending = $request->pending;
        $total = $request->total;
        $start_time = Carbon::parse($request->started_at);
        $ended_at = Carbon::parse($request->ended_at);
        $user = new User();
        $user = $user->find(Auth::id());
        $product = new Product();
        $product = $product->find($id);
        $product->update($request->toArray());
        SansController::update($time, $pending, $total, $start_time, $id, $ended_at);
        $product = Product::with('sans')->find($id);
        return response()->json(['message' => 'محصول با موفقیت به روز رسانی شد', 'product' => $product]);
    }

    public function destroy($id)
    {
        $user = new User();
        $user = $user->find(Auth::id());

        $product = new Product();
        $product = $product->find($id);
        $product->delete($id);
        return response()->json(['message' => 'محصول با موفقیت غیر فعال  شد ']);
    }
    public function restore($id)
    {
        $product = new Product();
        $product = $product->onlyTrashed()->findOrFail($id);
        $product->restore();
        return response()->json(["message" => 'محصول با موفقیت فعال شد']);
    }
    public function MarinaSuggestion()
    {
        $data = Product::where('marina_suggestion','yes')->get();
        return response()->json(['data' => $data]);
    }
    public function OffSuggestion()
    {
        $data = Product::where('off_suggestion','yes')->get();
        return response()->json(['data' => $data]);
    }
    public function Top()
    {
        $top = Product::withCount('orders')->orderBy('orders_count', 'desc')->take(10)->get();
        return response()->json(['top' => $top]);
    }
}
