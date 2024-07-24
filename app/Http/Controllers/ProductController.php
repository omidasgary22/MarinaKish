<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($id)
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
        $product = new Product();
        $product = $product->create($request->toArray());
        return response()->json(['message' => 'محصول با موفقیت ایجاد شد', 'product' => $product]);
    }
    public function update($request, $id)
    {
        $product = new Product();
        $product = $product->find($id);
        $product->update($request->validated());
        return response()->json(['message' => 'محصول با موفقیت به روز رسانی شد', 'product' => $product]);
    }

    public function destroy($id)
    {
        $product = new Product();
        $product = $product->find($id);
        $product->delete();
        return response()->json(['محصول با موفقیت حذف شد ']);
    }

    public function restore($id)
    {
        $product = new Product();
        $product = $product->withTrashed()->find($id);
        $product->restore();
        return response()->json(['message' => ' محصول با موفقیت بازگردانده شد ', 'product' => $product]);
    }
}
