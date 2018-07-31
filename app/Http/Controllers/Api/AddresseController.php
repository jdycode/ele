<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/7/30
 * Time: 10:12
 */

namespace App\Http\Controllers\Api;

use App\Models\Addresse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;


class AddresseController extends Controller
{
    /*
     * 添加地址
     */
    public function add(Request $request)
    {
//        dd($request->all());
//    验证
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'tel' => [
                'required',
                'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/'
            ],
        ]);
        //判断
        if ($validate->fails()) {
            //返回错误信息
            return [
                'status' => 'false',
                'massage' => $validate->errors()->first()
            ];
        }
//接收所有数据
        $data = $request->post();
        //存入数据
        Addresse::create($data);
        //提示
        return [
            'status' => 'true',
            'massage' => "添加成功"
        ];
    }

    /*
     * 地址列表
     */
    public function list(Request $request)
    {
        $data = $request->all();
//    dd($data);
   return Addresse::where('user_id', $data['user_id'])->get();
}

    /*
     * 修改
     */
    public function edit(Request $request)
    {
        $data = $request->all();
//       dd($data);
        $add = Addresse::FindOrfail($data['id']);
//        验证
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'tel' => [
                'required',
                'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/'
            ],
        ]);
        //判断
        if ($validate->fails()) {
            //返回错误信息
            return [
                'status' => 'false',
                'massage' => $validate->errors()->first()
            ];
        }
        //修改数据
       $add->update($data);
       return [
         'status'=>"true",
           'massage'=>'修改成功'
       ];
    }

}