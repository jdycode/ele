<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/7/23
 * Time: 18:31
 */

namespace App\Http\Controllers\Shop;


use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {

        $menus =Menu::all();
        return view('shop.menu.index',compact('menus'));
}

    /*
    * 添加
    */
    public function add(Request $request)
    {
        $cates = Shop::all();
        $menus= MenuCategory::all();
        //取出所有商品分类信息
        $menu = Menu::all();
        //判断是不是post提交
        if ($request->isMethod('post')) {

            //验证信息是否合法  如果验证失败跳回回去
            $this->validate($request, [
                'goods_name' => "required",
                'rating' => "required",
                'shop_id' => "required|int",
                'category_id' => "required",
                'goods_price' => "required",
                'description' => "required",
                'month_sales' => "required",
                'rating_count' => "required",
                'tips' => "required",
                'satisfy_count' => "required",
                'satisfy_rate' => "required",
            ]);
            //var_dump($request);exit;
            //接收所有数据
            $data = $request->all();
//            dd($data);
            $data['logo'] ='';
            //上传图片
            if($request->file('img')){
                $filename = ImageUploadTool::save($request->file('img'), "books", 'jdy');
                //在data里追加上传的文件
                $data['logo'] = $filename;
            }
            //插入数据
            Menu::create($data);
            //提示信息
            $request->session()->flash('success', '添加成功');
            //跳转
            return redirect()->route('menu.index');
        }
        return view('shop.menu.add', compact('menu', 'menus','cates'));
    }
}