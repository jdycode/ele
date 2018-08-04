<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{

    //商家列表
    public function list(Request $request)
    {
        //搜索
        //找到商家
        $keyword = $request->input('keyword??%');
        $shops = Shop::where('shop_name', 'like', "%$keyword%")->where('status', 1)->get();
//        dd($shops);

        foreach ($shops as $shop) {
            $shop->shop_img = "/uploads/" . $shop->shop_img;
            $shop->distance = rand(100, 5000);
            $shop->estimate_time = $shop->distance / 40;
        }
        return $shops;
    }


    public function index(Request $request)
    {
        //店铺id
        $id = $request->input('id');
//      dd($id);
        //取出当前店铺信息
        $shop = Shop::find($id);
        //添加配送距离和时间字段
        $shop->distance = rand(100, 5000);
        $shop->estimate_time = $shop->distance / 40;
        //给店铺添加评论
        $shop->evaluate = [
            ["user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http://www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 1,
                "send_time" => 30,
                "evaluate_details" => "不怎么好吃"],

            [
                "user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http://www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 4.5,
                "send_time" => 30,
                "evaluate_details" => "很好吃"
            ],
            [
                "user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http://www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 5,
                "send_time" => 30,
                "evaluate_details" => "很好吃"
            ],
        ];
        //得到所有分类
        $cates = MenuCategory::where('shop_id', $id)->get();
        //循环得到当前分类的所有数据
        foreach ($cates as $cate) {
            $shop->shop_img = $shop->shop_img;
            $cate->goods_list = Menu::where('shop_id', $cate->id)->get();
        }
        //把分类数据追加到$shop 里面
        $shop->commodity = $cates;
//        dd($shop);
        return $shop;
    }
}
