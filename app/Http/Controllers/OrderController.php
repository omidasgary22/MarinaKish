<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Passenger;
use App\Models\Product;
use App\Models\Sans;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index($id = null)
    {
        $order = new Order();
        $user = new User();
        $user = $user->find(Auth::id());
        if ($id){
            $order = $order->where('user_id', Auth::id())->where('id', $id)->with('factor')->first();
        }else{
            $order =$order->where('user_id', Auth::id())->with('factor:total_price')->get();
        }
        return response()->json($order);
    }
    public function admin_index($id = null)
    {
        $orders = new Order();
        if(!$id){
        $orders = $orders->with('factor:total_price')->get();
        }else{
            $orders = $orders->with('factor')->find($id);
        }
        return response()->json(['order'=>$orders]);
    }
    public function store(Request $request)
    {
        $sans = new Sans();
        $order = new Order();
        $user = User::find(Auth::id());
        $product = Product::find($request->product_id);
        $reserved = $order->where('day_reserved', $request->day_reserved)->where('sans_id', $request->sans_id)->sum('number');
        $capacity = $sans->find($request->sans_id);
        $total = $capacity->capacity;
        $limited = $product->age_limited;
        $order_sum = (int)$reserved;
        $age = (int)Carbon::parse($user->birth_day)->diff(Carbon::now())->format("%y");
        $remaining =  $total - $order_sum;
        $passengers = $request->passengers_id;
        if ($user->email) {
            if($request->number <= $remaining) {
                if ($limited <= $age) {
                    $order = $order->create($request->merge(['user_id' => Auth::id()])->toArray());
                    $order_id = $order->id;
                    $order = Order::find($order_id);
                    foreach ($passengers as $passenger) {
                        $id = $passenger;
                        $user = Passenger::find($id);
                        $passenger_age = (int)Carbon::parse($user->birth_day)->diff(Carbon::now())->format('%y');
                    }
                    if ($passenger_age >= $limited) {
                        $order->passengers()->attach($user);
                    } else {
                        return response()->json(['message' => "سن گردشگر{$passenger->name}کمتر از حد مجاز است"]);
                    }
                    $product_id = $request->product_id;
                    $number = $request->number;
                    FactorController::store($order_id, $product_id, $number);
                    $order = Order::with('factor')->find($order_id);
                    return response()->json(["message" => 'سفارش با موفقیت ثبت شد', "order" => $order]);
                }
            }else{
                return response()->json(['message' => "ظرفیت پر است"]);
            }

        } else {
            return response()->json(["message" => "پرفابل کاربری شما کامل نیس لطفا ان را تکمیل نمایید"]);
        }
        return response()->json(['message' => "خطادر ثبت سفارش"]);
    }
    public function destroy($id)
    {
        $order = new Order();
        $order->delete($id);
        return response()->json([
            "message" => 'سفارش با موفقیت لغو شد',
            'order' => $order
        ]);
    }
}
