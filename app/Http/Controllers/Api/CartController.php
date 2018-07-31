<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/7/30
 * Time: 14:56
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Cart;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /*
     * 保存购物车
     */
    public function add(Request $request)
    {
        Cart::where('user_id', $request->input('user_id'))->delete();
        //接收所有数据
        $goods = $request->input('goodsList');
        $count = $request->input('goodsCount');
//      dd($goods);
        foreach ($goods as $k => $good) {
            $data = [
                'user_id' => $request->post('user_id'),
                'goods_id' => $good,
                'amount' => $count[$k],
            ];
            Cart::create($data);
        }
        return [
            "status" => "true",
            "message" => "添加成功"
        ];
    }

    /*
     * 获取购物车数据
     */
    public function cart(Request $request)
    {
        //通过id 确定购物车属于哪个用户
        $goods = Cart::where('user_id', $request->input('user_id'))->get();
        $sum = 0;
        //循环取出数据
        foreach ($goods as $good) {
            $menu = Menu::where('id', $good->goods_id)->first();
            //赋值
            $good['goods_name'] = $menu['goods_name'];
            $good['goods_img'] = $menu['goods_img'];
            $good['goods_price'] = $menu['goods_price'];
            $sum += $good['goods_price'] * $good->amount;
        }
        $data['goods_list'] = $goods;
        $data['totalCost'] = $sum;
        return $data;
    }
}