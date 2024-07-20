<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = User::create($request->merge(["password" => Hash::make($request->password)])->toArray());
        $user->assignRole('user');
        return response()->json($user);
    }
    public function index()
    {
        $user = new User();
        if (Auth::user()){
            $user = $user->find(Auth::id());
            if ($user->hasRole('admin')) {
                $users = $user->with('comments', 'orders')->orderBy('created_at', 'desc')->paginate(10);
            }
        }
        return response()->json($users);
    }
    public function me()
    {
        if (Auth::user()){
            $user = new User();
            $me = $user->with('comments', 'orders')->where('id',Auth::id())->first();
        }
        return response()->json($me);
    }
}
