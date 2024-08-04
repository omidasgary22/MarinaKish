<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetpasswordRequest;
use App\Http\Requests\UserUpdateRequest;
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
        }
        if (!Hash::check($password, $user->password)) {
            return response()->json('password wrong');
        }
        $token = $user->createToken($code)->plainTextToken;
        return response()->json(['token' => $token]);
    }
    public function logout()
    {
        $user = new User();
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
        return response()->json($users);
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
    public function resetPassword(Request $request)
    {
        $user = new User();
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $password = $user->where('id', Auth::id())->first();
        if (!Hash::check($password->password, $old_password)) {
            return response()->json('old password wrong');
        }
        $password = $password->update(['password' => $new_password])->where('id', Auth::id());
        $user = $user->where('id', Auth::id())->first();
        $user->update(['password' => Hash::make($new_password)]);
        return response()->json($user);
    }
}
