<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mrgoon\AliSms\AliSms;

class MemberController extends Controller
{
    /*
     * 短信发送
     */
    public function sms(Request $request)
    {
        //接收手机号码
        $tel = $request->input('tel');
        //设置验证码
        $code = rand(1000, 9999);
        //把验证码存起来
        Redis::set("tel_" . $tel, $code);
        //设置验证码过期时间
        Redis::expire("tel_" . $tel, 300);
        //可以这样测试
        return [
            "status" => "true",
            "message" => "获取短信验证码成功" . $code
        ];
        //配置
        //短信发送
        $config = [
            'access_key' => 'LTAIZB5XDmEyaNfT',
            'access_secret' => 'oCsoy06A0M9b8Mb52mUeOjTZ9AUE73',
            'sign_name' => '蒋达勇',
        ];
        $aliSms = new AliSms();
        $response = $aliSms->sendSms($tel, 'SMS_140660142', ['code' => $code], $config);
        dd($response);
        //判断短信是否发送成功
        if ($response->Message === "ok") {
            //成功
            return [
                "status" => "true",
                "message" => "验证成功"
            ];

        } else {
            //失败
            return [
                "status" => "false",
                "message" => "验证失败"
            ];
        }
    }

    /*
     * 会员注册
     */
    public function reg(Request $request)
    {
        //接收数据
        $data = $request->all();
//        dd($data);
        //验证
        $validate = Validator::make($data, [
            'username' => 'required',
            'sms' => 'required',
            'tel' => [
                'required',
                'regex:/^o?(13|14|15|17|18|19)[0-9]{9}$/',
//                'unique:members'
            ],
            'password' => 'required|min:6'
        ]);
        //验证   如果验证错误 提示信息
        if ($validate->fails()) {
//返回错误信息
            return [
                'status' => "false",
                //得到错误信息
                'message' => $validate->errors()->first()
            ];
        }
        //验证验证码
        //取出验证码
        $code = Redis::get('tel_' . $data['tel']);
        //判断验证码是否一致
        if ($code != $data['sms']) {
            //返回错误信息
            return [
                'status' => 'false',
                'message' => "验证码错误"
            ];
        }
        //密码加密
        $data['password'] = bcrypt($data['password']);
//        dd($data);
        //数据入库
        Member::create($data);
        //        //返回信息
        return [
            'status' => "true",
            'message' => "注册成功"
        ];
    }

    /*
     * 登录
     */
    public function login(Request $request)
    {
        // 找出当前用户
        $member = Member::where("username", $request->post('name'))->first();
        //dd($member);
        //假如用户名存在则验证密码
        if ($member && Hash::check($request->post('password'), $member->password)) {
            return [
                'status' => 'true',
                'massage' => "登录成功",
                'user_id' => $member->id,
                'username' => $member->username
            ];
        }
        //帐号密码不存在或不正确登录失败
        return [
            'status' => 'false',
            'massage' => "登录失败"
        ];
    }

    /*
     * 重置密码
     */
    public function forget(Request $request)
    {
        //接收手机号码
        $tel = $request->input('tel');
        //得到当前用户对象
        $member = Member::where('tel', $tel)->first();
        //判断手机号码是否正确
        if ($member) {
            //接收新密码
            $data = $request->input();
//            密码加密
            $data['password'] = encrypt($data['password']);
            $member->save();
            return [
                'status' => "true",
                'massage' => "重置密码成功"
            ];
        }
        //失败
        return [
            'status' => 'false',
            'massage' => "重置密码失败"
        ];
    }

    /*
     * 修改密码
     */
    public function changePassword(Request $request)
    {
        //通过ID找到当前对象
        $member = Member::find($request->post('id'));
      //验证
        if (Hash::check($request->post('oldPassword'), $member->password)) {

            //接收新密码
            $data = $request->input();
            //新密码加密
            $member->password = bcrypt($data['newPassword']);
            //存入数据
            $member->save();
            if ($member) {
                return [
                    "status" => "ture",
                    "message" => "密码修改成功"
                ];
            }

        }

        return [
            "status" => "false",
            "message" => "原密码有误"
        ];
    }


    public function det(Request $request)
    {
       return Member::where('id',$request->all(['user_id']))->first();
    }
}
