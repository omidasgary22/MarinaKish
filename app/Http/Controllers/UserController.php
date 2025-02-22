<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangepasswordRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetpasswordRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $code = $request->national_code;
        $password = $request->password;
        $user = User::select('id', 'national_code', 'password')->where('national_code', $code)->first();
        if (!$user) {
            return response()->json('national_code wrong');
        }
        if (!Hash::check($password, $user->password)) {
            return response()->json('password wrong');
        }
        $token = $user->createToken($code)->plainTextToken;
        return response()->json(['token' => $token,"role" => $user->getRoleNames()]);
    }
    public function logout()
    {
        $user = new User();
        $user = $user->find(Auth::id());
        $user->tokens()->delete();
    }
    public function create(RegisterRequest $request)
    {
        $user = new User();
        $code = $request->national_code;
        $user = $user->onlyTrashed()->where('national_code',$code)->first();
        if ($user)
        {
            $user->onlyTrashed()->restore();
            $user->update($request->all());
        }else {
            $user = User::create($request->toArray());
            $user->assignRole('user');
        }
        return response()->json(["message"=>'ثبت نام با موفقیت انجام شد',"user"=>$user]);
    }
    public function update(UserUpdateRequest $request)
    {
        $user = new User();
        $user = $user->find(Auth::id());
        $user->update($request->toArray());
        return response()->json($user);
    }
    public function index()
    {
        $user = new User();
        $user = $user->find(Auth::id());
        if ($user->hasRole('admin')) {
            $users = $user->with('comments', 'orders', 'tickets','passengers')->orderBy('created_at', 'desc')->paginate(10);
        }
        return response()->json(['users'=>$users]);
    }
    public function me()
    {
        $user = new User();
        $me = $user->with('comments', 'orders', 'tickets','passengers')->where('id', Auth::id())->first();
        return response()->json($me);
    }

    public function destroy()
    {
        $user = new User();
        $user = $user->findOrfail(Auth::id());
        $user->delete();
        return response()->json(['message' => 'کاربر با موفقیت حذف شد.']);
    }
    public function chpassword(ResetpasswordRequest $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['error' => 'رمز عبور قبلی اشتباه است'], 400);
        }
        $user->update(['password' => Hash::make($request->new_password)]);

        return response()->json(['message' => 'رمز عبور شما با موفقیت تغییر کرد']);

    }
    public function forgotPassword(ChangepasswordRequest $request)
    {
        $phone = $request->phone;
        $password = fake()->randomNumber(8,true);
        $user = User::where('phone',$phone)->update(['password' => Hash::make($password)]);
        if ($user) {
            $patternValues = [
                "password" => $password,
            ];
            $apiKey = "vDV6zMh8GADh2lFq7lKRhko7nq9PALWKI5-iLl3aC50=";

            $client = new \IPPanel\Client($apiKey);

            $messageId = $client->sendPattern(
                "udd15ycqfsymdyc",    // pattern code
                "+983000505",      // originator
                $phone,  // recipient
                $patternValues  // pattern values
            );
            return response()->json(['message' => 'رمز عبور جدید برای شما ارسال شد']);
        }
        return \response()->json(['massage' => 'شماره همراه موجود نمی باشد']);
    }
}
