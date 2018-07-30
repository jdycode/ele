<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/7/24
 * Time: 17:59
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;


class ActivityController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin')->except("login");
    }
    /*
     * 显示首页
     */
    public function index()
    {
        //得到所有数据
        $acts = Activity::orderBy('id','desc')->paginate(2);
        //显示列表
        return view('admin.activity.index', compact('acts'));
    }

    /*
     * 添加
     */
    public function add(Request $request)
    {
       //判断是不是post提交
       if($request->isMethod('post')){
            //验证
           $this->validate($request,[
              'title'=>'required' ,
                'content'=>'required' ,
            ]);
           $data = $request->post();
           //插入数据
           Activity::create($data);
           //提示信息并跳转
        return redirect()->route('activity.index')->with('success','添加成功');
       }
        //显示列表
        return view('admin.activity.add');
    }


    /*
   * 编辑
   */
    public function edit(Request $request,$id)
    {
       $acts = Activity::findOrFail($id);
        //判断是不是post提交
        if($request->isMethod('post')){
            //验证
            $this->validate($request,[
            ]);
            $data = $request->post();
            //插入数据
            $acts->update($data);
            //提示信息并跳转
            return redirect()->route('activity.index')->with('success','添加成功');
        }
        //显示列表
        return view('admin.activity.edit',compact('acts'));
    }


    /*
     * 删除
     */
    public function del($id)
    {
        //找到当前数据
        $act = Activity::findOrFail($id);
        //删除数据
        $act->delete();
        //提示信息并跳转
        return redirect()->route('activity.index')->with('success','删除成功');
    }

}