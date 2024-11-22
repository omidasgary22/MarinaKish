<?php

namespace App\Http\Controllers;

use App\Http\Requests\logoSettingRequest;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
        Setting::find($id)->update([
            'value' => $request->value,
            'updated_at' => Carbon::now()
        ]);
        $setting = Setting::findOrFail($id);
//        dd($setting);
        return response()->json(['message'=>'تنظیمات با موفقیت بروزرسانی شد','setting' => $setting]);
    }
    public function logo(logoSettingRequest $request)
    {
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {

            $image = Media::where('collection_name', 'logo')->first();
            if ($image) {
                Media::destroy($image->id);
            }
            $setting = Setting::first();
            $logo = $setting->addMedia($request->file('logo'))
                ->toMediaCollection('logo');

            // گرفتن URL از رسانه جدید
            $logoUrl = $logo->getFullUrl();
            Setting::findOrFail(5)->update([
                'value' => $logoUrl,
            ]);

            return response()->json(['logo' => 'لگو با موفقیت آپلود شد', 'url' => $logoUrl]);

        } else {
            return response()->json(['error' => 'فایل انتخاب شده نامعتبر است یا وجود ندارد'], 400);
        }
    }


}
