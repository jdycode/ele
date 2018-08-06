<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventPrizeController extends Controller
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
        $prs = EventPrize::all();
        return view('admin.prize.index',compact('prs'));
    }

    /*
     * 添加
     */

    public function add(Request $request)
    {
        //判断是否post提交
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request,[
                'name'=>'required',
                'description'=>'required',
            ]);
            $data = $request->post();
            //数据入库
//            dd($data);
            EventPrize::create($data);
            //提示 并跳转
            return redirect()->route('prize.index')->with('success','添加成功');
        }
        $eves = Event::all();
//        dd($eves);
        return view('admin.prize.add',compact('eves'));
    }
/*
 * 编辑
 */
    public function edit(Request $request,$id)
    {
        //找到当前id
        $prs = EventPrize::findOrFail($id);
        //判断是否post提交
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request,[
                'name'=>'required',
                'description'=>'required',
            ]);
            $data = $request->post();
            //数据入库
            $prs->update($data);
            //提示 并跳转
            return redirect()->route('prize.index')->with('success','修改成功');
        }
        $eves = Event::all();
//        dd($eves);
        return view('admin.prize.edit',compact('eves'));
    }

    /*
     * 删除
     */
    public function del($id)
    {
        //通过id找到当前数据
        $prs = EventPrize::findOrFail($id);
        //删除数据
        $prs->delete();
        //提示并跳转
        return redirect()->route('prize.index')->with('success','删除成功');
}
}
