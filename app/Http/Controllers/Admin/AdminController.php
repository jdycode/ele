<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/7/22
 * Time: 16:53
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    /*
     * 注册
     */
    public function reg(Request $request)
    {
        //判断是否是post提交
        if($request->isMethod('post')){
//            dd($request->post());
            //验证
            $this->validate($request,[
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);
            $data=$request->post();
            $data['password']=bcrypt($request->post('password'));
            //插入数据
            Admin::create($data);
            //提示信息
            $request->session()->flash('success',"注册成功");
            //跳转
            return redirect()->route('admin.login');
        }
        //显示注册页面
        return view('admin.admin.reg');
}

/*
 * 登录
 */
    public function login(Request $request)
    {
        //判断是不是post提交
        if($request->isMethod('post')){
//            dd($request->post());
            //验证
            $this->validate($request,[
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
                ]);
           //登录
            if(Auth::guard('admin')->attempt(['name'=>$request->post('name'),'password'=>$request->post('password')])){
                //提示信息
                $request->session()->flash('success','登录成功');
                //跳转
                return redirect()->route('admin.index');
            }else{
                //提示信息
                $request->session()->flash('danger', '帐号或密码错误');
                //跳转
                return redirect()->back()->withInput();
            }
        }
        //显示注册页面
        return view('admin.admin.login');
}

/*
 * 显示列表
 */

    public function index(Request $request)
    {
        //得到所有数据
        $admins=Admin::all();
        //跳转
        return view('admin.admin.index', compact('admins'));
}

    /*
      * 退出
      */
    public function logout(Request $request)
    {
        //退出
        Auth::logout();
        //提示
        $request->session()->flash("success", "退出成功");
        //跳转
        return redirect()->route('admin.login');

    }
}