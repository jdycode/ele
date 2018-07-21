<?php

namespace App\Http\Controllers\Shop;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class AdminController extends Controller
{
    /**
     * 注册
     */
    public function reg(Request $request)
    {
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
          ]);
            //接收数据
            $data = $request->all();
//           dd($data);

            //密码加密
            $data['password'] = bcrypt($data['password']);
            //入库
            Admin::create($data);
            //提示信息
            $request->session()->flash('success', '注册成功');
            //跳转
            return redirect()->route('admin.login');
        }
        //显示视图
        return view('shop.admin.reg');
    }
    /*
     * 登录
     */

    public function login(Request $request)
    {
        //判断是不是post提交
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                'name' => 'required',
                'password' => 'required',
                'email' => 'required',
            ]);
            //登录
            if (Auth::attempt(['name' => $request->post('name'), 'password' => $request->post('password')], $request->has('remenber'))) {
                //提示信息
                $request->session()->flash('success', '登录成功');
                //跳转  intended 从哪里来就跳哪里去，如果没有来路就跳默认页面
                return redirect()->intended(route('admin.index'));
            } else {
                //提示信息
                $request->session()->flash('danger', '帐号或密码错误');
                //跳转  intended 从哪里来就跳哪里去，如果没有来路就跳默认页面
                return redirect()->back()->withInput();
            }
        }
        return view('shop.admin.login');
    }


    public function index(Request $request)
    {
        //取到所有数据
        $admins = Admin::all();
//        dd($users);
        return view('shop.admin.index', compact('admins'));
    }


    /*
     * 编辑
     */
    public function edit(Request $request, $id)
    {
        //通过id找到对象
        $admins = Admin::find($id);
//        dd($request->post());
        $data=$request->post();
        //判断是不是post提交
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                'name' => 'required',
                'password' => 'required',
                'email' => 'required'
            ]);
            //更新数据
            $admins->update($data);
            //提示信息
            $request->session()->flash('success', '修改成功');

            //跳转
            return redirect()->route('admin.index');
        }
        //显示视图
        return view('shop.admin.edit', compact('admins'));
    }

    /*
     * 删除
     */
    public function del(Request $request, $id)
    {
        //通过id找到对象
        $admins = Admin::find($id);
        //删除数据
        $admins->delete();
        //提示
        $request->session()->flash('success', '删除成功');
        //跳转
        return redirect()->route('admin.index');
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
