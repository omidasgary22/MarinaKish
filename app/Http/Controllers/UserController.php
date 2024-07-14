<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $code = $request->national_code;
        $password = $request->password;
        $user = User::select('id', 'national_code', 'password')->where('national_code', $code)->first();
        if (!$user) {
            return response()->json('national_code wrong');
        }if(!Hash::check($password ,$user->password)){
            return response()->json('password wrong');
        }
        $token = $user->createToken($code)->plainTextToken;
        return response()->json(['token'=>$token]);
    }
    public function create(Request $request)
    {
        $User = User::create($request->merge(["password" => Hash::make($request->password)])->toArray());
        return response()->json($User);
    }
}
