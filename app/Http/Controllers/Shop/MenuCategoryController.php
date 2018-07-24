<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/7/23
 * Time: 14:44
 */

namespace App\Http\Controllers\Shop;

use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class MenuCategoryController extends Controller
{

    public function index()
    {
        $cates = MenuCategory::all();
//        dd($cates);
        //显示首页
        return view('shop.menu_cate.index', compact('cates'));

    }
/**
 * 添加
 */

    public function add(Request $request)
    {
        $cates = Shop::all();
        //判断是不是post提交
        if($request->isMethod('post')){
            //验证信息是否合法
            $this->validate($request, [
                'name' => "required",
                'type_accumulation' => "required",
                'description' => "required",
            ]);
//            //接收数据
            $data = $request->all();
            //写入数据
           MenuCategory::create($data);
            //提示信息
            $request->session()->flash('success', '添加成功');
            //跳转
            return redirect()->route('menu_cate.index');
        }
        return view('shop.menu_cate.add',compact('cates'));

    }

/*
 * 编辑
 */
    public function edit(Request $request,$id)
    {
        $cates= MenuCategory::find($id);
        //判断是不是post提交
//        dd($cates);
        if($request->isMethod('post')){
            //验证信息是否合法
            $this->validate($request, [
                'name' => "required",
                'type_accumulation' => "required",
                'description' => "required",
            ]);
            //修改数据
           $cates->update();
            //提示信息
            $request->session()->flash('success', '修改成功');
            //跳转
            return redirect()->route('menu_cate.index','cates');
        }
        return view('shop.menu_cate.edit');

    }

    /*
     * 删除
     */
        public function del(Request $request,$id)
    {
        //通过id找到对象
        $cates = MenuCategory::find($id);
        //删除数据
        $cates->delete();
        //提示信息
        $request->session()->flash('success', '删除成功');

        //跳转
        return redirect()->route('menu_cate.index');
    }
}