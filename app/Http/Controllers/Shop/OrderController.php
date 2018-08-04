<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/8/1
 * Time: 14:42
 */

namespace App\Http\Controllers\Shop;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    /*
     * 订单首页
     */
    public function index(Request $request)
    {
        $orders =Order::where('shop_id',Auth::user()->shop_id)->paginate(5);
//       dd($orders);

        return view('shop.order.index',compact('orders'));
 }
 
 /*
  * 改变订单状态
  */

    public function change($id,$status)
    {
        $orders =Order::where('shop_id',Auth::user()->shop_id)->where('id',$id)->update(['status'=>$status]);
        if($orders){
            return redirect()->route('order.index')->with('success','改变状态成功');
        }
 }

 /*
  * 查看
  */
    public function select(Request $request,$id)
    {
      $rsts = Order::find($id);
      $ordergoods= $rsts->goods;
//        //显示视图
       return view('shop.order.select',compact('rsts','ordergoods'));
}



    /*
     * 每日统计
     */
    public function day(Request $request)
    {
        $days= Order::where("shop_id", 2)->Select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as day,SUM(total) AS money,count(*) AS count"))->groupBy("day")->orderBy("day", 'desc')->limit(30);
        //接收参数
        $start = $request->input('start');
        $end = $request->input('end');
        //判断是否有起始时间
        if ($start !== null) {
            $days->whereDate("created_at", '>=', $start);
        }
        if ($end !== null) {
            $days->whereDate("created_at", '<=', $end);
        }
        //得到每日统计
        $orders = $days->get();
        //显示视图
        return view('shop.order.day', compact('orders'));
    }
/*
 * 每月统计
 */

    public function month(Request $request)
    {
        $months= Order::where("shop_id", 2)->Select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month,SUM(total) AS money,count(*) AS count"))->groupBy("month")->orderBy("month", 'desc')->limit(30);
//        dd($months);
        //接收参数
        $start = $request->input('start');
        $end = $request->input('end');
        //判断是否有起始时间
        if ($start !== null) {
            $months->whereDate("created_at", '>=', $start);
        }
        if ($end !== null) {
            $months->whereDate("created_at", '<=', $end);
        }
        //得到每日统计
        $orders = $months->get();
        //显示视图
        return view('shop.order.month', compact('orders'));
    }

}