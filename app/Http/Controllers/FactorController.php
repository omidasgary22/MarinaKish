<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class FactorController extends Controller
{
    static function store($order_id,$product_id,$number)
    {
        $factor = new Factor();
        $price = Product::select('price')->where('id',$product_id)->first()->price;
        $total_price = $price * $number;
        $factor = $factor->create([
            'order_id' => $order_id,
            'total_price' => $total_price,
        ]);
        $factor_id = $factor->id;
        Order::where('id',$order_id)->update(['factor_id'=>$factor_id]);
    }
}
