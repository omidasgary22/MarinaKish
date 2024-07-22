<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store($request)
    {
        $product = Product::create($request->toArray());
        return response()->json(['message' => 'محصول با موفقیت ایجاد شد', 'product' => $product]);
    }

    public function update($request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());
        return response()->json(['message' => 'محصول با موفقیت به روز رسانی شد', 'product' => $product]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['محصول با موفقیت حذف شد ']);
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        return response()->json(['message' => ' محصول با موفقیت بازگردانده شد ', 'product' => $product]);
    }
}
