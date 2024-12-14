<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use App\Models\Offcode;
use App\Models\Order;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class OffcodeController extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $off_codes = Offcode::all();
        }else{
             $off_codes = Offcode::findOrFail($id);
        }
        return response()->json(['off code'=>$off_codes]);
    }
    public function store( Request $request)
    {
        $off_code = new Offcode();
        $code = $request->code;
        $off_code = $off_code->Create($request->toArray());
        return response()->json(['message'=>'کد تخفیف با موفقیت ثبت شد','off code' => $off_code]);
        NewsController::send($code);
    }
    public function update(Request $request,$id)
    {
        $off_code = new Offcode();
        $off_code = $off_code->findOrFail($id);
        $off_code->update($request->toArray());
        return response()->json(['message'=>'کد تخفیف با موفقیت به روزرسانی شد','off code'=>$off_code]);
    }
    public function use(Request $request,$code_id)
    {
        $price = $request->price;
        $off_code = new Offcode();
        $off_code = $off_code->findOrFail($code_id);
        $number = $off_code->number;
        $expire = $off_code->expire_time;
        $start = $off_code->start_time;
        $today = Carbon::now();
        if($number> 0)
        {
            if($off_code) {
                if ($today->isBefore($expire)) {
                    if ($today->isAfter($start)) {
                        $price_nagative = ($price * $off_code->percent) / 100;
                        $new_price = $price - $price_nagative;

                        $number = $number - 1;
                        Offcode::where("code", $request->code)->update([
                            'number' => $number
                        ]);
                        return response()->json(["new price" => $new_price]);
                    }
                }
            }
        }
        return response()->json('کد تخفیف معتبر نمی باشد');
    }
    public function delete($id)
    {
        $off_code = new Offcode();
        $off_code = $off_code->find($id);
        $off_code->delete();
        return response()->json(["message"=>'کد تخفیف با موفقیت غیر فعال شد']);
    }
    public function restore($id)
    {
        $off_code = new Offcode();
        $off_code = $off_code->onlyTrashed()->find($id);
        $off_code->restore();
        return response()->json(["message"=>'کد تخفیف با موفقیت باز گزدانی شد','off code'=> $off_code]);
    }
}
