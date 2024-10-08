<?php

namespace App\Http\Controllers;

use App\Http\Requests\PassengerCreateRequest;
use App\Http\Requests\PassengerUpdateRequest;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassengerController extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $passengers = Passenger::where('user_id',Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        }else{
            $passengers = Passenger::find($id);
        }
        return response()->json($passengers);
    }
    public function store(PassengerCreateRequest $request)
    {
        $passenger = new Passenger();
        $passenger = $passenger->onlyTrashed()->where('national_code', $request->national_code)->first();
        if (!$passenger) {
            $passenger = Passenger::create($request->merge(["user_id"=>Auth::id()])->toArray());
        }else{
            $passenger->restore();
            $passenger->update($request->toArray());
        }
        return response()->json(['message'=>'گردشگر با موفقیت ثبت شد','passenger'=>$passenger]);
    }
    public function update(PassengerUpdateRequest $request,$id)
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
