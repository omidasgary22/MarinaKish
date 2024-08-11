<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function store(Request $request)
    {
        $passenger = new Passenger();
        $passenger = $passenger->onlyTrash()->where('national_code', $request->national_code)->first();
        if (!$passenger) {
            $passenger = $passenger->created($request->toArray());
        }else{
            $passenger->restore();
            $passenger->update($request->toArray());
        }
        return response()->json(['message'=>'گردشگر با موفقیت ثبت شد','passenger'=>$passenger]);
    }
    public function update(Request $request,$id)
    {
        $passenger = new Passenger();
        $passenger = $passenger->find($id);
        $passenger->update($request->toArray());
        return response()->json(['message'=>'اطلاعات گردشگر با موفقیت به روز رسانی شد','passenger'=>$passenger]);
    }
    public function destroy($id)
    {
        $passenger = new Passenger();
        $passenger = $passenger->find($id);
        $passenger->delete();
        return response()->json(['message'=>'گردشگر با موفقیت حذف شد']);
    }
}
