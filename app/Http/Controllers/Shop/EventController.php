<?php

namespace App\Http\Controllers\Shop;

use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct()
{
    $this->middleware('auth:web')->except("login");
}
    /*
     * 首页展示
     */

    public function list()
    {
        $eves = Event::all();
        //显示视图
        return view('shop.event.list', compact('eves'));
    }

    /*
     * 查看活动
     */

    public function show(Request $request ,$id)
    {
        $eve= Event::findOrFail($id);
       $eve->num = EventUser::where('events_id',$eve->id)->count();
        //显示视图
        return view('shop.event.show', compact('eve'));
    }

    /*
     * 活动报名
     */

    public function check(Request $request,$id)
    {
       $eves=EventUser::create(['events_id'=>$id,'user_id'=>Auth::user()->id]);
   if ($eves){
         return redirect()->route('event.list')->with('success','报名成功');
   }
    }


}
