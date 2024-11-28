<?php

namespace App\Http\Controllers;

use App\Mail\VerifiedCode;
use App\Models\VerifingCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VerifingCodeController extends Controller
{
    public function MakeCode(Request $request)
    {
        $verified = new VerifingCode();
        $phone = $request->phone;
        $code = fake()->randomNumber(5, true);
        $verified = $verified->create([
            'phone' => $phone,
            'type' => 'phone',
            'code' => $code,
        ]);
        $apiKey = "vDV6zMh8GADh2lFq7lKRhko7nq9PALWKI5-iLl3aC50=";
        $client = new \IPPanel\Client($apiKey);
        $patternValues = [
            "code" => $code,
        ];
        $messageId = $client->sendPattern(
            "zimrzynf416wg2j",    // pattern code
            "+983000505",      // originator
            $phone,  // recipient
            $patternValues,  // pattern values
        );
        return response()->json(['message' => 'کدتایید برای شما ارسال شد']);
    }
    public function CheckCode(Request $request)
    {
        $phone = $request->phone;
        $code = $request->code;
        $exist =VerifingCode::where('phone', $phone)->first();
        if ($exist){
            if ($code == $exist->code)
            {
                VerifingCode::where('phone', $phone)->delete();
                return response()->json(['message' => 'code is ok']);
            }else{
                return response()->json(['message' => 'کد نا معتبر است']);
            }
        }else{
            return response()->json(['message' => 'شماره تلفن نا معتبر است']);
        }
    }
}
