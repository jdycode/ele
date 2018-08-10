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
use EasyWeChat\Foundation\Application;
use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\Response\QrCodeResponse;

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
                'status' => "false",
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
        try {
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
            Cart::where('user_id', $request->post('user_id'))->delete();
            //提交数据
            DB::commit();
        } catch (\Exception $exception) {
            //回滚
            DB::rollBack();
            //返回数据
            return [
                'status' => "false",
                'message' => $exception->getMessage()
            ];
        }
        return [
            'status' => "true",
            'message' => '您的订单已生成',
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
            $data['goods_list'] = $good;
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
                "status" => "false",
                "message" => "你的余额不足"
            ];
        }
        //付款
        $member->money = $member->money - $order->total;
        $member->save();
//更改订单支付状态
        $order->status = 1;
        $order->save();
        return [
            "status" => "true",
            "message" => "支付成功"
        ];
    }

    /*
     * 微信支付
     */
    public function wxPay(Request $request)
    {
        //得到订单
        $order = Order::find($request->input('id'))->first();
//        dd(config('wechat'));
        //创建微信对象
        $app = new Application(config('wechat'));
//得到要支付的对象
        $payment = $app->payment;
//生成订单
        //1.订单配置
        $attributes = [
            'trade_type' => 'NATIVE', // JSAPI，NATIVE，APP...
            'body' => 'ele点餐',
            'detail' => 'ele点餐',
            'out_trade_no' => time(),
            'total_fee' => $order->total * 100, // 单位：分
            'notify_url' => 'http://jdyboss.com/api/order/ok', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            //   'openid'           => '当前用户的 openid', // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];
//订单生成
        $PayOrder = new \EasyWeChat\Payment\Order($attributes);
        //统一下单
        $result = $payment->prepare($PayOrder);
//        dd($result);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
            //取出预支付链接
            $payUrl = $result->prepay_id;
            //把支付链接生成二维码
//           $qrCode = new QrCode($payUrl);
//           header('Content-Type: '.$qrCode->getContentType());
//           echo $qrCode->writeString();

            $qrCode = new QrCode($payUrl);//二维码地址
            $qrCode->setSize(300);//二维码大小

// Set advanced options
            $qrCode->setWriterByName('png');
            $qrCode->setMargin(10);
            $qrCode->setEncoding('UTF-8');
            $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH);//容错级别
            $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
            $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
            $qrCode->setLabel('微信扫码支付', 16, public_path() . '/assets/noto_sans.otf', LabelAlignment::CENTER);
            $qrCode->setLogoPath(public_path() . '/assets/uu.jpg');
            $qrCode->setLogoWidth(100);
            $qrCode->setValidateResult(false);

// Directly output the QR code
            header('Content-Type: ' . $qrCode->getContentType());
            echo $qrCode->writeString();

            exit;
        }
    }

//微信异步通知
    public function ok()
    {
        //创建微信对象
        $app = new Application(config('wechat'));
        $response = $app->payment->handleNotify(function ($notify, $successful) {
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
//            $order = 查询订单($notify->out_trade_no);
            $order = Order::where('sn', $notify->out_trade_no)->first();

            if ($order->status !== 0) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }

            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->paid_at) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }

            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                // $order->paid_at = time(); // 更新支付时间为当前时间
                $order->status = 1;//更改订单状态
            }

            $order->save(); // 保存订单

            return true; // 返回处理完成
        });

        return $response;
    }


    /*
     * 订单状态
     */
    public function status(Request $request)
    {
        return [
            'status' => Order::find($request->input('id'))->status
        ];
    }
}