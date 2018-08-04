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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller {

    public function __construct()
    {
        $this->middleware('auth:admin')->except("login",'reg');
    }

    /*
     * 注册
     */
    public function reg(Request $request)
    {
        //判断是否是post提交
        if ($request->isMethod('post')) {
//            dd($request->post());
            //验证
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);
            $data = $request->post();
            $data['password'] = bcrypt($request->post('password'));
            //插入数据
            $admin = Admin::create($data);
            $admin->syncRoles($request->post('role'));
            //提示信息
            $request->session()->flash('success', "注册成功");
            //跳转
            return redirect()->route('admin.login');
        }
        $roles = Role::all();
//        dd($roles);
        //显示注册页面
        return view('admin.admin.reg',compact('roles'));
    }

    /*
     * 登录
     */
    public function login(Request $request)
    {
        //判断是不是post提交
        if ($request->isMethod('post')) {
//            dd($request->post());
            //验证
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);
            //登录
            if (Auth::guard('admin')->attempt(['name' => $request->post('name'), 'password' => $request->post('password')])) {
                //提示信息
                $request->session()->flash('success', '登录成功');
                //跳转
                return redirect()->route('admin.index');
            } else {
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
        $admins = Admin::all();
        //跳转
        return view('admin.admin.index', compact('admins'));
    }


    /*
     * 删除管理员
     */
    public function del($id)
    {
        //1号管理员不能删除
        if ($id == 1) {
            return back()->with('denger', '1号管理员不能删除');
        }
        $admin = Admin::findOrFail($id);
        $admin->delete();
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

    /**
     * 更改密码
     */
    public function edit(Request $request)
    {
        //判断是否POST提交
        if ($request->isMethod("post")){
            //验证
            $this->validate($request,[
                'old_password'=>'required',
                'password'=>'required|confirmed'
            ]);
            //得到当前用户对象
            $admin=Auth::guard('admin')->user();
            $oldPassword=$request->post('old_password');
            //3.判断老密码是否正确
            if (Hash::check($oldPassword,$admin->password)){
                //如果老密码正确 设置新密码
                $admin->password=Hash::make($request->post('password'));
                // 保存修改
                $admin->save();
                // 跳转
                return redirect()->route('admin.index')->with("success","修改密码成功");
            }
            //旧密码不正确
            return back()->with("danger","旧密码码不正确");
        }
        //显示视图
        return view("admin.admin.edit");
    }
}