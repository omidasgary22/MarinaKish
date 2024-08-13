<?php

namespace App\Http\Controllers;

use App\Mail\VerifiedCode;
use App\Models\VerifingCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VerifingCodeController extends Controller
{
    public function MakeCode(Request $request, $type)
    {
        $verified = new VerifingCode();
        $phone = $request->phone;
        switch ($type) {
            case 'phone':
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
                break;
            case 'email':
                $email = $request->email;
                $code = fake()->randomNumber(5, true);
                $verified->create([
                    'email' => $email,
                    'code' => $code
                ]);
                Mail::to($email)->send(new VerifiedCode($email, $code));
                return response()->json(['message' => 'کد تایید برای شما ارسال شد']);
                break;
        }
    }
}
