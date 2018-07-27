<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin')->except("login");
    }
    /*
     * 列表
     */
    public function index()
    {
        //得到所有数据
        $cates = ShopCategory::paginate(2);
        //跳转
        return view("admin.shop_category.index", compact('cates'));
    }

    /*
 * 添加
 */
    public function add(Request $request)
    {
        //判断是不是post提交
        if ($request->isMethod('post')) {
            //验证信息是否合法  如果验证失败跳回回去
            $this->validate($request, [
                'name' => "required",
                'intro' => "required",
                'status' => "required",
            ]);
            //var_dump($request);exit;
            //接收数据
            $data = $request->all();
            $data['logo'] = '';
            if ($request->file('img')) {
                $data['logo'] = $request->file('img')->store('books', 'public_images');
            }
            //插入数据
            ShopCategory::create($data);
            //提示信息
            $request->session()->flash('success', '添加成功');
            //跳转
            return redirect()->route('shop_category.index');
        }
        //显示视图
        return view('admin.shop_category.add', compact('category'));
    }

    /*
     * 编辑
     */
    public function edit(Request $request, $id)
    {
        //通过id找到对象
        $cates = ShopCategory::find($id);
        //在data里面追加图片
        $data['logo'] = $request->logo;
        //判断是不是post提交
        if ($request->isMethod('post')) {
            //验证
//            $this->validate($request, [
//                'name' => "required",
//                'intro' => "required",
//                'status' => "required",
//            ]);
            //判断图片是否存在
            if ($request->file('img')) {
                //上传图片
                $data['logo'] = $request->file('img')->store('books', 'public_images');
            }
            //更新数据
            $cates->update($data);
            //提示信息
            $request->session()->flash('success', '修改成功');

            //跳转
            return redirect()->route('shop_category.index');
        }
        //显示视图
        return view('admin.shop_category.edit', compact('cates'));
    }

    /*
     * 删除
     */
    public function del(Request $request, $id)
    {
        //通过id找到对象
        $cates = ShopCategory::find($id);
        //删除数据
        $cates->delete();
        //提示信息
        $request->session()->flash('success', '删除成功');

        //跳转
        return redirect()->route('shop_category.index');
    }

}
