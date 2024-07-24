<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ProductController extends Controller
{
    public function index($id = null)
    {
        $products = new Product();
        if (!$id) {
            $products = Product::all();
        }
        $products = $products->find($id);
        return response()->json($products);
    }
    public function store(StoreProductRequest $request)
    {
        $user = new User();
        $user = $user->find(Auth::id());
        if($user->hasRole('admin')) {
            $product = new Product();
            $product = $product->create($request->toArray());
            return response()->json(['message' => 'محصول با موفقیت ایجاد شد', 'product' => $product]);
        }
    }
    public function update(Request $request, $id)
    {
        $user = new User();
        $user = $user->find(Auth::id());
        if ($user->hasRole('admin'))
        {
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

    public function restore($id)
    {
        $user = new User();
        $user = $user->find(Auth::id());
        if ($user->hasRole('admin')) {
            $product = new Product();
            $product = $product->withTrashed()->find($id);
            $product->restore();
            return response()->json(['message' => ' محصول با موفقیت بازگردانده شد ', 'product' => $product]);
        }
    }
}
