<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventPrize;
use App\Models\EventUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except("login");
    }

    /*
     * 首页展示
     */

    public function index()
    {
        $eves = Event::all();
        //显示视图
        return view('admin.event.index', compact('eves'));
    }

    /*
     * 添加
     */
    public function add(Request $request)
    {
        //判断是否post提交
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                'title' => 'required',
                'content' => 'required',
                'signup_start' => 'required',
                'signup_end' => 'required',
                'prize_date' => 'required',
                'signup_num' => 'required',
            ]);
            $data = $request->post();
//            dd( $data);
            //数据入库
            Event::create($data);
            //提示并跳转
            return redirect()->route('event.index')->with('success', '添加成功');
        }
        //显示视图
        return view('admin.event.add');
    }

    /*
     * 编辑
     */
    public function edit(Request $request, $id)
    {
        //找到id
        $eves = Event::findOrFail($id);
        //判断是否post提交
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                'title' => 'required',
                'content' => 'required',
                'signup_start' => 'required',
                'signup_end' => 'required',
                'prize_date' => 'required',
                'signup_num' => 'required',
            ]);
            $data = $request->post();
//            dd( $data);
            //数据入库
            $eves->update($data);
            //提示并跳转
            return redirect()->route('event.index')->with('success', '添加成功');
        }
        //显示视图
        return view('admin.event.edit', compact('eves'));
    }

    /*
     * 开奖
     */
    public function open(Request $request, $id)
    {
        $users = EventUser::where('events_id', $id)->pluck('user_id')->toArray();
        $prices = EventPrize::where('events_id', $id)->pluck('id')->toArray();
        //打乱
        shuffle($users);
        shuffle($prices);
//        dd($prices);
        foreach ($prices as $k => $v){
            EventPrize::where('id', $v)->update(['user_id' => $users[$k]]);
        }
        //更改状态
    Event::findOrFail($id)->update(['is_prize'=>1]);
        //跳转
        return redirect()->route('event.index')->with('success','开奖成功');
    }

    /*
     * 删除
     */
    public function del($id)
    {
        //通过id找到当前数据
        $eve = Event::findOrFail($id);
        //删除数据
        $eve->delete();
        //提示并跳转
        return redirect()->route('event.index')->with('success', '删除成功');
    }
}
