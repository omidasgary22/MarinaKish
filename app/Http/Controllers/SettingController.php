<?php

namespace App\Http\Controllers;

use App\Http\Requests\logoSettingRequest;
use App\Models\Media;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index($id = null)
    {
        if ($id == null) {
            $settings = Setting::all();
        }else {
            $settings = Setting::findOrFail($id);
        }
        return response()->json(["setting"=>$settings]);
    }
    public function update(Request $request)
    {
        $setting = Setting::find($request->keys)->updated([
            'value' => $request->value,
            'updated_at' => Carbon::now()
        ]);
        return response()->json($setting);
    }
    public function logo(logoSettingRequest $request)
    {
        $image = Media::where('collection_name','logo')->first();
        if ($image)
        {
            Media::destroy($image->id);
        }
        $logo = Setting::addMedia($request->file('logo'))->toMediaCollection('logo');
        $logo = $logo->getFullUrl();
        return response()->json($logo);

    }
}
