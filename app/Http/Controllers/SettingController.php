<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return response()->json(["setting"=>$settings]);
    }
    public function update(Request $request)
    {
        $setting = Setting::find($request->keys())->updated($request->all());
        return response()->json($setting);
    }
}
