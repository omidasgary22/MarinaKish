<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request){
        $user = new User();
        $national_code = $request->national_code;
        $password = $request->password;
        $code = $user->select('id','national_code','password')->where('national_code',$national_code)->first();
        $password = Hash::check($password,$user->password);
        if(!$code|!$password){
            return response()->json('password or national code wrong');
        }
    }
    public function create(Request $request)
    {
        $user = new User();
        $user->create($request->toArray());
        return response()->json($request);
    }


}
