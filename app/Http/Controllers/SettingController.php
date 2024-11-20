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
    public function update(Request $request,$id)
    {
        $setting = Setting::find($id)->updated([
            'value' => $request->value,
            'updated_at' => Carbon::now()
        ]);
        return response()->json($setting);
    }
    public function logo(logoSettingRequest $request)
    {
        $setting = new Setting();
        $image = Media::where('collection_name','logo')->first();
        if ($image)
        {
            Media::destroy($image->id);
        }
        $logo = $setting->addMedia($request->file('logo'))->toMediaCollection('logo');
        $logo = Media::where('collection_name','logo')->getUrl();
        dd($logo);
        return response()->json(['logo' => 'لگو با موفقیت آپلود شد']);

    }
}
