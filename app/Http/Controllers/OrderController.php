<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function store(Request $request)
    {
        $order = new Order();
        $number_reserved= $order->withSum('number')->where('product_id',$request->product_id)->where('create_at',$request->date)->get();
        $product = Product::select('id','total')->where('id',$request->product_id);
        dd($product,$number_reserved);
    }
}
