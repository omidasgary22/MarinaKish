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
        $reserved = $sans->withSum("orders","number",function (Builder $query)use($request){
            $query->where('order.day_reserved',$request->day_reserved);
        })->first();
        $total = $reserved->capacity;
        $order_sum = $reserved->orders_sum_number;
        $remaining =  $total - $order_sum;
        if ($request->number <= $remaining){
            $order = $order->create($request->merge(['user_id'=>Auth::id()])->toArray());
            $order_id = $order->id;
            $product_id = $request->product_id;
            $number = $request->number;
            FactorController::store($order_id,$product_id,$number);
            $order = with('factor')->find($order_id);
            return response()->json(["message"=>'سفارش با موفقیت ثبت شد',$order]);
        }else{
            return response()->json(["message"=>"ظرفیت پر است"]);
        }
    }
}
