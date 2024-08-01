<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function store(Request $request)
    {
        $product = Product::with('sans:remaining,reserved')->find($request->product_id);


    }
}
