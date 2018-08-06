<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
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
        $mem = Member::paginate(10);
        return view('admin.member.index',compact('mem'));
    }
    /*
     * 添加
     */
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'username' => 'required',
                'tel' => [
                    'required',
                    'regex:/^o?(13|14|15|17|18|19)[0-9]{9}$/',
//                'unique:members'
                ],
                'password' => 'required|min:6'
            ]);
           $data = $request->post();
            $data['password']=bcrypt($data['password']);
           //插入数据
            Member::create($data);
            //提示并跳转
            return redirect()->route('member.index')->with('success','添加成功');
        }
        //显示视图
        return view('admin.member.add');
}

    /*
     * 充值金额
     */

    public function edit(Request $request,$id)
    {
        $mems= Member::findOrFail($id);
//      dd($mems['money']);

        //判断是否post提交
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request,[
               'money'=>'required',
            ]);
            $money = $request->post('money');
            $data['jifen']= $money ;
//            dd($money);
            $data['money'] =$mems['money']+$money;
            //更新数据
            $mems->update($data);
            //提示信息  跳转
  return redirect()->route('member.index')->with('success','充值成功');
        }
        //显示视图
        return view('admin.member.edit',compact('mems'));
    }
    
    /*
     * 删除
     */
    public function del($id)
    {
        $mem = Member::findOrFail($id);
        //删除数据
       $mem->delete();
        //提示并跳转
        return redirect()->route('member.index')->with('success','删除成功');
    }
}
