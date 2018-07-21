<?php


namespace App\Http\Controllers\Admin;

use App\Models\ShopCategory;
use App\Models\Shops;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    public function index()
    {
        $cate=ShopCategory::all();
        $shops=Shops::all();
        return view('admin.shops.index',compact('shops','cate'));
     }
/*
 * 添加
 */
    public function add(Request $request)
    {
        $cates=ShopCategory::all();
        //判断是不是post提交
        if ($request->isMethod('post')) {

            //验证信息是否合法  如果验证失败跳回回去
//            $this->validate($request, [
//                'shop_category_id' => "required",
//                'shop_name' => "required",
//                'shop_img' => "required",
//                'shop_rating' => "required",
//                'brand' => "required",
//                'on_time' => "required",
//                'fengniao' => "required",
//                'bao' => "required",
//                'piao' => "required",
//                'zhun' => "required",
//                'start_send' => "required",
//                'send_cost' => "required",
//                'notice' => "required",
//                'discount' => "required",
//                'status' => "required",
//            ]);

            //接收数据
            $data = $request->post();
            $data['shop_img'] = '';
            if ($request->file('img')) {
                $data['shop_img'] = $request->file('img')->store('books', 'public_images');
            }

            //插入数据
            Shops::create($data);
            //提示信息
            $request->session()->flash('success', '添加成功');
            //跳转
            return redirect()->route('shops.index');
        }
        //显示视图
        return view('admin.shops.add', compact('cates'));
    }
/*
 * 编辑
 */
    public function edit(Request $request, $id)
    {
        $cates=ShopCategory::all();
        //通过id找到对象
        $shops = Shops::find($id);
        //在data里面追加图片
        $data['img'] = $shops ->shop_img;
        //判断是不是post提交
        if ($request->isMethod('post')) {
            //验证
//           $this->validate($request, [
//                'shop_category_id' => "required",
//                'shop_name' => "required",
//                'shop_img' => "required",
//                'shop_rating' => "required",
//                'brand' => "required",
//                'on_time' => "required",
//                'fengniao' => "required",
//                'bao' => "required",
//                'piao' => "required",
//                'zhun' => "required",
//                'start_send' => "required",
//                'send_cost' => "required",
//                'notice' => "required",
//                'discount' => "required",
//                'status' => "required",
//            ]);
            //判断图片是否存在
            if ($request->file('img')) {
                //上传图片
                $data['shop_img'] = $request->file('img')->store('books', 'public_images');
            }
            //更新数据
            $shops->update($data);
            //提示信息
            $request->session()->flash('success', '修改成功');

            //跳转
            return redirect()->route('shops.index');
        }
        //显示视图
        return view('admin.shops.edit', compact('shops','cates'));
    }

    public function del(Request $request,$id)
    {
        //通过id找到对象
        $shops = Shops::find($id);
        //删除数据
        $shops->delete();
        //提示信息
        $request->session()->flash('success', '删除成功');
        //跳转
        return redirect()->route('shops.index');
    }

    }