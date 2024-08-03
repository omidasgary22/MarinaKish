<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Sans;
use http\Env\Response;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function store(Request $request)
    {
        $sans = new Sans();
        $order = new Order();
        $reserved = $order->where('day_reserved',$request->day_reserved)->where('sans_id',$request->sans_id)->sum('number');
        $capacity = $sans->find($request->sans_id);
        $total = $capacity->capacity;
        $order_sum = (int)$reserved;
        $remaining =  $total - $order_sum;
        if ($request->number <= $remaining){
            $order = $order->create($request->merge(['user_id'=>Auth::id()])->toArray());
            $order_id = $order->id;
            $order = Order::find($order_id);
            $order->passengers()->attach($request->passengers_id);
            $product_id = $request->product_id;
            $number = $request->number;
            FactorController::store($order_id,$product_id,$number);
            $order = Order::with('factor')->find($order_id);
            return response()->json(["message"=>'سفارش با موفقیت ثبت شد',"order"=>$order]);
        }else{
            return response()->json(["message"=>"ظرفیت پر است"]);
        }
    }
}
