<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
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
            $products = $products->find($id);
        } else {
            $products = $products->with('sans')->orderBy('id', 'desc')->paginate(10);
        }
        return response()->json($products);
    }
    public function store(StoreProductRequest $request)
    {
        $user = new User();
        $user = $user->find(Auth::id());
        $time = $request->time;
        $pending = $request->pending;
        $total = $request->total;
        $started_at = Carbon::parse($request->started_at);
        $ended_at = Carbon::parse($request->ended_at);
        if ($user->hasRole('admin')) {
            $product = new Product();
            $product = $product->create($request->toArray());
            $id = $product->id;
            while ($started_at->lessThan($ended_at)) {
                Sans::create([
                    'product_id' => $id,
                    'start_time' => $started_at->toTimeString(),
                    'remaining' => $total,
                ]);
                $started_at->addMinute($pending + $time);
            }
            $product = Product::with('sans')->find($id);
            return response()->json(['message' => 'محصول با موفقیت ایجاد شد', 'product' => $product]);
        }
    }
    public function update(Request $request, $id)
    {
        $user = new User();
        $user = $user->find(Auth::id());
        if ($user->hasRole('admin')) {
            $product = new Product();
            $product = $product->find($id);
            $product->update($request->toArray());
            return response()->json(['message' => 'محصول با موفقیت به روز رسانی شد', 'product' => $product]);
        }
    }

    public function destroy($id)
    {
        $user = new User();
        $user = $user->find(Auth::id());
        if ($user->hasRole('admin')) {
            $product = new Product();
            $product = $product->find($id);
            $product->delete($id);
            return response()->json(['message' => 'محصول با موفقیت حذف شد ']);
        }
    }
}
