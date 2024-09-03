<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use App\Models\Order;
use App\Models\Product;
use Evryn\LaravelToman\Facades\Toman;
use Evryn\LaravelToman\Money;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
        public static function store($id)
        {
            $price = Factor::find($id)->total_price;
            $mobile =auth()->user()->phone;
            $email = auth()->user()->email;
            $request = Toman::amount(Money::Toman($price))
                ->mobile($mobile)
                 ->email($email)
                ->request();

            if ($request->successful()) {
                $transactionId = $request->transactionId();
                // Store created transaction details for verification

                return $request->pay(); // Redirect to payment URL
            }

            if ($request->failed()) {
                return response()->json(['error' => $request->failed()], 400);
            }
        }
}
