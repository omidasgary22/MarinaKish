<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
        public static function store($id)
        {
            $price = Factor::find($id)->total_price;
            $token = config('services.pay_token');
            $args = [
                "amount" =>$price,
        "payerIdentity" => "شناسه کاربر در صورت وجود",
        "payerName" => "نام کاربر پرداخت کننده",
        "description" => "توضیحات",
        "returnUrl" => "آدرس برگشتی از سمت درگاه",
        "clientRefId" => "شماره فاکتور"
    ];

    $payment = new \PayPing\Payment($token);

    try {
        $payment->pay($args);
    } catch (\Exception $e) {
        var_dump($e->getMessage());
    }
    //echo $payment->getPayUrl();

    header('Location: ' . $payment->getPayUrl());
        }
}
