<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/7/31
 * Time: 10:58
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Addresse;
use App\Models\OrderGood;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function add(Request $request)
    {
        //确定地址
        $addr = Addresse::find($request->post('address_id'));
//    dd($addr);
        //判断地址是否正确
        if ($addr === null) {
            return [
                'status' => 'false',
                'massage' => "地址选择有误"
            ];
        }
        //得到用户id并赋值
        $data['user_id'] = $request->post('user_id');
        //通过购物车找到店铺id
        $carts = Cart::where('user_id', $request->post('user_id'))->get();
        //通过购物车找商品 再通过商品id找出shop_id
        $shopId = Menu::find($carts[0]->goods_id)->shop_id;
        //赋值
        $data['shop_id'] = $shopId;
        //生成订单号码
        $data['sn'] = date('ymdhms') . rand(1000, 9999);
        //收货地址信息
        $data['provence'] = $addr->provence;
        $data['city'] = $addr->city;
        $data['area'] = $addr->area;
        $data['detail_address'] = $addr->detail_address;
        $data['tel'] = $addr->tel;
        $data['name'] = $addr->name;

        //计算总价
        $sum = 0;
        foreach ($carts as $k => $v) {
            $good = Menu::where('id', $v->goods_id)->first();
            //计算
            $sum += $v->amount * $good->goods_price;
        }
        //赋值
        $data['total'] = $sum;
        //订单状态 待支付
        $data['status'] = 0;

//       return $data;
        //开启事务
        DB::beginTransaction();
        try{
            //创建订单
            $order = Order::create($data);
            //添加订单商品
            foreach ($carts as $k1 => $v1) {
                //找出当前商品
                $good = Menu::find($v1->goods_id);
                //构造数据
                $dataGoods['order_id'] = $order->id;
                $dataGoods['goods_id'] = $v1->goods_id;
                $dataGoods['amount'] = $v1->amount;
                $dataGoods['goods_img'] = $good->goods_img;
                $dataGoods['goods_name'] = $good->goods_name;
                $dataGoods['goods_price'] = $good->goods_price;
                //插入数据
                OrderGood::create($dataGoods);
            }
            //清空购物车
            Cart::where('user_id',$request->post('user_id'))->delete();
            //提交数据
            DB::commit();
        }catch (\Exception $exception){
            //回滚
            DB::rollBack();
            //返回数据
            return [
                'status' =>'false',
                'massage'=>$exception->getMessage()
            ];
        }
        return [
            'status' => 'true',
            'massage' => '添加成功',
            'order_id' => $order->id
        ];
    }

    /*
     * 订单数据
     */
    public function detail(Request $request)
    {
        $id = $request->all();
        //获取订单id
        $act = Order::where('id', $id)->first();
//      dd($request->id);
        //构造数据
        $data['id'] = $id['id'];
        $data['order_code'] = $act->sn;
        $data['order_birth_time'] = (string)$act->created_at;
        $data['order_status'] = $act->order_status;
        $data['shop_id'] = $act->shop_id;
        $shop = Shop::where('id', $act->shop_id)->first();
        $data['shop_name'] = $shop->shop_name;
        $data['shop_img'] = $shop->shop_img;
        $data['order_price'] = $act->total;
        $data['order_address'] = $act->province . $act->city . $act->area . $act->detail_address;
        $data['goods_list'] = OrderGood::where('order_id', $id['id'])->get();
        return $data;
    }

    /*
     * 订单列表
     */

    public function list(Request $request)
    {

        $id = \request()->all();
        $orders = Order::where("user_id", $id['user_id'])->get();
        $datas = [];
        foreach ($orders as $order) {
            $data['order_birth_time'] = (string)$order->created_at;
            $data['order_status'] = $order->order_status;
            $data['id'] = $order->id;
            $data['order_code'] = $order->sn;
            $shop = Shop::where('id', $order->shop_id)->first();
            $data['shop_name'] = $shop->shop_name;
            $data['shop_img'] = $shop->shop_img;
            $data['order_price'] = $order->total;
            $data['order_address'] = $order->provence . $order->city . $order->area . $order->detail_address;
            $good[] = OrderGood::where('order_id', $order->id)->first();
            $data['goods_list']= $good;
            $datas[] = $data;
        }

        return $datas;
    }

    /*
     * 支付
     */
    public function pay(Request $request)
    {
        //找到订单id
        $order = Order::find($request->post('id'));
        //找到该订单的用户
        $member = Member::find($order->user_id);
        //判断账户余额
        if ($order->total > $member->money) {
            return [
                'status' => 'false',
                'massage' => "你的余额不足"
            ];
        }
        //付款
        $member->money = $member->money - $order->total;
        $member->save();
//更改订单支付状态
        $order->status = 1;
        $order->save();
        return [
            'status' => 'true',
            'massage' => "支付成功"
        ];
    }
}