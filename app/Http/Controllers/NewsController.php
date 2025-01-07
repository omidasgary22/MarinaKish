<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsStoreRequest;
use App\Mail\News as MailNews;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsController extends Controller
{
   public function index()
   {
       $news = News::all()->sortByDesc('created_at')->paginate(10);
       return response()->json(['news_member'=>$news]);
   }
   public function store(NewsStoreRequest $request)
   {
       $restore = News::onlyTrashed()->where('email',$request)->first();
       if ($restore)
       {
           $restore->restore();
       }else {
           News::created($request);
       }
       return response()->json(['news_member'=>'شما با موفقیت در خبرنامه عضو شدید']);
   }
   static function send($code)
   {
       $members = News::all()->toArray();
       foreach ($members as $member) {
           Mail::to($member['email'])->send(new MailNews($code));
       }
   }
   public function delete(Request $request)
   {
       News::where('email',$request['email'])->delete();
       return response()->json('شما از خبر نامه خارج شدید');
   }
}
