<?php

namespace App\Http\Controllers\Shop;

use App\Models\User;
use App\Models\ShopCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * 注册
     */
    public function reg(Request $request)
    {
        if ($request->isMethod('post')) {
//            dd($request->post());
            //验证
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
          ]);

            //更新店铺表
            $shops = new Shop();
            //设置shop的状态为0 未审核
            $shops->status=0;
            $shops->shop_img='';
            //批量赋值
            $shops->fill($request->input());
//            dd($request->input());
            /*
             *   相当于    $shop->name=$_POST['shop_name'];
             */
            //图片上传
            $file=$request->file('shop_img');
            //dd($file);
            //判断是否需要上传了图片
            if($file){
                //需要上传就上传图片
                $shops->shop_img=$file->store('/uploads/books','public_images');
            }
//dd($shops->shop_img);
            //开启事务
            DB::transaction(function () use($shops,$request){
            //保存商家信息
                $shops->save();
            //添加用户信息
                User::create([
                    'shop_id' => $shops->id,
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password')),
                    'status'=>0
                ]);
            });

            //提示信息
            $request->session()->flash('success', '注册成功');
            //跳转
            return redirect()->route('user.login');
        }
        //得到所有商家分类
        $cates=ShopCategory::where('status',1)->get();
        //显示视图
        return view('shop.user.reg',compact('cates'));
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
                'password' => 'required',
                'email' => 'required',
            ]);
            //登录
            if (Auth::attempt(['name' => $request->post('name'), 'password' => $request->post('password')], $request->has('remenber'))) {
                //提示信息
                $request->session()->flash('success', '登录成功');
                //跳转  intended 从哪里来就跳哪里去，如果没有来路就跳默认页面
                return redirect()->intended(route('user.index'));
            } else {
                //提示信息
                $request->session()->flash('danger', '帐号或密码错误');
                //跳转  intended 从哪里来就跳哪里去，如果没有来路就跳默认页面
                return redirect()->back()->withInput();
            }
        }
        return view('shop.user.login');
    }

/*
 * 显示首页
 */
    public function index(Request $request)
    {
        //取到所有数据
        $users = User::all();
//        dd($users);
        return view('shop.user.index', compact('users'));
    }


    /*
     * 编辑
     */
    public function edit(Request $request, $id)
    {
        //通过id找到对象
        $users = User::findOrFail($id);
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
            $users->update($data);
            //提示信息
            $request->session()->flash('success', '修改成功');

            //跳转
            return redirect()->route('user.index');
        }
        //显示视图
        return view('shop.user.edit', compact('users'));
    }

    /*
     * 删除
     */
    public function del(Request $request, $id)
    {
        //通过id找到对象

        $users = User::findOrFail($id);
        //删除数据
        $users->delete();
        //提示
        $request->session()->flash('success', '删除成功');
        //跳转
        return redirect()->route('user.index');
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
        return redirect()->route('user.login');

    }
}
